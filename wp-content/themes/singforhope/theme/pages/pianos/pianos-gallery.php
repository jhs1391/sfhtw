<style>
	#slide-over-panel {
		transform: translateX(100%);
		transition: transform 0.3s ease-in-out;
	}

	#slide-over-panel.show {
		transform: translateX(0);
	}
</style>

<div class="px-12 py-12">


	<input type="text" id="search-bar" placeholder="Search..."
		class="w-full px-3 py-2 mb-8 text-lg border rounded-lg focus:outline-none" />
	<ul role="list" id="pianos-list" class="grid grid-cols-2 gap-x-2 gap-y-6 sm:grid-cols-3 lg:grid-cols-6">
		<?php
		$args = array(
			'post_type' => 'piano',
			'posts_per_page' => 200,
		);
		$the_query = new WP_Query( $args );
		$i = 0; // Add a counter
		while ( $the_query->have_posts() ) :
			$the_query->the_post();
			?>
			<li class="relative" data-post-id="<?php echo get_the_ID(); ?>" data-post-url="<?php the_permalink(); ?>">
				<div
					class="block w-full overflow-hidden bg-gray-100 rounded-lg group aspect-h-7 aspect-w-10 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
					<?php if ( has_post_thumbnail() ) {
						$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
						?>
						<!-- Include the counter value in a data-index attribute -->
						<img data-index="<?php echo $i; ?>" data-src="<?php echo $image_src[0]; ?>"
							class="object-cover group-hover:opacity-75" />
					<?php } ?>
					<button type="button" class="absolute inset-0 focus:outline-none">
						<span class="sr-only">View details for
							<?php the_title(); ?>
						</span>
					</button>
				</div>
				<p class="block mt-2 text-sm font-medium text-gray-900 truncate pointer-events-none">
					<?php the_title(); ?>
				</p>
				<p class="block text-sm font-medium text-gray-500 pointer-events-none">
					<?php echo get_field( 'artist_name' ); ?>
				</p>
			</li>
			<?php
			$i++; // Increment the counter
		endwhile;
		wp_reset_postdata(); ?>

	</ul>
</div>

<div id="slide-over-panel" class="relative z-10" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
	<!-- Background backdrop, show/hide based on slide-over state. -->
	<div class="fixed inset-0"></div>

	<div class="fixed inset-0 overflow-hidden">
		<div class="absolute inset-0 overflow-hidden">
			<div class="fixed inset-y-0 right-0 flex max-w-full pl-10 pointer-events-none sm:pl-16">
				<!--
		  Slide-over panel, show/hide based on slide-over state.

		  Entering: "transform transition ease-in-out duration-500 sm:duration-700"
			From: "translate-x-full"
			To: "translate-x-0"
		  Leaving: "transform transition ease-in-out duration-500 sm:duration-700"
			From: "translate-x-0"
			To: "translate-x-full"
		-->
				<div class="w-screen max-w-2xl pointer-events-auto">
					<div class="flex flex-col h-full py-6 overflow-y-scroll bg-white shadow-xl">
						<div class="px-4 sm:px-6">
							<div class="flex items-start justify-between">
								<h2 class="text-base font-semibold leading-6 text-gray-900" id="slide-over-title">Panel
									title</h2>
								<div class="flex items-center ml-3 h-7">
									<button type="button"
										class="relative text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
										<span class="absolute -inset-2.5"></span>
										<span class="sr-only">Close panel</span>
										<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
											stroke="currentColor" aria-hidden="true">
											<path stroke-linecap="round" stroke-linejoin="round"
												d="M6 18L18 6M6 6l12 12" />
										</svg>
									</button>
								</div>
							</div>
						</div>
						<div class="relative flex-1 px-4 mt-6 sm:px-6">
							<div id="slide-over-content"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	const observer = lozad('.lozad', {
		loaded: function (el) {
			// Calculate the delay - each subsequent image will be delayed by an additional 150ms
			const delay = el.getAttribute('data-index') * 50;
			// Add the delay and opacity-100 classes
			el.style.transitionDelay = `${delay}ms`;
			el.classList.add('opacity-100');
		}
	});
	observer.observe();

	// Add event listeners to each piano image and title
	const pianoItems = document.querySelectorAll('#pianos-list li');
	pianoItems.forEach(item => {
		item.addEventListener('click', function (event) {
			event.preventDefault(); // Prevent the default action

			const postUrl = this.getAttribute('data-post-url');

			window.open(postUrl, '_blank');
		});
	});





	document.querySelector('#slide-over-panel button[type="button"]').addEventListener('click', function () {
		document.getElementById('slide-over-panel').classList.remove('show');
	});


</script>