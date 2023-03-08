<?php
/**
 * Register custom image sizes
 * @wp-hook
 */
function starterkit_register_image_sizes(): void {
	//add_image_size('single-post', 1280, 400, true);
}
add_action('after_setup_theme', 'starterkit_register_image_sizes');


/**
 * Convert an iframe (like from an ACF oEmbed field) to a Vimeo background embed
 *
 * @param $embed
 *
 * @return mixed|string
 */
function starterkit_convert_embed_to_vimeo_background($embed) {
	if($embed && strpos($embed, 'vimeo.com') !== false) {
		$embed = starterkit_add_params_to_embed($embed, array('background' => 1));
	}

	return $embed;
}

/*
 * Add extra parameters to an embed's src attribute
 */
function starterkit_add_params_to_embed($embed, $params): string {
	// Break at the src attribute
	$embed = explode('src="', $embed, 2);
	$before_src = $embed[0];

	// Break after the src attribute value
	$embed = explode('"', $embed[1], 2);
	$after_src = $embed[1];

	// Add the background parameter to the src attribute value
	$src = $embed[0];
	$src = add_query_arg($params, $src);

	// Reassemble
	return $before_src . 'src="' . $src . '"' . $after_src;
}
