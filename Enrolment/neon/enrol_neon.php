<?php
// This file is the enrolment plugin that accompanies the auth_neon plugin for Moodle - http://moodle.org/
//
// This software is Copyright(c) 2016 by Greg Harley - https://github.com/gharley/neon-auth-moodle
// License - MIT https://opensource.org/licenses/MIT MIT

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/enrollib.php');

/**
 * Class enrol_neon
 *
 * This plugin uses information gathered by the auth_neon plugin to
 * enrol users in courses that require registration and or payment.
 */
class enrol_neon extends enrol_plugin{
  /**
   * Forces synchronisation of user enrolments.
   *
   * this function is called for all enabled enrol plugins
   * right after every user login.
   *
   * This override looks for user membership data set by the auth_neon plugin.
   *
   * @param object $user user record
   * @return void
   */
  public function sync_user_enrolments($user) {
    global $DB;

    $fieldId = $DB->get_field('user_info_field', 'id', array('shortname' => 'auth_neon_memberships'));
    if( empty($fieldId) ) return;

    $memberships = $DB->get_field('user_info_data', 'data', array('userid' => $user->id, 'fieldid' => $fieldId));
    if( empty($memberships) ) return;

    $memberships = json_decode($memberships);
    $this->showDataAndDie($memberships, true);

  }

  private function showDataAndDie($data, $die = false){
    echo '<pre>';
    print_r($data);
    echo '</pre>';

    if( isset($die) && $die == true ) die();
  }
}
