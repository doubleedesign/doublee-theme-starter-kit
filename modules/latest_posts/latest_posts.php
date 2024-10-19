<?php
if(is_single()) {
	$cats = get_the_terms(get_the_id(), 'category');
	$heading = 'More posts about ' . $cats[0]->name;
	$args = array(
		'posts_per_page' => 3,
		'post_type'      => 'post',
		'tax_query'      => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'id',
				'terms'    => $cats[0]->term_id
			),
		),
	);
} else {
	$heading = get_sub_field('heading');
	$cats = get_sub_field('show_posts_from');
	$args = array(
		'posts_per_page' => 3,
		'post_type'      => 'post',
		'tax_query'      => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'id',
				'terms'    => $cats
			),
		),
	);
}
$query = new WP_Query($args);
?>
<section class="module module__latest-posts">
	<header class="module__latest-posts__heading entry-content row">
		<div class="col-12">
			<h2><?php echo $heading; ?></h2>
		</div>
	</header>
	<div class="module__latest-posts__posts row">
		<?php
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
					'colour'      => 'default',
					'type'        => 'post'
				));
			}
		} else { ?>
			<div class="col-xs-12">
				<div class="alert alert--info">
					<p>Sorry, there&rsquo;s no posts at the moment.</p
				</div>
			</div>
		<?php }
		wp_reset_postdata();
		?>
	</div>
</section>
