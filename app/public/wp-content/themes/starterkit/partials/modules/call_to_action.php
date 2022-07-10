<?php
$width = get_sub_field('width');
$copy = get_sub_field('copy');
$button = get_sub_field('button');
?>
<section class="module module__call-to-action module__call-to-action--<?php echo $width; ?>">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-10">
				<div class="module__call-to-action__inner entry-content">
					<?php echo $copy; ?>
					<?php if($button) {
						$url = $button['url'];
						$label = $button['title'];
						$target = $button['target']; ?>
						<a href="<?php echo $url; ?>" class="btn btn--primary" target="<?php echo $target; ?>"><?php echo $label; ?></a>
					<?php } ?>

				</div>
			</div>
		</div>
	</div>
</section>
