<?php

require('../../config.php');

$error = false;
$error_code = '';

$code = optional_param('code', '', PARAM_TEXT);

if( empty($code) ){
  $error = true;
  $error_code = optional_param('error', '', PARAM_TEXT);

  if( empty($error_code) ){
    $error_code = get_string('auth_neon_empty_code_param', 'auth_lenauth');
  }
}

if( empty($error) ){
  global $CFG;

  $loginurl = $CFG->wwwroot . '/login/index.php';

  if( !empty($CFG->alternateloginurl) ){
    $loginurl = $CFG->alternateloginurl;
  }

  $url_params = array('oauthcode' => $code, 'authprovider' => 'neon');

  $url = new moodle_url($loginurl, $url_params);
}else{
  $moodle_index_url_errors = array('oauth_failure' => $error);

  if( !empty($error_code) ){
    $moodle_index_url_errors['code'] = $error_code;
  }

  $url = new moodle_url('/', $moodle_index_url_errors);
}

redirect($url);
