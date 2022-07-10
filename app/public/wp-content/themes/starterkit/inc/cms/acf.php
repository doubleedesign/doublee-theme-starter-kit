<?php
/**
 * @wp-hook
 * @return void
 */
function starterkit_setup_acf() {

	// Google maps
	if(defined('GMAPS_KEY') && GMAPS_KEY) {
		acf_update_setting('google_api_key', GMAPS_KEY);
	}

	if(function_exists('acf_add_options_page')) {
		acf_add_options_page(array(
			'page_title' => 'Global Options',
		));
	}
}
add_action('acf/init', 'starterkit_setup_acf');