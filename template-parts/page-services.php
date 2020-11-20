<?php

/**
 * Template Name: Services
 * 
 * The template for displaying services
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlatC
 */

get_header();
?>

<main id="primary" class="site-main page-services">

    <?php
    $query = new WP_Query(array(
        'post_type' => 'services',
        'posts_per_page' => -1
    ));
    ?>

    <div class="services">
        <div class="desc">
            <h3></h3>
            <p></p>
            <div class="background"></div>
        </div>
        <div class="name">

            <ul>
                <?php $active = 'active'; ?>
                <?php while ($query->have_posts()) : $query->the_post();
                    $content = 'data-srv-content="' . esc_html(get_the_content()) . '" data-srv-image="'.get_the_post_thumbnail_url().'"';
                    if ($active == 'active') {
                        echo '<li '.$content.' class="active srv-item" id="srv-' . get_the_id() . '">' . get_the_title() . '</li>';
                    } else {
                        echo '<li '.$content.' class="srv-item" id="srv-' . get_the_id() . '" >' . get_the_title() . '</li>';
                    }
                    $active = false;
                endwhile;
                wp_reset_query(); ?>
            </ul>
        </div>
    </div>
    <div id="nav-overlay">
        <nav>
        <?php if( has_nav_menu('main-menu') ){
					wp_nav_menu(array( 'theme_location' => 'main-menu', 'menu_class' => 'nav-list', 'container' => false ));
				}; ?>
        </nav>
    </div>

</main><!-- #main -->

<?php
get_footer();
