<?php
// This file is part of the auth_neon plugin for Moodle - http://moodle.org/
//
// This software is Copyright(c) 2016 by Greg Harley - https://github.com/gharley/neon-auth-moodle
// License - MIT https://opensource.org/licenses/MIT MIT

/**
 * Login with Neon CRM password.
 *
 * @package auth_none
 * @author Greg Harley
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * Inspired by the lenauth plugin by Igor Sazonov ( @tigusigalpa )
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/authlib.php');
require_once('neon.php');

/**
 * Plugin for neon authentication.
 */
class auth_plugin_neon extends auth_plugin_base{
  private $usingSandbox = true;

  /**
   * Neon webservice settings
   *
   * request_token_url (set in constructor) endpoint for requesting auth token
   * grant_type always 'authorization_code'
   * request_api_url API endpoint for retrieving user data
   */
  protected $_settings = array(
      'grant_type' => 'authorization_code',
      'request_api_url' => 'https://api.neoncrm.com/neonws/services/api',
  );

  protected $_config;
  protected $_last_user_number = 0;

  private static $_instance;

  function auth_plugin_neon(){
    global $DB;

    $this->_settings['request_token_url'] = $this->usingSandbox ? 'https://trial.z2systems.com/np/oauth/token' : 'https://z2systems.com/np/oauth/token';

    $this->authtype = 'neon';
    $this->_config = get_config('auth/neon');
    $this->roleauth = 'auth_neon';
    $this->errorlogtag = '[AUTH neon]';
  }

  public static function getInstance(){
    if( !isset(self::$_instance) && !(self::$_instance instanceof auth_plugin_neon) ){
      self::$_instance = new self();
    }

    return self::$_instance;
  }

  private function showDataAndDie($data, $die = false){
    echo '<pre>';
    print_r($data);
    echo '</pre>';

    if( isset($die) && $die == true ) die();
  }

  /**
   * Returns true if the username and password work or don't exist and false
   * if the user exists and the password is wrong.
   *
   * @param string $username The username
   * @param string $password The password
   * @return bool Authentication success or failure.
   */
  function user_login($username, $password){
    global $CFG, $DB;

    $user = $DB->get_record('user', array('username' => $username, 'mnethostid' => $CFG->mnet_localhost_id));

    if( !empty($user) && $user->auth == 'neon' ){
      if( !empty(optional_param('code', '', PARAM_TEXT)) ) return true;
    }

    return false;
  }

  protected function _get_query_data(array $array){
    $query_array = array();

    foreach( $array as $key => $value ){
      $query_array[] = urlencode($key) . '=' . urlencode($value);
    }

    return join('&', $query_array);
  }

  /**
   * This is where the OAuth request is made, if necessary
   */
  function loginpage_hook(){
    global $SESSION, $CFG, $DB;

    $access_token = false;
    $send_oauth_request = false;
    $authorizationcode = optional_param('oauthcode', '', PARAM_TEXT);

    if( !empty($authorizationcode) ){
      if( !isset($_COOKIE[$this->authtype . '_access_token']) ) $send_oauth_request = true;

      // require cURL from Moodle core
      require_once($CFG->libdir . '/filelib.php');

      $curl = new curl();
      $curl->resetHeader();
      $curl->setHeader('Content-Type: application/x-www-form-urlencoded');

      if( $send_oauth_request ){
        $params = array();
        $params['client_id'] = $this->_config->auth_neon_client_id;
        $params['client_secret'] = $this->_config->auth_neon_client_secret;
        $params['grant_type'] = $this->_settings['grant_type'];
        $params['code'] = $authorizationcode;
        $params['redirect_uri'] = $CFG->wwwroot . '/auth/neon/redirect.php?auth_service=' . $this->authtype;

        $curl_tokens_values = $curl->post(
            $this->_settings['request_token_url'],
            $this->_get_query_data($params)
        );
      }

      // check for token response
      if( !empty($curl_tokens_values) || !$send_oauth_request ){
        $token_values = array();

        // parse token values
        if( $send_oauth_request || !isset($_COOKIE[$this->authtype . '_access_token']) ){
          $token_values = json_decode($curl_tokens_values, true);
          $access_token = $token_values['access_token'];

          if( !empty($access_token) ){
            setcookie($this->authtype . '_access_token', $access_token, time() + 86400, '/'); // 86400 = 24 hours
          }else{
            //check native errors if exists
            if( isset($token_values['error']) ){
              switch( $token_values['error'] ){
                case 'invalid_client':
                  throw new moodle_exception('Neon CRM invalid OAuth settings. Check your Private Key and Secret Key', 'auth_neon');
                default:
                  throw new moodle_exception('Neon CRM Unknown Error with code: ' . $token_values['error']);
              }
            }else{
              throw new moodle_exception('Can not get access for "access_token" or/and "expires" params after request', 'auth_neon');
            }
          }
        }else{
          if( isset($_COOKIE[$this->authtype . '_access_token']) ){
            $access_token = $_COOKIE[$this->authtype . '_access_token'];
          }else{
            throw new moodle_exception('Someting wrong, maybe expires', 'auth_neon');
          }
        }
      }

      if( !empty($access_token) ){
        $neon = new Neon();
        $keys = array(
            'orgId' => $this->_config->auth_neon_org_id,
            'apiKey' => $this->_config->auth_neon_api_key
        );

        $neon->login($keys);

        $queryparams = array(
            'method' => 'account/retrieveIndividualAccount',
            'parameters' => array(
                'accountId' =>  $access_token,
            )
        );

        $isOrg = false;
        $result = $neon->go($queryparams);

        // If query fails try getting org data
        if( $result['operationResult'] != 'SUCCESS' ){
          $queryparams['method'] = 'account/retrieveOrganizationAccount';
          $isOrg = true;
          $result = $neon->go($queryparams);
        }

        if( $result['operationResult'] == 'SUCCESS' ){
          $neon_account = $isOrg ? $result['organizationAccount'] : $result['individualAccount'];

          $username = $neon_account['login']['username'];
          $contact = $neon_account['primaryContact'];

          $contactId = $contact['contactId'];
          $user_email = $contact['email1'];
          $first_name = $contact['firstName'];
          $last_name = $contact['lastName'];
        }else{
          throw new moodle_exception('Unable to log in as individual or organization', 'auth_neon');
        }

        $queryparams = array(
            'method' => 'membership/listMembershipHistory',
            'parameters' => array(
                'accountId' =>  $access_token,
            )
        );

        $result = $neon->go($queryparams);
//        $this->showDataAndDie($result, true);

        if( !empty($username) ){
          $moodle_user = $DB->get_record('user', array('username' => $username, auth => $this->authtype, 'deleted' => 0, 'mnethostid' => $CFG->mnet_localhost_id));
        }else{
          @setcookie($this->authtype . '_access_token', null, time() - 3600);
          throw new moodle_exception('Login failed', 'auth_neon');
        }

        if( empty($moodle_user) ){
          //check for username exists in DB
          $user_neon_check = $DB->get_record('user', array('username' => $username));

          if( !empty($user_neon_check) ){
            throw new moodle_exception('Username exists with a different auth type', 'auth_neon');
          }

          // create user HERE
          $moodle_user = create_user_record($username, '', 'neon');
        }

        // complete Authenticate user
        authenticate_user_login($username, null);

        // fill $newuser object with response data from webservices
        $newuser = new stdClass();
        if( !empty($user_email) ){
          $newuser->email = $user_email;
        }

        if( !empty($first_name) ){
          $newuser->firstname = $first_name;
        }

        if( !empty($last_name) ){
          $newuser->lastname = $last_name;
        }

        if( !empty($this->_config->auth_neon_default_country) ){
          $newuser->country = $this->_config->auth_neon_default_country;
        }

        if( $moodle_user ){
          if( $moodle_user->suspended == 1 ){
            throw new moodle_exception('auth_neon_user_suspended', 'auth_neon');
          }

          if( !empty($newuser) ){
            $newuser->id = $moodle_user->id;
            $moodle_user = (object)array_merge((array)$moodle_user, (array)$newuser);
            $DB->update_record('user', $moodle_user);
          }

          complete_user_login($moodle_user);

          // Redirection
          $urltogo = $CFG->wwwroot;

          if( user_not_fully_set_up($moodle_user) ){
            $urltogo = $CFG->wwwroot . '/user/edit.php';
          }else if( isset($SESSION->wantsurl) && (strpos($SESSION->wantsurl, $CFG->wwwroot) === 0) ){
            $urltogo = $SESSION->wantsurl;
            unset($SESSION->wantsurl);
          }else{
            unset($SESSION->wantsurl);
          }
        }

        redirect($urltogo);
      }else{
        throw new moodle_exception('auth_neon_access_token_empty', 'auth_neon');
      }
    }
  }

  public function logoutpage_hook(){
    @setcookie($this->authtype . '_access_token', null, -1, '/');

    return true;
  }

  function is_internal(){
    return false;
  }

  protected function setDefaults($config){
    // set to defaults if undefined
    if( !isset($config->auth_neon_user_prefix) ){
      $config->auth_neon_user_prefix = 'neon_user_';
    }

    if( !isset($config->auth_neon_default_country) ){
      $config->auth_neon_default_country = '';
    }

    if( !isset($config->auth_neon_api_key) ){
      $config->auth_neon_api_key = '';
    }

    if( !isset($config->auth_neon_org_id) ){
      $config->auth_neon_org_id = '';
    }

    if( !isset($config->auth_neon_client_id) ){
      $config->auth_neon_client_id = '';
    }

    if( !isset($config->auth_neon_client_secret) ){
      $config->auth_neon_client_secret = '';
    }

    if( !isset($config->auth_neon_button_text) ){
      $config->auth_neon_button_text = get_string('auth_neon_button_text_default', 'auth_neon');
    }
  }

  /**
   * Prints a form for configuring this authentication plugin.
   *
   * This function is called from admin/auth.php, and outputs a full page with
   * a form for configuring this plugin.
   *
   * @param array $page An object containing all the data for this page.
   */
  function config_form($config, $err, $user_fields){
    $this->setDefaults($config); // Set defaults for uninitialized fields

    include "admin_config.php";

    print_auth_lock_options($this->authtype, $user_fields, get_string('auth_fieldlocks_help', 'auth'), false, false);
  }

  /**
   * Processes and stores configuration data for this authentication plugin.
   */
  function process_config($config){
    if( has_capability('moodle/user:update', context_system::instance()) ){
      $this->setDefaults($config); // Set defaults for uninitialized fields

      // save settings
      set_config('auth_neon_api_key', trim($config->auth_neon_api_key), 'auth/neon');
      set_config('auth_neon_org_id', trim($config->auth_neon_org_id), 'auth/neon');
      set_config('auth_neon_client_id', trim($config->auth_neon_client_id), 'auth/neon');
      set_config('auth_neon_client_secret', trim($config->auth_neon_client_secret), 'auth/neon');
      set_config('auth_neon_button_text', trim($config->auth_neon_button_text), 'auth/neon');

      set_config('auth_neon_user_prefix', trim($config->auth_neon_user_prefix), 'auth/neon');
      set_config('auth_neon_default_country', trim($config->auth_neon_default_country), 'auth/neon');

      return true;
    }

    throw new moodle_exception('You do not have permissions', 'auth_neon');
  }
}
