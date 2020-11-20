<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FlatC
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1 minimum-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'flatc'); ?></a>
		<div class="loader">
			<div class="loader-gif">
				<?php
				the_custom_logo();
				$logo = get_option('site-loading-svg');
				$id = attachment_url_to_postid($logo);
				$file = get_attached_file($id);
				if ($logo) {
					echo '<div class="loading-svg-front forwards">' . file_get_contents($file) . '</div>';
				} else {
				?>
					<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
				<?php
				};
				?>
			</div>
		</div>

		<header id="masthead" class="site-header">
			<div class="site-branding">
				<?php
				the_custom_logo();
				$logo = get_option('site-logo-svg');
				$id = attachment_url_to_postid($logo);
				$file = get_attached_file($id);
				if ($logo) {
					if (is_page_template('template-parts/page-blog.php')){
						$logo = get_option('site-loading-svg');
						$id = attachment_url_to_postid($logo);
						$file = get_attached_file($id);
					}
					echo '<a href="' . esc_url(home_url('/')) . '">' . file_get_contents($file) . '</a>';
				} else {
				?>
					<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
				<?php
				};
				?>
			</div><!-- .site-branding -->
			<div id="nav-btn" class="burger burger-rotate">
				<div class="burger-lines"></div>
			</div>
			<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap" rel="stylesheet">
		</header><!-- #masthead -->