<?php
the_post();
get_header();
?>

<?php get_template_part('partials/breadcrumbs'); ?>

	<div class="container">
		<article class="pseudo-module single-post row">
			<div class="col-xs-12 col-lg-10 col-xl-9">
				<header class="single-post__header entry-content">
					<div class="single-post__header__title">
						<h1><?php the_title(); ?></h1>
					</div>
					<div class="single-post__header__meta">
						<?php echo starterkit_entry_meta(); ?>
					</div>
				</header>
				<?php if(has_post_thumbnail()) { ?>
					<div class="single-post__image">
						<?php the_post_thumbnail('single-post'); ?>
					</div>
				<?php } ?>
				<div class="single-post__copy entry-content">
					<?php the_content(); ?>
				</div>
			</div>
		</article>
	</div>

<?php get_footer(); ?>