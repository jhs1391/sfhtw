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
			'name' => __( 'Footer', 'singforhope' ),
			'id' => 'sidebar-1',
			'description' => __( 'Add widgets here to appear in your footer.', 'singforhope' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
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
add_filter( 'show_admin_bar', '__return_false' );


/**
 * Create pages and set their templates.
 */
function setup_pages() {
	$pages = array(
		'Home' => 'pages/home/home.php',
		'About' => 'pages/about/about.php',
		'Donate' => 'pages/donate/donate.php',
		'Contact' => 'pages/contact/contact.php',
		'Volunteer' => 'pages/volunteer/volunteer.php',
		'Sponsor' => 'pages/sponsor/sponsor.php',
		'Login' => 'pages/login/login.php',
		'Health' => 'pages/health/health.php',
		'Education' => 'pages/education/education.php',
		'Workforce' => 'pages/workforce/workforce.php',
		'Pianos' => 'pages/pianos/pianos.php',
		'Diplomacy' => 'pages/diplomacy/diplomacy.php',
		'Gifts' => 'pages/gifts/gifts.php',
		'App' => 'app/app.php',
	);

	foreach ( $pages as $page_title => $template ) {
		// Check if the page exists by title
		$args = array(
			'post_type' => 'page',
			'name' => sanitize_title( $page_title ),
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$existing_page = get_post();
			}
		} else {
			// No page found with this title.
		}

		wp_reset_postdata(); // Always reset after a custom query.

		if ( null == $existing_page ) {
			// Create the page
			$page_id = wp_insert_post(
				array(
					'post_title' => $page_title,
					'post_type' => 'page',
					'post_status' => 'publish',
				)
			);

			// Error handling for wp_insert_post
			if ( is_wp_error( $page_id ) ) {
				error_log( 'Failed to insert new page: ' . $page_id->get_error_message() );
				continue;
			}

			// Set the custom template for the new page
			if ( $template && file_exists( get_template_directory() . '/' . $template ) ) {
				update_post_meta( $page_id, '_wp_page_template', $template );
			} else if ( $template ) {
				error_log( "Template file $template not found" );
			}

			// Set the Home page as the static front page
			if ( $page_title === 'Home' ) {
				update_option( 'show_on_front', 'page' );
				update_option( 'page_on_front', $page_id );
			}


		} else {
			// If the page already exists, just set the custom template
			if ( $template && file_exists( get_template_directory() . '/' . $template ) ) {
				update_post_meta( $existing_page->ID, '_wp_page_template', $template );
			} else if ( $template ) {
				error_log( "Template file $template not found" );
			}

			// Set the existing Home page as the static front page
			if ( $page_title === 'Home' ) {
				update_option( 'show_on_front', 'page' );
				update_option( 'page_on_front', $existing_page->ID );
			}

		}
	}
}
add_action( 'after_setup_theme', 'setup_pages' );

function disable_gutenberg_on_specific_pages( $can_edit, $post ) {
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
	if ( $post && 'page' === $post->post_type && in_array( $post->post_title, $pages ) ) {
		// Disable Gutenberg
		$can_edit = false;
	}

	return $can_edit;
}
add_filter( 'use_block_editor_for_post', 'disable_gutenberg_on_specific_pages', 10, 2 );

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
add_action( 'admin_head', 'hide_postdivrich' );

// Register AJAX endpoint for deleting the entry
add_action( 'wp_ajax_delete_entry', 'delete_entry_callback' );
add_action( 'wp_ajax_nopriv_delete_entry', 'delete_entry_callback' );
function delete_entry_callback() {
	if ( isset( $_POST['index'] ) ) {
		$index = $_POST['index'];

		// Retrieve the existing invited_artists data
		$invited_artists = get_field( 'invited_artists' );

		// Check if the index is within the valid range
		if ( $index >= 0 && $index < count( $invited_artists ) ) {
			// Remove the entry at the specified index
			array_splice( $invited_artists, $index, 1 );

			// Update the invited_artists field with the modified data
			update_field( 'invited_artists', $invited_artists );

			// Send a success response
			echo 'success';
		} else {
			// If the index is out of range, send an error response
			echo 'error';
		}
	} else {
		// If the index is not provided, send an error response
		echo 'error';
	}
	wp_die();
}

// Disable support for comments and pingbacks in post types
function disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ( $post_types as $post_type ) {
		if ( post_type_supports( $post_type, 'comments' ) ) {
			remove_post_type_support( $post_type, 'comments' );
			remove_post_type_support( $post_type, 'trackbacks' );
		}
	}
}
add_action( 'admin_init', 'disable_comments_post_types_support' );

// Close comments on the front-end
function disable_comments_status() {
	return false;
}
add_filter( 'comments_open', 'disable_comments_status', 20, 2 );
add_filter( 'pings_open', 'disable_comments_status', 20, 2 );

// Hide existing comments
function disable_comments_hide_existing_comments( $comments ) {
	$comments = array();
	return $comments;
}
add_filter( 'comments_array', 'disable_comments_hide_existing_comments', 10, 2 );

// Remove comments page in menu
function disable_comments_admin_menu() {
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'disable_comments_admin_menu' );

// Redirect any user trying to access comments page
function disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ( $pagenow === 'edit-comments.php' ) {
		wp_redirect( admin_url() );
		exit;
	}
}
add_action( 'admin_init', 'disable_comments_admin_menu_redirect' );

// Remove comments metabox from dashboard
function disable_comments_dashboard() {
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
}
add_action( 'admin_init', 'disable_comments_dashboard' );

// Remove comments links from admin bar
function disable_comments_admin_bar() {
	if ( is_admin_bar_showing() ) {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu( 'comments' );
	}
}
add_action( 'admin_init', 'disable_comments_admin_bar' );


function remove_all_dashboard_widgets() {
	global $wp_meta_boxes;
	foreach ( array_keys( $wp_meta_boxes['dashboard'] ) as $context ) {
		foreach ( array_keys( $wp_meta_boxes['dashboard'][ $context ] ) as $priority ) {
			foreach ( array_keys( $wp_meta_boxes['dashboard'][ $context ][ $priority ] ) as $widget ) {
				remove_meta_box( $widget, 'dashboard', $context );
			}
		}
	}
}
add_action( 'wp_dashboard_setup', 'remove_all_dashboard_widgets', 9999 );

add_action( 'wp_ajax_get_pianos', 'get_pianos' );
add_action( 'wp_ajax_nopriv_get_pianos', 'get_pianos' );

function get_pianos() {
	$search_text = $_POST['search_text'];
	$args = array(
		'post_type' => 'piano',
		'posts_per_page' => 12,
		's' => $search_text,
		'meta_query' => array(
			'relation' => 'OR',
			array(
				'key' => 'artist_name',
				'value' => $search_text,
				'compare' => 'LIKE'
			)
		)
	);
	$the_query = new WP_Query( $args );
	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		// Output the HTML for each piano here
	endwhile;
	wp_reset_postdata();
	die();
}

function acf_mapbox_api( $api ) {

	$api['key'] = 'pk.eyJ1Ijoic2ZoYWRtaW4iLCJhIjoiY2t6bWZoemliMXBmbDJucGFjcHBqcGNpeiJ9.hTActdDjpLc-9IEf-EPnPA'; // Please obtain an access token from your Mapbox account and replace the dummy value
	return $api;

}
add_filter( 'acf/fields/mapbox/api', 'acf_mapbox_api' );

function add_custom_roles() {
	// Get the capabilities of 'subscriber'
	$subscriber = get_role( 'subscriber' );
	$subscriber_caps = $subscriber->capabilities;

	// Add new roles with 'subscriber' capabilities
	add_role( 'artist', __( 'Artist' ), $subscriber_caps );
	add_role( 'partner', __( 'Partner' ), $subscriber_caps );
	add_role( 'staff', __( 'Staff' ), $subscriber_caps );
	add_role( 'adjudicator', __( 'Adjudicator' ), $subscriber_caps );
}
add_action( 'init', 'add_custom_roles' );

function hide_all_admin_notices() {
	remove_all_actions( 'admin_notices' );
}
add_action( 'admin_print_scripts', 'hide_all_admin_notices' );

function register_user() {
	// Check if email exists
	$email_exists = email_exists( $_POST['hs_work_email_hire_us_1'] );

	if ( ! $email_exists ) {
		// Generate a random password.
		$random_password = wp_generate_password();

		// Register user with email as username
		$user_id = wp_create_user( $_POST['hs_work_email_hire_us_1'], $random_password, $_POST['hs_work_email_hire_us_1'] );

		// Set the new user's role as "artist"
		$user = new WP_User( $user_id );
		$user->set_role( 'artist' );

		// Set the user first name and last name and the Artist name as the display name.
		wp_update_user(
			array(
				'ID' => $user_id,
				'first_name' => $_POST['hs_firstname_hire_us_1'],
				'last_name' => $_POST['hs_lastname_hire_us_1'],
				'display_name' => $_POST['hs_firstname_hire_us_1'] . ' ' . $_POST['hs_lastname_hire_us_1']
			)
		);

		// Log in user
		wp_set_auth_cookie( $user_id );

		// Send JSON response
		wp_send_json_success();
		exit;
	} else {
		// Email already exists, ask for password to login.
		wp_send_json_error( 'Email already exists' );
		exit;
	}
}
add_action( 'wp_ajax_register_user', 'register_user' );
add_action( 'wp_ajax_nopriv_register_user', 'register_user' );



// Function to check for upcoming scheduled emails and send them
function send_scheduled_invites() {
	// Get today's date
	$today = date( 'Y-m-d H:i:s' );

	// Query 'program' posts
	$args = [ 
		'post_type' => 'program',
		'posts_per_page' => -1, // You might want to limit this and run the cron more frequently
	];

	$programs = new WP_Query( $args );

	if ( $programs->have_posts() ) {
		while ( $programs->have_posts() ) {
			$programs->the_post();
			$post_id = get_the_ID();

			// Check if there are 'invite_emails' for this program
			if ( have_rows( 'invite_emails', $post_id ) ) {
				while ( have_rows( 'invite_emails', $post_id ) ) {
					the_row();
					$email_subject = get_sub_field( 'email_subject' );
					$email_body = get_sub_field( 'email_body' );
					$email_datetime = get_sub_field( 'email_datetime' );

					// Check if the email_datetime is set for the next day
					if ( $email_datetime && strtotime( $email_datetime ) > strtotime( $today ) && strtotime( $email_datetime ) < strtotime( '+1 day', strtotime( $today ) ) ) {
						// Check 'invited_artists' and send them the email
						if ( have_rows( 'invited_artists', $post_id ) ) {
							while ( have_rows( 'invited_artists', $post_id ) ) {
								the_row();
								$artist_email = get_sub_field( 'invited_artist_email' );

								// Send the email
								if ( is_email( $artist_email ) ) {
									wp_mail( $artist_email, $email_subject, $email_body );
								}
							}
						}
					}
				}
			}
		}
		wp_reset_postdata();
	}
}

// Hook to schedule the email sending
function schedule_email_sending() {
	if ( ! wp_next_scheduled( 'send_scheduled_invites_hook' ) ) {
		wp_schedule_event( time(), 'hourly', 'send_scheduled_invites_hook' );
	}
}
add_action( 'wp', 'schedule_email_sending' );

// Action hook for the cron job to send the scheduled emails
add_action( 'send_scheduled_invites_hook', 'send_scheduled_invites' );

// Optional: Function to clear the scheduled hook on deactivation
function clear_scheduled_email_sending() {
	$timestamp = wp_next_scheduled( 'send_scheduled_invites_hook' );
	wp_unschedule_event( $timestamp, 'send_scheduled_invites_hook' );
}
register_deactivation_hook( __FILE__, 'clear_scheduled_email_sending' );


function fetch_piano_content() {
	$post_id = $_POST['post_id'];
	$post = get_post( $post_id );
	echo apply_filters( 'the_content', $post->post_content );
	die();
}
add_action( 'wp_ajax_fetch_piano_content', 'fetch_piano_content' );
add_action( 'wp_ajax_nopriv_fetch_piano_content', 'fetch_piano_content' );


function add_data_email_log() {
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	global $wpdb;
	$table_name = $wpdb->prefix . 'wpmailsmtp_emails_log';

	$sql = "ALTER TABLE $table_name ADD COLUMN context column_definition";

	dbDelta( $sql );
}

add_data_email_log(); // Call the function

remove_action( 'wp_head', 'wp_generator' );
