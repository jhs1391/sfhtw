<?php
require_once 'wp-load.php'; // replace with the actual path to your wp-load.php file

if ( isset( $_GET['delete'] ) ) {
	$i = $_GET['delete'];
	delete_row( 'invited_artists', $i + 1 );
}
?>