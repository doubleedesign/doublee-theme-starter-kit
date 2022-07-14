<?php
/**
 * starterkit functions and definitions
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package starterkit
 */
require 'inc/setup/constants.php';
require 'inc/cms/acf.php';
require 'inc/cms/admin.php';
require 'inc/cms/customizer.php';
require 'inc/setup/theme-support.php';
require 'inc/setup/enqueue.php';
require 'inc/setup/media.php';
require 'inc/setup/menus.php';
require 'inc/setup/widgets.php';
require 'inc/theming/markup.php';
require 'inc/theming/utilities.php';
require 'inc/theming/template-tags.php';


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 * @wp-hook
 * @global int $content_width
 */
function starterkit_content_width() {
	$GLOBALS['content_width'] = apply_filters('starterkit_content_width', 640);
}
add_action('after_setup_theme', 'starterkit_content_width', 0);
