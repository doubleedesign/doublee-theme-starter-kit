<?php
the_post();
get_header();
if( ! is_front_page()) {
	get_template_part('partials/breadcrumbs');
}
get_template_part('partials/get-modules');
get_footer();