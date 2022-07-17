<?php
$copy = get_sub_field('copy');
if($copy) { ?>
	<section class="module module__copy">
		<div class="row">
			<div class="col-12 col-lg-10 entry-content">
				<?php echo $copy; ?>
			</div>
		</div>
	</section>
<?php } ?>