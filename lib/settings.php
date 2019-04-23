<?php

namespace PlatformCoop\Settings;

add_action('cmb2_admin_init', function () {
	$cmb = new_cmb2_box([
		'id' => 'platformcoop_configuration',
		'title' => esc_html__('Site Configuration', 'platformcoop-support'),
		'menu_title' => esc_html__('Configuration', 'platformcoop-support'),
		'object_types' => ['options-page'],
		'option_key' => 'platformcoop_configuration',
		'capability' => 'manage_options',
	]);
	$cmb->add_field([
		'name' => esc_html__('Donate Link', 'platformcoop-support'),
		'desc' => esc_html__('Link to external donation form (used in site footer and some page templates).', 'platformcoop-support'),
		'id' => 'donate_link',
		'type' => 'text_url',
		'default' => 'https://go.newschool.edu/s/1811/17/interior.aspx?sid=1811&gid=2&pgid=537&cid=1698&dids=34&bledit=1',
	]);
	$cmb->add_field([
		'name' => esc_html__('Newsletter Signup Text', 'platformcoop-support'),
		'desc' => esc_html__('Prompt for newsletter signup call to action (use in site footer).', 'platformcoop-support'),
		'id' => 'signup_text',
		'type' => 'textarea_small',
		'default' => 'Once a month, we’ll email you with the latest news and activity in the community.',
	]);
	$cmb->add_field([
		'name' => esc_html__('Newsletter Signup Link', 'platformcoop-support'),
		'desc' => esc_html__('Link to external newsletter signup form (used in site footer and some page templates).', 'platformcoop-support'),
		'id' => 'signup_link',
		'type' => 'text_url',
		'default' => 'https://lists.riseup.net/www/info/platformcoop-newsletter',
	]);
});

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string $key     Options array key
 * @param  mixed  $default Optional default value
 * @return mixed           Option value
 */
function get_config_option( $key = '', $default = false )
{
	if (function_exists('cmb2_get_option')) {
		return cmb2_get_option('platformcoop_configuration', $key, $default);
	}
	$opts = get_option('platformcoop_configuration', $default);
	$val = $default;
	if ('all' == $key) {
		$val = $opts;
	} elseif (is_array($opts) && array_key_exists($key, $opts) && false !== $opts[ $key ]) {
		$val = $opts[ $key ];
	}
	return $val;
}
