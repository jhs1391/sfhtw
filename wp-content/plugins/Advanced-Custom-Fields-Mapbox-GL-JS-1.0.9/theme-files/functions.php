<?php

/**
 * Mapbox API
 *
 * Copy this to your theme's functions.php preferably at the end
 *
 * @param $api
 *
 * @return mixed
 */
function acf_mapbox_api( $api ) {
	$api['key'] = 'XXXX'; // Please obtain an access token from your Mapbox account and replace the dummy value

	return $api;
}

add_filter( 'acf/fields/mapbox/api', 'acf_mapbox_api' );
