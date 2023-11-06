<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div id="invite-artist-modal"
	class="hs-overlay hidden w-full h-full fixed top-0 left-0 z-[60] overflow-x-hidden overflow-y-auto">
	<div
		class="m-3 mt-0 transition-all ease-out opacity-0 hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 sm:max-w-5xl sm:w-full sm:mx-auto">
		<div class="flex flex-row p-3 bg-white border border-gray-200 rounded">
			<div class="flex w-1/2">
				<div class="p-5 ">

					<div class="max-w-lg mx-auto">
						<div>
							<div class="text-center">
								<svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor"
									viewBox="0 0 48 48" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M34 40h10v-4a6 6 0 00-10.712-3.714M34 40H14m20 0v-4a9.971 9.971 0 00-.712-3.714M14 40H4v-4a6 6 0 0110.713-3.714M14 40v-4c0-1.313.253-2.566.713-3.714m0 0A10.003 10.003 0 0124 26c4.21 0 7.813 2.602 9.288 6.286M30 14a6 6 0 11-12 0 6 6 0 0112 0zm12 6a4 4 0 11-8 0 4 4 0 018 0zm-28 0a4 4 0 11-8 0 4 4 0 018 0z" />
								</svg>
								<h2 class="mt-2 text-base font-semibold leading-6 text-gray-900">Invite Artists to Apply
								</h2>
								<p class="mt-1 text-sm text-gray-500">You haven’t added any team members to your project
									yet. As
									the owner
									of this project, you can manage team member permissions.</p>
							</div>
							<form id="invite-form" action="#" method="post" class="flex mt-6 space-x-2">
								<label for="name" class="sr-only">Name</label>
								<input type="text" name="name" id="name"
									class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-harmony sm:text-sm sm:leading-6"
									placeholder="Enter a name">
								<label for="email" class="pl-3 sr-only">Email address</label>
								<input type="email" name="email" id="email"
									class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-harmony sm:text-sm sm:leading-6"
									placeholder="Enter an email">
								<button type="submit"
									class="flex-shrink-0 px-3 py-2 ml-4 text-sm font-semibold text-white rounded-md shadow-sm bg-harmony hover:bg-harmony focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-harmony">Send
									invite</button>

								<?php
								// Check if there's a POST request and if the email is already used
								if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset( $email_already_used ) && $email_already_used ) {
									echo '<p class="error">This email address is already used.</p>';
								}
								?>
							</form>




						</div>
						<h3 class="mt-10 text-sm font-medium text-gray-500">Artists invited to this program</h3>
						<div class="overflow-y-scroll min-h-[400px]">
							<ul id="artists-list" role="list"
								class="mt-4 border-t border-b border-gray-200 divide-y divide-gray-200">
								<?php
								if ( have_rows( 'invited_artists' ) ) :
									$i = 0;
									while ( have_rows( 'invited_artists' ) ) :
										the_row();
										$name = get_sub_field( 'invited_artist_name' );
										$email = get_sub_field( 'invited_artist_email' );
										echo '<li class="flex items-center justify-between py-4 space-x-3">';
										echo '<div class="flex items-center flex-1 min-w-0 space-x-3">';
										echo '<div class="flex-1 min-w-0">';
										echo '<p class="text-sm font-medium text-gray-900 truncate">' . $name . '</p>';
										echo '<p class="text-sm font-medium text-gray-500 truncate">' . $email . '</p>';

										// Get the current post ID
										$current_post_id = get_the_ID();

										// Get the user by email
										$user = get_user_by( 'email', $email );

										// Check if user exists and 'email_log' repeater field has any rows
										if ( $user && have_rows( 'email_log', 'user_' . $user->ID ) ) {
											// Loop through the rows
											while ( have_rows( 'email_log', 'user_' . $user->ID ) ) {
												the_row();
												// Check if 'email-key' subfield value matches 'artist-invite'
												// and 'post_id' subfield value matches the current post id
												if ( get_sub_field( 'email-key' ) == 'artist-invite' && get_sub_field( 'post_id' ) == $current_post_id ) {
													// Display the 'email_log' value
													echo '<p class="text-sm font-medium text-gray-500 truncate">' . get_sub_field( 'email_log' ) . '</p>';
												}
											}
										}

										echo '</div></div>';
										echo '<a href="?delete=' . ( $i + 1 ) . '" class="text-red-500 hover:text-red-700">Remove</a>';

										echo '</li>';
										$i++;
									endwhile;
								endif;
								?>
							</ul>
						</div>




					</div>

				</div>
			</div>
			<div class="flex w-1/2 p-12">
				<ul role="list" class="space-y-6">
					<li class="relative flex gap-x-4">
						<div class="absolute top-0 left-0 flex justify-center w-6 -bottom-6">
							<div class="w-px bg-gray-200"></div>
						</div>
						<div class="relative flex items-center justify-center flex-none w-6 h-6 bg-white">
							<div class="h-1.5 w-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300"></div>
						</div>
						<p class="flex-auto py-0.5 text-xs leading-5 text-gray-500"><span
								class="font-medium text-gray-900">First Invite</span> created the invoice.</p>
						<time datetime="2023-01-23T10:32" class="flex-none py-0.5 text-xs leading-5 text-gray-500">7d
							ago</time>
					</li>
					<li class="relative flex gap-x-4">
						<div class="absolute top-0 left-0 flex justify-center w-6 -bottom-6">
							<div class="w-px bg-gray-200"></div>
						</div>
						<div class="relative flex items-center justify-center flex-none w-6 h-6 bg-white">
							<div class="h-1.5 w-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300"></div>
						</div>
						<p class="flex-auto py-0.5 text-xs leading-5 text-gray-500"><span
								class="font-medium text-gray-900">First Reminder</span> edited the invoice.</p>
						<time datetime="2023-01-23T11:03" class="flex-none py-0.5 text-xs leading-5 text-gray-500">6d
							ago</time>
					</li>
					<li class="relative flex gap-x-4">
						<div class="absolute top-0 left-0 flex justify-center w-6 -bottom-6">
							<div class="w-px bg-gray-200"></div>
						</div>
						<div class="relative flex items-center justify-center flex-none w-6 h-6 bg-white">
							<div class="h-1.5 w-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300"></div>
						</div>
						<p class="flex-auto py-0.5 text-xs leading-5 text-gray-500"><span
								class="font-medium text-gray-900">Last Reminder</span> sent the invoice.</p>
						<time datetime="2023-01-23T11:24" class="flex-none py-0.5 text-xs leading-5 text-gray-500">6d
							ago</time>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$("#invite-form").on('submit', function (e) {
			e.preventDefault();

			$.ajax({
				type: 'POST',
				url: 'form-handler.php', // replace with the path to your PHP file that handles the form submission
				data: $(this).serialize(),
				success: function (response) {
					var artist = JSON.parse(response);

					var newRow = '<li class="flex items-center justify-between py-4 space-x-3">' +
						'<div class="flex items-center flex-1 min-w-0 space-x-3">' +
						'<div class="flex-1 min-w-0">' +
						'<p class="text-sm font-medium text-gray-900 truncate">' + artist.name + '</p>' +
						'<p class="text-sm font-medium text-gray-500 truncate">' + artist.email + '</p>' +
						'</div></div>' +
						'<a href="?delete=' + artist.id + '" class="text-red-500 hover:text-red-700">Remove</a>' +
						'</li>';

					$('#artists-list').prepend(newRow);
				},
				error: function () {
					alert('There was an error. Please try again.');
				}
			});
		});
	});

	$(document).ready(function () {
		$("#artists-list").on('click', 'a', function (e) {
			e.preventDefault();

			var row = $(this).closest('li');
			var id = $(this).attr('href').split('=')[1];

			$.ajax({
				type: 'GET',
				url: 'delete-handler.php', // replace with the path to your PHP file that handles the deletion
				data: { 'delete': id },
				success: function () {
					row.fadeOut(300, function () { $(this).remove(); });
				},
				error: function () {
					alert('There was an error. Please try again.');
				}
			});
		});
	});

</script>