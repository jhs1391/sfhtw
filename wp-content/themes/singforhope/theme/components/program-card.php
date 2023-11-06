<div
	class="group flex flex-col h-full bg-white border border-gray-200 shadow-sm overflow-hidden rounded-xl dark:bg-slate-900 dark:border-gray-700 dark:shadow-slate-700/[.7] transition-all duration-300">
	<div class="h-52 flex flex-col justify-center items-center bg-gray-200 rounded-xl relative gradient-overlay">
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="w-full h-full rounded-xl"
				style="background-image: url('<?php the_post_thumbnail_url(); ?>'); background-size: cover; background-position: center center;">
			</div>
		<?php } else { ?>
			<!-- Default Image or SVG -->
		<?php } ?>

		<?php
		$start_date = get_field( 'program_dates_applications_start_date' );
		$end_date = get_field( 'program_dates_applications_end_date' );
		if ( $start_date <= current_time( 'Ymd' ) && $end_date >= current_time( 'Ymd' ) ) { ?>
			<span
				class="absolute top-1 right-1 inline-flex items-center gap-x-1.5 rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-600 z-50">
				<svg class="h-1.5 w-1.5 fill-gray-400" viewBox="0 0 6 6" aria-hidden="true">
					<circle cx="3" cy="3" r="3" />
				</svg>
				Open Applications
			</span>
		<?php } ?>
		<?php
		$public_start_date = get_field( 'program_dates_public_start_date' );
		$public_end_date = get_field( 'program_dates_public_end_date' );
		if ( $public_start_date <= current_time( 'Ymd' ) && $public_end_date >= current_time( 'Ymd' ) ) { ?>
			<span
				class="absolute top-1 right-1 inline-flex items-center gap-x-1.5 rounded-md bg-harmonylight px-2 py-1 text-xs font-medium text-harmony z-50">
				<svg class="h-1.5 w-1.5 fill-gray-400" viewBox="0 0 6 6" aria-hidden="true">
					<circle cx="3" cy="3" r="3" />
				</svg>
				Open Publicly!
			</span>
		<?php } ?>
		<div class="absolute bottom-3 left-3 z-50 group-hover:bottom-10 transition-all duration-300">
			<h3 class="text-3xl font-semibold text-white dark:text-gray-300 dark:hover:text-white">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h3>
		</div>

		<div class="absolute bottom-3 left-3 z-50 opacity-0 group-hover:opacity-100 transition-all duration-300">
			<p class="text-white">Additional Information</p>
		</div>
		TODO: Add here a 48x48px circle image of all posts type 'piano' that are in this current posts acf relationship
		field
		'program_pianos'
	</div>
</div>