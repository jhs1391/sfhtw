<div
	class="relative overflow-hidden transition-all duration-500 ease-in-out before:absolute before:top-0 before:left-1/2 before:bg-[url('https://i.imgur.com/CAMdIZZ.jpg')] before:bg-no-repeat before:bg-top before:bg-cover before:w-full before:h-full before:-z-[1] before:transform before:-translate-x-1/2 dark:before:bg-[url('https://i.imgur.com/CAMdIZZ.jpg')] bg-white bg-opacity-95 rounded-xl shadow">

	<div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-10">
		<div class="absolute top-0 right-0">
			<?php include( 'wp-content/themes/singforhope/theme/components/countdown.php' ); ?>
		</div>

		<!-- Announcement Banner -->
		<div class="flex justify-center">
			<a class="inline-flex items-center gap-x-2 bg-white border border-gray-200 text-md text-gray-600 px-3 rounded-full transition hover:border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:hover:border-gray-600 dark:text-gray-400"
				href="javascript:void(0)"> <!-- Changed href here -->
				New to Sing for Hope?
				<span class="flex items-center gap-x-1">
					<span class="border-l border-gray-200 text-melody pl-2 dark:text-blue-500" id="learnMoreBtn"
						onclick="toggleLearnMore(event)">Learn How it Works</span>
					<svg class="w-2.5 h-2.5 text-melody" width="16" height="16" viewBox="0 0 16 16" fill="none">
						<path d="M5.27921 2L10.9257 7.64645C11.1209 7.84171 11.1209 8.15829 10.9257 8.35355L5.27921 14"
							stroke="currentColor" stroke-width="2" stroke-linecap="round" />
					</svg>
				</span>
			</a>
		</div>
		<!-- End Announcement Banner -->

		<!-- Title -->
		<div class="mt-1 p-3 text-center mx-auto">
			<h1
				class="block font-bold text-gray-900 text-4xl md:text-5xl lg:text-6xl dark:text-gray-200 text-shadow shadow-white">
				Applications are Open
			</h1>
		</div>
		<!-- End Title -->

		<div class="mt-0 max-w-3xl text-center mx-auto">
			<p class="text-lg text-gray-900 dark:text-gray-400">Join the thousands of artists that have taken part of
				the Sing for Hope Pianos program.</p>
		</div>

		<!-- Buttons -->
		<div class="mt-8 grid gap-3 w-full sm:inline-flex sm:justify-center">
			<a class="inline-flex justify-center items-center gap-x-3 text-center bg-gradient-to-tl from-white to-gray-200 hover:from-gray-200 hover:to-white border border-transparent text-gray-800 text-sm font-medium rounded-full focus:outline-none focus:ring-2 focus:ring-harmony focus:ring-offset-2 focus:ring-offset-white py-3 px-4 dark:focus:ring-offset-gray-800"
				href="#">
				Download Template
			</a>
			<a class="inline-flex justify-center items-center gap-x-3 text-center bg-gradient-to-tl from-harmony to-harmony hover:from-harmony hover:to-harmony border border-transparent text-white text-sm font-medium rounded-full focus:outline-none focus:ring-2 focus:ring-harmony focus:ring-offset-2 focus:ring-offset-white py-3 px-4 dark:focus:ring-offset-gray-800"
				id="startApplication" onclick="toggleStartApplication(event)" href="#">
				Start Application
			</a>
		</div>
		<!-- End Buttons -->

		<div id="learn-more" class="mt-8 w-full hidden transition-all duration-500 ease-in-out"
			style="max-height: 0; overflow: hidden;">
			<?php include( 'application/learnmore.php' ); ?>
		</div>


		<div id="step1" class="px-4 py-6 sm:px-6 lg:px-8 lg:py-6 mx-auto hidden">
			<div class="relative">
				<!-- Card -->
				<div class="flex flex-col border bg-white rounded-xl p-4 sm:p-6 lg:p-10 dark:border-gray-700">
					<h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
						Sign up to apply
					</h2>

					<div class="mt-6 grid gap-4 lg:gap-6">
						<!-- Grid -->
						<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
							<div>
								<label for="hs-firstname-hire-us-1"
									class="block text-sm text-gray-700 font-medium dark:text-white">First
									Name</label>
								<input type="text" name="hs-firstname-hire-us-1" id="hs-firstname-hire-us-1"
									class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-harmony focus:ring-harmony dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
							</div>

							<div>
								<label for="hs-lastname-hire-us-1"
									class="block text-sm text-gray-700 font-medium dark:text-white">Last
									Name</label>
								<input type="text" name="hs-lastname-hire-us-1" id="hs-lastname-hire-us-1"
									class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-harmony focus:ring-harmony dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
							</div>
						</div>
						<!-- End Grid -->

						<div>
							<label for="hs-work-email-hire-us-1"
								class="block text-sm text-gray-700 font-medium dark:text-white">Email</label>
							<input type="email" name="hs-work-email-hire-us-1" id="hs-work-email-hire-us-1"
								autocomplete="email"
								class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-harmony focus:ring-harmony dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
						</div>

						<!-- Grid -->
						<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
							<div>
								<label for="hs-company-hire-us-1"
									class="block text-sm text-gray-700 font-medium dark:text-white">Artist
									Name</label>
								<input type="text" name="hs-company-hire-us-1" id="hs-company-hire-us-1"
									class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-harmony focus:ring-harmony dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
							</div>

							<div>
								<label for="hs-company-website-hire-us-1"
									class="block text-sm text-gray-700 font-medium dark:text-white">Organization
								</label>
								<input type="text" name="hs-company-website-hire-us-1" id="hs-company-website-hire-us-1"
									class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-harmony focus:ring-harmony dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
							</div>
						</div>
						<!-- End Grid -->


					</div>
					<!-- End Grid -->

					<!-- Checkbox -->
					<div class="mt-3 flex">
						<div class="flex">
							<input id="remember-me" name="remember-me" type="checkbox"
								class="shrink-0 mt-1.5 border-gray-200 rounded text-harmony pointer-events-none focus:ring-harmony dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-harmony dark:checked:border-harmony dark:focus:ring-offset-gray-800">
						</div>
						<div class="ml-3">
							<label for="remember-me" class="text-xs text-gray-600 dark:text-gray-400">By
								submitting this
								form I have read and acknowledged the <a
									class="text-harmony decoration-2 hover:underline font-medium" href="#">Privact
									policy</a></label>
						</div>
					</div>
					<!-- End Checkbox -->




					<div>
						<button id="registerButton" type="submit"
							class="inline-flex justify-center items-center gap-x-3 text-center bg-harmony hover:bg-harmony border border-transparent text-sm lg:text-base text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-harmony focus:ring-offset-2 focus:ring-offset-white transition py-3 px-4 dark:focus:ring-offset-gray-800"
							onclick="registerUser()">
							Sign up and continue</button>
					</div>



					<div class="mt-3 text-center">
						<p class="text-sm text-gray-500">
							Next, you'll upload your design.
						</p>
					</div>
				</div>

				<!-- End Card -->
			</div>

		</div>

		<div id="step2" class="px-4 py-6 sm:px-6 lg:px-8 lg:py-6 mx-auto hidden">
			<?php include( 'application/step2.php' ); ?>
		</div>

	</div>
</div>
</div>
<!-- End Hero -->

<script>
	function toggleLearnMore(event) {
		event.preventDefault();

		const learnMoreSection = document.getElementById('learn-more');

		if (learnMoreSection.classList.contains('hidden')) {
			learnMoreSection.style.maxHeight = 'none';
			learnMoreSection.classList.remove('hidden');
			learnMoreSection.classList.add('block');
			window.scrollBy({ top: 240, left: 0, behavior: 'smooth' });
		} else {
			learnMoreSection.style.maxHeight = '0';
			learnMoreSection.classList.add('hidden');
			learnMoreSection.classList.remove('block');
		}
	}

	function toggleStartApplication(event) {
		event.preventDefault();

		const startApplicationSection = document.getElementById('step1');

		if (startApplicationSection.classList.contains('hidden')) {
			startApplicationSection.style.maxHeight = 'none';
			startApplicationSection.classList.remove('hidden');
			startApplicationSection.classList.add('block');
			window.scrollBy({ top: 240, left: 0, behavior: 'smooth' });
		} else {
			startApplicationSection.style.maxHeight = '0';
			startApplicationSection.classList.add('hidden');
			startApplicationSection.classList.remove('block');
		}
	}


	<?php if ( is_user_logged_in() ) : ?>
		document.getElementById('step1').style.display = 'none';
		document.getElementById('step2').style.display = 'block';
	<?php endif; ?>

	function registerUser() {
		var firstName = document.getElementById('hs-firstname-hire-us-1').value;
		var lastName = document.getElementById('hs-lastname-hire-us-1').value;
		var email = document.getElementById('hs-work-email-hire-us-1').value;

		jQuery.ajax({
			url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
			type: 'POST',
			data: {
				action: 'register_user',
				hs_firstname_hire_us_1: firstName,
				hs_lastname_hire_us_1: lastName,
				hs_work_email_hire_us_1: email
			},
			success: function (data) {
				location.reload();
			},
			error: function (errorThrown) {
				console.log(errorThrown);
			}
		});
	}



</script>