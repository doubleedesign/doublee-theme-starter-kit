<?php
/**
 * Theme header
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package starterkit
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> lang="en">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'starterkit'); ?></a>

	<header id="masthead" class="site-header">
		<div class="container">
			<div class="row">

				<div class="site-header__logo col-xs-10 col-md-4 col-xl-3">
					<?php
					the_custom_logo();
					if(is_front_page() && is_home()) :
						?>
						<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
					<?php
					else :
						?>
						<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
					<?php
					endif;
					$starterkit_description = get_bloginfo('description', 'display');
					if($starterkit_description || is_customize_preview()) :
						?>
						<p class="site-description"><?php echo $starterkit_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?></p>
					<?php endif; ?>
				</div>

				<div class="site-header__menu-toggle col-xs-2">
					<button id="header-menu-button" class="btn btn--primary--hollow btn--icon" aria-controls="primary-menu" aria-expanded="false">
						<i class="fa-solid fa-bars"></i>
						<i class="fa-solid fa-times" style="display: none"></i>
						<span class="screen-reader-text"><?php esc_html_e('Open/Close Primary Menu', 'starterkit'); ?></span>
					</button>
				</div>

				<nav class="site-header__nav col-xs-12 col-lg-8 col-xl-9">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'header',
							'menu_id'        => 'primary-menu',
							'menu_class'     => 'menu site-header__nav__menu',
							'depth'          => 1
						)
					); ?>
				</nav>

			</div>
		</div>
	</header>
