<?php


?>
<div class="grid md:grid-cols-2 gap-12 items-start">
	<div>
		<h1 class="text-2xl sm:text-3xl lg:text-4xl lg:leading-tight font-bold dark:text-white text-gray-800">Here are
			the rules</h1>
		<p class="mt-1 md:text-lg dark:text-gray-200 text-gray-800">Your artisit creativity has no limits... well,
			amost.</p>


	</div>
	<!-- End Col -->

	<?php
	$current_user_id = get_current_user_id();
	$current_post_id = get_the_ID();
	$args = array(
		'post_type' => 'application',
		'posts_per_page' => 1,
		'author' => $current_user_id,
		'meta_query' => array(
			array(
				'key' => 'application_program', // name of custom field
				'value' => $current_post_id, // matches exactly "123", not just 123. This prevents a match for "1234"
				'compare' => '='
			)
		)
	);
	$query = new WP_Query( $args );

	$user_has_entry = false;
	$post_id = '';

	if ( $query->have_posts() ) {
		$user_has_entry = true;
		while ( $query->have_posts() ) {
			$query->the_post();
			$post_id = get_the_ID(); // Get the ID of the post.
			$last_application_title = get_the_title();
			$last_application_description = get_field( 'artwork_description' );
		}
	}
	wp_reset_postdata();

	// Get the URLs of the images
	$front_image_url = '';
	$back_image_url = '';
	$sides_image_url = '';
	if ( $user_has_entry ) {
		$front_image = get_field( 'artwork_front', $post_id );
		$back_image = get_field( 'artwork_back', $post_id );
		$sides_image = get_field( 'artwork_sides', $post_id );

		if ( $front_image ) {
			$front_image_url = $front_image['url'];
		}

		if ( $back_image ) {
			$back_image_url = $back_image['url'];
		}

		if ( $sides_image ) {
			$sides_image_url = $sides_image['url'];
		}
	}

	?>



	<div class="relative">
		<!-- Card -->
		<div class="bg-white flex flex-col border rounded-xl p-4 sm:p-6 lg:p-10 dark:border-gray-700">
			<h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
				Submit your design
			</h2>

			<form method="post" enctype="multipart/form-data">
				<?php wp_nonce_field( 'form_nonce_action', 'form_nonce_field' ); ?>
				<input type="hidden" name="application_form" value="1">
				<input type="hidden" name="application_program" value="<?php echo get_the_ID(); ?>">
				<div class="">
					<!-- Grid -->
					<div class="space-y-4 sm:space-y-6">


						<div class="space-y-2">
							<label for="af-submit-app-project-name"
								class="inline-block text-sm font-medium text-gray-800 mt-2.5 dark:text-gray-200">
								Artwork Title
							</label>

							<input id="af-submit-app-project-name" type="text"
								class="py-2 px-3 pr-11 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-harmony focus:ring-harmony dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400"
								placeholder="Enter your artwork title" name="af-submit-app-project-name"
								value="<?php echo isset( $last_application_title ) ? esc_attr( $last_application_title ) : ''; ?>">

						</div>




						<div class="space-y-2">
							<label for="af-submit-app-upload-images"
								class="inline-block text-sm font-medium text-gray-800 mt-2.5 dark:text-gray-200">
								Upload Design Files
							</label>
							<div class="flex space-x-2">
								<div class="w-1/3">
									<label for="af-submit-app-upload-images-front"
										class="group block cursor-pointer text-center border-2 border-dashed border-gray-200 rounded-lg dark:border-gray-700">
										<input id="af-submit-app-upload-images-front"
											name="af-submit-app-upload-images-front" type="file"
											accept=".jpg,.jpeg,.png,.pdf" class="sr-only"
											onchange="previewImage(event, 'front-preview')">
										<img id="front-preview" src="<?php echo esc_url( $front_image_url ); ?>" alt=""
											class="w-full h-auto min-h-[120px]">
										<span class="mt-2 block text-sm text-gray-800 dark:text-gray-200">
											Front
										</span>
										<span id="front-preview-error" class="mt-2 block text-sm text-red-600"></span>
									</label>
								</div>
								<div class="w-1/3">
									<label for="af-submit-app-upload-images-back"
										class="group block cursor-pointer text-center border-2 border-dashed border-gray-200 rounded-lg dark:border-gray-700">
										<input id="af-submit-app-upload-images-back"
											name="af-submit-app-upload-images-back" type="file"
											accept=".jpg,.jpeg,.png,.pdf" class="sr-only"
											onchange="previewImage(event, 'back-preview')">
										<img id="back-preview" src="<?php echo esc_url( $back_image_url ); ?>" alt=""
											class="w-full h-auto min-h-[120px]">
										<span class="mt-2 block text-sm text-gray-800 dark:text-gray-200">
											Back
										</span>
										<span id="back-preview-error" class="mt-2 block text-sm text-red-600"></span>

									</label>
								</div>
								<div class="w-1/3">
									<label for="af-submit-app-upload-images-sides"
										class="group block cursor-pointer text-center border-2 border-dashed border-gray-200 rounded-lg dark:border-gray-700">
										<input id="af-submit-app-upload-images-sides"
											name="af-submit-app-upload-images-sides" type="file"
											accept=".jpg,.jpeg,.png,.pdf" class="sr-only"
											onchange="previewImage(event, 'sides-preview')">
										<img id="sides-preview" src="<?php echo esc_url( $sides_image_url ); ?>" alt=""
											class="w-full h-auto min-h-[120px]">
										<span class="mt-2 block text-sm text-gray-800 dark:text-gray-200">
											Sides
										</span>
										<span id="sides-preview-error" class="mt-2 block text-sm text-red-600"></span>

									</label>
								</div>
							</div>


						</div>

						<div class="space-y-2">
							<label for="af-submit-app-description"
								class="inline-block text-sm font-medium text-gray-800 mt-2.5 dark:text-gray-200">
								Design statement
							</label>

							<textarea id="af-submit-app-description"
								class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-harmony focus:ring-harmony dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400"
								rows="6" name="af-submit-app-description"
								placeholder="A detailed summary will better explain your products to the audiences. Our users will see this in your dedicated product page."><?php echo isset( $last_application_description ) ? esc_textarea( $last_application_description ) : ''; ?></textarea>


						</div>
					</div>
					<!-- End Grid -->


				</div>
				<div class="mt-6 grid">
					<button type="submit"
						class="inline-flex justify-center items-center gap-x-3 text-center bg-harmony hover:bg-harmony border border-transparent text-sm lg:text-base text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-harmony focus:ring-offset-2 focus:ring-offset-white transition py-3 px-4 dark:focus:ring-offset-gray-800">
						<?php echo $user_has_entry ? 'Update your application' : 'Submit your design'; ?>
					</button>

				</div>
				<div class="progress" style="display: none;">
					<div class="progress-bar" role="progressbar" style="width: 0%;" id="uploadProgressBar"></div>
				</div>

			</form>


		</div>
		<!-- End Card -->
	</div>
	<!-- End Col -->
</div>

<script src="https://unpkg.com/jsqr"></script>

<script>
	function previewImage(event, previewId) {
		let reader = new FileReader();
		reader.onload = function () {
			let output = document.getElementById(previewId);
			output.src = reader.result;

			let canvas = document.createElement('canvas');
			let context = canvas.getContext('2d');
			let img = new Image();
			img.onload = function () {
				canvas.width = img.width;
				canvas.height = img.height;
				context.drawImage(img, 0, 0, img.width, img.height);
				let imageData = context.getImageData(0, 0, canvas.width, canvas.height);
				let code = jsQR(imageData.data, imageData.width, imageData.height);
				if (code && code.data === 'sfh') {
					output.style.border = '2px solid green';
				} else {
					output.style.border = '2px dashed red';
					document.getElementById(previewId + '-error').textContent = "Try again";
				}
			};
			img.src = reader.result;
		};
		reader.readAsDataURL(event.target.files[0]);
	}

	document.querySelector('form').addEventListener('submit', function (event) {
		event.preventDefault();

		// Show the progress bar
		document.querySelector('.progress').style.display = 'block';

		var form = event.target;
		var formData = new FormData(form);

		fetch(form.action, {
			method: 'POST',
			body: formData
		}).then(response => {
			if (!response.ok) {
				throw new Error('Network response was not ok');
			}
			return response.blob();
		}).then(data => {
			// Handle the success of the file upload here
		}).catch(error => {
			console.error('There has been a problem with your fetch operation:', error);
		});
	});


	fetch(form.action, {
		method: 'POST',
		body: formData
	}).then(response => {
		if (!response.ok) {
			throw new Error('Network response was not ok');
		}
		return response.blob();
	}).then(data => {
		// Handle the success of the file upload here
	}).catch(error => {
		console.error('There has been a problem with your fetch operation:', error);
	});

	var request = new XMLHttpRequest();
	request.upload.addEventListener('progress', function (event) {
		if (event.lengthComputable) {
			var percentComplete = event.loaded / event.total;
			percentComplete = parseInt(percentComplete * 100);

			// Update the progress bar
			document.getElementById('uploadProgressBar').style.width = percentComplete + '%';
		}
	});

	request.open('POST', form.action);
	request.send(formData);

</script>