<?php
/**
 * Customise login screen logo
 * @wp-hook
 */
function starterkit_login_logo(): void {
	$custom_logo_id = get_theme_mod('custom_logo');
	if($custom_logo_id) {
		$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
		?>
		<style>
			#login h1 a {
				width: <?php echo $logo[1]; ?>px !important;
				height: <?php echo $logo[2]; ?>px !important;
				background-image: url('<?php echo $logo[0]; ?>') !important;
				padding-bottom: 0 !important;
				background-size: 100% auto !important;
			}
		</style>
	<?php }
}
add_action('login_enqueue_scripts', 'starterkit_login_logo');


/**
 * Change the excerpt explanation in the backend
 * @param $translated_text
 * @param $text
 * @param $domain
 *
 * @wp-hook
 *
 * @return string
 * @noinspection PhpUnusedParameterInspection
 * @noinspection PhpUnusedParameterInspection
 */
function starterkit_change_excerpt_explanation($translated_text, $text, $domain): string {
	$post_type = get_post_type();
	switch($translated_text) {
		case 'Excerpts are optional hand-crafted summaries of your content that can be used in your theme. <a href="%s">Learn more about manual excerpts</a>.' :
			if($post_type == 'page') {
				$translated_text = 'Preview text';
				break;
			}
			if($post_type == 'post') {
				$translated_text = 'Preview text';
				break;
			}
	}

	return $translated_text;
}
add_filter('gettext', 'starterkit_change_excerpt_explanation', 20, 3);


/**
 * Rename some admin menu items for clarity
 * @return void
 */
function starterkit_rename_admin_menu_items(): void {
    global $menu;

    foreach ($menu as $key => $value) {
        if($value[0] == 'Site Kit') {
            $menu[$key][0] = 'Google Site Kit';
        }
    }
}
add_action('admin_menu', 'starterkit_rename_admin_menu_items', 100);


/**
 * Move Yoast SEO to the bottom of edit screens
 * @wp-hook
 */
function starterkit_move_yoast_seo_metabox(): string {
	return 'low';
}
add_filter('wpseo_metabox_prio', 'starterkit_move_yoast_seo_metabox');

/**
 * Remove unwanted metaboxes
 * @wp-hook
 */
function starterkit_remove_meta_boxes(): void {
	remove_meta_box('nf_admin_metaboxes_appendaform', array('page', 'post'), 'side');
}
add_action('add_meta_boxes', 'starterkit_remove_meta_boxes', 99);


/**
 * Load editor styles in ACF WYSIWYG fields
 * Ref: https://pagegwood.com/web-development/custom-editor-stylesheets-advanced-custom-fields-wysiwyg/
 * @param $mce_init
 * @wp-hook
 *
 * @return array
 */
function starterkit_add_editor_styles_to_tinymce($mce_init): array {
	$content_css = '/editor-styles.css';
	$version = filemtime(get_stylesheet_directory() . $content_css);
	$content_css = get_stylesheet_directory_uri() . $content_css . '?v=' . $version; // it caches hard, use this to force a refresh

	if(isset($mce_init['content_css'])) {
		$content_css_new = $mce_init['content_css'] . ',' . $content_css;
		$mce_init['content_css'] = $content_css_new;
	}

	return $mce_init;
}
add_filter('tiny_mce_before_init', 'starterkit_add_editor_styles_to_tinymce');


/**
 * Add predefined colours to TinyMCE
 * @wp-hook
 * @param $settings
 *
 * @return array
 */
function starterkit_add_mce_colours($settings): array {
	$colours = array(
		'000000' => 'Black',
		'FFFFFF' => 'White',
		'602AA2' => 'Primary',
		'2B193D' => 'Secondary',
		'009DD6' => 'Accent'
	);

	if(!empty($colours)) {
		$map = array();
		foreach($colours as $value => $label) {
			$map[] = '"'.$value.'","'.$label.'"';
		}

		$settings['textcolor_map'] = '['.implode(',', $map).']';
	}

	return $settings;
}
add_filter('tiny_mce_before_init', 'starterkit_add_mce_colours');



/**
 * Add custom text formats to TinyMCE
 * Note: 'selector' for block-level element that format is applied to; 'inline' to add wrapping tag e.g.'span'
 * @wp-hook
 * @param $buttons
 *
 * @return array
 */
function starterkit_add_mce_styleselect($buttons): array {
	array_unshift($buttons, 'styleselect');

	return $buttons;
}
add_filter('mce_buttons_2', 'starterkit_add_mce_styleselect');

function starterkit_add_mce_styles($init_array): array {
	$style_formats = array(
		array(
			'title' => 'Lead paragraph',
			'selector' => 'p',
			'classes' => 'lead'
		),
	);

	$init_array['style_formats'] = json_encode($style_formats);

	return $init_array;
}
add_filter('tiny_mce_before_init', 'starterkit_add_mce_styles');


/**
 * Add custom image sizes to editor image size dropdown
 * @wp-hook
 */
/*function starterkit_media_sizes_dropdown($sizes) {
	$sizes['container_width'] = 'Container width';

	return $sizes;
}
add_filter('image_size_names_choose', 'starterkit_media_sizes_dropdown');
*/


/**
 * Add "attachment" post type to link popup search
 * @wp-hook
 *
 * @param $query
 *
 * @return array
 */
function starterkit_link_query($query): array {
	$query['post_type'][] = 'attachment';
	$query['post_status'] = array($query['post_status'], 'inherit');

	return $query;
}
add_filter('wp_link_query_args', 'starterkit_link_query', 10, 1);

function starterkit_link_query_results($results) {
	array_walk($results, function(&$r) {
		$post = get_post($r['ID']);
		if($post->post_type == 'attachment') {
			$r['permalink'] = $post->guid;
		}
	});

	return $results;
}
add_filter('wp_link_query', 'starterkit_link_query_results', 10, 1);
