<?php

/**
 * FlatC functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package FlatC
 */

ini_set('html_errors', true);

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (!function_exists('flatc_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function flatc_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on FlatC, use a find and replace
		 * to change 'flatc' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('flatc', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

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
		add_theme_support('customize-selective-refresh-widgets');

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
add_action('after_setup_theme', 'flatc_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function flatc_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('flatc_content_width', 640);
}
add_action('after_setup_theme', 'flatc_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function flatc_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'flatc'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'flatc'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'flatc_widgets_init');

/**
 * Enqueue front-end scripts and styles.
 */
function flatc_scripts()
{

	if (is_page_template('template-parts/page-portfolio.php')) {
		wp_enqueue_script('flatc-portfolio', get_template_directory_uri() . '/js/portfolio.js', array('jquery'), _S_VERSION, true);
	}

	if (is_page_template('template-parts/page-services.php')) {
		wp_enqueue_script('flatc-services', get_template_directory_uri() . '/js/services.js', array('jquery'), _S_VERSION, true);
	}

	if (is_page_template('template-parts/page-blog.php') || is_singular('post')) {
		wp_enqueue_script("jquery-effects-core");
		wp_enqueue_script('splide', get_template_directory_uri() . '/js/splide.min.js');
		wp_enqueue_style('splide-style', get_template_directory_uri() . '/splide-core.min.css');
		wp_enqueue_script('flatc-blog', get_template_directory_uri() . '/js/blog.js', array('jquery'), _S_VERSION, true);
		wp_localize_script('flatc-blog', 'ajax', ['url' => admin_url('admin-ajax.php')]);
	}

	if (is_page_template('template-parts/page-contact.php')) {
		wp_enqueue_script('contactJs', get_template_directory_uri() . '/js/contact.js', array('jquery'));
	}

	wp_enqueue_style('flatc-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('flatc-style', 'rtl', 'replace');

	wp_enqueue_script('gsap', get_template_directory_uri() . '/js/gsap.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('gsap-textplugin', get_template_directory_uri() . '/js/TextPlugin.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('flatc-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), _S_VERSION, true);


	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'flatc_scripts');

/**
 * Enqueue admin scripts and styles.
 */
function flatc_admin_scripts()
{
	wp_enqueue_script('mediaupload', get_template_directory_uri() . '/js/mediaupload.js', array('jquery'), _S_VERSION, true);
	wp_enqueue_media();
	wp_enqueue_style('wp-color-picker');
	wp_enqueue_script('wp-color-picker');
}
add_action('admin_enqueue_scripts', 'flatc_admin_scripts');

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
 * Navigation Menu
 */
require get_template_directory() . '/inc/nav-menu.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Custom Post Type
 */
function portfolio_post_type()
{
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
		'supports'			  => array(
			'title',
			'editor',
			'revisions',
		),
		'menu_position'		  => 4,
		'exclude_from_search' => true,
	);
	register_post_type('portfolio', $args);
}
add_action('init', 'portfolio_post_type');

function services_post_type()
{
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
		'supports'			  => array(
			'title',
			'editor',
			'thumbnail',
			'revisions',
		),
		'menu_position'		  => 4,
		'exclude_from_search' => true,
	);
	register_post_type('services', $args);
}
add_action('init', 'services_post_type');

function flatc_contact_post_type()
{
	$labels = array(
		'name'				 => 'Contact',
		'singular_name'		 => 'Contact',
		'add_new' 			 => 'New Message',
		'all_items' 		 => 'Messages',
		'add_new_item' 		 => 'Add Message',
		'edit_item' 		 => 'Edit Message',
		'new_item' 			 => 'New Message',
		'view_item' 		 => 'View Message',
		'search_item' 		 => 'Search Message',
		'not_found' 		 => 'No messages found',
		'not_found_in_trash' => 'No messages found in trash',
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
		'supports'			  => array(
			'title',
			'editor',
			'author'
		),
		'menu_position'		  => 5,
		'exclude_from_search' => true,
		'menu_icon'			  => 'dashicons-email-alt',
	);
	register_post_type('contact', $args);
}
add_action('init', 'flatc_contact_post_type');

function set_contact_columns($columns)
{
	$newColumns = [];
	$newColumns['title'] = 'Full Name';
	$newColumns['message'] = 'Message';
	$newColumns['email'] = 'Email';
	$newColumns['date'] = 'Date';
	return $newColumns;
}
add_filter('manage_contact_posts_columns', 'set_contact_columns');

function contact_custom_column($column, $post_id)
{
	switch($column) {
		case 'message':
			echo get_the_excerpt();
			break;
		case 'email':
			$email = get_post_meta($post_id, '_contact_email_value_key', true);
			echo '<a href="mailto:"'.$email.'">'.$email.'</a>';
			break;
	}
}
add_action('manage_contact_posts_custom_column', 'contact_custom_column', 10, 2);

function contact_add_meta_box()
{
	add_meta_box('contact_email', 'User Email', 'flatc_contact_email_callback', 'contact', 'side');
	add_meta_box('contact_phone', 'User Phone', 'flatc_contact_phone_callback', 'contact', 'side');
}

function flatc_contact_email_callback($post)
{
	wp_nonce_field('flatc_save_contact_data', 'contact_email_meta_box_nonce');

	$value = get_post_meta($post->ID, '_contact_email_value_key', true);

	echo '<label for="contact_email_field" >User Email Address: </label>';
	echo '<input type="email" id="contact_email_field" name="contact_email_field" value="'.esc_attr($value).'" size="25" />';
}
add_action('add_meta_boxes', 'contact_add_meta_box');

function flatc_contact_phone_callback($post)
{

	$value = get_post_meta($post->ID, '_contact_phone_value_key', true);

	echo '<label for="contact_phone_field" >User Phone Number: </label>';
	echo '<input type="text" id="contact_phone_field" name="contact_phone_field" value="'.esc_attr($value).'" size="25" />';
}
add_action('add_meta_boxes', 'contact_add_meta_box');

function flatc_save_contact_data($post_id) {
	if( !isset($_POST['contact_email_meta_box_nonce']) ) return;

	if(!wp_verify_nonce($_POST['contact_email_meta_box_nonce'], 'flatc_save_contact_data')) return;

	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

	if(!current_user_can('edit_post', $post_id)) return;

	if(!isset($_POST['contact_email_field'])) return;

	$email = sanitize_text_field($_POST['contact_email_field']);
	$phone = sanitize_text_field($_POST['contact_phone_field']);
	update_post_meta($post_id, '_contact_email_value_key', $email);
	update_post_meta($post_id, '_contact_phone_value_key', $phone);
}
add_action('save_post', 'flatc_save_contact_data' );

function excerpt($limit)
{
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt) >= $limit) {
				array_pop($excerpt);
				$excerpt = implode(" ", $excerpt) . '...';
		} else {
				$excerpt = implode(" ", $excerpt);
		}
		$excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
		return $excerpt;
}

function flatc_ajax_search()
{
	ob_start();
	?>
		<?php

		if(isset($_GET['search_term'])){
			$query = new WP_Query([
				'posts_per_page' => -1,
				'post_type'      => 'post',
				's'              => $_GET['search_term'],
			]);
		}

		if(isset($_GET['search_category'])){
			$query = new WP_Query([
				'posts_per_page' => -1,
				'post_type'      => 'post',
				'cat'  => $_GET['search_category']
			]);
		}

		if ($query->have_posts()) {
			echo '<div class="latest-post-list search-results">';
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
			echo '</div>';
		}
		?>
	<?php
	$respones = ob_get_clean();
	wp_send_json_success($respones);

	die();
}

add_action('wp_ajax_nopriv_flatc_ajax_search', 'flatc_ajax_search');
add_action('wp_ajax_flatc_ajax_search', 'flatc_ajax_search');


function my_custom_mime_types($mimes)
{

	// New allowed mime types.
	$mimes['svg'] = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';

	return $mimes;
}
add_filter('upload_mimes', 'my_custom_mime_types');

// Add custom meta fields
function add_meta_boxes()
{
	global $post;
	if ('template-parts/page-blog.php' == get_post_meta($post->ID, '_wp_page_template', true)) {
		add_meta_box('slider_categories', 'Slider Categories', 'slider_categories_callback', null, 'side');
	}
}
add_action('add_meta_boxes_page', 'add_meta_boxes');

function slider_categories_callback()
{
	global $post;
	wp_nonce_field('flatc_slider_meta_box', 'flatc_slider_meta_box_nonce');

	$value = get_post_meta($post->ID, 'slider_categories', false);

?>
	<label for="flatc_slider"><?php _e("Choose value:", 'choose_value'); ?></label>
	<br>
<?php
	foreach (get_categories() as $category) {
		// $checked = checked($value, $category->name, false);
		if (in_array($category->name, $value[0])) {
			$checked = 'checked="checked"';
		} else {
			$checked = '';
		}
		echo '<input type="checkbox" name="flatc_slider_input[]" ' . $checked . ' value="' . $category->name . '">' . $category->name . '<br>';
	}
}

function flatc_save_meta_box($post_id)
{
	// Check if our nonce is set.
	if (!isset($_POST['flatc_slider_meta_box_nonce'])) {
		return;
	}

	// Verify that the nonce is valid.
	if (!wp_verify_nonce($_POST['flatc_slider_meta_box_nonce'], 'flatc_slider_meta_box')) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	// Check the user's permissions.
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	$new_meta_value = (isset($_POST['flatc_slider_input']) ? sanitize_html_class($_POST['flatc_slider_input']) : '');

	update_post_meta($post_id, 'slider_categories', $new_meta_value);
}
add_action('save_post', 'flatc_save_meta_box');

add_action('wp_ajax_nopriv_flatc_save_user_contact_form', 'save_contact');
add_action('wp_ajax_flatc_save_user_contact_form', 'save_contact');

function save_contact()
{
	$name = wp_strip_all_tags($_POST['name']);
	$phone = wp_strip_all_tags($_POST['phone']);
	$email = wp_strip_all_tags($_POST['email']);
	$message = wp_strip_all_tags($_POST['message']);

	$args = [
		'post_title'        => $name,
		'post_content'      => $message,
		'post_author'       => 1,
		'post_status'		=> 'publish',
		'post_type'         => 'contact',
		'meta_input'        => [
			'_contact_email_value_key' => $email,
			'_contact_phone_value_key' => $phone
		]
	];

	$postID = wp_insert_post($args);

	echo $postID;

	die();

}