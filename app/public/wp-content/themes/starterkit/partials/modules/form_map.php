<?php
$copy = get_sub_field('copy');
$contact = get_sub_field('include_contact_details');
$form = get_sub_field('form_shortcode');
$map = get_sub_field('map');

$infowindow = '<div class="address">';
foreach(array('name', 'street_number', 'street_name', 'city', 'state_short', 'post_code') as $index => $field) {
	if(isset($map[$field])) {
		$infowindow .= sprintf('<span class="segment segment__%s">%s</span> ', $field, $map[$field]);
	}
}
$infowindow .= '</div>';
?>
<section class="module module__form-map">
	<div class="container">
		<div class="row">
			<div class="module__form-map__copy entry-content col-xs-12 col-md-6">
				<?php echo $copy; ?>
				<?php echo starterkit_address('expanded'); ?>
			</div>
			<div class="module__form-map__form col-xs-12 col-md-6">
				<?php echo do_shortcode($form); ?>
			</div>
		</div>
	</div>
	<?php if($map) { ?>
		<div class="module__form-map__map">
			<div class="acf-map" data-zoom="<?php echo $map['zoom']; ?>">
				<div class="marker"
					 data-lat="<?php echo esc_attr($map['lat']); ?>"
					 data-lng="<?php echo esc_attr($map['lng']); ?>">
					<?php echo $infowindow; ?>
				</div>
			</div>
		</div>
	<?php } ?>
</section>
