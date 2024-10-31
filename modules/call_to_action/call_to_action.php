<?php
$width = get_sub_field('width');
$copy = get_sub_field('copy');
$include_phone = get_sub_field('include_phone_number');
$phone = get_field('contact_details', 'option')['phone'];
$button = get_sub_field('button');
$theme = get_sub_field('colour_theme')[0]['colour_theme'];
$bg = get_sub_field('background_colour');

$bgColour = $bg === 'theme' ? $theme : $bg;
$btnColour = $bg === 'theme' ? 'white' : $theme;
?>
<section
	class="module module__call-to-action module__call-to-action--<?php echo $width; ?> <?php echo $width === 'fullwidth' ? "has-$bgColour-background-color" : 'has-white-background-color' ?>">
	<div class="row">
		<div class="<?php echo $width === 'narrow' ? 'col-12 col-lg-10' : 'col-12' ?>">
			<div class="module__call-to-action__inner has-<?php echo $bgColour; ?>-background-color entry-content">

				<div class="module__call-to-action__inner__text">
					<?php echo $copy; ?>
				</div>

				<?php if($include_phone && $phone) { ?>
					<div class="module__call-to-action__inner__phone">
						<i class="fa-solid fa-mobile-screen"></i>
						<span class="phone"><?php echo $phone; ?></span>
					</div>
				<?php } ?>

				<?php if($button) { ?>
					<div class="module__call-to-action__inner__button">
						<?php
						$url = $button['url'];
						$label = $button['title'];
						$target = $button['target']; ?>
						<a href="<?php echo $url; ?>" class="btn btn--<?php echo $btnColour; ?>" target="<?php echo $target; ?>"><?php echo $label; ?></a>
					</div>
				<?php } ?>

			</div>
		</div>
	</div>
</section>
