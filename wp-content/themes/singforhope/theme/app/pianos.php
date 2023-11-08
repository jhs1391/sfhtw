<?php
function get_program_status( $dates, $today ) {
	if ( empty( $dates ) || ! isset( $dates['program_dates_applications_start_date'] ) || ! isset( $dates['program_dates_applications_end_date'] ) ) {
		return [ 'status' => 'Dates Not Available', 'color' => 'gray' ];
	}
	if ( $today >= DateTime::createFromFormat( 'Ymd', $dates['program_dates_application_start_date'] ) && $today <= DateTime::createFromFormat( 'Ymd', $dates['program_dates_application_end_date'] ) ) {
		return [ 'status' => 'Open Applications', 'color' => 'yellow' ];
	} elseif ( $today >= DateTime::createFromFormat( 'Ymd', $dates['program_dates_adjudication_start_date'] ) && $today <= DateTime::createFromFormat( 'Ymd', $dates['program_dates_adjudication_end_date'] ) ) {
		return [ 'status' => 'Under Adjudication', 'color' => 'orange' ];
	} elseif ( $today >= DateTime::createFromFormat( 'Ymd', $dates['program_dates_painting_start_date'] ) && $today <= DateTime::createFromFormat( 'Ymd', $dates['program_dates_painting_end_date'] ) ) {
		return [ 'status' => 'In Painting', 'color' => 'blue' ];
	} elseif ( $today >= DateTime::createFromFormat( 'Ymd', $dates['program_dates_public_start_date'] ) && $today <= DateTime::createFromFormat( 'Ymd', $dates['program_dates_public_end_date'] ) ) {
		return [ 'status' => 'Public', 'color' => 'green' ];
	} else {
		return [ 'status' => 'Unknown Status', 'color' => 'gray' ];
	}
}
?>

<!-- Table Section -->
<div class="px-4 py-10 mx-auto sm:px-6 lg:px-8 lg:py-14">

	<!-- Card -->
	<div class="flex flex-col ">
		<div class="-m-1.5 overflow-x-auto">
			<div class="p-1.5 min-w-full inline-block align-middle">
				<div
					class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-700">

					<!-- Header -->
					<div
						class="grid gap-3 px-6 py-4 border-b border-gray-200 md:flex md:justify-between md:items-center dark:border-gray-700">
						<div>
							<h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
								Programs
							</h2>
							<p class="text-sm text-gray-600 dark:text-gray-400">
								Add users, edit and more.
							</p>
						</div>

						<div>
							<div class="inline-flex gap-x-2">
								<a class="inline-flex items-center justify-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 align-middle transition-all bg-white border rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800"
									href="#">
									View archive
								</a>

								<a class="inline-flex items-center justify-center gap-2 px-3 py-2 text-sm font-semibold text-white transition-all border border-transparent rounded-md bg-harmony hover:bg-harmony focus:outline-none focus:ring-2 focus:ring-harmony focus:ring-offset-2 dark:focus:ring-offset-gray-800"
									href="#">
									<svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
										viewBox="0 0 16 16" fill="none">
										<path d="M2.63452 7.50001L13.6345 7.5M8.13452 13V2" stroke="currentColor"
											stroke-width="2" stroke-linecap="round" />
									</svg>
									Create program
								</a>
							</div>
						</div>
					</div>

					<!-- Table -->
					<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
						<thead class="bg-gray-50 dark:bg-slate-800">
							<tr>
								<th scope="col" class="py-3 pl-6 text-left">

								</th>
								<th scope="col" class="py-3 pl-12 pr-6 text-left lg:pl-12 xl:pl-12">
									<div class="flex items-center gap-x-2">
										<span
											class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-gray-200">
											Program
										</span>
									</div>
								</th>

								<th scope="col" class="px-6 py-3 text-left">
									<div class="flex items-center gap-x-2">
										<span
											class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-gray-200">
											Partners
										</span>
									</div>
								</th>

								<th scope="col" class="px-6 py-3 text-left">
									<div class="flex items-center gap-x-2">
										<span
											class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-gray-200">
											Status
										</span>
									</div>
								</th>

								<th scope="col" class="px-6 py-3 text-left">
									<div class="flex items-center gap-x-2">
										<span
											class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-gray-200">
											Timeline
										</span>
									</div>
								</th>

								<th scope="col" class="px-6 py-3 text-left">
									<div class="flex items-center gap-x-2">
										<span
											class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-gray-200">
											Next Milestone
										</span>
									</div>
								</th>

								<th scope="col" class="px-6 py-3 text-right"></th>
							</tr>
						</thead>

						<tbody class="divide-y divide-gray-200 dark:divide-gray-700">
							<?php
							$programs = get_posts( array(
								'post_type' => 'program',
								'post_status' => 'publish',
								'numberposts' => -1
							) );

							$current_date = new DateTime();

							foreach ( $programs as $program ) {
								$partners = get_field( 'program_partners', $program->ID );
								$location = get_field( 'program_location', $program->ID );
								$location = $location ? $location : "No Location";

								// Get the launch date
								$launch_date_field = get_field( 'launch_date', $program->ID );

								if ( $launch_date_field ) {
									$launch_date = new DateTime( $launch_date_field );

									// Calculate the difference in days
									$interval = $current_date->diff( $launch_date );
									$days_left = $interval->format( '%a' );
								} else {
									$days_left = "N/A";
								}

								// Get the program dates
								$program_dates = get_field( 'program_dates', $program->ID );
								$program_dates = $program_dates ? $program_dates : array();

								// Determine program status
							

								$program_status = get_program_status( $program_dates, $current_date );

								?>
								<tr>
									<td class="w-px h-px whitespace-nowrap"></td>
									<td class="h-px w-72 whitespace-nowrap">
										<div class="px-6 py-3">
											<span class="block font-semibold text-gray-800 text-md dark:text-gray-200">
												<?php echo get_the_title( $program->ID ); ?>
											</span>
											<span class="block text-sm text-gray-500">
												<?php echo $location; ?>
											</span></span>
										</div>
									</td>
									<td class="w-px h-px whitespace-nowrap">
										<div class="py-3 pl-6 pr-6 lg:pl-3 xl:pl-0">
											<div class="flex items-center gap-x-3">
												<?php
												if ( ! empty( $partners ) ) {
													foreach ( $partners as $partner ) { ?>
														<a class="relative z-10 block" href="#">
															<div class="flex px-6 py-2 -space-x-2">
																<div class="inline-flex hs-tooltip">
																	<img class="hs-tooltip-toggle inline-block h-[2.375rem] w-[2.375rem]  rounded-full ring-2 ring-white dark:ring-gray-800"
																		src="<?php echo get_avatar_url( $partner['ID'] ); ?>"
																		alt="Image Description">
																	<span
																		class="absolute z-10 invisible block px-2 py-1 text-xs font-medium text-white transition-opacity bg-gray-900 rounded-md shadow-sm opacity-0 hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible dark:bg-slate-700"
																		role="tooltip">
																		<?php echo $partner['display_name']; ?>
																	</span>
																</div>
															</div>
														</a>
													<?php }
												} else {
													echo "<p>No partners</p>";
												}
												?>
											</div>

										</div>
									</td>

									<td class="w-px h-px whitespace-nowrap">
										<div class="px-6 py-3">
											<span
												class="inline-flex items-center gap-1.5 py-0.5 px-2 rounded-full text-xs font-medium bg-<?php echo $program_status['color']; ?>-100 text-<?php echo $program_status['color']; ?>-800 dark:bg-<?php echo $program_status['color']; ?>-900 dark:text-<?php echo $program_status['color']; ?>-200">
												<?php echo $program_status['status']; ?>
											</span>
										</div>
									</td>

									<td class="w-px h-px whitespace-nowrap">
										<div class="px-6 py-3">
											<div class="flex items-center gap-x-3">
												<span class="text-xs text-gray-500">
													<?php echo $days_left; ?> days left
												</span>
												<div
													class="flex w-full h-1.5 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
													<div class="flex flex-col justify-center overflow-hidden bg-gray-800 dark:bg-gray-200"
														role="progressbar" style="width: 25%" aria-valuenow="25"
														aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									</td>
									<td class="w-px h-px whitespace-nowrap">
										<div class="px-6 py-3">
											<span class="text-xs text-gray-500">
												<?php echo $days_left; ?> days left
											</span>
										</div>
									</td>
									<td class="w-px h-px whitespace-nowrap">
										<div class="px-6 py-1.5">
											<a data-hs-overlay="#hs-overlay-body-scrolling"
												class="inline-flex items-center gap-x-1.5 text-sm text-blue-600 decoration-2 hover:underline font-medium">
												View
											</a>
										</div>
									</td>
								</tr>

							<?php } ?>


						</tbody>
					</table>
					<!-- End Table -->

				</div>
			</div>
		</div>
	</div>
	<!-- End Card -->
</div>
<!-- End Table Section -->