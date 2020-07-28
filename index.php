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
					<p>Blog</p>
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
			<div class="col2 col">
				<h3>Kiemelt Munkáim</h3>
				<h2>Portfolio</h2>
			</div>
			<div class="col3 col">
				<h3>Amikkel szolgálok</h3>
				<h2>Szolgáltatások</h2>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();

