<?php
/**
 * Register menus
 */
function starterkit_register_menus() {
	register_nav_menus(array(
		'header' => 'Header menu',
		'footer' => 'Footer menu'
	));
}
add_action('init', 'starterkit_register_menus');


/**
 * Add classes to menu <li> tags
 *
 * @param $classes
 * @param $item
 * @param $args
 * @param $depth
 *
 * @return mixed
 */
function starterkit_menu_item_classes($classes, $item, $args, $depth) {

	// Header menu
	if($args->theme_location == 'header-menu') {
		array_push($classes, 'nav-item');

		if(in_array('menu-item-has-children', $classes)) {
			array_push($classes, 'has-sub');
			array_push($classes, 'toggle-hover');
		}
	}

	// Footer menu
	if($args->theme_location == 'footer-menu') {
		if($depth == 0 && $args->depth > 1) {
			array_push($classes, 'menu-item--top-level col-xs-12 col-sm-6 col-xl-3');
		} else if($args->depth == 1) {
			array_push($classes, 'col-xs-12');
		}
	}

	return $classes;
}
add_filter('nav_menu_css_class', 'starterkit_menu_item_classes', 10, 4);


/**
 * Add classes to menu <a> tags
 *
 * @param $atts
 * @param $item
 * @param $args
 * @param $depth
 *
 * @return mixed
 */
function starterkit_menu_link_classes($atts, $item, $args, $depth) {

	// Header menu
	if($args->theme_location == 'header-menu' && $depth == 0 && in_array('menu-item-has-children', $item->classes)) {
		$atts['class'] = 'nav-dropdown-link';
	}

	return $atts;
}
add_filter('nav_menu_link_attributes', 'starterkit_menu_link_classes', 10, 4);


/**
 * Add classes to sub-menu <ul>
 *
 * @param $classes
 * @param $args
 *
 * @return mixed
 */
function starterkit_menu_submenu_classes($classes, $args) {

	// Header menu
	if($args->theme_location == 'header-menu') {
		array_push($classes, 'dropdown-menu');
		array_push($classes, 'dropdown-animated');
	}

	return $classes;
}
add_filter('nav_menu_submenu_css_class', 'starterkit_menu_submenu_classes', 10, 2);