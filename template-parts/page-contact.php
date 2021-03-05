<?php

/**
 * Template Name: Contact
 * 
 * The template for displaying contact
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FlatC
 */

get_header();
global $post;
?>

<main id="primary" class="site-main page-contact">
    <h1>Dolgozzunk együtt!</h1>
    <div class="contact-row">
        <div class="email-row">
            <img src="<?php echo get_template_directory_uri() . '/inc/svg/email.svg' ?>" class="email-image" alt="Email image"><p class="email"><?php echo get_post_meta($post->ID, '_flatc_email', true) ?></p>
        </div>
        <div class="phone-row">
            <img src="<?php echo get_template_directory_uri() . '/inc/svg/phone-call.svg' ?>" alt="Phone image" class="phone-image"><p class="phone-number"><?php echo get_post_meta($post->ID, '_flatc_phone_number', true) ?></p>
        </div>
    </div>
    <a href="#" class="btn-contact">Beszéljünk róla!</a>
    <div class="contact-form">
        <span class="close">✖</span>
        <h1>Ez egy contact form</h1>
        <form action=""></form>
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
