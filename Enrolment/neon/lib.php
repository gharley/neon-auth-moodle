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
class enrol_neon_plugin extends enrol_plugin{
  /**
   * Add new instance of enrol plugin with default settings.
   * @param object $course
   * @return int id of new instance
   */
  public function add_default_instance($course) {
    $fields = array('status'=>$this->get_config('status'));

    return $this->add_instance($course, $fields);
  }

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

    if( $user->auth != 'neon' ) return;

    $fieldId = $DB->get_field('user_info_field', 'id', array('shortname' => 'auth_neon_memberships'));
    if( empty($fieldId) ) return;

    $memberships = $DB->get_field('user_info_data', 'data', array('userid' => $user->id, 'fieldid' => $fieldId));
    if( empty($memberships) ) return;

    $memberships = json_decode($memberships);

    foreach( $memberships as $membership ){
      if( $membership->status != 'SUCCEED' ) continue;

      $course = $DB->get_record('course', array('idnumber' => $membership->membershipName));
      if( empty($course) ) continue;

      $enrolment = $DB->get_record('enrol', array('enrol' => 'neon', 'courseid' => $course->id));
      if( empty($enrolment) ){
        $record = new stdClass();
        $record->enrol = 'neon';
        $record->courseid = $course->id;
        $record->status = $course->startdate <= getdate()[0] ? 1 : 0;

        $DB->insert_record('enrol', $record);
        $enrolment = $DB->get_record('enrol', array('enrol' => 'neon', 'courseid' => $course->id));
      }

      $this->enrol_user($enrolment, $user->id);
    }
  }

  private function showDataAndDie($data, $die = false){
    echo '<pre>';
    print_r($data);
    echo '</pre>';

    if( isset($die) && $die == true ) die();
  }
}
