<?php
/**
 * Enqueue front-end scripts and styles
 * @wp-hook
 */
function starterkit_enqueue_frontend(): void {
	$theme_deps = array(
		'vendor-scripts'
	);

	if(is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	wp_enqueue_style('starterkit-style', get_stylesheet_uri(), array(), THEME_VERSION);

	wp_enqueue_script('vendor-scripts', get_template_directory_uri() . '/js/dist/vendor.bundle.js', array(), THEME_VERSION, true);

	wp_enqueue_script('fontawesome', '//kit.fontawesome.com/328982870b.js', array(), '6.x', true);

	if(defined('GMAPS_KEY') && GMAPS_KEY) {
		wp_enqueue_script('gmaps', 'https://maps.googleapis.com/maps/api/js?key=' . GMAPS_KEY, '', '3', true);
		array_push($theme_deps, 'gmaps');
	}

	wp_enqueue_script('theme-scripts', get_template_directory_uri() . '/js/dist/theme.bundle.js', $theme_deps, THEME_VERSION, true);

}
add_action('wp_enqueue_scripts', 'starterkit_enqueue_frontend');


/**
 * Enqueue TinyMCE editor styles
 * @wp-hook
 *
 * @return void
 */
function starterkit_editor_css(): void {
	add_editor_style(get_template_directory_uri() . '/editor-styles.css');
}
add_action('admin_init', 'starterkit_editor_css');


/**
 * Enqueue admin CSS
 * @wp-hook
 *
 * @return void
 */
function starterkit_admin_css(): void {
	wp_enqueue_style('starterkit-admin-css', get_template_directory_uri() . '/admin-styles.css');
}
add_action('admin_enqueue_scripts', 'starterkit_admin_css');
