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

require_once($CFG->libdir.'/authlib.php');

/**
 * Plugin for neon authentication.
 */
class auth_plugin_neon extends auth_plugin_base {

    /**
     * Neon webservice settings
     *
     * request_token_url endpoint for requesting auth token
     * grant_type always 'authorization_code'
     * request_api_url API endpoint for retrieving user data
     */
    protected $_settings = array(
        'request_token_url' => 'https://trial.z2systems.com/np/oauth/token',
        'grant_type'        => 'authorization_code',
        'request_api_url'   => 'https://api.neoncrm.com/neonws/services/api',
    );

    protected $_config;

    private static $_instance;

    /**
     * Constructor.
     */
    function auth_plugin_neon() {
        global $DB;

        $this->authtype = 'neon';
        $this->_config = get_config('auth/neon');
        $this->_user_info_fields = $DB->get_records('user_info_field');
        $this->roleauth = 'auth_neon';
        $this->errorlogtag = '[AUTH neon]';
    }

    /**
     * Singleton
     * @return object
     */
    public static function getInstance() {
        if( !isset(self::$_instance) && !(self::$_instance instanceof auth_plugin_neon) ){
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Returns true if the username and password work or don't exist and false
     * if the user exists and the password is wrong.
     *
     * @param string $username The username
     * @param string $password The password
     * @return bool Authentication success or failure.
     */
    function user_login ($username, $password) {
        global $CFG, $DB;

        $user = $DB->get_record('user', array('username'=>$username, 'mnethostid'=>$CFG->mnet_localhost_id));

        if( !empty($user) && $user->auth == 'neon' ){
            if( !empty(optional_param( 'code', '', PARAM_TEXT )) ) return true;
        }

        return false;
    }

    /**
     * Updates the user's password.
     *
     * called when the user password is updated.
     *
     * @param  object  $user        User table object
     * @param  string  $newpassword Plaintext password
     * @return boolean result
     *
     */
    function user_update_password($user, $newpassword) {
        $user = get_complete_user_data('id', $user->id);
        // This will also update the stored hash to the latest algorithm
        // if the existing hash is using an out-of-date algorithm (or the
        // legacy md5 algorithm).
        return update_internal_user_password($user, $newpassword);
    }

    function prevent_local_passwords() {
        return false;
    }

    /**
     * Returns true if this authentication plugin is 'internal'.
     *
     * @return bool
     */
    function is_internal() {
        return true;
    }

    /**
     * Returns true if this authentication plugin can change the user's
     * password.
     *
     * @return bool
     */
    function can_change_password() {
        return true;
    }

    /**
     * Returns the URL for changing the user's pw, or empty if the default can
     * be used.
     *
     * @return moodle_url
     */
    function change_password_url() {
        return null;
    }

    /**
     * Returns true if plugin allows resetting of internal password.
     *
     * @return bool
     */
    function can_reset_password() {
        return true;
    }

    /**
     * Returns true if plugin can be manually set.
     *
     * @return bool
     */
    function can_be_manually_set() {
        return true;
    }

    /**
     * Prints a form for configuring this authentication plugin.
     *
     * This function is called from admin/auth.php, and outputs a full page with
     * a form for configuring this plugin.
     *
     * @param array $page An object containing all the data for this page.
     */
    function config_form($config, $err, $user_fields) {
        include "config.html";
    }

    /**
     * Processes and stores configuration data for this authentication plugin.
     */
    function process_config($config) {
        return true;
    }

}


