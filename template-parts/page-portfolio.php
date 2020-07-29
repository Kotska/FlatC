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

get_header();
?>

	<main id="primary" class="site-main page-portfolio">

		<div class="col1 col">
			<div class="col1-inner">
			</div>
			<?php
				$args = array(  
					'post_type' => 'portfolio',
					'post_status' => 'publish',
					'posts_per_page' => -1, 
					'orderby' => 'date', 
					'order' => 'ASC',
				);
			
				$loop = new WP_Query( $args ); 
				
				echo '<ul class="portfolio-list">';
				$active = 0;

					while ( $loop->have_posts() ) : $loop->the_post();
						if ($active == 0){
							echo '<li class="active portfolio-item" data-item-name="'. get_the_title() .'">' . '' . '</li>';
							$active = 1;
						} else {
							echo '<li class="portfolio-item" data-item-name="'. get_the_title() .'">' . '' . '</li>';
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
				<div class="col-text">
					<h2 id="portfolio-title"></h2>
					<h3 id="portfolio-link"></h3>
				</div>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();