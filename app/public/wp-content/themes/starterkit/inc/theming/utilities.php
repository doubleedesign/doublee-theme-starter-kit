<?php
/**
 * Check if a plugin is active
 *
 * @param $plugin_file name of plugin file eg woocommerce/woocommerce.php
 *
 * @return bool
 */
function starterkit_is_plugin_active($plugin_file) {
	static $plugins = null;

	if( ! $plugins) {
		$plugins = get_option('active_plugins');
	}

	return in_array($plugin_file, $plugins);
}

/**
 * Return the type part of a mime type, eg for image/jpeg returns jpeg
 *
 * @param $mime the mime type to parse
 *
 * @return string
 */
function starterkit_parse_mime($mime) {
	preg_match('/.*\/(\w*)\+?.*/', $mime, $matches);

	return $matches[1];
}


/**
 * Account for content in ACF flexible modules when getting the excerpt
 *
 * @param $excerpt
 *
 * @return false|mixed|string
 */
function starterkit_get_excerpt_from_acf($excerpt) {

	if( ! $excerpt) {
		// Find the first set of flexible modules, if there are any
		$field_name = starterkit_get_name_of_first_acf_field_name_of_type('flexible_content');
		$modules = get_field($field_name);

		// If there's modules, find the first one with a WYSIWYG or textarea field and get its value
		if($field_name && $modules) {
			$excerpt = starterkit_get_first_acf_subfield_value_of_type($modules, array('wysiwyg', 'textarea'), $field_name);
		}
	}

	return $excerpt;
}
add_filter('get_the_excerpt', 'starterkit_get_excerpt_from_acf', 10, 1);


/**
 * Utility function to get the name of the first ACF field of the specified type.
 *
 * @param        $field_type
 * @param string $post_id
 *
 * @return int|string
 */
function starterkit_get_name_of_first_acf_field_name_of_type($field_type, $post_id = '') {
	$field_name = '';

	if( ! $post_id) {
		$post_id = get_the_id();
	}

	$acf_fields = get_fields($post_id, true);
	if($acf_fields) {
		foreach($acf_fields as $name => $value) {
			$field_object = get_field_object($name);
			if($field_object['type'] == $field_type) {
				$field_name = $name;
				break;
			}
		}
	}

	return $field_name;
}


/**
 * Utility function to get the first direct subfield in an ACF set (flexible content or repeater) that is of the given type(s)
 * Recursively checks within nested sets for their first instance of the type when applicable
 * Returns the field (or sub-field) value ready for use by the calling function.
 * // TODO: Test this on grouped fields too.
 *
 * @param array  $fields              Array of ACF fields or subfields, as returned by get_field() on a flexible content or repeater field
 * @param array  $types               The field types we want to look for
 * @param string $parent_field_name   The name of the top level field, e.g. the flexible content field.
 *                                    Optional because when looking at nested fields recursively, the original value needs to be passed again.
 *
 * @return string
 */
function starterkit_get_first_acf_subfield_value_of_type(array $fields, array $types, string $parent_field_name = '') {
	$all_field_data = starterkit_get_sub_field_data('content_modules', get_the_id());

	// If no fields were provided if they're not an array, bail early
	// Brought this out on its own to keep the main loop's nesting as simple and shallow as possible
	if(empty($fields) && ! is_array($fields)) {
		return false;
	}

	// Loop through the fields
	foreach($fields as $index => $subfield) {

		// If the subfield's value is an array, it's a nested fieldset so we need to go another level down
		if(is_array($subfield)) {
			return starterkit_get_first_acf_subfield_value_of_type($fields[$index], $types, $parent_field_name);
		}

		// We've reached content fields and can now proceed to look for our desired field types
		foreach($all_field_data as $data) {
			if(($data['name'] == $index) && (in_array($data['type'], $types)) && ( ! empty($data['value']))) {
				return $value_to_use = $data['value'];
			}
		}
	}

	// If a value hasn't been returned yet, there isn't one
	return false;
}


/**
 * Utility function to get data about sub-fields that we want to use in starterkit_get_first_acf_subfield_value_of_type
 * because you can't use get_sub_field_object outside of an ACF have_rows loop which was causing headaches with nested repeaters and whatnot
 *
 * @param $field_name
 * @param $post_id
 *
 * @return array
 */
function starterkit_get_sub_field_data($field_name, $post_id) {
	global $wpdb;
	$data = array();

	// Query the database for the field content of this field's subfields. Starts with the field slug without an underscore.
	// Returns an indexed array of meta ID, postt ID, meta key, and meta value sub-arrays.
	$meta_key_search = "'" . $field_name . "%'";
	$postmeta = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE post_id = $post_id AND meta_key LIKE $meta_key_search ORDER BY meta_key ASC", ARRAY_A);

	// Query the database for the field keys of this field's subfields. Starts with the field slug preceded by an underscore.
	// Field keys are not unique - e.g. repeaters will have the same field key for each instance of a subfield.
	$meta_key_search = "'_" . $field_name . "%'";
	$keymeta = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE post_id = $post_id AND meta_key LIKE $meta_key_search ORDER BY meta_key ASC", ARRAY_A);

	// Merge the results
	$merged = array();
	foreach($postmeta as $index => $result_data) {
		$merged[] = array_merge_recursive($result_data, $keymeta[$index]);
	}

	// Because the keys are the same in the arrays we merged, this will cause the values to be a sub-array
	// Let's fix that, and don't include data we don't need
	$flattened = array();
	foreach($merged as $merged_array) {
		$flattened[] = array(
			'post_id' => $merged_array['post_id'][0],
			'value'   => $merged_array['meta_value'][0],
			'key'     => $merged_array['meta_value'][1]
		);
	}

	// Use this and some more processing to build an array of all the data we need
	$i = 0;
	foreach($flattened as $index => $raw_data) {
		if(is_array($raw_data)) {
			$object = get_field_object($raw_data['key']);
			$value = $raw_data['value'];
			$parent_key = $object['parent'];
			$parent_name = '';

			if( ! empty($parent_key)) {
				$parent_object = get_field_object($parent_key);
				$parent_name = $parent_object['name'];
			}

			$data[$i]['name'] = $object['name'];
			$data[$i]['value'] = $value;
			$data[$i]['type'] = $object['type'];
			$data[$i]['parent_name'] = $parent_name;

			$i++;
		}
	}

	return $data;
}


/**
 * Get Yoast SEO primary term
 *
 * @param       $taxonomy
 * @param false $id
 *
 * @return array|false|mixed|WP_Error|WP_Term|null
 */
function starterkit_get_primary_term($taxonomy, $id = false) {
	$id = ($id ? $id : get_the_ID());

	$term = false;
	if(class_exists('WPSEO_Primary_Term')) {
		$primary_term = new WPSEO_Primary_Term($taxonomy, $id);
		$term = get_term($primary_term->get_primary_term());
	}

	if( ! $term || is_wp_error($term)) {
		$terms = get_the_terms($id, $taxonomy);

		if($terms && ! is_wp_error($terms)) {
			foreach($terms as $t) {
				if($t->parent !== 0) {
					$term = $t;
					break;
				}
			}
		}

		if(( ! $term || is_wp_error($term)) && ! empty($terms) && ! is_wp_error($terms)) {
			$term = reset($terms);
		}
	}

	return $term;
}


/**
 * Reroute page to 404 as per ACF field page_inaccessible
 *
 * @param $template
 *
 * @return mixed|string
 */
function starterkit_reroute_to_404($template) {
	if(get_field('page_inaccessible')) {
		return locate_template('404.php');
	} else {
		return $template;
	}
}
add_filter('template_include', 'starterkit_reroute_to_404');


/**
 * Redirect to a URL as per ACF field page_redirect
 */
function starterkit_redirect_to_url() {
	$redirect = get_field('page_redirect');
	if($redirect && $redirect['url']) {
		wp_redirect($redirect['url']);
	}
}
add_action('template_redirect', 'starterkit_redirect_to_url');