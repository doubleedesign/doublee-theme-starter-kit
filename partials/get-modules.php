<?php
$source = get_the_id();
if(have_rows(MODULES_FIELD_NAME, $source)) {
	while (have_rows( MODULES_FIELD_NAME, $source)) {
		the_row();
		get_template_part('partials/modules/'.get_row_layout());
	}
}