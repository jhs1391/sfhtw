<div class="px-12 pb-12 mx-auto ">
	<!-- Grid -->
	<div class="grid lg:grid-cols-8 lg:gap-x-8 xl:gap-x-12 lg:items-center">
		<div class="rounded lg:col-span-4 mt-10 lg:mt-0 p-6">
			<iframe class="rounded" width="600" height="350" src="https://www.youtube.com/embed/2kGLILDaeK0"
				title="The Sing for Hope Pianos on CBS Sunday Morning" frameborder="0"
				allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
				allowfullscreen></iframe>
		</div>

		<div class="lg:col-span-4 parallax" data-speed="0.1">
			<h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Overview</h1>

			<p class="mt-3 text-lg text-gray-800 dark:text-gray-400">From the Bronx to Beirut, the Sing for Hope Pianos
				program is a global arts initiative that creates artist-designed pianos; places them in public spaces
				for anyone and everyone to enjoy; then transports and activates them year-round in permanent homes in
				schools, hospitals, transit hubs, refugee camps, and community-based organizations. Sing for Hope has
				provided more pianos for under-resourced public schools than any other organization in the world.</p>

		</div>
		<!-- End Col -->


		<!-- End Col -->
	</div>
	<!-- End Grid -->
</div>


<div class="px-12 pb-10 mx-auto ">
	<!-- Grid -->
	<div class="grid lg:grid-cols-8 lg:gap-x-8 xl:gap-x-12 lg:items-center">

		<div class="lg:col-span-4 parallax" data-speed="0.1">
			<p class="text-lg text-gray-800 dark:text-gray-400 -mt-44">The Sing for Hope Pianos is the country’s largest
				annually recurring public arts project, placing artist-designed pianos in parks and public spaces for
				anyone and everyone to play. Sparking impromptu music-making and connections, they create spontaneous
				moments of joy and community, bringing people together. And here’s the best part: the Sing for Hope
				Pianos are YOURS! They are free and open for all of your jam sessions, student performances, musically
				accompanied yoga sessions, dance-offs, workshop/classes, music videos, livestreams, and more. Your Sing
				for Hope Pianos’ creative opportunities are as boundless as your imagination.
			</p>



		</div>
		<div class="rounded lg:col-span-4 lg:mt-0 p-6">
			<img class="rounded max-h-[420px] object-cover"
				src="https://sfhmedia.nyc3.digitaloceanspaces.com/2023/08/frame-2-1.jpeg" width="100%" height="300px">
		</div>

		<!-- End Col -->


		<!-- End Col -->
	</div>
	<!-- End Grid -->
</div>

<script>
	window.addEventListener('scroll', function () {
		const parallaxElements = document.querySelectorAll('.parallax');
		const scrollPosition = window.pageYOffset;

		parallaxElements.forEach((element) => {
			let speed = element.dataset.speed;
			element.style.transform = `translateY(${scrollPosition * speed}px)`;
		});
	});

</script>