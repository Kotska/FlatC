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
 * Enqueue front-end scripts and styles.
 */
function flatc_scripts() {

	if (is_page_template('template-parts/page-portfolio.php')){
		wp_enqueue_script( 'flatc-portfolio', get_template_directory_uri() . '/js/portfolio.js', array('jquery'), _S_VERSION, true );
	}

	if (is_page_template('template-parts/page-services.php')){
		wp_enqueue_script( 'flatc-portfolio', get_template_directory_uri() . '/js/services.js', array('jquery'), _S_VERSION, true );
	}

	if (is_page_template('template-parts/page-blog.php')){
		wp_enqueue_script( 'flatc-portfolio', get_template_directory_uri() . '/js/blog.js', array('jquery'), _S_VERSION, true );
		wp_localize_script( 'flatc-portfolio', 'ajaxpagination', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	}

	wp_enqueue_style( 'flatc-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'flatc-style', 'rtl', 'replace' );

	wp_enqueue_script( 'gsap', get_template_directory_uri() . '/js/gsap.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'gsap-textplugin', get_template_directory_uri() . '/js/TextPlugin.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'flatc-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), _S_VERSION, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'flatc_scripts' );

/**
 * Enqueue admin scripts and styles.
 */
function flatc_admin_scripts() {
	wp_enqueue_script( 'mediaupload', get_template_directory_uri() . '/js/mediaupload.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_media();
	wp_enqueue_style( 'wp-color-picker');
	wp_enqueue_script( 'wp-color-picker');
}
add_action( 'admin_enqueue_scripts', 'flatc_admin_scripts' );

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
 * Admin functions.
 */
require get_template_directory() . '/inc/function-admin.php';

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

function services_post_type() {
	$labels = array(
		'name'				 => 'Services',
		'singular_name'		 => 'Service',
		'add_new' 			 => 'Add Item',
		'all_items' 		 => 'All Items',
		'add_new_item' 		 => 'Add Item',
		'edit_item' 		 => 'Edit Item',
		'new_item' 			 => 'New Item',
		'view_item' 		 => 'View Item',
		'search_item' 		 => 'Search Service',
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
	register_post_type( 'services', $args );
}
add_action( 'init', 'services_post_type' );


function ajax_pagination () {
	$response = [];
	$count = 0;
	$paged = $_POST['page'];
	$query = new WP_Query([
		'posts_per_page' => 3,
		'paged' => $paged,
		'post_type' => 'post'
	]);
	if ($query->have_posts()) :

	while ($query->have_posts()) : $query->the_post();

		$excerpt = get_the_excerpt();
		$excerpt = substr($excerpt, 0, 160);
		$excerpt = substr($excerpt, 0, strrpos($excerpt, ' '));
		$excerpt = $excerpt . '...';

		$response[$count]['title'] = get_the_title();
		$response[$count]['excerpt'] = $excerpt;
		$response[$count]['link'] = get_permalink();

		$count += 1;
	endwhile;

	wp_send_json_success($response);

	else : 

		wp_send_json_error('No more posts!');

	endif;

	die();
}

add_action( 'wp_ajax_nopriv_ajax_pagination', 'ajax_pagination' );
add_action( 'wp_ajax_ajax_pagination', 'ajax_pagination' );