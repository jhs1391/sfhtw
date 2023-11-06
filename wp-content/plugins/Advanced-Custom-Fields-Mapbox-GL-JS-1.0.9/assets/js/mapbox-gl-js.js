/**
 * Custom Mapbox JS
 */

/**
 * Create the custom map
 *
 * @param id
 * @param center_lat
 * @param center_lng
 * @param address
 * @param zoom
 * @param styles
 * @param enable_nav_control
 * @param enable_marker
 * @param enable_marker_popup
 */
function create_map(id, center_lat, center_lng, address, zoom, styles, enable_nav_control, enable_3d, enable_marker, enable_marker_popup, marker_icon) {
    // bail early if Mapbox required JS is not available
    if (typeof mapboxgl === 'undefined') {
        return;
    }
    let field_id = jQuery('#' + id);

    try {
        // Create the map coordinates using the values from the form or from the user's selected location
        let map = new mapboxgl.Map({
            container: 'map_' + id,
            zoom: (zoom) ? zoom : '16',
            center: [center_lng, center_lat],
            style: 'mapbox://styles/mapbox/' + styles
        });

        // Add the navigation control if it is set to be enabled ?>
        if (enable_nav_control) {
            let navControl = new mapboxgl.NavigationControl();
            map.addControl(navControl, 'top-left');
        }

        /* Given a query in the form "lng, lat" or "lat, lng"
         * returns the matching geographic coordinate(s)
         * as search results in carmen geojson format,
         * https://github.com/mapbox/carmen/blob/master/carmen-geojson.md */
        const coordinatesGeocoder = function(query) {
            // Match anything which looks like
            // decimal degrees coordinate pair.
            const matches = query.match(
                /^[ ]*(?:Lat: )?(-?\d+\.?\d*)[, ]+(?:Lng: )?(-?\d+\.?\d*)[ ]*$/i
            );
            if (!matches) {
                return null;
            }

            function coordinateFeature(lng, lat) {
                return {
                    center: [lng, lat],
                    geometry: {
                        type: 'Point',
                        coordinates: [lng, lat]
                    },
                    place_name: 'Lat: ' + lat + ' Lng: ' + lng,
                    place_type: ['coordinate'],
                    properties: {},
                    type: 'Feature'
                };
            }

            const coord1 = Number(matches[1]);
            const coord2 = Number(matches[2]);
            const geocodes = [];

            if (coord1 < -90 || coord1 > 90) {
                // must be lng, lat
                geocodes.push(coordinateFeature(coord1, coord2));
            }

            if (coord2 < -90 || coord2 > 90) {
                // must be lat, lng
                geocodes.push(coordinateFeature(coord2, coord1));
            }

            if (geocodes.length === 0) {
                // else could be either lng, lat or lat, lng
                geocodes.push(coordinateFeature(coord1, coord2));
                geocodes.push(coordinateFeature(coord2, coord1));
            }

            return geocodes;
        };

        // Add the geocoder to search for places using Mapbox Geocoding API
        map.addControl(new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            localGeocoder: coordinatesGeocoder,
            placeholder: address,
            marker: true
        }).on('result', function(geocoder) {
            let field_id = jQuery('#' + id);
            let hidden_input_lat = jQuery('.input-lat', field_id);
            let hidden_input_lng = jQuery('.input-lng', field_id);
            let hidden_input_address = jQuery('.input-address', field_id);
            let hidden_input_zoom = jQuery('.input-zoom', field_id);
            let center_lng = (geocoder.result.center[0]) ? geocoder.result.center[0] : null;
            let center_lat = (geocoder.result.center[1]) ? geocoder.result.center[1] : null;
            let address = (geocoder.result.place_name) ? geocoder.result.place_name : null;

            // Update the hidden elements using the values from the search result
            if (hidden_input_lat.length > 0 && center_lat) {
                // Update center_lat
                hidden_input_lat.val(center_lat);
            }
            if (hidden_input_lng.length > 0 && center_lng) {
                // Update center_lng
                hidden_input_lng.val(center_lng)
            }

            if (hidden_input_address.length > 0 && address) {
                // Update address

                hidden_input_address.val(address)
            }

            // Create the marker on the searched location
            if (center_lat && center_lng && address) {
                create_marker(map, center_lat, center_lng, address, enable_marker, enable_marker_popup, field_id);
            }
        }));

        // Fix width issue
       map.on('idle',function(){
        map.resize()
       })

        // Create the map marker
        create_marker(map, center_lat, center_lng, address, enable_marker, enable_marker_popup, field_id);

    } catch (error) {
        // Log important error message
        console.log(error.message);
    }
}

/**
 * Create the map marker
 *
 * @param map
 * @param center_lat
 * @param center_lng
 * @param address
 * @param enable_marker
 * @param enable_marker_popup
 */
function create_marker(map, center_lat, center_lng, address, enable_marker, enable_marker_popup, field_id) {
    // Add the marker if it is set to be enabled
    if (enable_marker) {
        // This GeoJSON will be used to determine where the marker will appear on the map
        let geoJSON = {
            type: 'FeatureCollection',
            features: [{
                type: 'Feature',
                geometry: {
                    type: 'Point',
                    coordinates: [center_lng, center_lat]
                },
                properties: {
                    title: 'Mapbox',
                    description: address
                }
            }]
        };

        // Add marker to the location
        geoJSON.features.forEach(function(marker) {
            // Create an HTML element for each feature
            let el = document.createElement('div');
            el.className = 'marker';

            let width = '41';
            let height = '41';

            // Make a marker for the feature and add to the map
            let map_marker = new mapboxgl.Marker(el, {
                anchor: 'bottom',
                draggable: true
            }).setLngLat(marker.geometry.coordinates);

            // Set the popup if the marker popup is set to be enabled
            if (enable_marker_popup) {
                map_marker.setPopup(new mapboxgl.Popup({ offset: 25 }) // adds popup
                    .setHTML('<h3>' + marker.properties.title + '</h3><p>' + marker.properties.description + '</p>'));
            }

            // Add the marker to the map
            map_marker.addTo(map);

            map_marker.on('dragend', function (e) {
              jQuery('.input-lat', field_id).val(e.target._lngLat.lat);
              jQuery('.input-lng', field_id).val(e.target._lngLat.lng);
            });

        });
    }
}