<?php
require_once('class-content-handling.php');
require_once('class-utils.php');

/**
 * The front-end specific functionality and customisations for the theme.
 */
class Starterkit_Frontend {

	public function __construct() {
		new Starterkit_Theme_Frontend_Utils();
		new Starterkit_Content_Handling();

		add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend']);
        add_filter('script_loader_tag', [$this, 'script_type_module'], 10, 3);
	}


	/**
	 * Enqueue front-end scripts and styles
	 * @wp-hook
	 */
	function enqueue_frontend(): void {
		if(is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}

		wp_enqueue_style('starterkit-style', get_template_directory_uri() . '/style.css', array(), THEME_VERSION);

		wp_enqueue_script('fontawesome', '//kit.fontawesome.com/328982870b.js', array(), '6.x', true);

        wp_enqueue_script('vue-loader', get_template_directory_uri() . '/common/js/vendor/vue3-sfc-loader.js');
        wp_enqueue_script('theme-vue', get_template_directory_uri() . '/common/js/vue-components.js', array(
            'vue-loader'
        ), THEME_VERSION, true);

        wp_enqueue_script('module-bundle', get_template_directory_uri() . '/modules/modules.bundle.js', array(), THEME_VERSION, true);

		if(defined('GMAPS_KEY') && GMAPS_KEY) {
			wp_enqueue_script('gmaps', 'https://maps.googleapis.com/maps/api/js?key=' . GMAPS_KEY, '', '3', true);
		}
	}

    /**
     * Add type=module to the theme scripts
     *
     * @param $tag
     * @param $handle
     * @param $src
     *
     * @return mixed|string
     */
    function script_type_module($tag, $handle, $src): mixed {
        if (in_array($handle, ['vue', 'theme-vue', 'animate-into-view', 'theme-animation', 'module-bundle'])) {
            $tag = '<script type="module" src="' . esc_url($src) . '" id="' . $handle . '" ></script>';
        }

        return $tag;
    }


    /**
     * Get nav menu items by location
     *
     * @param $location string menu location name
     * @param array $args args to pass to WordPress function wp_get_nav_menu_items
     *
     * @return false|array
     */
    static function get_nav_menu_items_by_location(string $location, array $args = []): false|array {
        $locations = get_nav_menu_locations();
        if(isset($locations[$location])) {
            $object = wp_get_nav_menu_object($locations[$location]);
            $items = wp_get_nav_menu_items($object->name, $args);
            $current = get_queried_object();
            $default_category_id = get_option('default_category');

            foreach ($items as $item) {
                if (isset($current->post_type) && $current->post_type == 'page') {
                    $post_id = $current->ID;
                    if ($post_id == $item->object_id) {
                        $item->classes[] = 'current-menu-item';
                    }
                    if ($post_id == $item->post_parent) {
                        $item->classes[] = 'current-menu-parent';
                    }
                } else if (isset($current->taxonomy) && $current->taxonomy == 'category') {
                    if ($item->object_id == PAGE_FOR_POSTS || $item->object_id == $default_category_id) {
                        $item->classes[] = 'current-menu-item';
                    }
                } else if (isset($current->post_type) && $current->post_type == 'post') {
                    if ($item->object_id == PAGE_FOR_POSTS || $item->object_id == $default_category_id) {
                        $item->classes[] = 'current-menu-parent';
                    }
                } else if (isset($current->post_type) && $item->type == 'post_type_archive') {
                    if ($current->post_type == $item->object) {
                        $item->classes[] = 'current-menu-parent';
                    }
                } else if ($item->type == 'post_type_archive' && $current->name == $item->object) {
                    $item->classes[] = 'current-menu-item';
                }


                if ($item->url) {
                    if (parse_url($item->url)['host'] !== parse_url(get_bloginfo('url'))['host']) {
                        $item->classes[] = 'external';
                    }
                }
            }

            return $items;
        }

        return [];
    }

}
