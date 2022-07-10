<?php get_header(); ?>

<div class="container">
	<div class="row">
		<?php
		if(have_posts()) {
			while(have_posts()) {
				the_post();
				get_template_part('partials/card');
			}
			get_template_part('partials/pagination');
		} else { ?>
			<div class="alert alert-warning">
				<p>No posts were found</p>
			</div>
		<?php } ?>
	</div>
</div>

<?php get_footer(); ?>
