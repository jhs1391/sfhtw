<div class="flex" id="countdown">
	<ul class="text-center flex space-x-8 text-xs uppercase p-6 text-gray-400 hover:text-gray-800">
		<li class="inline-block"><span id="days"
				class="block text-4xl font-bold text-gray-400 hover:text-gray-800"></span> <span id="days-text">Days</span></li>
		<li class="inline-block"><span id="hours"
				class="block text-4xl font-bold text-gray-400 hover:text-gray-800"></span> <span id="hours-text">Hours</span></li>
		<li class="inline-block"><span id="minutes"
				class="block text-4xl font-bold text-gray-400 hover:text-gray-800"></span> <span id="minutes-text">Minutes</span></li>
		<li class="inline-block"><span id="seconds"
				class="block text-4xl font-bold text-gray-400 hover:text-gray-800"></span> <span id="seconds-text">Seconds</span></li>
	</ul>
</div>

<?php
// get the applications end date from ACF field inside 'program_dates' group
$end_date = get_field( 'program_dates' )['applications_end_date'];

// convert the date format from 'Ymd' to 'm/d/Y'
$dateObject = DateTime::createFromFormat( 'Ymd', $end_date );

if ($dateObject) {
	$end_date = $dateObject->format( 'm/d/Y' );
} else {
	// handle the case where $end_date is not a valid date string
}
?>

<script>
	(function () {
		const second = 1000,
			minute = second * 60,
			hour = minute * 60,
			day = hour * 24;

		// set the countdown date to the applications end date fetched from ACF
		const countDown = new Date('<?php echo $end_date; ?>').getTime(),
			x = setInterval(function () {

				const now = new Date().getTime(),
					distance = countDown - now;

				let days = Math.floor(distance / (day));
				document.getElementById("days").innerText = days;
				document.getElementById("days-text").innerText = days === 1 ? "Day" : "Days";

				let hours = Math.floor((distance % (day)) / (hour));
				document.getElementById("hours").innerText = hours;
				document.getElementById("hours-text").innerText = hours === 1 ? "Hour" : "Hours";

				let minutes = Math.floor((distance % (hour)) / (minute));
				document.getElementById("minutes").innerText = minutes;
				document.getElementById("minutes-text").innerText = minutes === 1 ? "Minute" : "Minutes";

				let seconds = Math.floor((distance % (minute)) / second);
				document.getElementById("seconds").innerText = seconds;
				document.getElementById("seconds-text").innerText = seconds === 1 ? "Second" : "Seconds";

				//do something later when date is reached
				if (distance < 0) {
					document.getElementById("headline").innerText = "Launch time!";
					document.getElementById("countdown").style.display = "none";
					document.getElementById("content").style.display = "block";
					clearInterval(x);
				}
			}, 0)
	}());
</script>
