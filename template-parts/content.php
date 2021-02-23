<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlatC
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-box-header">
		<div class="header-bg-image">
			<div class="header-rl-bg-image" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
		</div>
		<div class="header-body">
			<div class="header-body__tags">
				<?php
					$category = get_the_category();
					foreach ($category as $cat) {
						echo '<p class="post-cat">'.$cat->name.'</p>';
					}
				?>
			</div>
			<div class="header-body__title">
				<?php
				if (is_singular()) :
					the_title('<h2 class="entry-title">', '</h2>');
				else :
					the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
				endif;
				?>
			</div>
		</div>
		<?php


		if ('post' === get_post_type()) :
		?>
			<div class="entry-meta">
				<?php
				flatc_posted_on();
				flatc_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</div>
	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'flatc'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post(get_the_title())
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'flatc'),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
<?php
