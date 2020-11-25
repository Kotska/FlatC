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
    <div class="slider-list">
        <?php
        $categories = get_post_meta($post->ID, 'slider_categories', false);
        foreach ($categories[0] as $category) {
            $args = [

                'category_name' => $category,
            ];
            $query = new WP_Query($args);
            ?>
            <h2 class="slider-title"><?php echo $category ?></h2>
            <div class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php
                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();
                                $title = get_the_title();
                                $link = get_permalink();
                                $thumbnail = get_the_post_thumbnail_url();
                                ?>
                                <li class="splide__slide">
                                    <div class="splide__slide__container">
                                        <img src="<?php echo $thumbnail; ?>">
                                    </div>
                                    <a href="<?php echo $link; ?>"><?php echo $title; ?></a>
                                </li>
                                <?php
                            }
                        }
                        wp_reset_postdata();
                    }
                    ?>
                    </ul>
                </div>
            </div>
    </div>
    <div class="latest-post">
        <h2 class="latest">Legfrissebb</h2>
        <span class="latest__text_underline" ></span>
        <?php
        $args = [
            'posts_per_page' => 1,
            'order'          => 'DESC',
            'orderby'        => 'date'
        ];
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $title = get_the_title();
                $link = get_permalink();
                $category = get_the_category();
                $thumbnail = get_the_post_thumbnail_url();
                ?>
                <img src="<?php echo $thumbnail; ?>"><br>
                <?php
                if ( ! empty( $categories ) ) {
                    foreach ($categories as $category) {
                        echo '<div class="categories"><a class="post-category">' . $category[0] . '</a></div>';
                    }
                }
                ?>
                <a href="<?php echo $link; ?>"><h3><?php echo $title ?></h3></a>
                <div class="excerpt"><p><?php echo get_the_excerpt(); ?></p></div>
                <?php
            }
        }
        ?>
    </div>
    <div class="latest-post-list">
        <?php
        $args = [
            'posts_per_page' => 4,
            'order'          => 'DESC',
            'orderby'        => 'date'
        ];
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $title = get_the_title();
                $link = get_permalink();
                $category = get_the_category();
                $thumbnail = get_the_post_thumbnail_url();
                ?>
                <div class="post-cont">
                <img src="<?php echo $thumbnail; ?>">
                <div class="title-cont">
                <?php
                if ( ! empty( $categories ) ) {
                    foreach ($categories as $category) {
                        echo '<div class="categories"><a class="post-category">' . $category[0] . '</a></div>';
                    }
                }
                ?>
                <a href="<?php echo $link; ?>"><h3><?php echo $title ?></h3></a>
                </div>
                <div class="excerpt"><p><?php echo get_the_excerpt(); ?></p></div>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <?php
    ?>
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
