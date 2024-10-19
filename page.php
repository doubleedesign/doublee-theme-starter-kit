<?php
the_post();
get_header();
if( ! is_front_page()) {
	get_template_part('partials/breadcrumbs'); ?>
	<header class="pseudo-module page-header">
		<div class="row">
			<div class="col-xs-12 entry-content">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>
	</header>
<?php }
get_template_part('get-modules');
get_footer();
