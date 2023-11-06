<?php
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

// Check if the field is not empty
if ( get_field( 'program_content' ) ) :

	// Display the field content
	the_field( 'program_content' );

endif;

// Get the current date
$current_date = date( 'Y-m-d' );

// Get the applications start and end dates
$applications_start_date = get_field( 'program_dates' )['applications_start_date'];
$applications_end_date = get_field( 'program_dates' )['applications_end_date'];

// Convert the 'Ymd' format into a format that strtotime() can understand
if ( $applications_start_date ) {
	$date = DateTime::createFromFormat( 'Ymd', $applications_start_date );
	$applications_start_date = $date->format( 'Y-m-d' );
}

if ( $applications_end_date ) {
	$date = DateTime::createFromFormat( 'Ymd', $applications_end_date );
	$applications_end_date = $date->format( 'Y-m-d' );
}

// Only show the program-application template if the current date is within the application period.
if ( $applications_end_date && strtotime( $applications_end_date ) > strtotime( $current_date )
	&& $applications_start_date && strtotime( $applications_start_date ) <= strtotime( $current_date ) ) :
	include( 'program-application.php' );
endif;
?>