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
			<div class="search-container">
				<input type="text" class="search-input" placeholder="Keresés...">
				<svg fill="#000000" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="24px" height="24px"><path d="M 20.5 6 C 12.509634 6 6 12.50964 6 20.5 C 6 28.49036 12.509634 35 20.5 35 C 23.956359 35 27.133709 33.779044 29.628906 31.75 L 39.439453 41.560547 A 1.50015 1.50015 0 1 0 41.560547 39.439453 L 31.75 29.628906 C 33.779044 27.133709 35 23.956357 35 20.5 C 35 12.50964 28.490366 6 20.5 6 z M 20.5 9 C 26.869047 9 32 14.130957 32 20.5 C 32 23.602612 30.776198 26.405717 28.791016 28.470703 A 1.50015 1.50015 0 0 0 28.470703 28.791016 C 26.405717 30.776199 23.602614 32 20.5 32 C 14.130953 32 9 26.869043 9 20.5 C 9 14.130957 14.130953 9 20.5 9 z"/></svg>
        	</div>
			<div id="nav-btn" class="burger burger-rotate">
				<div class="burger-lines"></div>
			</div>
			<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500&display=swap" rel="stylesheet">
		</header><!-- #masthead -->