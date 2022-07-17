<?php
$image_id = get_sub_field('image');
$heading = get_sub_field('heading');
$copy = get_sub_field('copy');
$button = get_sub_field('button');
?>
<section class="module module__hero">
	<div class="module__hero__image">
		<?php echo wp_get_attachment_image($image_id, 'full'); ?>
	</div>
	<div class="module__hero__copy">
		<div class="row">
			<div class="col-12 col-md-8 col-lg-6">
				<div class="module__hero__copy__inner entry-content">
					<h1><?php echo $heading; ?></h1>
					<?php echo wpautop($copy); ?>
					<?php
					if($button) {
						$url = $button['url'];
						$label = $button['title'];
						$target = $button['target']; ?>
						<a class="btn btn--primary" href="<?php echo $url; ?>" target="<?php echo $target; ?>"><?php echo $label; ?></a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>