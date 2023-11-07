<?php
add_action( 'init', 'handle_form_submission' );
function handle_form_submission() {

	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );

	if ( $_SERVER['REQUEST_METHOD'] !== 'POST' || ! isset( $_POST['application_form'] ) ) {
		return;
	}

	// Nonce verification for form submission
	if ( ! isset( $_POST['form_nonce_field'] ) || ! wp_verify_nonce( $_POST['form_nonce_field'], 'form_nonce_action' ) ) {
		die( 'Invalid form submission.' );
	}

	$current_user_id = get_current_user_id();

	// Check if user has already submitted an application for this program
	$args = array(
		'post_type' => 'application',
		'posts_per_page' => 1,
		'author' => $current_user_id,
		'meta_query' => array(
			array(
				'key' => 'application_program', // name of custom field
				'value' => sanitize_text_field( $_POST['application_program'] ), // matches exactly the ID of the current post
				'compare' => '=' // exact match
			)
		)
	);
	$query = new WP_Query( $args );

	$user_has_entry = false;

	if ( $query->have_posts() ) {
		$user_has_entry = true;
		while ( $query->have_posts() ) {
			$query->the_post();
			$post_id = get_the_ID(); // Get the ID of the post.
		}
	} else {
		// Create new application post
		$post_data = array(
			'post_title' => sanitize_text_field( $_POST['af-submit-app-project-name'] ),
			'post_status' => 'publish',
			'post_type' => 'application',
			'post_author' => $current_user_id,
		);
		$post_id = wp_insert_post( $post_data );
	}

	wp_reset_postdata();


	// If user has already submitted an application, update it.
	if ( $user_has_entry ) {
		$updated_post_data = array(
			'ID' => $post_id,
			'post_title' => sanitize_text_field( $_POST['af-submit-app-project-name'] ),
		);
		wp_update_post( $updated_post_data );
	}

	// Save other ACF fields data
	update_field( 'application_artist', $current_user_id, $post_id );
	update_field( 'application_submitted_time', current_time( 'mysql' ), $post_id );
	update_field( 'artwork_description', sanitize_textarea_field( $_POST['af-submit-app-description'] ), $post_id );
	if ( isset( $_POST['application_program'] ) ) {

		update_field( 'application_program', $_POST['application_program'], $post_id );
	}


	// Validate file upload and save ACF fields data
	$allowed_file_types = array( 'jpg' => 'image/jpg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'pdf' =>
		'application/pdf' );

	$file_fields = array(
		'af-submit-app-upload-images-front' => 'artwork_front',
		'af-submit-app-upload-images-back' => 'artwork_back',
		'af-submit-app-upload-images-sides' => 'artwork_sides'
	);
	foreach ( $file_fields as $field => $acf_field ) {
		if ( isset( $_FILES[ $field ] ) && $_FILES[ $field ]['name'] != '' ) {
			$file_type = wp_check_filetype( basename( $_FILES[ $field ]['name'] ) );
			if ( ! in_array( $file_type['type'], $allowed_file_types ) ) {
				die( 'Invalid file type for ' . $field . '.' );
			}

			// Upload file to WordPress
			$upload_overrides = array( 'test_form' => false );

			// Here we use media_handle_upload instead of wp_handle_upload
			$attach_id = media_handle_upload( $field, $post_id, array(), $upload_overrides );

			if ( is_wp_error( $attach_id ) ) {
				die( 'File upload error: ' . $attach_id->get_error_message() );
			} else {
				// Save file field data
				update_field( $acf_field, $attach_id, $post_id );
				error_log( "Saved field: " . $acf_field . " with attach_id: " . $attach_id );
			}
		}
	}

	// Redirect to the same page to prevent form resubmission on refresh.
	header( 'Location: ' . $_SERVER['REQUEST_URI'] );
	exit;

}

?>