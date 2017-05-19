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

    $fieldId = $DB->get_field('user_info_field', 'id', array('shortname' => 'auth_neon_orders'));
    if( empty($fieldId) ) return;

    $orders = $DB->get_field('user_info_data', 'data', array('userid' => $user->id, 'fieldid' => $fieldId));
    if( empty($orders) ) return;

    $orders = json_decode($orders);
// $this->showDataAndDie($orders, true);
    foreach( $orders as $order ){
      // if( $order->status != 'SUCCEED' ) continue;

      $course = $DB->get_record('course', array('idnumber' => $order->code));
      if( empty($course) ) continue;

      if( !$DB->record_exists('enrol', array('enrol' => 'neon', 'courseid' => $course->id)) ){
        $record = new stdClass();
        $record->enrol = 'neon';
        $record->courseid = $course->id;
        $record->status = $course->startdate <= getdate()[0] ? 0 : 1;

        $DB->insert_record('enrol', $record);
      }

      $enrolment = $DB->get_record('enrol', array('enrol' => 'neon', 'courseid' => $course->id));
      $this->enrol_user($enrolment, $user->id);
    }
  }

  /**
   * Attempt to automatically enrol current user in course without any interaction,
   * calling code has to make sure the plugin and instance are active.
   *
   * This should return either a timestamp in the future or false.
   *
   * @param stdClass $instance course enrol instance
   * @return bool|int false means not enrolled, integer means timeend
   */
  public function try_autoenrol(stdClass $instance) {
    global $USER;

    return false;
  }

  private function showDataAndDie($data, $die = false){
    echo '<pre>';
    print_r($data);
    echo '</pre>';

    if( isset($die) && $die == true ) die();
  }
}
