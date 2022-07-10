<?php
/**
 * Enqueue front-end scripts and styles
 */
function starterkit_enqueue_frontend() {
	wp_enqueue_style('starterkit-style', get_stylesheet_uri(), array(), THEME_VERSION);

	wp_enqueue_script('vendor-scripts', get_template_directory_uri() . '/js/dist/vendor.js', array(), THEME_VERSION, true);

	wp_enqueue_script('theme-scripts', get_template_directory_uri() . '/js/dist/theme.bundle.js', array(), THEME_VERSION, true);

	wp_enqueue_script('fontawesome', '//kit.fontawesome.com/328982870b.js', array(), '6.x', true);

	if(is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'starterkit_enqueue_frontend');


/**
 * Enqueue CMS scripts and styles
 */
function starterkit_enqueue_admin() {
	add_editor_style(get_template_directory_uri() . '/editor-styles.css');
}
add_action('admin_init', 'starterkit_enqueue_admin');
