<?php
$copy = get_sub_field('copy');
$image_id = get_sub_field('image');
$caption = wp_get_attachment_caption($image_id);
$order = get_sub_field('order');
?>
<section class="module module__copy-image module__copy-image--<?php echo $order; ?>">
	<div class="row">
		<figure class="module__copy-image__image col-12 col-md-6">
			<?php echo wp_get_attachment_image($image_id, 'medium'); ?>
			<?php if($caption) { ?>
				<figcaption class="module__copy-image__image__caption"><?php echo $caption; ?></figcaption>
			<?php } ?>
		</figure>
		<div class="module__copy-image__copy col-12 col-md-6">
			<div class="module__copy-image__copy__inner entry-content">
				<?php echo $copy; ?>
			</div>
		</div>
	</div>
</section>
