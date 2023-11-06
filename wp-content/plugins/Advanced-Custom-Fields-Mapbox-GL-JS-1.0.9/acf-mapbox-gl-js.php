<?php

/*
Plugin Name: Advanced Custom Fields: Mapbox GL JS
Description: Mapbox GL JS is a JavaScript library that uses WebGL to render interactive maps from vector tiles and Mapbox styles.
Version: 1.0.9
Author: WP Bees
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// check if class already exists
if ( ! class_exists( 'wpbees_acf_plugin_mapbox_gl_js' ) ) {

	class wpbees_acf_plugin_mapbox_gl_js {
		// vars
		var $settings;

		/**
		 *  __construct
		 *
		 *  This function will setup the class functionality
		 *
		 * @type    function
		 * @date    27/07/2018
		 * @since    1.0.0
		 *
		 * @param    void
		 *
		 * @return    void
		 */
		function __construct() {
			// settings
			// - these will be passed into the field class.
			$this->settings = array(
				'version' => '1.0.0',
				'url'     => plugin_dir_url( __FILE__ ),
				'path'    => plugin_dir_path( __FILE__ )
			);

			// include field depending on ACF version
			add_action( 'acf/include_field_types', array( $this, 'include_field' ) ); // v5
			add_action( 'acf/register_fields', array( $this, 'include_field' ) ); // v4

			// Create shortcode
			add_shortcode('mapbox-map', array($this, 'create_shortcode'));

			// Enqueue scripts
			add_action( 'wp_enqueue_scripts', array($this, 'acf_mapbox_assets' ));
		}

		/**
		 *  include_field
		 *
		 *  This function will include the field type class
		 *
		 * @type    function
		 *
		 * @param int $version
		 *
		 * @date    27/07/2018
		 * @since    1.0.0
		 *
		 * @return    void
		 */
		function include_field( $version ) {
			if ( ! $version ) {
				$version = 4;
			}

			// include file depending on version number
			include_once( 'fields/class-wpbees-acf-field-mapbox-gl-js-v' . $version . '.php' );
		}

		function acf_mapbox_assets(){
			// Mapbox assets
			wp_register_script( 'acf-mapbox-gl-js', '//api.mapbox.com/mapbox-gl-js/v2.8.2/mapbox-gl.js' );
			wp_register_style( 'acf-mapbox-gl-css', '//api.mapbox.com/mapbox-gl-js/v2.8.2/mapbox-gl.css' );

			// Our custom assets
			wp_register_style( 'acf-mapbox-gl-css-custom', plugin_dir_url(__FILE__ ) . '/assets/css/mapbox-gl-js.css' );
		}

		function generate_mapbox_features($post_type, $field_name){
			$posts = get_posts(array(
				'post_type' => $post_type,
				'posts_per_page' => -1,
				'post_status' => 'publish'
			));

			$features = array();

			if ($posts) {
				foreach ($posts as $key => $post) {
					$map_field = get_field($field_name, $post->ID);

					if ($map_field) {
						$props = array(
							'type' => 'Feature',
							'geometry' => array(
								'type' => 'Point',
								'coordinates' => array(
									$map_field['lng'],
									$map_field['lat']
								)
							),
							'properties' => array(
								'address' => $map_field['address']
							)
						);

						if (isset($map_field['acf_mapbox_marker_title'])) {
							$props['properties']['title'] = $map_field['acf_mapbox_marker_title'];
						}

						if (isset($map_field['acf_mapbox_marker_content'])) {
							$props['properties']['description'] = $map_field['acf_mapbox_marker_content'];
						}

						$features[] = $props;
					}
				}
			}

			return $features;
		}

		function create_shortcode($atts){
			wp_enqueue_script('acf-mapbox-gl-js');
			wp_enqueue_style('acf-mapbox-gl-css');
			wp_enqueue_style('acf-mapbox-gl-css-custom');

			$api = apply_filters( 'acf/fields/mapbox/api', array() );
			$fields = get_fields(); 
			$html = '';
			$atts = shortcode_atts( 	
				array(
				'post_type' => false,
				'field_name' => false
				),
			$atts );

			if($atts['post_type'] && $atts['field_name']){
				$features = $this->generate_mapbox_features($atts['post_type'], $atts['field_name']);
			}
			
			if ( isset( $api['key'] ) && !empty($fields) ):
				foreach ( $fields as $name => $location ):
					if ( ! isset( $location['lat'] ) && ! isset( $location['lng'] ) ):
						continue; 
					endif;
					$acf_mapbox_static = false;
					if (isset($location['acf_mapbox_static'])) $acf_mapbox_static = true;
					 $name = 'mapbox';
					 $style = '<style type="text/css"> #map_' . $name . '{';
						if (isset($location['width']) && !empty($location['width'])):
							$style .= 'width:' . $location['width'] . 'px;';
						endif;
						if (isset($location['height']) && !empty($location['height'])):
							$style .= 'height: ' . $location['height'] . 'px;';
						endif;
					$style .= 'max-width: 100%; } ';
						if (isset($location['marker_icon']) && $location['marker_icon']) {
							$style .= '#map_' . $name . ' .marker {';
								$style .= 'background-image: url(' . wp_get_attachment_image_url( $location['marker_icon'], 'full' ) . '); }';
						}

					$style .='</style>';
					$html .= $style;

					$html .= '<div id="map_' . $name . '">';
					if ($acf_mapbox_static):
						$map_width = (isset($location['width']) && !empty($location['width'])) ? $location['width'] : 1280;
						$map_height = (isset($location['height']) && !empty($location['height'])) ? $location['height'] : 600;
						$zoom = isset($location['zoom']) ? $location['zoom'] : '16';
						$lat = $location['lat'];
						$lng = $location['lng'];
						$style = $location["styles"];
						$token = $api['key'];
						$marker = '';
						if (isset($location['enable_marker']) && $location['enable_marker']) {
							$marker = '/pin-l-20+0c248d(' . $lat . ',' . $lng . ')';
						}
						
						$url = 'https://api.mapbox.com/styles/v1/mapbox/' . $style . '/static' . $marker . '/' . $lat . ',' . $lng . ',' . $zoom . '/' . $map_width . 'x' . $map_height . '?access_token=' . $token;
						$html .= '<img src="' . $url . '" alt="">';
					endif;
					$html .= '</div>';
					if(!$acf_mapbox_static): 
						ob_start(); ?>
						<script type="text/javascript">
							document.addEventListener("DOMContentLoaded", function(event) {
								if (mapboxgl) {
							    // Set the access token
							    mapboxgl.accessToken = '<?php echo $api['key']; ?>';
							    try {
							        // Create the map coordinates using the values from the form or from the user's selected location
							        var map = new mapboxgl.Map({
							            container: 'map_<?php echo $name; ?>',
							            zoom: <?php echo (isset($location['zoom'])) ? $location['zoom'] : '16'; ?>,
							            center: [<?php echo $location['lng']; ?>, <?php echo $location['lat']; ?>],
							            style: 'mapbox://styles/mapbox/<?php echo $location['styles']; ?>'
							            });
							        	// Enable 3D
							            <?php if (isset($location['enable_3d'])) { ?>
							            	// The 'building' layer in the mapbox-streets vector source contains building-height
											// data from OpenStreetMap.
											map.on('load', function() {
											    // Insert the layer beneath any symbol layer.
											    var layers = map.getStyle().layers;

											    var labelLayerId;
											    for (var i = 0; i < layers.length; i++) {
											        if (layers[i].type === 'symbol' && layers[i].layout['text-field']) {
											            labelLayerId = layers[i].id;
											            break;
											        }
											    }

											    map.addLayer({
											            'id': '3d-buildings',
											            'source': 'composite',
											            'source-layer': 'building',
											            'filter': ['==', 'extrude', 'true'],
											            'type': 'fill-extrusion',
											            'minzoom': 15,
											            'paint': {
											                'fill-extrusion-color': '#aaa',

											                // use an 'interpolate' expression to add a smooth transition effect to the
											                // buildings as the user zooms in
											                'fill-extrusion-height': [
											                    'interpolate',
											                    ['linear'],
											                    ['zoom'],
											                    15,
											                    0,
											                    15.05,
											                    ['get', 'height']
											                ],
											                'fill-extrusion-base': [
											                    'interpolate',
											                    ['linear'],
											                    ['zoom'],
											                    15,
											                    0,
											                    15.05,
											                    ['get', 'min_height']
											                ],
											                'fill-extrusion-opacity': 0.6
											            }
											        },
											        labelLayerId
											    );
											});
							            <?php } ?>
							            <?php // Add the navigation control if it is set to be enabled ?>
							            <?php if (isset($location['enable_nav_control']) && $location['enable_nav_control']): ?>
							                var navControl = new mapboxgl.NavigationControl();
							            	map.addControl(navControl, 'top-left');
							            <?php endif; ?>
							            <?php // Add the marker if it is set to be enabled ?>
							            <?php if (isset($location['enable_marker']) && $location['enable_marker']): 
											
											$ftrs = 
												array(
													'type' => 'Feature',
													'geometry' => array(
														'type' => 'Point',
														'coordinates' => array(
															$location['lng'], $location['lat']
														)
													),
													'properties' => array(
														'address' => $location['address']
													)
												);

											if (isset($location['acf_mapbox_marker_title'])) {
												$ftrs['properties']['title'] = $location['acf_mapbox_marker_title'];
											}

											if (isset($location['acf_mapbox_marker_content'])) {
												$ftrs['properties']['description'] = $location['acf_mapbox_marker_content'];
											}

											$geoJSON = array(
												'type' => 'FeatureCollection',
												'features' => array($ftrs)
											);
											
											if (isset($features) && !empty($features)) {
												$geoJSON['features'] = array_merge($geoJSON['features'], $features);
											}
											
											?>
							            // This GeoJSON will be used to determine where the markers will appear on the map
							            var geoJSON = <?php echo json_encode($geoJSON); ?>;

										if (geoJSON.features.length > 1) {
											// Fit bounds using features coordinates
											var bounds = new mapboxgl.LngLatBounds();

											geoJSON.features.forEach(function(feature) {
												bounds.extend(feature.geometry.coordinates);
											});

											map.fitBounds(bounds, {padding: 50});
										}

							            // Add the marker to map
							            geoJSON.features.forEach(function (marker) {
								            // Create an HTML element for each feature
								            var el = document.createElement('div');
								            el.className = 'marker';
								            // Make a marker for the feature and add to the map
								            var mapMarker = new mapboxgl.Marker(el).setLngLat(marker.geometry.coordinates);
								            <?php if (isset($location['enable_marker_popup']) && $location['enable_marker_popup']): ?>
								            // Set the popup if the marker popup is set to be enabled
								            var title = (marker.properties.title) ? marker.properties.title : '';
								            var description = (marker.properties.description) ? marker.properties.description : '';
								            mapMarker.setPopup(new mapboxgl.Popup({offset: 25}) // adds popup
								            .setHTML('<h3>' + title + '</h3><p>' + description + '</p>')); // popup HTML
								            <?php endif; ?>
								            // Add the marker to the map
								            mapMarker.addTo(map);
							        	});
							        <?php endif; ?>
							    } catch (error) {
									// Log important error message
									console.log(error.message);
							    }
							}
							});						 
							</script>
							<?php 
							$html .= ob_get_contents();
							ob_end_clean();
					endif;
				endforeach;
			else: 
				$html .= '<div style="color: #FF0000; margin: 0 auto; width: 50%; text-align: center;">' . __( 'Please set the Mapbox access token and make sure to change the ACF field name. For more info, please read the readme.txt file inside the plugin folder.' ) . '</div>';
			endif;
			return $html;
		}
	}

	// initialize
	new wpbees_acf_plugin_mapbox_gl_js();
}