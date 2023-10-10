<?php
/**
 * Sing for Hope functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Sing_for_Hope
 */

if ( ! defined( 'SFH_VERSION' ) ) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define( 'SFH_VERSION', '0.1.0' );
}

if ( ! defined( 'SFH_TYPOGRAPHY_CLASSES' ) ) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `sfh_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'SFH_TYPOGRAPHY_CLASSES',
		'prose prose-neutral max-w-none prose-a:text-primary'
	);
}

if ( ! function_exists( 'sfh_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function sfh_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Sing for Hope, use a find and replace
		 * to change 'singforhope' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'singforhope', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'singforhope' ),
				'menu-2' => __( 'Footer Menu', 'singforhope' ),
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

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove support for block templates.
		remove_theme_support( 'block-templates' );
	}
endif;
add_action( 'after_setup_theme', 'sfh_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sfh_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'singforhope' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'singforhope' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'sfh_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sfh_scripts() {
	wp_enqueue_style( 'singforhope-style', get_stylesheet_uri(), array(), SFH_VERSION );
	wp_enqueue_script( 'singforhope-script', get_template_directory_uri() . '/js/script.min.js', array(), SFH_VERSION, true );

	// Enqueue htmx.js
	wp_enqueue_script( 'htmx-script', get_template_directory_uri() . '/js/htmx.js', array(), SFH_VERSION, true );

	// Enqueue preline.js
	wp_enqueue_script( 'preline-script', get_template_directory_uri() . '/js/preline.js', array(), SFH_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sfh_scripts' );


/**
 * Enqueue the block editor script.
 */
function sfh_enqueue_block_editor_script() {
	wp_enqueue_script(
		'singforhope-editor',
		get_template_directory_uri() . '/js/block-editor.min.js',
		array(
			'wp-blocks',
			'wp-edit-post',
		),
		SFH_VERSION,
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'sfh_enqueue_block_editor_script' );

/**
 * Enqueue the script necessary to support Tailwind Typography in the block
 * editor, using an inline script to create a JavaScript array containing the
 * Tailwind Typography classes from SFH_TYPOGRAPHY_CLASSES.
 */
function sfh_enqueue_typography_script() {
	if ( is_admin() ) {
		wp_enqueue_script(
			'singforhope-typography',
			get_template_directory_uri() . '/js/tailwind-typography-classes.min.js',
			array(
				'wp-blocks',
				'wp-edit-post',
			),
			SFH_VERSION,
			true
		);
		wp_add_inline_script( 'singforhope-typography', "tailwindTypographyClasses = '" . esc_attr( SFH_TYPOGRAPHY_CLASSES ) . "'.split(' ');", 'before' );
	}
}
add_action( 'enqueue_block_assets', 'sfh_enqueue_typography_script' );

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function sfh_tinymce_add_class( $settings ) {
	$settings['body_class'] = SFH_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'sfh_tinymce_add_class' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Totally disable the admin toolbar. 
 */
function papumayor_disable_admin_bar() {
	return false;
}
add_filter('show_admin_bar', 'papumayor_disable_admin_bar');
/**
 * Create pages and set their templates.
 */
function setup_pages() {
	$pages = array(
		'Home' => 'pages/homepage.php',
		'About' => 'pages/about.php',
		'Donate' => 'pages/donate.php',
		'Contact' => 'pages/contact.php',
		'Volunteer' => 'pages/volunteer.php',
		'Sponsor' => 'pages/sponsor.php',
		'Login' => 'pages/login.php',
		'Health' => 'pages/health.php',
		'Education' => 'pages/education.php',
		'Workforce' => 'pages/workforce.php',
		'Pianos' => 'pages/pianos.php',
		'Diplomacy' => 'pages/diplomacy.php',
		'Gifts' => 'pages/gifts.php',
	);

	foreach ($pages as $page_title => $template) {
		// Check if the page exists by title
		$existing_page = get_page_by_title($page_title);

		if (null == $existing_page) {
			// Create the page
			$page_id = wp_insert_post(array(
				'post_title'     => $page_title,
				'post_type'      => 'page',
				'post_status'    => 'publish',
			));

			// Error handling for wp_insert_post
			if (is_wp_error($page_id)) {
				error_log('Failed to insert new page: ' . $page_id->get_error_message());
				continue;
			}

			// Set the custom template for the new page
			if ($template && file_exists(get_template_directory() . '/' . $template)) {
				update_post_meta($page_id, '_wp_page_template', $template);
			} else if ($template) {
				error_log("Template file $template not found");
			}
			
			// Set the Home page as the static front page
			if ($page_title === 'Home') {
				update_option('show_on_front', 'page');
				update_option('page_on_front', $page_id);
			}
		} else {
			// If the page already exists, just set the custom template
			if ($template && file_exists(get_template_directory() . '/' . $template)) {
				update_post_meta($existing_page->ID, '_wp_page_template', $template);
			} else if ($template) {
				error_log("Template file $template not found");
			}
			
			// Set the existing Home page as the static front page
			if ($page_title === 'Home') {
				update_option('show_on_front', 'page');
				update_option('page_on_front', $existing_page->ID);
			}
		}
	}
}
add_action('after_setup_theme', 'setup_pages');

function disable_gutenberg_on_specific_pages($can_edit, $post) {
	// Pages where Gutenberg should be disabled
	$pages = array(
		'Home',
		'About',
		'Donate',
		'Contact',
		'Volunteer',
		'Sponsor',
		'Login',
		'Health',
		'Education',
		'Workforce',
		'Pianos',
		'Diplomacy',
		'Gifts',
	);

	// Check if the current page is in the list
	if ($post && 'page' === $post->post_type && in_array($post->post_title, $pages)) {
		// Disable Gutenberg
		$can_edit = false;
	}

	return $can_edit;
}
add_filter('use_block_editor_for_post', 'disable_gutenberg_on_specific_pages', 10, 2);

// Hide classic content editor
function hide_postdivrich() {
    echo '
    <style type="text/css">
        #postdivrich {
            display: none;
        }
    </style>
    ';
}
add_action('admin_head', 'hide_postdivrich');
