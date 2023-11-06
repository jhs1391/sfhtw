<?php
require_once 'wp-load.php'; // replace with the actual path to your wp-load.php file

if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$time = date( 'Y-m-d H:i:s' );
	$field_key = "invited_artists"; // replace with your field key

	$email_already_used = false;
	if ( have_rows( $field_key ) ) {
		while ( have_rows( $field_key ) ) {
			the_row();
			if ( get_sub_field( 'invited_artist_email' ) == $email ) {
				$email_already_used = true;
				break;
			}
		}
	}

	if ( ! $email_already_used ) {
		$value = array(
			"invited_artist_name" => $name,
			"invited_artist_email" => $email,
			"invited_artist_timestamp" => $time
		);
		$new_id = add_row( $field_key, $value );

		// Get user by email
		$user = get_user_by( 'email', $email );
		if ( $user ) {
			// Check if 'email_log' repeater field has any rows
			if ( have_rows( 'email_log', 'user_' . $user->ID ) ) {
				// Loop through the rows
				while ( have_rows( 'email_log', 'user_' . $user->ID ) ) {
					the_row();
					// Check if 'email_key' subfield value matches 'artist_invite'
					if ( get_sub_field( 'email_key' ) == 'artist_invite' ) {
						// Entry with matching 'email_key' found, so exit the function
						return;
					}
				}
			}

			// Path to email template
			$template_path = get_template_directory() . '/emails/program/artist-invite.php';

			// Check if the template file exists
			if ( file_exists( $template_path ) ) {
				// Fetch the contents of the template file
				ob_start();
				include $template_path;
				$body = ob_get_clean();
			} else {
				// Fallback content if the template file doesn't exist
				$body = '-';
			}

			$headers = array( 'Content-Type: text/html; charset=UTF-8' );

			wp_mail( $email, $name, $body, $headers );

			// Get current post ID
			$post_id = get_the_ID();

			// Get New York Timezone
			$datetime = new DateTime( 'now', new DateTimeZone( 'America/New_York' ) );
			$ny_time = $datetime->format( 'Y-m-d H:i:s' );

			// Add entry to 'email_log' repeater field
			$email_log = array(
				'datetime_sent' => $ny_time,
				'email_key' => 'artist_invite',
				'context' => 'Email sent to artists when they are added to the list. Only sent once.',
				'post_id' => $post_id
			);
			add_row( 'email_log', $email_log, 'user_' . $user->ID );

			echo json_encode( array( 'id' => $new_id, 'name' => $name, 'email' => $email ) );

		} else {
			http_response_code( 400 );
			echo 'This email address is already used.';
		}

		// Redirect after POST method
		header( "Location: " . $_SERVER['REQUEST_URI'] );
		exit;
	}
}

if ( isset( $_GET['delete'] ) ) {
	$i = $_GET['delete'];
	delete_row( 'invited_artists', $i + 1 );

	// Redirect after GET method
	header( "Location: " . strtok( $_SERVER['REQUEST_URI'], '?' ) );
	exit;
}

?>