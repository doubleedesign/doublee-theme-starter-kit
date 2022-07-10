<?php
/**
 * Define constants
 * See https://stackoverflow.com/questions/1290318/php-constants-containing-arrays if using PHP < 7
 */
function starterkit_register_constants() {
	define('THEME_VERSION', '1.0.0');
	define('MODULES_FIELD_NAME', 'content_modules');
	define('MODULES_POST_TYPES', array('page'));
	define('MODULES_PARTIAL_PATH', 'partials/modules/');
	define('MODULES_TAXONOMIES', array('category'));
	define('MODULES_OPTIONS_PAGES', array()); // TODO
	define('GMAPS_KEY', '');
}
add_action('init', 'starterkit_register_constants', 10);