<?php
/**
 * Register button shortcode
 * @param $atts
 * @param null $content
 *
 * @return string
 */
function doublee_button_shortcode($atts, $content = null) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'url' => '',
			'color' => 'primary',
			'size' => '',
			'round' => '',
			'fullwidth' => '',
		),
		$atts
	);

	// Build array of classes
	$classes = array();
	array_push($classes, 'btn--' . $atts['color']); // Color has a default set above so we don't need to check for it.
	if($atts['size']) {
		array_push($classes, $atts['size']);
	}

	// Convert to string
	$classes = implode(' ', $classes);

	// Return the HTML
	return '<a href="' . $atts['url'] . '" class="btn ' . $classes . '">' . $content . '</a>';

}
add_shortcode('button', 'doublee_button_shortcode');


/**
 * Add TinyMCE button for button shortcode builder
 * Note: Styling additions in inc/admin/admin.php along with other admin styles
 * This just adds it to the button array, actual button is created by JS - see below
 *
 * @param array $buttons
 * @return array
 */
function doublee_mce_button_button($buttons) {
	array_splice($buttons, 10, 0, 'button');
	return $buttons;
}
add_filter('mce_buttons', 'doublee_mce_button_button');


/**
 * Load JavaScript file to handle the button
 * @param array $plugin_array
 * @return array
 */
function doublee_mce_button_plugin($plugin_array) {
	$plugin_array['button'] = get_stylesheet_directory_uri() . '/inc/cms/shortcode-button.js';
	return $plugin_array;
}
add_filter('mce_external_plugins', 'doublee_mce_button_plugin');
