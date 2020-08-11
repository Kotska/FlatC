<?php
/**
 * The navigation menu
 *
 * @package FlatC
 */
function register_flatc_menu() {
  register_nav_menu('main-menu',__( 'Main Menu' ));
}
add_action( 'init', 'register_flatc_menu' );