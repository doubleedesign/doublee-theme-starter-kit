<?php

/**
 * Class to handle customisations and additional functionality
 * related to ACF flexible content modules
 * @since 3.0.0
 */
class Starterkit_Layout_Modules {

    public function __construct() {
        add_filter('acfe/flexible/render/template', [$this, 'template_file_location'], 10, 4);
        add_filter('acfe/flexible/render/style', [$this, 'style_file_location'], 10, 4);
        add_filter('acfe/flexible/render/script', [$this, 'script_file_location'], 10, 4);

        // Override the paths in the backend to show these custom paths
        add_filter('acfe/flexible/prepend/template', [$this, 'display_template_render_path_in_admin'], 20, 3);
        add_filter('acf/prepare_field', [$this, 'display_template_render_file_in_admin'], 20, 3);
    }


    /**
     * Specify where ACF Extended should look for the template files to render dynamic previews
     * @param $template
     * @param $field
     * @param $layout
     * @param $is_preview
     * @param $post_id
     *
     * @return string
     */
    function template_file_location($template, $field, $layout, $is_preview): string {
        $parent_theme_path = get_template_directory() . "/modules/$layout[name]/$layout[name].php";
        $child_theme_path = get_stylesheet_directory() .  "/modules/$layout[name]/$layout[name].php";

        // Check if the template file exists in the child theme path first
        // (which will be the same as the parent theme path if using this theme standalone)
        // and if not, fall back to the parent theme path
        $template = file_exists($child_theme_path)
            ? $child_theme_path
            : $parent_theme_path;

        return $template;
    }

    /**
     * Specify where ACF Extended should look for the stylesheet files
     * @param $style
     * @param $field
     * @param $layout
     * @param $is_preview
     * @param $post_id
     *
     * @return string
     */
    function style_file_location($style, $field, $layout, $is_preview): string {
        $parent_theme_style = get_template_directory() . "/modules/$layout[name]/$layout[name].css";
        $child_theme_style = get_stylesheet_directory() . "/modules/$layout[name]/$layout[name].css";

        $style = file_exists($child_theme_style) ? $child_theme_style : $parent_theme_style;

        return $style ?? '';
    }


    /**
     * Specify where ACF Extended should look for the JavaScript files
     * @param $script
     * @param $field
     * @param $layout
     * @param $is_preview
     * @param $post_id
     *
     * @return string
     */
    function script_file_location($script, $field, $layout, $is_preview): string {
        $parent_theme_script = get_template_directory() . "/modules/$layout[name]/$layout[name].js";
        $child_theme_script = get_stylesheet_directory() . "/modules/$layout[name]/$layout[name].js";

        $script = file_exists($child_theme_script) ? $child_theme_script : $parent_theme_script;

        return $script ?? '';
    }


    /**
     * Display the custom paths in the admin interface
     */
    function display_template_render_path_in_admin($prepend, $field, $layout): string {
        return $prepend . "modules/$layout[name]/";
    }

    function display_template_render_file_in_admin($field) {
        if (str_ends_with($field['name'], '[acfe_flexible_render_template]')) {
            $field['placeholder'] = basename(rtrim($field['prepend'], '/')) . '.php';
        }
        if (str_ends_with($field['name'], '[acfe_flexible_render_style]')) {
            $field['placeholder'] = basename(rtrim($field['prepend'], '/')) . '.css';
        }
        if (str_ends_with($field['name'], '[acfe_flexible_render_script]')) {
            $field['placeholder'] = basename(rtrim($field['prepend'], '/')) . '.js';
        }

       return $field;
    }

}
