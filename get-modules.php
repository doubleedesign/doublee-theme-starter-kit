<?php
$source = get_the_id();
if(have_rows(MODULES_FIELD_NAME, $source)) {
	while (have_rows( MODULES_FIELD_NAME, $source)) {
		the_row();
        $row_name = get_row_layout();
		get_template_part("modules/$row_name/$row_name");
	}
}
