<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link    https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package starterkit
 */

get_header();
?>

	<main class="site-main">

		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h1><?php esc_html_e('Whoops! Nothing to see here!', 'starterkit'); ?></h1>

					<p><?php esc_html_e('That page cannot be found. Try searching for it?', 'starterkit'); ?></p>

					<?php get_search_form(); ?>
				</div>
			</div>
		</div>

	</main>

<?php
get_footer();
