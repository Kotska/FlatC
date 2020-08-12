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
                'post_type' => 'post',
                'posts_per_page' => -1,
                'paged' => $paged
            ));

            ?>

            <?php
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    $excerpt = get_the_excerpt();
                    $excerpt = substr($excerpt, 0, 160);
                    $excerpt = substr($excerpt, 0, strrpos($excerpt, ' '));
                    $excerpt = $excerpt . '...';

                    $categories = get_the_category();

            ?>
                    <div class="post-cont">
                        <?php 
                            foreach ($categories as $cat) {
                                echo '<a href="'. get_category_link($cat) .'" class="post-cat">'. $cat->name .'&nbsp;</a>';
                            }
                        ?>
                        <h3><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                        <p><?php echo $excerpt; ?></p>
                    </div>
            <?php
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
            <!-- <div id="pagination">
                <div class="prev"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg></div>
                <div class="next"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z"/></svg></div>

            </div> -->
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
