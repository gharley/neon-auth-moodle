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
 * Inspired by the neon plugin by Igor Sazonov ( @tigusigalpa )
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
     * Returns true if this authentication plugin is 'internal'.
     *
     * @return bool
     */
    function is_internal() {
        return false;
    }

    /**
     * Returns true if plugin allows resetting of internal password.
     *
     * @return bool
     */
    function can_reset_password() {
        return isset($this->_config->auth_neon_can_reset_password) ? $this->_config->auth_neon_can_reset_password : false;
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
        // set to defaults if undefined
        if( !isset($config->auth_neon_user_prefix) ){
            $config->auth_neon_user_prefix = 'neon_user_';
        }

        if( !isset($config->auth_neon_default_country) ){
            $config->auth_neon_default_country = '';
        }

        if( !isset($config->auth_neon_locale) ){
            $config->auth_neon_locale = 'en';
        }

        if( empty($config->auth_neon_can_reset_password) ){
            $config->auth_neon_can_reset_password = 0;
        }else{
            $config->auth_neon_can_reset_password = 1;
        }

        if( empty($config->auth_neon_can_confirm) ){
            $config->auth_neon_can_confirm = 0;
        }else{
            $config->auth_neon_can_confirm = 1;
        }

        if( empty($config->auth_neon_retrieve_avatar) ){
            $config->auth_neon_retrieve_avatar = 0;
        }else{
            $config->auth_neon_retrieve_avatar = 1;
        }

        if( empty($config->auth_neon_dev_mode) ){
            $config->auth_neon_dev_mode = 0;
        }else{
            $config->auth_neon_dev_mode = 1;
        }

        if( !isset($config->auth_neon_display_buttons) ){
            $config->auth_neon_display_buttons = 'inline-block';
        }

        if( !isset($config->auth_neon_button_width) ){
            $config->auth_neon_button_width = 0;
        }

        if( !isset($config->auth_neon_button_margin_top) ){
            $config->auth_neon_button_margin_top = 10;
        }

        if( !isset($config->auth_neon_button_margin_right) ){
            $config->auth_neon_button_margin_right = 10;
        }

        if( !isset($config->auth_neon_button_margin_bottom) ){
            $config->auth_neon_button_margin_bottom = 10;
        }

        if( !isset($config->auth_neon_button_margin_left) ){
            $config->auth_neon_button_margin_left = 10;
        }

        if( !isset($config->auth_neon_display_div) ){
            $config->auth_neon_display_div = 'block';
        }

        if( !isset($config->auth_neon_div_width) ){
            $config->auth_neon_div_width = 0;
        }

        if( !isset($config->auth_neon_div_margin_top) ){
            $config->auth_neon_div_margin_top = 0;
        }

        if( !isset($config->auth_neon_div_margin_right) ){
            $config->auth_neon_div_margin_right = 0;
        }

        if( !isset($config->auth_neon_div_margin_bottom) ){
            $config->auth_neon_div_margin_bottom = 0;
        }

        if( !isset($config->auth_neon_div_margin_left) ){
            $config->auth_neon_div_margin_left = 0;
        }

        if ( !isset( $config->auth_neon_api_key ) ) {
            $config->auth_neon_api_key = '';
        }

        if ( !isset( $config->auth_neon_org_id ) ) {
            $config->auth_neon_org_id = '';
        }

        if ( !isset( $config->auth_neon_client_id ) ) {
            $config->auth_neon_client_id = '';
        }

        if ( !isset( $config->auth_neon_client_secret ) ) {
            $config->auth_neon_client_secret = '';
        }

        if ( !isset( $config->auth_neon_button_text ) ) {
            $config->auth_neon_button_text = get_string( 'auth_neon_button_text_default', 'auth_neon' );
        }

        include "admin_config.php";

        print_auth_lock_options($this->authtype, $user_fields, get_string('auth_fieldlocks_help', 'auth'), false, false);
    }

    /**
     * Processes and stores configuration data for this authentication plugin.
     */
    function process_config($config) {
        return true;
    }

}


