<div class="py-6 flex bg-white w-full">
	<!-- Card Blog -->
	<div class="mx-auto w-full">
		<!-- Grid -->
		<div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-2 w-full">

			<?php
			$current_post_id = get_the_ID();
			$piano_posts = get_field( 'program_pianos', $current_post_id );
			$expected_piano_count = get_field( 'number_of_pianos', $current_post_id );
			$actual_piano_count = 0;

			// Check if the relationship is not empty
			if ( ! empty( $piano_posts ) ) {
				$piano_ids = array_map( function ($post) {
					return $post->ID;
				}, $piano_posts );

				$args = array(
					'post_type' => 'piano',
					'post__in' => $piano_ids,
					'posts_per_page' => -1,
				);
				$query = new WP_Query( $args );

				while ( $query->have_posts() ) :
					$query->the_post();
					$actual_piano_count++;
					?>

					<!-- Card -->
					<a class="group rounded-xl overflow-hidden border border-gray-200 p-2" href="<?php the_permalink(); ?>">
						<div class="relative pt-[50%] sm:pt-[70%] rounded-xl overflow-hidden">
							<img class="w-full h-full absolute top-0 left-0 object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out rounded-xl"
								src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">

						</div>

						<div class="mt-2">
							<h3 class="text-xl font-semibold text-gray-800 group-hover:text-gray-600 dark:text-gray-200">
								<?php the_title(); ?>
							</h3>
							<div class="mt-auto flex items-center gap-x-3">
								<img class="w-8 h-8 rounded-full"
									src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
									alt="Image Description">
								<div>
									<h5 class="text-sm text-gray-800 dark:text-gray-200">By Lauren Waller</h5>
								</div>
							</div>
						</div>
					</a>
					<!-- End Card -->
				<?php endwhile;
				wp_reset_postdata();
			}

			// Display placeholder cards for missing posts
			$missing_piano_count = $expected_piano_count - $actual_piano_count;
			for ( $i = 0; $i < $missing_piano_count; $i++ ) {
				?>

				<!-- Placeholder Card -->
				<div
					class="group rounded-xl overflow-hidden border-4 border-gray-200 p-2 bg-gray-100 border-dashed h-40 w-full">
					<div class="relative rounded-xl overflow-hidden flex items-center justify-center h-full">
						<span class="text- font-semibold text-gray-400 dark:text-gray-200">Piano goes here</span>
					</div>
				</div>
				<!-- End Placeholder Card -->

				<?php
			}
			?>

		</div>
		<!-- End Grid -->
	</div>
	<!-- End Card Blog -->
</div>