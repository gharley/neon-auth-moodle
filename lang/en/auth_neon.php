<?php
// This file is part of the auth_neon plugin for Moodle - http://moodle.org/
//
// This software is Copyright(c) 2016 by Greg Harley - https://github.com/gharley/neon-auth-moodle
// License - MIT https://opensource.org/licenses/MIT MIT

/**
 * Strings for component 'auth_neon', language 'en'.
 *
 * @package   auth_neon
 * @copyright 2016 onwards Greg Harley
 * @license   https://opensource.org/licenses/MIT MIT
 */

$string['auth_neondescription'] = 'Users can sign in using their Neon CRM account.';
$string['pluginname'] = 'Neon CRM';
$string['auth_neon_main_settings'] = 'Main settings';
$string['auth_neon_user_prefix_key'] = 'User prefix';
$string['auth_neon_user_prefix_desc'] = 'Moodle users nickname prefix, authorized via Neon';
$string['auth_neon_default_country_key'] = 'Default country';
$string['auth_neon_default_country_desc'] = 'Every user registered via Neon will have this country selected by default on register page';
$string['auth_neon_can_confirm_key'] = 'Moderate new users';
$string['auth_neon_can_confirm_desc'] = 'New users, registered via Neon needs to be moderated by Moodle administrator';
$string['auth_neon_retrieve_avatar_key'] = 'Retrieve avatar';
$string['auth_neon_retrieve_avatar_desc'] = 'If option checked and if user is newbie or exists without Moodle-based avatar, it will be uploaded automatically if it exists at social profile';

$string['auth_neon_settings'] = 'Neon CRM Settings';
$string['auth_neon_org_id'] = 'Organization ID';
$string['auth_neon_api_key'] = 'API Key';
$string['auth_neon_client_id'] = 'Client ID';
$string['auth_neon_client_secret_key'] = 'Secret key';
$string['auth_neon_buttontext_key'] = 'Login Button Text';
$string['auth_neon_button_text_default'] = 'Login with Neon CRM';
$string['auth_neon_desc'] = '
    <ol>
      <li>You need to sign up for an organization account at <a href="https://www.neoncrm.com/" target="_blank">Neon</a></li>
      <li>Once you have your account go to the <a href="https://developer.neoncrm.com/api/getting-started/" target="_blank">Getting Started</a> page to </li>
      <li>find out how to generate your api key and find your organization ID.</li>
      <li>Finally log in to NeonCRM as administrator and find your Client ID and </li>
      <li>Client Secret under OAuth on the System Settings Dashboard.</li>
    </ol>';

$string['auth_neon_buttons_settings'] = 'Buttons settings';

$string['auth_neon_button_div_width'] = 'Width (<em>0 = auto</em>)';
$string['auth_neon_buttons_location'] = 'Buttons location';
$string['auth_neon_display_inline'] = 'Inline';
$string['auth_neon_display_block'] = 'Block';

$string['auth_neon_margin_top_key'] = 'Margin top (px)';
$string['auth_neon_margin_right_key'] = 'Margin right (px)';
$string['auth_neon_margin_bottom_key'] = 'Margin bottom (px)';
$string['auth_neon_margin_left_key'] = 'Margin left (px)';

$string['auth_neon_div_settings'] = 'Buttons area settings';
$string['auth_neon_div_location'] = 'Area location';
$string['auth_neon_output_style_key'] = 'Live style';
$string['auth_neon_output_php_code_key'] = 'Theme PHP-code';
$string['auth_neon_output_settings'] = 'Output settings';
