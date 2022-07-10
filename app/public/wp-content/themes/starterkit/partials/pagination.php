<div class="pagination content row">
	<div class="col-12">
		<?php
		global $wp_query;
		$output = paginate_links(array(
			'current'   => max(1, get_query_var('paged')),
			'total'     => $wp_query->max_num_pages,
			'prev_text' => 'Prev',
			'next_text' => 'Next',
			'type'      => 'list',
			'end_size'  => 3,
			'mid_size'  => 3
		));
		$output = str_replace('page-numbers', 'btn btn--dark--hollow', $output);
		$output = str_replace("<ul class='btn btn--dark--hollow'>", '<ul>', $output);
		$output = str_replace('outline current', 'current', $output);

		echo $output;
		?>
	</div>
</div>