<?php
namespace Starterkit_Classic;

class Starterkit_Admin {

	public function __construct() {
        add_filter('gettext', [$this, 'change_excerpt_explanation'], 20, 3);
    }


	/**
	 * Change the excerpt explanation in the backend
	 * @param $translated_text
	 * @param $text
	 * @param $domain
	 *
	 *
	 * @return string
	 */
	function change_excerpt_explanation($translated_text, $text, $domain): string {
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
}
