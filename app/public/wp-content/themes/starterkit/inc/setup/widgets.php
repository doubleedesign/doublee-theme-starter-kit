<?php
/**
 * Register widget areas
 */
function starterkit_register_sidebars() {
	/*register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar',
		'description' => '',
		'before_widget' => '<div id="%1$s" class="sidebar %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="">',
		'after_title' => '</h2>',
	));*/
}
add_action('widgets_init', 'starterkit_register_sidebars');