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
    <td width="50%" colspan="2"><?php
      echo html_writer::checkbox(
          'auth_neon_can_confirm', 1,
          isset($config->auth_neon_can_confirm) ? $config->auth_neon_can_confirm : 0,
          get_string('auth_neon_can_confirm_key', 'auth_neon'), array('id' => 'auth_neon_can_confirm')
      );
      if( isset($err['auth_neon_can_confirm']) ){
        echo $OUTPUT->error_text($err['auth_neon_can_confirm']);
      } ?>
    </td>
    <td width="50%"><?php echo get_string('auth_neon_can_confirm_desc', 'auth_neon'); ?></td>
  </tr>
  <tr>
    <td width="50%" colspan="2"><?php
      echo html_writer::checkbox(
          'auth_neon_retrieve_avatar', 1,
          isset($config->auth_neon_retrieve_avatar) ? $config->auth_neon_retrieve_avatar : 0,
          get_string('auth_neon_retrieve_avatar_key', 'auth_neon'), array('id' => 'auth_neon_retrieve_avatar')
      );
      if( isset($err['auth_neon_retrieve_avatar']) ){
        echo $OUTPUT->error_text($err['auth_neon_retrieve_avatar']);
      } ?>
    </td>
    <td width="50%"><?php echo get_string('auth_neon_retrieve_avatar_desc', 'auth_neon'); ?></td>
  </tr>
  <?php if( $CFG->debugdeveloper == 1 ) : ?>
    <tr>
      <td width="50%" colspan="2"><?php
        echo html_writer::checkbox(
            'auth_neon_dev_mode', 1,
            isset($config->auth_neon_dev_mode) ? $config->auth_neon_dev_mode : 0,
            get_string('auth_neon_dev_mode_key', 'auth_neon'), array('id' => 'auth_neon_dev_mode')
        );
        if( isset($err['auth_neon_dev_mode']) ){
          echo $OUTPUT->error_text($err['auth_neon_dev_mode']);
        } ?>
      </td>
      <td width="50%"><?php echo get_string('auth_neon_dev_mode_desc', 'auth_neon'); ?></td>
    </tr>
  <?php else : ?>

  <?php endif; ?>

  <tr>
    <td colspan="3"><h3><?php echo get_string('auth_neon_settings', 'auth_neon');
        if( !empty($config->auth_neon_client_id) ) :
          echo ' ( ' . html_writer::link(new moodle_url('https://trial.z2systems.com/np/' . $config->auth_neon_client_id), get_string('auth_neon_dashboard', 'auth_neon'), array('target' => '_blank')) . ' )';
        endif; ?>
      </h3></td>
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
  <tr>
    <td align="right" width="15%"><label
          for="auth_neon_social_id_field"><?php echo get_string('auth_neon_binding_key', 'auth_neon'); ?></label>
    </td>
    <td width="35%"><?php
      echo html_writer::select(
          $this->_neon_get_user_info_fields_array(),
          'auth_neon_social_id_field_disabled',
          $config->auth_neon_social_id_field,
          get_string('select') . '...',
          array(
              'id' => 'auth_neon_social_id_field',
              'class' => 'auth_neon_social_id_field',
              'disabled' => 'disabled'
          )
      );
      if( isset($err['auth_neon_social_id_field']) ){
        echo $OUTPUT->error_text($err['auth_neon_social_id_field']);
      }
      ?>
      <!--input type="hidden" name="auth_neon_social_id_field" value="<?php echo $config->auth_neon_social_id_field; ?>" /-->
    </td>
  </tr>
  <tr>
    <td align="right" width="15%"><label
          for="auth_neon_google_order"><?php echo get_string('auth_neon_order', 'auth_neon'); ?></label></td>
    <td width="35%"><?php echo html_writer::empty_tag('input',
          array('type' => 'number',
              'id' => 'auth_neon_google_order',
              'name' => 'auth_neon_order[neoncrm]',
              'class' => 'auth_neon_google_order',
              'value' => array_search('neoncrm', $order_array),
              'size' => 10,
              'min' => 1,
              'max' => 8,
              'maxlength' => 1,
              'autocomplete' => 'off')
      ); ?>
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

  <!--OUTPUT-->
  <tr>
    <td colspan="3">
      <h3><?php echo get_string('auth_neon_output_settings', 'auth_neon'); ?></h3>
    </td>
  </tr>
  <tr>
    <td colspan="3">
      <table class="generaltable" cellspacing="0" width="100%">
        <thead>
        <tr>
          <th width="40%"><?php echo get_string('auth_neon_output_style_key', 'auth_neon'); ?></th>
          <th width="60%"><?php echo get_string('auth_neon_output_php_code_key', 'auth_neon'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach( $this->_styles_array as $style_item ) : ?>
          <tr>
            <td>
              <?php echo auth_neon_out::getInstance()->neon_output($style_item, true); ?>
              <br/><em><?php echo $style_item; ?></em>
              <?php
              switch( $style_item ){
                case 'bootstrap-font-awesome':
                case 'bootstrap-font-awesome-simple':
                  echo '<br /><small style="color:red">' . get_string('auth_neon_bootstrap_fontawesome_needle', 'auth_neon') . '</small>';
                  break;
              }
              ?>
            </td>
            <td>
              <code>&lt;?php if ( file_exists( $CFG->dirroot . '/auth/neon/out.php' ) ) :<br/>include_once
                $CFG->dirroot . '/auth/neon/out.php';<br/>echo
                auth_neon_out::getInstance()->neon_output('<?php echo $style_item; ?>');<br/>endif; ?&gt;
              </code>
              <br/><a
                  href="<?php echo $CFG->wwwroot; ?>/auth/neon/htmlcode.php?style=<?php echo $style_item; ?>"
                  target="_blank"><?php echo get_string('auth_neon_static_html', 'auth_neon'); ?></a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </td>
  </tr>
</table>
