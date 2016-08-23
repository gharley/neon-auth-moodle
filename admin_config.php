<?php
defined('MOODLE_INTERNAL') || die();
global $CFG;
?>

<table cellspacing="0" cellpadding="5" border="0">
  <tr>
    <td colspan="3"><h3><?php echo get_string('auth_neon_main_settings', 'auth_neon'); ?></h3></td>
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

  <!--BUTTONS/DIVS SETTINGS-->
  <tr>
    <td colspan="3">
      <table cellspacing="0" cellpadding="5" border="0" width="100%">
        <tr>
          <td width="50%" colspan="2">
            <h3><?php echo get_string('auth_neon_buttons_settings', 'auth_neon'); ?></h3></td>
          <td width="50%" colspan="2">
            <h3><?php echo get_string('auth_neon_div_settings', 'auth_neon'); ?></h3></td>
        </tr>
        <tr>
          <td align="right" width="15%"><label
                for="auth_neon_display_buttons"><?php echo get_string('auth_neon_buttons_location', 'auth_neon'); ?></label>
          </td>
          <td width="35%">
            <?php
            echo html_writer::select(
                array(
                    'inline-block' => get_string('auth_neon_display_inline', 'auth_neon'),
                    'block' => get_string('auth_neon_display_block', 'auth_neon'),
                ),
                'auth_neon_display_buttons', $config->auth_neon_display_buttons, false, array('id' => 'auth_neon_display_buttons')
            );
            ?>
          </td>
          <td align="right" width="15%"><label
                for="auth_neon_display_div"><?php echo get_string('auth_neon_div_location', 'auth_neon'); ?></label>
          </td>
          <td width="35%">
            <?php
            echo html_writer::select(
                array(
                    'inline-block' => get_string('auth_neon_display_inline', 'auth_neon'),
                    'block' => get_string('auth_neon_display_block', 'auth_neon'),
                ),
                'auth_neon_display_div', $config->auth_neon_display_div, false, array('id' => 'auth_neon_display_div')
            );
            ?>
          </td>
        </tr>
        <tr>
          <td align="right" width="15%"><label
                for="auth_neon_button_width"><?php echo get_string('auth_neon_button_div_width', 'auth_neon'); ?></label>
          </td>
          <td width="35%">
            <?php echo html_writer::empty_tag('input',
                array('type' => 'text',
                    'id' => 'auth_neon_button_width',
                    'name' => 'auth_neon_button_width',
                    'class' => 'auth_neon_button_width',
                    'value' => !empty($config->auth_neon_button_width) ? $config->auth_neon_button_width : 0,
                    'size' => 5,
                    'autocomplete' => 'off')
            );
            if( isset($err['auth_neon_button_width']) ){
              echo $OUTPUT->error_text($err['auth_neon_button_width']);
            }
            ?>
          </td>
          <td align="right" width="15%"><label
                for="auth_neon_div_width"><?php echo get_string('auth_neon_button_div_width', 'auth_neon'); ?></label>
          </td>
          <td width="35%">
            <?php echo html_writer::empty_tag('input',
                array('type' => 'text',
                    'id' => 'auth_neon_div_width',
                    'name' => 'auth_neon_div_width',
                    'class' => 'auth_neon_div_width',
                    'value' => !empty($config->auth_neon_div_width) ? $config->auth_neon_div_width : 0,
                    'size' => 5,
                    'autocomplete' => 'off')
            );
            if( isset($err['auth_neon_div_width']) ){
              echo $OUTPUT->error_text($err['auth_neon_div_width']);
            }
            ?>
          </td>
        </tr>
        <tr>
          <td align="right" width="15%"><label
                for="auth_neon_button_margin_top"><?php echo get_string('auth_neon_margin_top_key', 'auth_neon'); ?></label>
          </td>
          <td width="35%">
            <?php echo html_writer::empty_tag('input',
                array('type' => 'text',
                    'id' => 'auth_neon_button_margin_top',
                    'name' => 'auth_neon_button_margin_top',
                    'class' => 'auth_neon_button_margin_top',
                    'value' => $config->auth_neon_button_margin_top,
                    'size' => 5,
                    'autocomplete' => 'off')
            );
            if( isset($err['auth_neon_button_margin_top']) ){
              echo $OUTPUT->error_text($err['auth_neon_button_margin_top']);
            }
            ?>
          </td>
          <td align="right" width="15%"><label
                for="auth_neon_div_margin_top"><?php echo get_string('auth_neon_margin_top_key', 'auth_neon'); ?></label>
          </td>
          <td width="35%">
            <?php echo html_writer::empty_tag('input',
                array('type' => 'text',
                    'id' => 'auth_neon_div_margin_top',
                    'name' => 'auth_neon_div_margin_top',
                    'class' => 'auth_neon_div_margin_top',
                    'value' => $config->auth_neon_div_margin_top,
                    'size' => 5,
                    'autocomplete' => 'off')
            );
            if( isset($err['auth_neon_div_margin_top']) ){
              echo $OUTPUT->error_text($err['auth_neon_div_margin_top']);
            }
            ?>
          </td>
        </tr>
        <tr>
          <td align="right" width="15%"><label
                for="auth_neon_button_margin_right"><?php echo get_string('auth_neon_margin_right_key', 'auth_neon'); ?></label>
          </td>
          <td width="35%">
            <?php echo html_writer::empty_tag('input',
                array('type' => 'text',
                    'id' => 'auth_neon_button_margin_right',
                    'name' => 'auth_neon_button_margin_right',
                    'class' => 'auth_neon_button_margin_right',
                    'value' => $config->auth_neon_button_margin_right,
                    'size' => 5,
                    'autocomplete' => 'off')
            );
            if( isset($err['auth_neon_button_margin_right']) ){
              echo $OUTPUT->error_text($err['auth_neon_button_margin_right']);
            }
            ?>
          </td>
          <td align="right" width="15%"><label
                for="auth_neon_div_margin_right"><?php echo get_string('auth_neon_margin_right_key', 'auth_neon'); ?></label>
          </td>
          <td width="35%">
            <?php echo html_writer::empty_tag('input',
                array('type' => 'text',
                    'id' => 'auth_neon_div_margin_right',
                    'name' => 'auth_neon_div_margin_right',
                    'class' => 'auth_neon_div_margin_right',
                    'value' => $config->auth_neon_div_margin_right,
                    'size' => 5,
                    'autocomplete' => 'off')
            );
            if( isset($err['auth_neon_div_margin_right']) ){
              echo $OUTPUT->error_text($err['auth_neon_div_margin_right']);
            }
            ?>
          </td>
        </tr>
        <tr>
          <td align="right" width="15%"><label
                for="auth_neon_button_margin_bottom"><?php echo get_string('auth_neon_margin_bottom_key', 'auth_neon'); ?></label>
          </td>
          <td width="35%">
            <?php echo html_writer::empty_tag('input',
                array('type' => 'text',
                    'id' => 'auth_neon_button_margin_bottom',
                    'name' => 'auth_neon_button_margin_bottom',
                    'class' => 'auth_neon_button_margin_bottom',
                    'value' => $config->auth_neon_button_margin_bottom,
                    'size' => 5,
                    'autocomplete' => 'off')
            );
            if( isset($err['auth_neon_button_margin_bottom']) ){
              echo $OUTPUT->error_text($err['auth_neon_button_margin_bottom']);
            }
            ?>
          </td>
          <td align="right" width="15%"><label
                for="auth_neon_div_margin_bottom"><?php echo get_string('auth_neon_margin_bottom_key', 'auth_neon'); ?></label>
          </td>
          <td width="35%">
            <?php echo html_writer::empty_tag('input',
                array('type' => 'text',
                    'id' => 'auth_neon_div_margin_bottom',
                    'name' => 'auth_neon_div_margin_bottom',
                    'class' => 'auth_neon_div_margin_bottom',
                    'value' => $config->auth_neon_div_margin_bottom,
                    'size' => 5,
                    'autocomplete' => 'off')
            );
            if( isset($err['auth_neon_div_margin_bottom']) ){
              echo $OUTPUT->error_text($err['auth_neon_div_margin_bottom']);
            }
            ?>
          </td>
        </tr>
        <tr>
          <td align="right" align="right" width="15%"><label
                for="auth_neon_button_margin_left"><?php echo get_string('auth_neon_margin_left_key', 'auth_neon'); ?></label>
          </td>
          <td width="35%">
            <?php echo html_writer::empty_tag('input',
                array('type' => 'text',
                    'id' => 'auth_neon_button_margin_left',
                    'name' => 'auth_neon_button_margin_left',
                    'class' => 'auth_neon_button_margin_left',
                    'value' => $config->auth_neon_button_margin_left,
                    'size' => 5,
                    'autocomplete' => 'off')
            );
            if( isset($err['auth_neon_button_margin_left']) ){
              echo $OUTPUT->error_text($err['auth_neon_button_margin_left']);
            }
            ?>
          </td>
          <td align="right" width="15%"><label
                for="auth_neon_div_margin_left"><?php echo get_string('auth_neon_margin_left_key', 'auth_neon'); ?></label>
          </td>
          <td width="35%">
            <?php echo html_writer::empty_tag('input',
                array('type' => 'text',
                    'id' => 'auth_neon_div_margin_left',
                    'name' => 'auth_neon_div_margin_left',
                    'class' => 'auth_neon_div_margin_left',
                    'value' => $config->auth_neon_div_margin_left,
                    'size' => 5,
                    'autocomplete' => 'off')
            );
            if( isset($err['auth_neon_div_margin_left']) ){
              echo $OUTPUT->error_text($err['auth_neon_div_margin_left']);
            }
            ?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
