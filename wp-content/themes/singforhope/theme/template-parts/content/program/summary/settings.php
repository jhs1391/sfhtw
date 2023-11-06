<div class="flex border-b border-gray-100 pb-3 mb-6 justify-between">
	<h3 class="">Settings</h3>
	<div class="flex flex-shrink-0 self-center">
		<div class="relative inline-block text-left">
			<div>
				<button type="button" class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
					id="menu-settings-button" aria-expanded="false" aria-haspopup="true">
					<span class="sr-only">Open options</span>
					<svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
						<path
							d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
					</svg>
				</button>
			</div>


			<div id="settings-dropdown-menu"
				class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
				role="menu" aria-orientation="vertical" aria-labelledby="menu-settings-button" tabindex="-1">
				<div class="py-1" role="none">
					<a href="#" class="text-gray-700 flex px-4 py-2 text-sm" role="menuitem" tabindex="-1"
						id="menu-settings-item-0">
						<button type="button" class="" data-hs-overlay="#hs-overlay-right">
							Edit
						</button>
					</a>
					<a href="#" class="text-gray-700 flex px-4 py-2 text-sm" role="menuitem" tabindex="-1"
						id="menu-settings-item-1">

						<span>Embed</span>
					</a>
					<a href="#" class="text-gray-700 flex px-4 py-2 text-sm" role="menuitem" tabindex="-1"
						id="menu-settings-item-2">

						<span>Report content</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="hs-overlay-right"
	class="hs-overlay hs-overlay-open:translate-x-0 hidden translate-x-full fixed top-0 pt-32 right-0 transition-all duration-300 transform h-full max-w-lg w-full z-[40] bg-white border-r dark:bg-gray-800 dark:border-gray-700 [--body-scroll:true] [--overlay-backdrop:false] shadow-xl"
	tabindex="-1">

	<div class="flex justify-between items-center py-3 px-4 border-b dark:border-gray-700">
		<h3 class="font-bold text-gray-800 dark:text-white">
			Edit Program Settings
		</h3>
		<button type="button"
			class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white text-sm dark:text-gray-500 dark:hover:text-gray-400 dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800"
			data-hs-overlay="#hs-overlay-right">
			<span class="sr-only">Close modal</span>

		</button>
	</div>
	<div class="p-10">
		<p class="text-gray-800 dark:text-gray-400">

			<?php acfe_form( 'edit-piano-program-settings' ); ?>

		</p>
	</div>
</div>

<div class="overflow-x-auto -mx-1.5 flex-col">
	<div class="inline-block min-w-full align-middle px-1.5">
		<div class="overflow-hidden">
			<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
				<tbody class="divide-y divide-gray-200 dark:divide-gray-700">

					<!-- Program URL -->
					<tr>
						<td class="py-4 text-xs font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
							Program URL
						</td>
						<td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 whitespace-nowrap">
							<a id="copyLink" href="<?php echo get_permalink(); ?>"
								class="px-2 py-2 bg-gray-100 text-gray-800 rounded-sm">
								<?php
								$post_name = str_replace( ' ', '', get_post_field( 'post_name', get_post() ) );
								echo ( ! empty( $post_name ) ) ? "singforhope.org/pianos/" . $post_name : "No program url available";
								?>
							</a>
						</td>
					</tr>

					<!-- Launch Date -->
					<tr>
						<td class="py-4 text-xs font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
							Launch Date
						</td>
						<td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 whitespace-nowrap">
							<?php
							$launch_date = get_field( 'program_launch_date' );
							if ( ! empty( $launch_date ) ) {
								$date = DateTime::createFromFormat( 'Ymd', $launch_date );
								echo $date->format( 'F j, Y' );

								// Calculate the difference between the launch date and today's date
								$now = new DateTime();
								$interval = $date->diff( $now );
								echo '<span class="text-xs text-gray-400">in ' . $interval->days . ' days</span>';
							} else {
								echo "No launch date available";
							}
							?>
						</td>
					</tr>

					<!-- Number of Pianos -->
					<tr>
						<td class="py-4 text-xs font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap"
							style="vertical-align: top;">
							Number of Pianos
						</td>
						<td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 whitespace-nowrap">
							<?php
							$num_of_pianos = get_field( 'number_of_pianos' );
							if ( ! empty( $num_of_pianos ) ) {
								echo '<div style="display: grid; grid-template-columns: repeat(5, 1fr); grid-gap: 10px;">';
								echo '<span style="font-size: 20px; font-weight: bold; text-align: center; padding: 10px;" class="rounded bg-gray-100">' . $num_of_pianos . '</span>';
								for ( $i = 0; $i < $num_of_pianos; $i++ ) {
									echo '<img width="42px" src="https://us.123rf.com/450wm/asantosg/asantosg1805/asantosg180500007/101070667-vector-illustration-of-an-upright-piano-in-cartoon-style-isolated-on-white-background.jpg?ver=6">';
								}
								echo '</div>';
							} else {
								echo "No number of pianos available";
							}
							?>
						</td>
					</tr>

				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Global notification live region, render this permanently at the end of the document -->
<div aria-live="assertive"
	class="absolute top-5 left-5 z-50 w-[240px] pointer-events-none flex items-end px-4 py-6 sm:items-start sm:p-6">
	<div class="flex w-full flex-col items-center space-y-4 sm:items-end">
		<div id="notificationPanel"
			class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5 transform translate-y-2 opacity-0 sm:translate-x-2">
			<div class="p-4">
				<div class="flex items-start">
					<div class="flex-shrink-0">
						<svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
							stroke="currentColor" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
						</svg>
					</div>
					<div class="ml-3 w-0 flex-1 pt-0.5">
						<p class="text-sm font-medium text-gray-900">Link copied!</p>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<script>document.addEventListener('DOMContentLoaded', (event) => {
		const button = document.getElementById('menu-settings-button');
		const dropdownMenu = document.getElementById('settings-dropdown-menu');

		dropdownMenu.style.display = 'none';

		button.addEventListener('click', () => {
			if (dropdownMenu.style.display === 'none') {
				dropdownMenu.style.display = 'block';
				dropdownMenu.classList.remove('opacity-0', 'scale-95');
				dropdownMenu.classList.add('opacity-100', 'scale-100');
			} else {
				dropdownMenu.style.display = 'none';
				dropdownMenu.classList.remove('opacity-100', 'scale-100');
				dropdownMenu.classList.add('opacity-0', 'scale-95');
			}
		});
	});

	document.getElementById("copyLink").addEventListener("click", function (event) {
		event.preventDefault();
		var copyText = this.href;
		navigator.clipboard.writeText(copyText).then(function () {
			// Get the notification panel
			var notificationPanel = document.getElementById('notificationPanel');

			// Calculate the position of the copyLink div
			var copyLinkRect = event.target.getBoundingClientRect();

			// Position the notification panel relative to the copyLink div
			notificationPanel.style.top = (window.scrollY + copyLinkRect.bottom + 10) + 'px'; // 10px below
			notificationPanel.style.left = (window.scrollX + copyLinkRect.left) + 'px'; // Aligned to the left

			// Show the notification panel by adding the necessary classes
			notificationPanel.classList.remove('translate-y-2', 'opacity-0', 'sm:translate-x-2');
			notificationPanel.classList.add('transladte-y-0', 'opacity-100', 'sm:translate-x-0');

			// Hide the notification panel after 4 seconds
			setTimeout(function () {
				notificationPanel.classList.remove('translate-y-0', 'opacity-100', 'sm:translate-x-0');
				notificationPanel.classList.add('translate-y-2', 'opacity-0', 'sm:translate-x-2');
			}, 4000);
		}).catch(function (error) {
			alert('Error in copying link: ' + error);
		});
	});
</script>