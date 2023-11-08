<link href='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css' rel='stylesheet' />

<div class="flex flex-row space-x-2.5">

	<div class="w-full bg-white border border-gray-200 rounded p-5">

		<div>Public Sites</div>

		<script src='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js'></script>
		<style>
			#btn-spin {
				font: bold 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
				background-color: #3386c0;
				color: #fff;
				position: absolute;
				top: 20px;
				left: 50%;
				z-index: 1;
				border: none;
				width: 300px;
				margin-left: -100px;
				display: block;
				cursor: pointer;
				padding: 10px 20px;
				border-radius: 3px;
			}

			#btn-spin:hover {
				background-color: #4ea0da;
			}
		</style>
		<div id="map"></div>
		<button id="btn-spin">Pause rotation</button>
		<script>
			mapboxgl.accessToken = 'pk.eyJ1Ijoic2ZoYWRtaW4iLCJhIjoiY2t6bWZnY2VhNWY0djJwdHZhZnpvY3prbSJ9.5vyd64pGtGwl9YfMNFH9eQ';
			const map = new mapboxgl.Map({
				container: 'map',
				style: 'mapbox://styles/mapbox/satellite-v9',
				projection: 'globe', // Display the map as a globe, since satellite-v9 defaults to Mercator
				zoom: 1.5,
				center: [-90, 40]
			});

			map.on('style.load', () => {
				map.setFog({}); // Set the default atmosphere style
			});

			// The following values can be changed to control rotation speed:

			// At low zooms, complete a revolution every two minutes.
			const secondsPerRevolution = 1420;
			// Above zoom level 5, do not rotate.
			const maxSpinZoom = 5;
			// Rotate at intermediate speeds between zoom levels 3 and 5.
			const slowSpinZoom = 3;

			let userInteracting = false;
			let spinEnabled = true;

			function spinGlobe() {
				const zoom = map.getZoom();
				if (spinEnabled && !userInteracting && zoom < maxSpinZoom) {
					let distancePerSecond = 360 / secondsPerRevolution;
					if (zoom > slowSpinZoom) {
						// Slow spinning at higher zooms
						const zoomDif =
							(maxSpinZoom - zoom) / (maxSpinZoom - slowSpinZoom);
						distancePerSecond *= zoomDif;
					}
					const center = map.getCenter();
					center.lng -= distancePerSecond;
					// Smoothly animate the map over one second.
					// When this animation is complete, it calls a 'moveend' event.
					map.easeTo({ center, duration: 1000, easing: (n) => n });
				}
			}

			// Pause spinning on interaction
			map.on('mousedown', () => {
				userInteracting = true;
			});

			// Restart spinning the globe when interaction is complete
			map.on('mouseup', () => {
				userInteracting = false;
				spinGlobe();
			});

			// These events account for cases where the mouse has moved
			// off the map, so 'mouseup' will not be fired.
			map.on('dragend', () => {
				userInteracting = false;
				spinGlobe();
			});
			map.on('pitchend', () => {
				userInteracting = false;
				spinGlobe();
			});
			map.on('rotateend', () => {
				userInteracting = false;
				spinGlobe();
			});

			// When animation is complete, start spinning if there is no ongoing interaction
			map.on('moveend', () => {
				spinGlobe();
			});

			document.getElementById('btn-spin').addEventListener('click', (e) => {
				spinEnabled = !spinEnabled;
				if (spinEnabled) {
					spinGlobe();
					e.target.innerHTML = 'Pause rotation';
				} else {
					map.stop(); // Immediately end ongoing animation
					e.target.innerHTML = 'Start rotation';
				}
			});

			spinGlobe();
		</script>


	</div>
</div>