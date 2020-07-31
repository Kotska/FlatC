<?php

/**
 * Template Name: Portfolio
 * 
 * The template for displaying portfolio items
 * 
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlatC
 */

 $post = get_post(8);
 if ($post) {
	 setup_postdata( $post );
 }

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
							echo '<li class="active portfolio-item cursor" ' .$mobileImage.$tabletImage.$desktopImage.' data-item-name="'. get_the_title() . '"' . $url .'>' . '' . '</li>';
							$active = 1;
						} else {
							echo '<li class="portfolio-item cursor" '.$mobileImage.$tabletImage.$desktopImage.' data-item-name="'. get_the_title() . '"' .$url . '>' . '' . '</li>';
						}
					endwhile;

				echo '</ul>';
			
				
				wp_reset_postdata();
			?>
			<span class="border"></span>
		</div>
		<div id="nav-overlay">
			<nav>
				<ul class="nav-list">
					<li class="nav-list-li">Portfolio</li>
					<li class="nav-list-li">Blog</li>
					<li class="nav-list-li">Kapcsolat</li>
					<li class="nav-list-li">Szolgáltatások</li>
				</ul>
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