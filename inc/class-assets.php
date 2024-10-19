<?php
namespace Starterkit_Classic;

class Starterkit_Assets {

	public function __construct() {
		add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend']);
        add_filter('script_loader_tag', [$this, 'script_type_module'], 10, 3);
    }


	/**
	 * Enqueue frontend scripts and styles
     * Note: This is in addition to the enqueue_frontend method in the accompanying plugin
	 * @see Starterkit_Common_Frontend::enqueue_frontend()
     *
     * @return void
	 */
	function enqueue_frontend(): void {
        wp_enqueue_script('module-bundle', get_template_directory_uri() . '/modules/modules.bundle.js', array(), THEME_STARTERKIT_VERSION, true);
	}


    /**
     * Add type=module to the theme scripts
     * Note: This is in addition to the script_type_module method in the accompanying plugin
     *  @see Starterkit_Common_Frontend::enqueue_frontend()
     *
     * @param $tag
     * @param $handle
     * @param $src
     *
     * @return mixed|string
     */
    function script_type_module($tag, $handle, $src): mixed {
        if (in_array($handle, ['module-bundle', 'theme-animation'])) {
            $tag = '<script type="module" src="' . esc_url($src) . '" id="' . $handle . '" ></script>';
        }

        return $tag;
    }
}
