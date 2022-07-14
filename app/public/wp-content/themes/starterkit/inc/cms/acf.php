<?php
/**
 * Setup for Advanced Custom Fields
 * @wp-hook
 * @return void
 */
function starterkit_setup_acf() {

	if(function_exists('acf_add_options_page')) {
		acf_add_options_page(array(
			'page_title' => 'Global Options',
			'position'   => 2
		));
	}
}
add_action('acf/init', 'starterkit_setup_acf', 5);


/**
 * Update the Google Maps key ACF setting after the options page has been created
 * and after the google_maps_api_key field in it has been used to set
 * the GMAPS_KEY constant in starterkit_register_constants()
 * i.e. the priority is important
 * @return void
 * @see starterkit_setup_acf()
 * @see starterkit_register_constants()
 * @wp-hook
 */
function starterkit_acf_gmaps() {
	if(defined('GMAPS_KEY')) {
		acf_update_setting('google_api_key', GMAPS_KEY);
	}
}
add_action('init', 'starterkit_acf_gmaps', 11);
