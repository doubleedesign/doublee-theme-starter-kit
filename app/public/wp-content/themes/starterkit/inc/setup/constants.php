<?php
/**
 * Define constants
 * Note that for the Google Maps key to work, the options page must have a field for it called google_maps_api_key
 * and this function must be run after starterkit_setup_acf()
 * and before starterkit_acf_gmaps()
 * @see starterkit_setup_acf()
 * @see starterkit_acf_gmaps()
 * @wp-hook
 * See https://stackoverflow.com/questions/1290318/php-constants-containing-arrays if using PHP < 7
 */
function starterkit_register_constants(): void {
	define('THEME_VERSION', '1.0.0');
	define('MODULES_FIELD_NAME', 'content_modules');
	define('MODULES_POST_TYPES', array('page'));
	define('MODULES_PARTIAL_PATH', 'partials/modules/');
	//define('MODULES_TAXONOMIES', array('category'));
	//define('MODULES_OPTIONS_PAGES', array()); // TODO
	define('PAGE_FOR_POSTS', get_option('page_for_posts'));

	if(class_exists('ACF')) {
		// Get it from options table instead of using ACF get_field()
		// because it doesn't work for dh_acf_gmaps() there, I assume because of that running on the acf_init hook
		$acf_gmaps_key = get_option('options_google_maps_api_key');
	}
	if(isset($acf_gmaps_key)) {
		define('GMAPS_KEY', $acf_gmaps_key);
	}
	else {
		define('GMAPS_KEY', '');
	}
}
add_action('init', 'starterkit_register_constants', 10);
