<section class="module module__sitemap bg-white">
	<div class="row">
		<div class="entry-content col-12 col-md-8 col-xl-7">
			<h2>Site Map</h2>
			<ul>
			<?php
			$args = array(
				'posts_per_page' => -1,
				'post_type'      => 'page',
				'post_parent' 	 => 0,
				'orderby'		 => 'menu_order',
				'post__not_in'	 => array(get_the_id())
			);
			$query = new WP_Query($args);
			$page_ids = wp_list_pluck($query->posts, 'ID');

			foreach($page_ids as $page_id) { ?>
				<li><a href="<?php echo get_the_permalink($page_id); ?>"><?php echo get_the_title($page_id); ?></a>
					<?php
					$args = array(
						'posts_per_page' => -1,
						'post_type'      => 'page',
						'post_parent'	 => $page_id,
						'orderby'		 => 'menu_order',
						'post__not_in'	 => array(get_the_id())
					);
					$query = new WP_Query($args);
					$sub_page_ids = wp_list_pluck($query->posts, 'ID');

					if($sub_page_ids) { ?>
						<ul>
							<?php foreach($sub_page_ids as $sub_page_id) { ?>
								<li><a href="<?php echo get_the_permalink($sub_page_id); ?>"><?php echo get_the_title($sub_page_id); ?></a></li>
							<?php } ?>
						</ul>
					<?php } ?>

					<?php
					if($page_id == get_option('page_for_posts')) {
						$cats = get_terms( array(
							'taxonomy' => 'category',
							'hide_empty' => false,
						));
						?>
						<ul>
							<?php foreach($cats as $cat) { ?>
								<?php if($cat->name == 'Uncategorised') { ?>
									<li><a href="<?php echo get_term_link($cat->term_id); ?>"><?php echo $cat->name; ?> posts</a></li>
								<?php } else { ?>
									<li><a href="<?php echo get_term_link($cat->term_id); ?>">Posts about <?php echo $cat->name; ?></a></li>
								<?php } ?>
							<?php } ?>
						</ul>
					<?php } ?>
				</li>
			<?php } ?>
			</ul>
		</div>
	</div>
</section>