<?php
defined('MOODLE_INTERNAL') || die();
global $CFG;
?>

<table cellspacing="0" cellpadding="5" border="0">
  <tr>
    <td colspan="3"><h3><?php echo get_string('auth_neon_main_settings', 'auth_neon'); ?></h3></td>
  </tr>
  <tr>
    <td width="50%" colspan="2"><?php
        echo html_writer::checkbox(
                'auth_neon_sandbox', 1,
                $config->auth_neon_sandbox,
                get_string( 'auth_neon_sandbox_key', 'auth_neon' ), array( 'id' => 'auth_neon_sandbox' )
        );
      if( isset($err['auth_neon_sandbox']) ){
        echo $OUTPUT->error_text($err['auth_neon_sandbox']);
      } ?>
    </td>
    <td width="50%"><?php echo get_string('auth_neon_sandbox_desc', 'auth_neon'); ?></td>
  </tr>
  <tr>
    <td align="right" width="15%"><label
          for="auth_neon_user_prefix"><?php echo get_string('auth_neon_user_prefix_key', 'auth_neon'); ?></label>
    </td>
    <td width="35%"><?php echo html_writer::empty_tag('input',
          array('type' => 'text',
              'id' => 'auth_neon_user_prefix',
              'name' => 'auth_neon_user_prefix',
              'class' => 'auth_neon_user_prefix',
              'value' => $config->auth_neon_user_prefix,
              'size' => 50,
              'autocomplete' => 'off')
      );
      if( isset($err['auth_neon_user_prefix']) ){
        echo $OUTPUT->error_text($err['auth_neon_user_prefix']);
      } ?>
    </td>
    <td width="50%"><?php echo get_string('auth_neon_user_prefix_desc', 'auth_neon'); ?></td>
  </tr>
  <tr>
    <td align="right" width="15%"><label
          for="auth_neon_default_country"><?php echo get_string('auth_neon_default_country_key', 'auth_neon'); ?></label>
    </td>
    <td width="35%"><?php
      echo html_writer::select(
          get_string_manager()->get_list_of_countries(),
          'auth_neon_default_country',
          $config->auth_neon_default_country,
          get_string('selectacountry') . '...',
          array(
              'id' => 'auth_neon_default_country',
              'class' => 'auth_neon_default_country'
          )
      );
      if( isset($err['auth_neon_default_country']) ){
        echo $OUTPUT->error_text($err['auth_neon_default_country']);
      } ?>
    </td>
    <td width="50%"><?php echo get_string('auth_neon_default_country_desc', 'auth_neon'); ?></td>
  </tr>
  <tr>
    <td colspan="3"><h3><?php echo get_string('auth_neon_settings', 'auth_neon'); ?></h3></td>
  </tr>
  <tr>
    <td align="right" width="15%"><label
          for="auth_neon_org_id"><?php echo get_string('auth_neon_org_id', 'auth_neon'); ?></label>
    </td>
    <td width="35%"><?php echo html_writer::empty_tag('input',
          array('type' => 'text',
              'id' => 'auth_neon_org_id',
              'name' => 'auth_neon_org_id',
              'class' => 'auth_neon_org_id',
              'value' => !empty($config->auth_neon_org_id) ? $config->auth_neon_org_id : '',
              'size' => 50,
              'autocomplete' => 'off')
      );
      if( isset($err['auth_neon_org_id']) ){
        echo $OUTPUT->error_text($err['auth_neon_org_id']);
      } ?>
    </td>
    <td width="50%" rowspan="6" valign="top"><?php echo get_string('auth_neon_desc', 'auth_neon'); ?></td>
  </tr>
  <tr>
    <td align="right" width="15%"><label
          for="auth_neon_api_key"><?php echo get_string('auth_neon_api_key', 'auth_neon'); ?></label>
    </td>
    <td width="35%"><?php echo html_writer::empty_tag('input',
          array('type' => 'text',
              'id' => 'auth_neon_api_key',
              'name' => 'auth_neon_api_key',
              'class' => 'auth_neon_api_key',
              'value' => !empty($config->auth_neon_api_key) ? $config->auth_neon_api_key : '',
              'size' => 50,
              'autocomplete' => 'off')
      );
      if( isset($err['auth_neon_api_key']) ){
        echo $OUTPUT->error_text($err['auth_neon_api_key']);
      } ?>
    </td>
  </tr>
  <tr>
    <td align="right" width="15%"><label
          for="auth_neon_client_id"><?php echo get_string('auth_neon_client_id', 'auth_neon'); ?></label>
    </td>
    <td width="35%"><?php echo html_writer::empty_tag('input',
          array('type' => 'text',
              'id' => 'auth_neon_client_id',
              'name' => 'auth_neon_client_id',
              'class' => 'auth_neon_client_id',
              'value' => !empty($config->auth_neon_client_id) ? $config->auth_neon_client_id : '',
              'size' => 50,
              'autocomplete' => 'off')
      );
      if( isset($err['auth_neon_client_id']) ){
        echo $OUTPUT->error_text($err['auth_neon_client_id']);
      } ?>
    </td>
  </tr>
  <tr>
    <td align="right" width="15%"><label
          for="auth_neon_client_secret"><?php echo get_string('auth_neon_client_secret_key', 'auth_neon'); ?></label>
    </td>
    <td width="35%"><?php echo html_writer::empty_tag('input',
          array('type' => 'text',
              'id' => 'auth_neon_client_secret',
              'name' => 'auth_neon_client_secret',
              'class' => 'auth_neon_client_secret',
              'value' => !empty($config->auth_neon_client_secret) ? $config->auth_neon_client_secret : '',
              'size' => 50,
              'autocomplete' => 'off')
      );
      if( isset($err['auth_neon_client_secret']) ){
        echo $OUTPUT->error_text($err['auth_neon_client_secret']);
      } ?>
    </td>
  </tr>
  <tr>
    <td align="right" width="15%"><label
          for="auth_neon_button_text"><?php echo get_string('auth_neon_buttontext_key', 'auth_neon'); ?></label>
    </td>
    <td width="35%"><?php echo html_writer::empty_tag('input',
          array('type' => 'text',
              'id' => 'auth_neon_button_text',
              'name' => 'auth_neon_button_text',
              'class' => 'auth_neon_button_text',
              'value' => !empty($config->auth_neon_button_text) ? $config->auth_neon_button_text : '',
              'size' => 50,
              'autocomplete' => 'off')
      );
      if( isset($err['auth_neon_button_text']) ){
        echo $OUTPUT->error_text($err['auth_neon_button_text']);
      } ?>
    </td>
  </tr>
</table>
