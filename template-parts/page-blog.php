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
            <div class="splide">
                <h2 class="slider-title"><?php echo $category ?></h2>
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
                        ?>
                    </ul>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="latest-post-list">
        <h3 class="latest-text">Legújabb</h3>
        <h3 class="latest-text-2">Legfrissebb blogbejegyzések</h3>
        <?php
        $args = [
            'posts_per_page' => 4,
            'order'          => 'DESC',
            'orderby'        => 'date',
            'offset'         => 1
        ];
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $title = get_the_title();
                $link = get_permalink();
                $category = get_the_category();
                $thumbnail = get_the_post_thumbnail_url();
                $image_alt = get_the_post_thumbnail_caption();
        ?>
                    
                        <div class="post-cont">
                            <a class="post-thumbnail" href="<?php echo $link ?>">
                                <div class="post-thumbnail">
                                    <div class="bg-image" style="background-image: url('<?php echo $thumbnail ?>');"></div>
                                </div>
                            </a>
                            <div class="post-text">
                                <div class="title-cont">
                                    <?php
                                    if (!empty($categories)) {
                                        foreach ($categories as $category) {
                                            echo '<div class="categories"><a class="post-category">' . $category[0] . '</a></div>';
                                        }
                                    }
                                    ?>
                                    <a href="<?php echo $link ?>">
                                        <h3><?php echo $title ?></h3>
                                    </a>
                                </div>
                                <div class="excerpt">
                                    <p><?php echo excerpt(25); ?></p>
                                </div>
                            </div>
                            <div class="post-cont-bg"></div>
                            
                        </div>

        <?php
            }
        }
        ?>
    </div>
    <div class="no-results">
        <h1>Nincs találat :(</h1>
    </div>
    <div class="searching-results">
        <h1>Keresés...</h1>
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
