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
    <div class="contact-image">
        <img src="<?php echo get_template_directory_uri() . '/inc/svg/contact_us.svg' ?>" alt="">
    </div>
    <div class="contact-form" >
        <a href="#" class="close"></a>
        <h1>Ez egy contact form</h1>
        <form action="#" method="post" id="flatc-contact-form" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
            <input id="form-name" type="text" placeholder="Név">
            <input id="form-email" type="email" placeholder="Email">
            <input id="form-phone" type="text" placeholder="Telefonszám">
            <textarea id="form-message" type="text" placeholder="Üzenet..."></textarea>
        </form>
        <a href="#" class="btn-submit">Küldés</a>
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
