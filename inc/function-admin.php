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
	register_setting( 'flatc-settings-main', 'site-logo-svg');
	register_setting( 'flatc-settings-main', 'site-loading-svg');
    register_setting( 'flatc-settings-group', 'col1_menu' );
    register_setting( 'flatc-settings-group', 'col1_menu_desc' );
    register_setting( 'flatc-settings-group', 'col1_menu_link' );

    register_setting( 'flatc-settings-group', 'col2_menu' );
    register_setting( 'flatc-settings-group', 'col2_menu_desc' );
	register_setting( 'flatc-settings-group', 'col2_menu_link' );
	
	register_setting( 'flatc-settings-group', 'blog_name' );
	register_setting( 'flatc-settings-group', 'blog_link' );


	add_settings_section( 'flatc-settings-options', 'Menu Settings', 'flatc_menu_settings', 'flatc_settings_menu' );
	add_settings_section('flatc-main-settings', 'Manage Options', 'flatc_main_section', 'flatc_settings');

	add_settings_field('flatc-logo-svg', 'Site SVG Logo', 'flatc_site_svg', 'flatc_settings', 'flatc-main-settings');
	add_settings_field('flatc-loading-svg', 'Site Loading SVG', 'flatc_loading_svg', 'flatc_settings', 'flatc-main-settings');

    add_settings_field( 'flatc-col1-text', 'First Column Menu Name', 'flatc_col1_name', 'flatc_settings_menu', 'flatc-settings-options' );
    add_settings_field( 'flatc-col1-link', 'First Column Link', 'flatc_col1_link', 'flatc_settings_menu', 'flatc-settings-options' );

    add_settings_field( 'flatc-col2-text', 'Second Column Menu Name', 'flatc_col2_name', 'flatc_settings_menu', 'flatc-settings-options' );
	add_settings_field( 'flatc-col2-link', 'Second Column Link', 'flatc_col2_link', 'flatc_settings_menu', 'flatc-settings-options' );
	
	add_settings_field( 'flatc-blog-name', 'Blog Menu Name', 'flatc_blog_name', 'flatc_settings_menu', 'flatc-settings-options' );
	add_settings_field( 'flatc-blog-link', 'Blog Menu Link', 'flatc_blog_link', 'flatc_settings_menu', 'flatc-settings-options' );
}

function flatc_loading_svg() {
	$svg = get_option('site-loading-svg');
	$id = attachment_url_to_postid($svg);
	$file = get_attached_file($id);
	echo '<input type="button" class="button button-secondary" value="Upload SVG" id="upload-button-loading"/> <input type="hidden" id="loading-svg" name="site-loading-svg" value="'.$svg.'"/>';
	if ($file) {
		echo '<div class="logo-svg">'. file_get_contents($file) . '</div>';
	}
}

function flatc_site_svg(){
	$logo = get_option('site-logo-svg');
	$id = attachment_url_to_postid($logo);
	$file = get_attached_file($id);
	echo '<input type="button" class="button button-secondary" value="Upload Logo" id="upload-button-svg"/> <input type="hidden" id="logo-svg" name="site-logo-svg" value="'.$logo.'"/>';
	if ($file) {
		echo '<div class="logo-svg">'. file_get_contents($file) . '</div>';
	}
}

function flatc_main_section(){

}

function flatc_blog_link(){
	$blogLink = esc_attr(get_option( 'blog_link' ));
	echo '<input type="text" name="blog_link" value="'.$blogLink.'" placeholder="" />';
}
function flatc_blog_name(){
	$blogName = esc_attr(get_option( 'blog_name' ));
	echo '<input type="text" name="blog_name" value="'.$blogName.'" placeholder="Blog" />';
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

 
/**
 * =====================
 *      META BOXES
 * =====================
 */

 // ================
 //  Portfolio Link
 // ================

function portfolio_add_meta_box() {
	add_meta_box( 'portfolio_link', 'Website Link', 'portfolio_link_callback', 'portfolio', 'side' );
}
add_action( 'add_meta_boxes', 'portfolio_add_meta_box' );

function portfolio_link_callback( $post ) {
	wp_nonce_field( 'portfolio_save_link', 'portfolio_link_meta_box_nonce' );

	$value = get_post_meta( $post->ID, '_portfolio_link_value_key', true );

	echo '<label for="portfolio_link_field" >Website URL: </label>';
	echo '<input type="text" id="portfolio_link_field" name="portfolio_link_field" value="' . esc_attr($value) . '" size="25" />';
}

function portfolio_save_link( $post_id ) {
	if ( !isset( $_POST['portfolio_link_meta_box_nonce'] ) ){
		return;
	}
	if( !wp_verify_nonce( $_POST['portfolio_link_meta_box_nonce'], 'portfolio_save_link' ) ){
		return;
	}

	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) {
		return;
	}

	if ( !current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( !isset( $_POST['portfolio_link_field'] ) ){
		return;
	}

	$field_data = sanitize_text_field($_POST['portfolio_link_field']);

	update_post_meta( $post_id, '_portfolio_link_value_key', $field_data );

}
add_action( 'save_post', 'portfolio_save_link' );

// ===============
//  Desktop Imgage
// ===============

function desktop_image_add_metabox()
{
    add_meta_box('desktopimagediv', __('Desktop Image', 'text-domain'), 'desktop_image_metabox', 'portfolio', 'side', 'low');
}
add_action( 'add_meta_boxes', 'desktop_image_add_metabox' );

function desktop_image_metabox ( $post ) {
	global $content_width, $_wp_additional_image_sizes;

	$image_id = get_post_meta( $post->ID, '_desktop_image_id', true );

	$old_content_width = $content_width;
	$content_width = 254;

	if ( $image_id && get_post( $image_id ) ) {

		if ( ! isset( $_wp_additional_image_sizes['post-thumbnail'] ) ) {
			$thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
		} else {
			$thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail' );
		}

		if ( ! empty( $thumbnail_html ) ) {
			$content = $thumbnail_html;
			$content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_desktop_image_button" >' . esc_html__( 'Remove desktop image', 'text-domain' ) . '</a></p>';
			$content .= '<input type="hidden" id="upload_desktop_image" name="_desktop_cover_image" value="' . esc_attr( $image_id ) . '" />';
		}

		$content_width = $old_content_width;
	} else {

		$content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
		$content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set desktop image', 'text-domain' ) . '" href="javascript:;" id="upload_desktop_image_button" id="set-desktop-image" data-uploader_title="' . esc_attr__( 'Choose an image', 'text-domain' ) . '" data-uploader_button_text="' . esc_attr__( 'Set desktop image', 'text-domain' ) . '">' . esc_html__( 'Set desktop image', 'text-domain' ) . '</a></p>';
		$content .= '<input type="hidden" id="upload_desktop_image" name="_desktop_cover_image" value="" />';

	}

	echo $content;
}

add_action( 'save_post', 'desktop_image_save', 10, 1 );
function desktop_image_save ( $post_id ) {
	if( isset( $_POST['_desktop_cover_image'] ) ) {
		$image_id = (int) $_POST['_desktop_cover_image'];
		update_post_meta( $post_id, '_desktop_image_id', $image_id );
	}
}

// ===============
//  Tablet Imgage
// ===============

function tablet_image_add_metabox()
{
    add_meta_box('tabletimagediv', __('Tablet Image', 'text-domain'), 'tablet_image_metabox', 'portfolio', 'side', 'low');
}
add_action( 'add_meta_boxes', 'tablet_image_add_metabox' );

function tablet_image_metabox ( $post ) {
	global $content_width, $_wp_additional_image_sizes;

	$image_id = get_post_meta( $post->ID, '_tablet_image_id', true );

	$old_content_width = $content_width;
	$content_width = 254;

	if ( $image_id && get_post( $image_id ) ) {

		if ( ! isset( $_wp_additional_image_sizes['post-thumbnail'] ) ) {
			$thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
		} else {
			$thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail' );
		}

		if ( ! empty( $thumbnail_html ) ) {
			$content = $thumbnail_html;
			$content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_tablet_image_button" >' . esc_html__( 'Remove tablet image', 'text-domain' ) . '</a></p>';
			$content .= '<input type="hidden" id="upload_tablet_image" name="_tablet_cover_image" value="' . esc_attr( $image_id ) . '" />';
		}

		$content_width = $old_content_width;
	} else {

		$content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
		$content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set tablet image', 'text-domain' ) . '" href="javascript:;" id="upload_tablet_image_button" id="set-tablet-image" data-uploader_title="' . esc_attr__( 'Choose an image', 'text-domain' ) . '" data-uploader_button_text="' . esc_attr__( 'Set tablet image', 'text-domain' ) . '">' . esc_html__( 'Set tablet image', 'text-domain' ) . '</a></p>';
		$content .= '<input type="hidden" id="upload_tablet_image" name="_tablet_cover_image" value="" />';

	}

	echo $content;
}

add_action( 'save_post', 'tablet_image_save', 10, 1 );
function tablet_image_save ( $post_id ) {
	if( isset( $_POST['_tablet_cover_image'] ) ) {
		$image_id = (int) $_POST['_tablet_cover_image'];
		update_post_meta( $post_id, '_tablet_image_id', $image_id );
	}
}

 // ===============
 //  Mobile Imgage
 // ===============

function mobile_image_add_metabox () {
	add_meta_box( 'mobileimagediv', __( 'Mobile Image', 'text-domain' ), 'mobile_image_metabox', 'portfolio', 'side', 'low');
}
add_action( 'add_meta_boxes', 'mobile_image_add_metabox' );

function mobile_image_metabox ( $post ) {
	global $content_width, $_wp_additional_image_sizes;

	$image_id = get_post_meta( $post->ID, '_mobile_image_id', true );

	$old_content_width = $content_width;
	$content_width = 254;

	if ( $image_id && get_post( $image_id ) ) {

		if ( ! isset( $_wp_additional_image_sizes['post-thumbnail'] ) ) {
			$thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
		} else {
			$thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail' );
		}

		if ( ! empty( $thumbnail_html ) ) {
			$content = $thumbnail_html;
			$content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_mobile_image_button" >' . esc_html__( 'Remove mobile image', 'text-domain' ) . '</a></p>';
			$content .= '<input type="hidden" id="upload_mobile_image" name="_mobile_cover_image" value="' . esc_attr( $image_id ) . '" />';
		}

		$content_width = $old_content_width;
	} else {

		$content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
		$content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set mobile image', 'text-domain' ) . '" href="javascript:;" id="upload_mobile_image_button" id="set-mobile-image" data-uploader_title="' . esc_attr__( 'Choose an image', 'text-domain' ) . '" data-uploader_button_text="' . esc_attr__( 'Set mobile image', 'text-domain' ) . '">' . esc_html__( 'Set mobile image', 'text-domain' ) . '</a></p>';
		$content .= '<input type="hidden" id="upload_mobile_image" name="_mobile_cover_image" value="" />';

	}

	echo $content;
}

add_action( 'save_post', 'mobile_image_save', 10, 1 );
function mobile_image_save ( $post_id ) {
	if( isset( $_POST['_mobile_cover_image'] ) ) {
		$image_id = (int) $_POST['_mobile_cover_image'];
		update_post_meta( $post_id, '_mobile_image_id', $image_id );
	}
}

// ===============
//  Color Picker
// ===============
function color_add_metabox () {
	add_meta_box( 'colordiv', __( 'Background Color', 'text-domain' ), 'color_meta_box', 'portfolio', 'side', 'low');
}
add_action( 'add_meta_boxes', 'color_add_metabox' );

function color_meta_box( $post ){
	$background_color = get_post_meta( $post->ID, '_background_color', true );
	wp_nonce_field( 'save_color_meta_box', 'color_meta_box_nonce' );
	?>
	<style type="text/css">
		.hidden{display: none;}
	</style>
	<script>
		jQuery(document).ready(function ($) {
			$('.color-field').each(function(){
				$(this).wpColorPicker();
			});
		});
	</script>
	<div class="pagebox">
		<h4>Color</h4>
		<input class="color-field" type="text" name="background_color" value="<?php esc_attr_e($background_color); ?>"/>
	</div>
	<?php
}

function save_color_meta_box( $post_id ){
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if( !current_user_can( 'edit_pages' ) ) {
		return;
	}
	if ( !isset( $_POST['color_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['color_meta_box_nonce'], 'save_color_meta_box' ) ) {
		return;
	}
	$background_color = (isset($_POST["background_color"]) && $_POST["background_color"]!='') ? $_POST["background_color"] : '';
	update_post_meta($post_id, "_background_color", $background_color);
}
add_action( 'save_post', 'save_color_meta_box' );

// ===============
//  Contact
// ===============

function phone_number_metabox () {
	global $post;
	$pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
	if($pageTemplate == 'template-parts/page-contact.php' ) {
		add_meta_box( 'phone_number', 'Contact', 'phone_meta_box', 'page', 'side', 'low');
	}
}
add_action( 'add_meta_boxes', 'phone_number_metabox' );

function phone_meta_box($post)
{
	$number = get_post_meta( $post->ID, '_flatc_phone_number', true );
	$email = get_post_meta( $post->ID, '_flatc_email', true );
	wp_nonce_field( 'save_phone_meta_box', 'phone_meta_box_nonce' );
	?>
	<div class="pagebox">
		<h4>Phone Number: </h4>
		<input type="text" name="phone_number" value="<?php esc_attr_e($number); ?>"/>
		<h4>Email: </h4>
		<input type="email" name="flatc_email" value="<?php esc_attr_e($email); ?>"/>
	</div>
	<?php
}

function save_phone_meta_box( $post_id ){
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if( !current_user_can( 'edit_pages' ) ) {
		return;
	}
	if ( !isset( $_POST['phone_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['phone_meta_box_nonce'], 'save_phone_meta_box' ) ) {
		return;
	}
	$number = (isset($_POST["phone_number"]) && $_POST["phone_number"]!='') ? $_POST["phone_number"] : '';
	update_post_meta($post_id, "_flatc_phone_number", $number);
	$email = (isset($_POST["flatc_email"]) && $_POST["flatc_email"]!='') ? $_POST["flatc_email"] : '';
	update_post_meta($post_id, "_flatc_email", $email);
}
add_action( 'save_post', 'save_phone_meta_box' );

