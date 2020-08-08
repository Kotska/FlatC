<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlatC
 */

get_header();
?>

	<main id="primary" class="site-main">

		<div class="col1 col">
			<div class="col1-inner">
				<h1>Hello World!</h1>
				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde sequi corrupti error labore quisquam sunt distinctio ab, reiciendis nobis vero maiores beatae facere qui, quas, voluptas incidunt repudiandae voluptate quae. Animi, laudantium reprehenderit. Quibusdam illum doloribus non nihil, recusandae ipsam doloremque optio necessitatibus dolorem, nostrum, veritatis earum.</p>
				<div class="blog">
					<p data-link="<?php echo esc_attr(get_option( 'blog_link' )); ?>" class="blog-text"><?php echo esc_attr(get_option( 'blog_name' )); ?></p>
				</div>
			</div>
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
			<div data-link="<?php echo esc_attr(get_option( 'col1_menu_link' )); ?>" class="col2 col">
				<div class="col-text">
					<h3><?php echo esc_attr(get_option( 'col1_menu_desc' )); ?></h3>
					<h2 class="col2-title"><?php echo esc_attr(get_option( 'col1_menu' )); ?></h2>
				</div>
			</div>
			<div data-link="<?php echo esc_attr(get_option( 'col2_menu_link' )); ?>" class="col3 col">
				<div class="col-text">
					<h3>Amikkel szolgálok</h3>
					<h2 class="col3-title">Szolgáltatások</h2>
				</div>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();

