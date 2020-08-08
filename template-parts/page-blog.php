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
    <?php

    $query = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'paged' => $paged
    ));

    ?><div class="aligner">

    </div>
    <?php
    $postLayout = ['post-blue', 'post-grey', 'post-white'];
    $count = 0;
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            if ($count == 3 ? $count = 0 : '');
                set_query_var('blog_post_layout', $postLayout[$count]);
                get_template_part( 'template-parts/blog', 'content' );
            $count += 1;
        endwhile;
    endif;
    wp_reset_postdata();
    ?>
    <div id="pagination">
        <div class="prev"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg></div>
        <div class="next"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z"/></svg></div>

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
</main><!-- #main -->

<?php
get_footer();
