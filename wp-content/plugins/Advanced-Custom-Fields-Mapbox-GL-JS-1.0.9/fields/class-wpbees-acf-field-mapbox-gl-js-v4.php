<?php

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// check if class already exists
if ( ! class_exists( 'wpbees_acf_field_mapbox_gl_js' ) ) {

	class wpbees_acf_field_mapbox_gl_js extends acf_field {

		// vars
		var $settings, // will hold info such as dir / path
			$defaults; // will hold default field options


		/*
		*  __construct
		*
		*  Set name / label needed for actions / filters
		*
		*  @since	3.6
		*  @date	23/01/13
		*/

		function __construct( $settings ) {
			/**
			 *  name (string) Single word, no spaces. Underscores allowed
			 */
			$this->name = 'Mapbox';

			/**
			 * label (string) Multiple words, can include spaces, visible when selecting a field type
			 */
			$this->label = __( 'Mapbox', 'acf-mapbox' );

			/**
			 * category (string) Basic | Content | Choice | Relational | JQuery | Layout | CUSTOM GROUP NAME
			 */
			$this->category = 'jQuery';

			/**
			 * defaults (array) Array of default settings which are merged into the field object. These are used later in settings
			 */
			$this->defaults = array(
				'height'              => '',
				'center_lat'          => '',
				'center_lng'          => '',
				'zoom'                => '',
				'styles'              => '',
				'enable_3d'           => '',
				'enable_marker'       => '',
				'enable_marker_popup' => '',
				'enable_nav_control'  => '',
				'marker_icon'         => ''
			);

			/**
			 * default map values
			 */
			$this->default_values = array(
				'height'     => '400',
				'center_lat' => '-77.01866',
				'center_lng' => '38.888',
				'zoom'       => '12',
				'styles'     => 'streets-v10',
			);

			/**
			 * l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
			 *  var message = acf._e('Mapbox', 'error');
			 */
			$this->l10n = array(
				'error' => __( 'Error! Please enter a higher value', 'acf-mapbox' ),
			);

			// do not delete!
			parent::__construct();

			/**
			 * settings (array) Store plugin settings (url, path, version) as a reference for later use with assets
			 */
			$this->settings = $settings;
		}


		/*
		*  create_options()
		*
		*  Create extra options for your field. This is rendered when editing a field.
		*  The value of $field['name'] can be used (like below) to save extra data to the $field
		*
		*  @type	action
		*  @since	3.6
		*  @date	23/01/13
		*
		*  @param	$field	- an array holding all the field's data
		*/

		function create_options( $field ) {
			// defaults?
			/*
			$field = array_merge($this->defaults, $field);
			*/

			// key is needed in the field names to correctly save the data
			$key = $field['name'];


			// Create Field Options HTML
			?>
			<?php // Center latitude field ?>
            <tr class="field_option field_option_<?php echo $this->name; ?>">
                <td class="label">
                    <label><?php _e( 'Center (lat)', 'acf-mapbox' ); ?></label>
                    <p class="description"><?php _e( 'Center the initial map.', 'acf-mapbox' ); ?></p>
                </td>
                <td>
					<?php

					do_action( 'acf/create_field', array(
						'type'        => 'text',
						'name'        => 'fields[' . $key . '][center_lat]',
						'value'       => $field['center_lat'],
						'layout'      => 'horizontal',
						'prepend'     => 'lat',
						'placeholder' => $this->default_values['center_lat']
					) );

					?>
                </td>
            </tr>

			<?php // Center longitude field ?>
            <tr class="field_option field_option_<?php echo $this->name; ?>">
                <td class="label">
                    <label><?php _e( 'Center (lng)', 'acf-mapbox' ); ?></label>
                    <p class="description"><?php _e( 'Center the initial map. lng value must be between -90 and 90', 'acf-mapbox' ); ?></p>
                </td>
                <td>
					<?php

					do_action( 'acf/create_field', array(
						'type'        => 'text',
						'name'        => 'fields[' . $key . '][center_lng]',
						'value'       => $field['center_lng'],
						'layout'      => 'horizontal',
						'prepend'     => 'lng',
						'placeholder' => $this->default_values['center_lng'],
						'_append'     => 'center_lat'
					) );

					?>
                </td>
            </tr>

			<?php // Zoom level field ?>
            <tr class="field_option field_option_<?php echo $this->name; ?>">
                <td class="label">
                    <label><?php _e( 'Zoom', 'acf-mapbox' ); ?></label>
                    <p class="description"><?php _e( 'Set the initial zoom level', 'acf-mapbox' ); ?></p>
                </td>
                <td>
					<?php

					do_action( 'acf/create_field', array(
						'type'        => 'text',
						'name'        => 'fields[' . $key . '][zoom]',
						'value'       => $field['zoom'],
						'layout'      => 'horizontal',
						'placeholder' => $this->default_values['zoom'],
					) );

					?>
                </td>
            </tr>

			<?php // Map container's width field ?>
            <tr class="field_option field_option_<?php echo $this->name; ?>">
                <td class="label">
                    <label><?php _e( 'Width', 'acf-mapbox' ); ?></label>
                    <p class="description"><?php _e( 'Customise the map width. If left empty, default width will be 100%', 'acf-mapbox' ); ?></p>
                </td>
                <td>
					<?php

					do_action( 'acf/create_field', array(
						'type'   => 'text',
						'name'   => 'fields[' . $key . '][width]',
						'value'  => $field['width'],
						'layout' => 'horizontal',
						'append' => 'px',
					) );

					?>
                </td>
            </tr>

			<?php // Map container's height field ?>
            <tr class="field_option field_option_<?php echo $this->name; ?>">
                <td class="label">
                    <label><?php _e( 'Height', 'acf-mapbox' ); ?></label>
                    <p class="description"><?php _e( 'Customise the map height', 'acf-mapbox' ); ?></p>
                </td>
                <td>
					<?php

					do_action( 'acf/create_field', array(
						'type'        => 'text',
						'name'        => 'fields[' . $key . '][height]',
						'value'       => $field['height'],
						'layout'      => 'horizontal',
						'append'      => 'px',
						'placeholder' => $this->default_values['height'],
					) );

					?>
                </td>
            </tr>

			<?php // Mapbox styles selection field ?>
            <tr class="field_option field_option_<?php echo $this->name; ?>">
                <td class="label">
                    <label><?php _e( 'Styles', 'acf-mapbox' ); ?></label>
                    <p class="description"><?php _e( 'Select a Mapbox Styles to use', 'acf-mapbox' ); ?></p>
                </td>
                <td>
					<?php

					do_action( 'acf/create_field', array(
						'type'        => 'select',
						'name'        => 'fields[' . $key . '][styles]',
						'value'       => $field['styles'],
						'layout'      => 'horizontal',
						'placeholder' => $this->default_values['styles'],
						'choices'     => array(
							'streets-v10'                  => 'streets-v10',
							'outdoors-v10'                 => 'outdoors-v10',
							'light-v9'                     => 'light-v9',
							'dark-v9'                      => 'dark-v9',
							'satellite-v9'                 => 'satellite-v9',
							'satellite-streets-v10'        => 'satellite-streets-v10',
							'navigation-preview-day-v2'    => 'navigation-preview-day-v2',
							'navigation-preview-night-v2'  => 'navigation-preview-night-v2',
							'navigation-guidance-day-v2'   => 'navigation-guidance-day-v2',
							'navigation-guidance-night-v2' => 'navigation-guidance-night-v2'
						)
					) );

					?>
                </td>
            </tr>

            <?php // Enable/Disable the map 3D ?>
            <tr class="field_option field_option_<?php echo $this->name; ?>">
                <td class="label">
                    <label><?php _e( 'Enable 3D', 'acf-mapbox' ); ?></label>
                    <p class="description"><?php _e( 'Enable 3D layer on the map', 'acf-mapbox' ); ?></p>
                </td>
                <td>
					<?php

					do_action( 'acf/create_field', array(
						'type'   => 'true_false',
						'name'   => 'fields[' . $key . '][enable_3d]',
						'value'  => $field['enable_3d'],
						'layout' => 'horizontal',
						'class'  => 'conditional-toggle'
					) );

					?>
                </td>
            </tr>

			<?php // Enable/Disable the map marker ?>
            <tr class="field_option field_option_<?php echo $this->name; ?>">
                <td class="label">
                    <label><?php _e( 'Map Marker', 'acf-mapbox' ); ?></label>
                    <p class="description"><?php _e( 'Enable the marker on the map', 'acf-mapbox' ); ?></p>
                </td>
                <td>
					<?php

					do_action( 'acf/create_field', array(
						'type'   => 'true_false',
						'name'   => 'fields[' . $key . '][enable_marker]',
						'value'  => $field['enable_marker'],
						'layout' => 'horizontal',
						'class'  => 'conditional-toggle'
					) );

					?>
                </td>
            </tr>

			<?php // Enable/Disable the map marker popup ?>
            <tr class="field_option field_option_<?php echo $this->name; ?>">
                <td class="label">
                    <label><?php _e( 'Map Marker Popup', 'acf-mapbox' ); ?></label>
                    <p class="description"><?php _e( 'Enable the marker popup on the map', 'acf-mapbox' ); ?></p>
                </td>
                <td>
					<?php

					do_action( 'acf/create_field', array(
						'type'   => 'true_false',
						'name'   => 'fields[' . $key . '][enable_marker_popup]',
						'value'  => $field['enable_marker_popup'],
						'layout' => 'horizontal',
						'class'  => 'conditional-toggle'
					) );

					?>
                </td>
            </tr>

            <?php // Select marker icon ?>
            <tr class="field_option field_option_<?php echo $this->name; ?>">
                <td class="label">
                    <label><?php _e( 'Map Marker Icon', 'acf-mapbox' ); ?></label>
                    <p class="description"><?php _e( 'Leave empty to use default icon', 'acf-mapbox' ); ?></p>
                </td>
                <td>
					<?php

					do_action( 'acf/create_field', array(
						'type'   => 'image',
						'name'   => 'fields[' . $key . '][marker_icon]',
						'value'  => $field['marker_icon'],
						'layout' => 'horizontal',
						'class'  => 'conditional-toggle'
					) );

					?>
                </td>
            </tr>

			<?php // Enable/Disable the map navigation control ?>
            <tr class="field_option field_option_<?php echo $this->name; ?>">
                <td class="label">
                    <label><?php _e( 'Navigation Control', 'acf-mapbox' ); ?></label>
                    <p class="description"><?php _e( 'Enable the navigation control on the map', 'acf-mapbox' ); ?></p>
                </td>
                <td>
					<?php

					do_action( 'acf/create_field', array(
						'type'   => 'true_false',
						'name'   => 'fields[' . $key . '][enable_nav_control]',
						'value'  => $field['enable_nav_control'],
						'layout' => 'horizontal',
						'class'  => 'conditional-toggle'
					) );

					?>
                </td>
            </tr>
			<?php
		}

		/**
		 *  create_field()
		 *
		 *  Create the HTML interface for your field
		 *
		 * @param    $field - an array holding all the field's data
		 *
		 * @type    action
		 * @since    3.6
		 * @date    23/01/13
		 */
		function create_field( $field ) {
			// Apply filter from functions.php to use the Mapbox access token
			$api = apply_filters( 'acf/fields/mapbox/api', array() );

			// Get the field ID because this will serve as the wrapper element of the map and the hidden fields
			$field_id = $field['id'];

			// validate value
			if ( empty( $field['value'] ) ) {
				$field['value'] = array();
			}

			// Populate fields with default values if they're empty yet
			foreach ( $this->default_values as $k => $v ) {
				if ( empty( $field[ $k ] ) ) {
					$field[ $k ] = $v;
				}
			}

			// The following fields: Zoom, Height, Width, Styles, Map Marker, Map Marker Popup,
			// and Navigation Control should always use the values from the form. But if the form
			// is not yet supplied with values, the $this->default_values will be used.
			//
			// The fields lat and lang will use the user supplied values if already supplied. Else, the $this->default_values will be used.
			//
			// The field address will always use the user supplied value.
			$field['value'] = array(
				'lat'                 => ( ! empty( $field['value']['lat'] ) ) ? $field['value']['lat'] : $field['center_lat'],
				'lng'                 => ( ! empty( $field['value']['lng'] ) ) ? $field['value']['lng'] : $field['center_lng'],
				'address'             => ( ! empty( $field['value']['address'] ) ) ? $field['value']['address'] : '',
				'zoom'                => $field['zoom'],
				'width'               => $field['width'],
				'height'              => $field['height'],
				'styles'              => $field['styles'],
				'enable_marker'       => $field['enable_marker'],
				'enable_3d'           => $field['enable_3d'],
				'enable_marker_popup' => $field['enable_marker_popup'],
				'marker_icon'         => $field['marker_icon'],
				'enable_nav_control'  => $field['enable_nav_control'],
				'acf_mapbox_static'   => ( ! empty( $field['value']['acf_mapbox_static'] ) ) ? $field['value']['acf_mapbox_static'] : 0,
				'acf_mapbox_marker_title'        => $field['value']['acf_mapbox_marker_title'],
				'acf_mapbox_marker_content'        => $field['value']['acf_mapbox_marker_content']
			);

			?>
            <div id="<?php echo $field['id']; ?>" class="acf-mapbox">
            	<p>
            		<label for="acf_mapbox_static">
            			<input type="checkbox" class="input-acf_mapbox_static" name="<?php echo esc_attr( $field['name'] ); ?>[acf_mapbox_static]" id="acf_mapbox_static" <?php if ($field['value']['acf_mapbox_static']): ?> checked="true" <?php endif; ?>>
            			Use static map
            		</label>
            	</p>
            	<?php if ($field['value']['enable_marker_popup']): ?>
	            	<p>
	            		<label for="acf_mapbox_marker_title">
	            			Marker title
	            			<input type="text" class="input-acf_mapbox_marker_title" name="<?php echo esc_attr( $field['name'] ); ?>[acf_mapbox_marker_title]" id="acf_mapbox_marker_title" value="<?php echo $field['value']['acf_mapbox_marker_title']; ?>" >
	            			
	            		</label>
	            	</p>
	            	<p>
	            		<label for="acf_mapbox_marker_content">
	            			Marker content
	            			<textarea class="input-acf_mapbox_marker_content" name="<?php echo esc_attr( $field['name'] ); ?>[acf_mapbox_marker_content]" id="acf_mapbox_marker_content"> <?php echo $field['value']['acf_mapbox_marker_content']; ?></textarea>
	            			
	            		</label>
	            	</p>
            	<?php endif; ?>
                <div class="acf-hidden">
                	<?php 
	                	unset($field['value']['acf_mapbox_static']); 
	                	unset($field['value']['acf_mapbox_marker_title']); 
	                	unset($field['value']['acf_mapbox_marker_content']); 
                	?>
					<?php foreach ( $field['value'] as $k => $v ): ?>
                        <input type="hidden" class="input-<?php echo $k; ?>" name="<?php echo esc_attr( $field['name'] ); ?>[<?php echo $k; ?>]" value="<?php echo esc_attr( $v ); ?>"/>
					<?php endforeach; ?>
                </div>

				<?php // Make sure that an access token is available ?>
				<?php if ( isset( $api['key'] ) ): ?>
					<?php $place_holder = ( isset( $field['value']['address'] ) ) ? $field['value']['address'] : $this->default_search_placeholder; // Use the selected place as a placeholder or use the default ?>
                    <div id="map_<?php echo $field_id; ?>"
                         style="<?php if ( $field['width'] ): ?>width: <?php echo $field['width']; ?>px;<?php endif; ?><?php if ( $field['height'] ): ?>height: <?php echo $field['height']; ?>px;<?php endif; ?>"></div>
                    <script type="text/javascript">
                        if (typeof mapboxgl !== 'undefined') {
                            // Set the access token
                            mapboxgl.accessToken = '<?php echo $api['key']; ?>';

                            // Create the map using all the values we gathered
                            if (typeof create_map !== 'undefined') {
                                create_map(
                                    "<?php echo $field_id; ?>",
									<?php echo ( ! empty( $field['value']['lat'] ) ) ? $field['value']['lat'] : $field['center_lat']; ?>,
									<?php echo ( ! empty( $field['value']['lng'] ) ) ? $field['value']['lng'] : $field['center_lng']; ?>,
                                    "<?php echo $place_holder; ?>",
									<?php echo $field['zoom']; ?>,
                                    "<?php echo $field['styles']; ?>",
									<?php echo ( $field['enable_nav_control'] == 1 ) ? 'true' : 'false'; ?>,
									<?php echo ( $field['enable_3d'] == 1 ) ? 'true' : 'false'; ?>,
									<?php echo ( $field['enable_marker'] == 1 ) ? 'true' : 'false'; ?>,
									<?php echo ( $field['enable_marker_popup'] == 1 ) ? 'true' : 'false'; ?>,
									"<?php echo ($field['marker_icon']) ? wp_get_attachment_image_url( $field['marker_icon'], 'full' ) : 0; ?>"
                                );
                            }
                        }
                    </script>
				<?php endif; ?>
            </div>
			<?php
		}

		/**
		 *  input_admin_enqueue_scripts()
		 *
		 *  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
		 *  Use this action to add CSS + JavaScript to assist your render_field() action.
		 *
		 * @type    action (admin_enqueue_scripts)
		 * @since    3.6
		 * @date    23/01/13
		 *
		 * @param    n/a
		 *
		 * @return    n/a
		 */
		function input_admin_enqueue_scripts() {
			// vars
			$url     = $this->settings['url'];
			$version = $this->settings['version'];

			// Register & include JS
			wp_enqueue_script( 'acf-mapbox-gl-js', 'https://api.mapbox.com/mapbox-gl-js/v0.47.0/mapbox-gl.js', array( 'acf-input' ), $version );
			wp_enqueue_script( 'acf-mapbox-gl-geocoder-js', 'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js', array( 'acf-input' ), $version );
			wp_enqueue_script( 'acf-mapbox-custom-js', "{$url}assets/js/mapbox-gl-js.js", array( 'acf-input' ), $version );

			// Register & include CSS
			wp_enqueue_style( 'acf-mapbox-gl-css', 'https://api.mapbox.com/mapbox-gl-js/v0.47.0/mapbox-gl.css', array( 'acf-input' ), $version );
			wp_enqueue_style( 'acf-mapbox-gl-geocoder-css', 'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css', array( 'acf-input' ), $version );
			wp_enqueue_style( 'acf-mapbox-custom-css', "{$url}assets/css/mapbox-gl-js.css", array( 'acf-input' ), $version );
		}

		/**
		 *  update_value()
		 *
		 *  This filter is applied to the $value before it is saved in the db
		 *
		 * @type    filter
		 * @since    3.6
		 * @date    27/07/18
		 *
		 * @param    $value (mixed) the value found in the database
		 * @param    $post_id (mixed) the $post_id from which the value was loaded
		 * @param    $field (array) the field array holding all the field options
		 *
		 * @return    $value
		 */
		function update_value( $value, $post_id, $field ) {
			if ( empty( $value ) || empty( $value['lat'] ) || empty( $value['lng'] ) ) {
				return false;
			}

			return $value;
		}

		/**
		 *  validate_value()
		 *
		 *  This filter is used to perform validation on the value prior to saving.
		 *  All values are validated regardless of the field's required setting. This allows you to validate and return
		 *  messages to the user if the value is not correct
		 *
		 * @type    filter
		 * @date    11/02/2014
		 * @since    5.0.0
		 *
		 * @param    $valid (boolean) validation status based on the value and the field's required setting
		 * @param    $value (mixed) the $_POST value
		 * @param    $field (array) the field array holding all the field options
		 * @param    $input (string) the corresponding input name for $_POST value
		 *
		 * @return    $valid
		 */
		function validate_value( $valid, $value, $field, $input ) {
			// bail early if not required
			if ( ! $field['required'] ) {
				return $valid;
			}

			if ( empty( $value ) || empty( $value['lat'] ) || empty( $value['lng'] ) ) {
				return false;
			}

			return $valid;
		}
	}

// initialize
	new wpbees_acf_field_mapbox_gl_js( $this->settings );
}