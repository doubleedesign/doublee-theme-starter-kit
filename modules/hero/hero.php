<?php
$image_id = get_sub_field('image');

$copy_group = get_sub_field('copy');
$heading = $copy_group['heading'];
$copy = $copy_group['copy'];
$button = $copy_group['button'];
$theme = $copy_group['colour_theme'][0]['colour_theme'];
$bg = $copy_group['background_colour'][0]['background_colour'];

$bgColour = $bg === 'theme' ? $theme : $bg;
$btnColour = $bg === 'theme' ? 'white' : $theme;
?>
<section class="module module__hero">
	<div class="module__hero__image">
		<?php echo wp_get_attachment_image($image_id, 'full'); ?>
	</div>
	<div class="module__hero__copy">
		<div class="row">
			<div class="col-12 col-md-8 col-lg-6">
				<div class="module__hero__copy__inner has-<?php echo $bgColour; ?>-background-color entry-content">
					<h1><?php echo $heading; ?></h1>
					<?php echo wpautop($copy); ?>
					<?php
					if($button) {
						$url = $button['url'];
						$label = $button['title'];
						$target = $button['target']; ?>
						<a class="btn btn--<?php echo $btnColour; ?>"
						   href="<?php echo $url; ?>" target="<?php echo $target; ?>">
							<?php echo $label; ?>
						</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>
