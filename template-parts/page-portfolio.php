<?php

/**
 * Template Name: Portfolio
 * 
 * The template for displaying portfolio items
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlatC
 */

get_header();
?>

	<main id="primary" class="site-main page-portfolio">

		<div class="col1">
		<img  id="mobile-image" src="" alt="Mobile view of website">
			<?php
				$args = array(  
					'post_type' => 'portfolio',
					'post_status' => 'publish',
					'posts_per_page' => -1, 
					'orderby' => 'date', 
					'order' => 'DESC',
				);
			
				$loop = new WP_Query( $args ); 
				
				echo '<ul class="portfolio-list">';
				$active = 0;

					while ( $loop->have_posts() ) : $loop->the_post();
						$link = get_post_meta( $post->ID, '_portfolio_link_value_key', true );
						if (strlen($link) < 2){
							$url = 'data-item-url="#"';
						} else {
							$url = 'data-item-url="' . $link . '"';
						}


						$background_color = get_post_meta( $post->ID, '_background_color', true );
						if (strlen($background_color) < 2){
							$background_color = 'data-background-color="#"';
						} else {
							$background_color = 'data-background-color="' . $background_color . '"';
						}
						

						$desktopImage = get_post_meta( $post->ID, '_desktop_image_id', true );
						if (strlen($desktopImage) < 2){
							$desktopImage = 'data-desktop-image="#"';
						} else {
							$desktopImage = wp_get_attachment_url( $desktopImage );
							$desktopImage = 'data-desktop-image="' . $desktopImage . '"';
						}
						$tabletImage = get_post_meta( $post->ID, '_tablet_image_id', true );
						if (strlen($tabletImage) < 2){
							$tabletImage = 'data-tablet-image="#"';
						} else {
							$tabletImage = wp_get_attachment_url( $tabletImage );
							$tabletImage = 'data-tablet-image="' . $tabletImage . '"';
						}
						$mobileImage = get_post_meta( $post->ID, '_mobile_image_id', true );
						if (strlen($mobileImage) < 2){
							$mobileImage = 'data-mobile-image="#"';
						} else {
							$mobileImage = wp_get_attachment_url( $mobileImage );
							$mobileImage = 'data-mobile-image="' . $mobileImage . '"';
						}

						if ($active == 0){
							echo '<li class="active portfolio-item cursor" ' .$mobileImage.$tabletImage.$desktopImage.$background_color.' data-item-name="'. get_the_title() . '"' . $url .'>' . '' . '</li>';
							$active = 1;
						} else {
							echo '<li class="portfolio-item cursor" '.$mobileImage.$tabletImage.$desktopImage.$background_color.' data-item-name="'. get_the_title() . '"' .$url . '>' . '' . '</li>';
						}
					endwhile;

				echo '</ul>';
			
				
				wp_reset_postdata();
			?>
			<span class="border"></span>
			<div class="indicator">
				<p>görgess</p>
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
		<div id="nav-overlay">
			<nav>
			<?php if( has_nav_menu('main-menu') ){
					wp_nav_menu(array( 'theme_location' => 'main-menu', 'menu_class' => 'nav-list', 'container' => false ));
				}; ?>
			</nav>
		</div>
		<div class="col-container">
			<div class="col23 col">
				<a href="" id="portfolio-title-text"><h2 id="portfolio-title"></h2></a>
				<a href="" id="portfolio-link-text"><h3 id="portfolio-link"></h3></a>
				<div class="res-images">
					<img  id="desktop-image" src="" alt="Desktop view of website">
					<img  id="tablet-image" src="" alt="Tablet view of website">
				</div>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();