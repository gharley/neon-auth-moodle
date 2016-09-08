<?php
// This file is the enrolment plugin that accompanies the auth_neon plugin for Moodle - http://moodle.org/
//
// This software is Copyright(c) 2016 by Greg Harley - https://github.com/gharley/neon-auth-moodle
// License - MIT https://opensource.org/licenses/MIT MIT

/**
 * Neon enrolment plugin settings and presets.
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {

  //--- general settings -----------------------------------------------------------------------------------
  $settings->add(new admin_setting_heading('enrol_neon_settings', '', get_string('pluginname_desc', 'enrol_neon')));

  //--- enrol instance defaults ----------------------------------------------------------------------------
  $settings->add(new admin_setting_heading('enrol_neon_defaults',
      get_string('enrolinstancedefaults', 'admin'), get_string('enrolinstancedefaults_desc', 'admin')));

  $settings->add(new admin_setting_configcheckbox('enrol_neon/defaultenrol',
      get_string('defaultenrol', 'enrol'), get_string('defaultenrol_desc', 'enrol'), 1));

  $options = array(ENROL_INSTANCE_ENABLED  => get_string('yes'), ENROL_INSTANCE_DISABLED => get_string('no'));

  $settings->add(new admin_setting_configselect_with_advanced('enrol_neon/status',
      get_string('status', 'enrol_neon'), get_string('status_desc', 'enrol_neon'),
      array('value'=>ENROL_INSTANCE_DISABLED, 'adv'=>false), $options));
}

