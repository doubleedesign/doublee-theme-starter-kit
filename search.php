<?php get_header(); ?>

	<main id="primary" class="pseudo-module">
		<?php if(have_posts()) { ?>
			<div class="page-header">
				<h1 class="page-title">
					<?php printf(esc_html__('Search Results for: %s', 'starterkit'), '<span>' . get_search_query() . '</span>'); ?>
				</h1>
			</div>
			<?php
			/* Start the Loop */
			while(have_posts()) {
                the_post();
                get_template_part('components/no-content/no-content', 'search');
            }
			the_posts_navigation();
        }
		else {
            get_template_part('components/post-excerpt/post-excerpt', 'none');
        } ?>
	</main>
<?php
get_footer();
