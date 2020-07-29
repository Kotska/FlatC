<?php
/**
 * FlatC functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package FlatC
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'flatc_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function flatc_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on FlatC, use a find and replace
		 * to change 'flatc' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'flatc', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'flatc' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'flatc_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'flatc_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function flatc_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'flatc_content_width', 640 );
}
add_action( 'after_setup_theme', 'flatc_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function flatc_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'flatc' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'flatc' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'flatc_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function flatc_scripts() {
	wp_enqueue_style( 'flatc-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'flatc-style', 'rtl', 'replace' );


	wp_enqueue_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.4.2/gsap.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'gsap-textplugin', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.4.2/TextPlugin.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'flatc-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'flatc_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Custom Post Type
 */
function portfolio_post_type() {
	$labels = array(
		'name'				 => 'Portfolio',
		'singular_name'		 => 'Portfolio',
		'add_new' 			 => 'Add Item',
		'all_items' 		 => 'All Items',
		'add_new_item' 		 => 'Add Item',
		'edit_item' 		 => 'Edit Item',
		'new_item' 			 => 'New Item',
		'view_item' 		 => 'View Item',
		'search_item' 		 => 'Search Portfolio',
		'not_found' 		 => 'No items found',
		'not_found_in_trash' => 'No items found in trash',
		'parent_item_colon'  => 'Parent Item'
	);
	$args = array(
		'labels' 	  		  => $labels,
		'public' 	  		  => true,
		'has_archive' 		  => false,
		'publicly_queryable'  => false,
		'query_var' 		  => false,
		'rewrite' 			  => true,
		'capability_type'	  => 'post',
		'hierarchichal'		  => false,
		'support'			  => array(
								'title',
								'editor',
								'thumbnail',
								'revisions',
		),
		'menu_position'		  => 4,
		'exclude_from_search' => true,
	);
	register_post_type( 'portfolio', $args );
}
add_action( 'init', 'portfolio_post_type' );

/**
 * Meta Boxes
 */

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