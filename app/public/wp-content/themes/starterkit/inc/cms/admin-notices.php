<?php

function starterkit_required_plugin_notification(): void {
	$warnings = array();
	if (!is_plugin_active('advanced-custom-fields-pro/acf.php')) {
		$warnings[] = 'Advanced Custom Fields Pro';
	}
	if (!is_plugin_active('advanced-custom-fields-component_field/index.php')) {
		$warnings[] = 'Advanced Custom Fields Component Field';
	}
	if (!is_plugin_active('classic-editor/classic-editor.php')) {
		$warnings[] = 'Classic Editor';
	}
	if (!is_plugin_active('tinymce-advanced/tinymce-advanced.php')) {
		$warnings[] = 'Advanced Editor Tools';
	}

	if(count($warnings) > 0) {
		echo '<div class="notice notice-error">';
			echo '<p>The '.wp_get_theme()->name.' theme requires the following plugins to be installed and activated for full functionality. Without them, some features may be missing or not work as expected.</p>';
			echo '<ul>';
				foreach($warnings as $warning) {
					echo '<li>'.$warning.'</li>';
				}
			echo '</ul>';
		echo '</div>';
	}
}
add_action('admin_notices', 'starterkit_required_plugin_notification');
