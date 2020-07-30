<?php

/**
 * @package FlatC
 * 
 * =====================
 *      ADMIN PAGE
 * =====================
 */

function flatc_add_admin_page() {

//Generate FlatC Admin Page
add_menu_page( 'FlatC Theme Options', 'FlatC', 'manage_options', 'flatc_settings', 'flatc_theme_create_page', '',  110 );

//Generate FlatC Admin Sub Pages
add_submenu_page( 'flatc_settings', 'FlatC Theme Options', 'Settings', 'manage_options', 'flatc_settings', 'flatc_theme_create_page'  );

add_submenu_page( 'flatc_settings', 'FlatC Menu Options', 'Menu Options', 'manage_options', 'flatc_settings_menu', 'flatc_theme_menu_page'  );

//Activate custom settings
add_action( 'admin_init', 'flatc_custom_settings' );
}
add_action( 'admin_menu', 'flatc_add_admin_page' );

function flatc_custom_settings() {
    register_setting( 'flatc-settings-group', 'col1_menu' );
    register_setting( 'flatc-settings-group', 'col1_menu_desc' );
    register_setting( 'flatc-settings-group', 'col1_menu_link' );

    register_setting( 'flatc-settings-group', 'col2_menu' );
    register_setting( 'flatc-settings-group', 'col2_menu_desc' );
    register_setting( 'flatc-settings-group', 'col2_menu_link' );


    add_settings_section( 'flatc-settings-options', 'Menu Settings', 'flatc_menu_settings', 'flatc_settings' );

    add_settings_field( 'flatc-col1-text', 'First Column Menu Name', 'flatc_col1_name', 'flatc_settings', 'flatc-settings-options' );
    add_settings_field( 'flatc-col1-link', 'First Column Link', 'flatc_col1_link', 'flatc_settings', 'flatc-settings-options' );

    add_settings_field( 'flatc-col2-text', 'Second Column Menu Name', 'flatc_col2_name', 'flatc_settings', 'flatc-settings-options' );
    add_settings_field( 'flatc-col2-link', 'Second Column Link', 'flatc_col2_link', 'flatc_settings', 'flatc-settings-options' );
}

function flatc_col2_link(){
    $col2Link = esc_attr(get_option( 'col2_menu_link' ));
    echo '<input type="text" name="col2_menu_link" value="'.$col2Link.'" placeholder="Second Column Link" />';
}

function flatc_col2_name() {
    $col2Name = esc_attr(get_option( 'col2_menu' ));
    $col2Desc = esc_attr(get_option( 'col2_menu_desc' ));
    echo '<input type="text" name="col2_menu" value="'.$col2Name.'" placeholder="Second Column H2" /> <input type="text" name="col2_menu_desc" value="'.$col2Desc.'" placeholder="Second Column H3" />';
}

function flatc_col1_link(){
    $col1Link = esc_attr(get_option( 'col1_menu_link' ));
    echo '<input type="text" name="col1_menu_link" value="'.$col1Link.'" placeholder="First Column Link" />';
}

function flatc_col1_name() {
    $col1Name = esc_attr(get_option( 'col1_menu' ));
    $col1Desc = esc_attr(get_option( 'col1_menu_desc' ));
    echo '<input type="text" name="col1_menu" value="'.$col1Name.'" placeholder="First Column H2" /> <input type="text" name="col1_menu_desc" value="'.$col1Desc.'" placeholder="First Column H3" />';
}

function flatc_menu_settings () {

}

 function flatc_theme_create_page() {
    require_once get_template_directory() . '/inc/templates/flatc-admin.php';
 }

 function flatc_theme_menu_page() {
    require_once get_template_directory() . '/inc/templates/flatc-admin-menu.php';
 }