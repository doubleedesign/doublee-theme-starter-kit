<div class="card col-xs-12 col-md-6 col-lg-4">
	<a href="<?php the_permalink(); ?>" class="card__content">
		<div class="card__content__image">
			<?php the_post_thumbnail(); ?>
		</div>
		<div class="card__content__copy entry-content">
			<h3><?php the_title(); ?></h3>
			<?php echo starterkit_custom_excerpt(get_the_excerpt(), 25); ?>
		</div>
	</a>
</div>
