<?php
$copy = get_sub_field('copy');
$image_id = get_sub_field('image');
$crop = get_sub_field('image_cropping');
$caption = wp_get_attachment_caption($image_id);
$order = get_sub_field('order');
$width = get_sub_field('width')[0]['width'];
$bg = get_sub_field('background_colour')[0]['background_colour'];
?>
<section class="module module__copy-image module__copy-image--<?php echo $order; ?> has-<?php echo $bg; ?>-background-color">
	<div class="row">
		<figure class="module__copy-image__image <?php echo $width === 'narrow' ? 'col-12 col-md-6 col-lg-5' : 'col-12 col-md-6' ?>">
			<div class="module__copy-image__image__media media-item--aspect-ratio-crop media-item--aspect-ratio-crop-<?php echo $crop; ?>">
				<?php echo wp_get_attachment_image($image_id, 'medium'); ?>
			</div>
			<?php if($caption) { ?>
				<figcaption class="module__copy-image__image__caption"><?php echo $caption; ?></figcaption>
			<?php } ?>
		</figure>
		<div class="module__copy-image__copy <?php echo $width === 'narrow' ? 'col-12 col-md-6 col-lg-5' : 'col-12 col-md-6' ?>">
			<div class="module__copy-image__copy__inner entry-content">
				<?php echo $copy; ?>
			</div>
		</div>
	</div>
</section>
