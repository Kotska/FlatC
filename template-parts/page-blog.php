<?php

/**
 * Template Name: Blog
 * 
 * The template for displaying the blog
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlatC
 */

get_header();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
?>
<main data-link="<?php echo get_page_link(); ?>" data-page="<?php echo $paged ?>" id="primary" class="site-main page-blog">
    <div class="blog-col1">
        <div class="blog-list">
            <?php

            $query = new WP_Query(array(
                'post_type'      => 'post',
                'posts_per_page' => -1,
                'paged'          => $paged
            ));

            ?>

            <?php
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    $excerpt = get_the_excerpt();
                    $excerpt = substr($excerpt, 0, 160);
                    $excerpt = substr($excerpt, 0, strrpos($excerpt, ' '));
                    $excerpt = $excerpt . '...';

                    get_template_part('template-parts/blog', 'content');

                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
    </div>
    <div class="blog-col2">
        <h3>Blog</h3>
        <ul>
            <?php wp_list_categories(array('title_li' => '')); ?>
        </ul>
    </div>
    <div id="nav-overlay">
        <nav>
            <?php if (has_nav_menu('main-menu')) {
                wp_nav_menu(array('theme_location' => 'main-menu', 'menu_class' => 'nav-list', 'container' => false));
            }; ?>
        </nav>
    </div>
</main><!-- #main -->

<?php
get_footer();
