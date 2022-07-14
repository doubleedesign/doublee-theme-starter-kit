<?php
$form = get_sub_field('form_shortcode');
?>
<section class="module module__form bg-light">
	<div class="row">
		<div class="col-12 col-md-9 col-xl-7">
			<?php echo do_shortcode($form); ?>
		</div>
	</div>
</section>
