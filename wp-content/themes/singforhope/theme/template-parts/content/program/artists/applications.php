<div id="artist-selection-mode" class="flex-grow p-5 mt-6 bg-white border border-gray-200 rounded">

	<div class="">
		<div class="sm:flex sm:items-center">


			<div class="sm:flex-auto">
				<h1 class="text-base font-semibold leading-6 text-gray-900">Artist Applications</h1>
				<p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name,
					title, email
					and role.</p>
			</div>
			<div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
				<button type="button"
					class="block px-3 py-2 text-sm font-semibold text-center text-white rounded-md shadow-sm bg-harmony hover:bg-harmony focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-harmony"
					data-hs-overlay="#invite-artist-modal">Invite Artists</button>
			</div>

		</div>
		<!-- Status section -->
		<div class="flex-grow">
			<div>
				<h4 class="sr-only">Status</h4>
				<div class="mt-3" aria-hidden="true">
					<div class="overflow-hidden bg-gray-200 rounded-full">
						<!-- Progress bar -->
						<div class="h-2 rounded-full bg-harmony" style="width: 27.5%"></div>
					</div>
					<!-- Status steps -->
					<div class="hidden grid-cols-4 mt-3 text-xs font-medium text-gray-600 sm:grid">
						<div class="text-harmony">Invite Artists</div>
						<div class="text-center text-harmony">RFP Opens</div>
						<div class="text-center">RFP Closes</div>
						<div class="text-right">Artist Selected</div>
					</div>
				</div>
			</div>
		</div>
		<div class="grid grid-cols-1 mt-6 bg-gray-100 rounded sm:grid-cols-2 lg:grid-cols-4">
			<div class="px-4 py-6 border-t border-gray-200/5 sm:px-6 lg:px-8">
				<p class="text-sm font-medium leading-6 text-gray-800">Required Artists</p>
				<p class="flex items-baseline mt-2 gap-x-2">
					<span class="text-4xl font-semibold tracking-tight text-gray">
						<?php echo get_field( 'number_of_pianos' ); ?>
					</span>
				</p>
			</div>
			<div class="px-4 py-6 border-t border-gray-200/5 sm:px-6 lg:px-8 sm:border-l">
				<p class="text-sm font-medium leading-6 text-gray-800">Invited Artists</p>
				<p class="flex items-baseline mt-2 gap-x-2">
					<span class="text-4xl font-semibold tracking-tight text-gray">
						<?php
						if ( have_rows( 'invited_artists' ) ) {
							echo count( get_field( 'invited_artists' ) );
						} else {
							echo '0';
						}
						?>
					</span>
				</p>
			</div>
			<div class="px-4 py-6 border-t border-gray-200/5 sm:px-6 lg:px-8 lg:border-l">
				<p class="text-sm font-medium leading-6 text-gray-800">Submitted</p>
				<p class="flex items-baseline mt-2 gap-x-2">
					<span class="text-4xl font-semibold tracking-tight text-gray">
						<?php
						$args = array(
							'post_type' => 'application',
							'meta_query' => array(
								array(
									'key' => 'application_program', // name of custom field (Advanced Custom Fields)
									'value' => get_the_ID(), // matches exactly "123", not just 123. This prevents a match for "1238"
									'compare' => '='
								)
							)
						);
						$related = new WP_Query( $args );
						echo $related->found_posts;
						wp_reset_postdata();
						?>
					</span>
				</p>
			</div>

			<div class="px-4 py-6 border-t border-gray-200/5 sm:px-6 lg:px-8 sm:border-l">
				<p class="text-sm font-medium leading-6 text-gray-800">Days to Close</p>
				<p class="flex items-baseline mt-2 gap-x-2">
					<span class="text-4xl font-semibold tracking-tight text-gray">
						<?php
						$end_date = DateTime::createFromFormat( 'Ymd', get_field( 'program_dates' )['applications_end_date'] );
						$now = new DateTime();
						if ( $now > $end_date ) {
							echo "CLOSED";
						} else {
							$interval = $now->diff( $end_date );
							echo $interval->format( '%a' );
						}
						?>
					</span>
				</p>
			</div>
		</div>

		<div class="flow-root mt-3">
			<div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
				<div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
					<table class="min-w-full divide-y divide-gray-300">
						<thead>
							<tr>
								<th scope="col"
									class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
									Artist
									Name</th>
								<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
									Artwork Title</th>
								<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status
								</th>
								<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date
								</th>
								<th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
									<span class="sr-only">View</span>
								</th>
							</tr>
						</thead>


						<?php include( 'application.php' ); ?>
						</tbody>



					</table>
				</div>
			</div>
		</div>
	</div>

</div>

<? include( 'invite-artist.php' ); ?>