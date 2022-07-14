<section class="module module__child-pages">
	<div class="container">
		<header class="module__child-pages__heading entry-content row">
			<div class="col-12">
				<h2>In this section</h2>
			</div>
		</header>
		<div class="row">
			<?php
			$args = array(
				'posts_per_page' => -1,
				'post_type'      => 'page',
				'post_parent'    => get_the_id()
			);
			$query = new WP_Query($args);
			if($query->have_posts()) {
				while($query->have_posts()) {
					$query->the_post();
					get_template_part('partials/card', '', array(
						'image_id'    => get_post_thumbnail_id(get_the_id()),
						'heading'     => get_the_title(),
						'description' => get_the_excerpt(),
						'link'        => array(
							'title'  => get_the_title(),
							'url'    => get_the_permalink(),
							'target' => ''
						),
						'colour'      => 'dark',
						'type'        => 'page'
					));
				}
			}
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>


















