<?php
$copy = get_sub_field('copy');
$width = get_sub_field('width')[0]['width'];
$bg = get_sub_field('background_colour')[0]['background_colour'];

if($copy) { ?>
	<section class="module module__copy bg-<?php echo $bg; ?>"">
		<div class="row">
			<div class="<?php echo $width === 'narrow' ? 'col-12 col-lg-10 entry-content' : 'col-12 entry-content' ?>">
				<?php echo $copy; ?>
			</div>
		</div>
	</section>
<?php } ?>
