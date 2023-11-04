<?php
/**
 * Setup for theme-specific Advanced Custom Fields stuff
 * @wp-hook
 * @return void
 */
function starterkit_setup_acf(): void {
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
function starterkit_acf_gmaps(): void {
	if(function_exists('acf_update_setting') && defined('GMAPS_KEY')) {
		acf_update_setting('google_api_key', GMAPS_KEY);
	}
}
add_action('init', 'starterkit_acf_gmaps', 11);
