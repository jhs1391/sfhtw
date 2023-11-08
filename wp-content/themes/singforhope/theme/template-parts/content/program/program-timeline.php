<div style="display: flex; justify-content: space-between;">
	<h4 class="pb-6 font-bold text-gray-900 text-md">Timeline</h4>
	<div class="flex space-x-4">
		<div id="today-link" class="text-xs underline" style="cursor:pointer;">Today</div>
		<div id="launch-link" class="text-xs underline" style="cursor:pointer;">Launch</div>
	</div>
</div>
<div class="h-screen overflow-y-auto" style="max-height: calc(80vh - 120px);" id="timeline-container">
	<div class="relative">
		<ul role="list" class="space-y-4">
			<?php

			$subitems = array(
				0 => array( 'Confirm Studio Space', 'Confirm Pre-display Location', 'Confirm Launch Event Location', 'Sign MOU', 'Select & Invite Adjudicators' ),
				1 => array( 'Confirm Adjudicators', 'Press Release', 'Outdoor Site Selection Begins' ),
				2 => array( 'Release RFP for Artists', 'Artist Recruitment', 'Release RFP for Donation Sites', 'Continue Outdoor Site Selection', 'Recruit studio manager' ),
				3 => array( 'Artist Submission Deadline', 'Donation Site Deadline', 'Adjudicate & Notify Artists', 'Select Donation Sites', 'Notify Donation Sites', 'Finalize Outdoor Sites', 'Hire studio Manager' ),
				4 => array( 'Supplies Delivered', 'Piano Delivery & Prep', 'Studio Setup', 'Artists Onboarded', 'Permits & COIs submitted' ),
				5 => array( 'Painting Begins', 'Design Collateral', 'Plan Launch Event' ),
				6 => array( 'Painting Ends', 'Finalize Pianos', 'Take Photos', 'Submit all info to the website', 'Print Collateral', 'Finalize Launch Event  Run-of-Show', 'Artists are Paid' ),
				7 => array( 'Move SFH Pianos to Public pre-display', 'Promotion & PR', ),
				8 => array( 'Move SFH Pianos to Launch Event', 'Hold Launch Event', 'Move SFH Pianos to Outdoor Exhibition', 'Move SFH Pianos back to Studio' ),
				9 => array( 'Studio: Piano Cleanup & Tuneup', 'Packup studio, clean up' ),
				10 => array( 'Begin Moving SFH Pianos to Donation Sites & hold Ribbon Cuttings', ),
				11 => array( 'Finish Moving SFH Pianos to Donation Sites & hold Ribbon Cutting', )
			);

			$launchDate = new DateTime( get_field( 'program_launch_date' ) );
			$startDate = ( clone $launchDate )->modify( "-8 months" );
			$currentMonthIndex = 0;

			for ( $i = 1; $i <= 12; $i++ ) {
				$milestoneDate = ( clone $startDate )->modify( "+" . $i . " months" );

				// Check if today's date is less than the milestone date
				if ( new DateTime() < $milestoneDate ) {
					// If true, then the previous month is the current month
					$currentMonthIndex = $i - 1;

					// Calculate the number of days between the start of this month and today
					$daysIntoMonth = ( new DateTime() )->diff( ( clone $startDate )->modify( "+" . $currentMonthIndex . " months" ) )->days;

					// Calculate the total number of days in this month
					$totalDaysInMonth = $milestoneDate->diff( ( clone $startDate )->modify( "+" . $currentMonthIndex . " months" ) )->days;

					// Calculate the top position based on the proportion of days passed in the current month
					$topPosition = ( ( $currentMonthIndex + ( $daysIntoMonth / $totalDaysInMonth ) ) / 12 ) * 100;

					break; // exit the loop as we've found the current month
				} else {
					$currentMonthIndex++;
				}
			}

			for ( $i = 0; $i < 12; $i++ ) :
				$milestoneDate = ( clone $startDate )->modify( "+" . $i . " months" );
				$isCurrentMonth = $milestoneDate->format( 'm' ) == date( 'm' );

				$currentSubitems = isset( $subitems[ $i ] ) ? $subitems[ $i ] : array();

				?>
				<li class="relative">
					<div class="flex gap-x-4">
						<div class="absolute top-0 left-0 flex justify-center w-6 -bottom-6">
							<div class="w-px bg-gray-200"></div>
						</div>
						<div class="relative flex items-center justify-center flex-none w-6 h-6">
							<div class="h-2.5 w-2.5 rounded-full bg-gray-100 ring-1 ring-gray-300"></div>
						</div>
						<p class="flex-auto py-0.5 text-xs leading-5 text-gray-500">
							<span
								class="<?php echo ( $i == 8 ? 'text-green-600' : 'text-gray-900' ); ?> <?php echo ( $i == 8 ? 'font-bold' : 'font-medium' ); ?>">
								<?php echo $milestoneDate->format( 'M d, Y' ); ?>
							</span>
						</p>
						<time datetime="<?php echo $milestoneDate->format( 'Y-m-d\TH:i' ); ?>"
							class="flex-none py-0.5 text-[10px] leading-5 <?php echo ( $i == 8 ? 'text-green-600' : 'text-gray-900' ); ?>">
							<?php
							if ( $i == 0 ) {
								echo 'Start';
							} elseif ( $i == 8 ) {
								echo 'Launch Date';
							} else {
								echo 'Month ' . $i;
							}
							?>
						</time>


					</div>

					<ul class="pl-6 space-y-0">
						<?php foreach ( $currentSubitems as $key => $subitem ) : ?>
							<li class="relative flex gap-x-1">
								<div class="relative flex items-center justify-center flex-none w-6 h-6">
									<div
										class="h-1.5 w-1.5 rounded-full <?php echo $key == 0 ? 'bg-white ring-1 ring-gray-300' : ( $key == 1 ? 'bg-gray-100 ring-1 ring-gray-300' : 'bg-gray-100 ring-1 ring-gray-300 ' ); ?>">
									</div>
								</div>
								<p class="flex-auto py-0.5 text-xs leading-5">
									<!-- Change text color based on key -->
									<span
										class="font-medium <?php echo $key == 0 ? 'text-gray-500' : ( $key == 1 ? 'text-gray-500' : 'text-gray-500' ); ?>">
										<?php echo $subitem; ?>
									</span>
								</p>
							</li>
						<?php endforeach; ?>
					</ul>


				</li>
				<?php if ( $isCurrentMonth ) : ?>
					<div id="magenta-line"
						style="position: absolute; left: 0; right: 0; top:<?php echo $topPosition; ?>%; height: 1px; background-color: magenta;">
						<div class="absolute -top-3 right-16 text-melody text-[8px]">Today</div>
					</div>
				<?php endif; ?>
				<?php if ( $i == 8 ) : ?>
					<?php
					// Calculate the number of days from start to launch
					$daysFromStartToLaunch = $startDate->diff( $milestoneDate )->days;

					// Calculate the total number of days from start to end
					$totalDaysInTimeline = $startDate->diff( ( clone $startDate )->modify( "+12 months" ) )->days;

					// Calculate the top position for the launch based on the proportion of days passed from start to launch
					$launchTopPosition = ( $daysFromStartToLaunch / $totalDaysInTimeline ) * 100;
					?>
					<div id="launch-line"
						style="position: absolute; left: 0; right: 0; top:<?php echo $launchTopPosition; ?>%;">
						<div class="absolute right-0 text-xs -top-3 text-melody"></div>
					</div>
				<?php endif; ?>


			<?php endfor; ?>

		</ul>
	</div>
</div>

<script>
	document.getElementById('today-link').addEventListener('click', function () {
		var magentaLine = document.getElementById('magenta-line');
		var container = document.getElementById('timeline-container');
		var topPosition = magentaLine.offsetTop - container.offsetTop;
		smoothScroll(container, topPosition - (container.clientHeight / 3));
	});

	document.getElementById('launch-link').addEventListener('click', function () {
		var launchLine = document.getElementById('launch-line');
		var container = document.getElementById('timeline-container');
		var topPosition = launchLine.offsetTop - container.offsetTop;
		smoothScroll(container, topPosition - (container.clientHeight / 3));
	});


	function smoothScroll(element, targetPosition) {
		var startPosition = element.scrollTop;
		var distance = targetPosition - startPosition;
		var duration = 1000;
		var start = null;

		window.requestAnimationFrame(step);

		function step(timestamp) {
			if (!start) start = timestamp;
			var progress = timestamp - start;
			element.scrollTop = easeInOutQuad(progress, startPosition, distance, duration);
			if (progress < duration) window.requestAnimationFrame(step);
		}
	}

	function easeInOutQuad(t, b, c, d) {
		t /= d / 2;
		if (t < 1) return c / 2 * t * t + b;
		t--;
		return -c / 2 * (t * (t - 2) - 1) + b;
	}

	// window.onload = function () {
	// 	document.getElementById('today-link').click();
	// }

</script>