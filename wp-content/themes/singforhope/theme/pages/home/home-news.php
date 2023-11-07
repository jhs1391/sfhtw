<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>



<div class="py-2 pt-6 pl-4 sm:pl-8 lg:pl-8 lg:py-6">


	<div class="pb-2 pr-10 mb-2 sm:flex sm:items-center sm:justify-between">
		<h2 class="pl-1 text-2xl font-bold md:text-2xl md:leading-tight dark:text-white">Featured News</h2>
		<div class="right-0 flex mt-3 sm:ml-4 sm:mt-0">
			<button type="button"
				class="inline-flex items-center px-3 py-2 text-sm font-semibold text-gray-900 bg-white rounded-full shadow-sm swiper-button-prev ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Prev</button>
			<button type="button"
				class="inline-flex items-center px-3 py-2 text-sm font-semibold text-gray-900 bg-white rounded-full shadow-sm swiper-button-next ring-1 ring-inset ring-gray-200 hover:bg-gray-50 ">Next</button>
			<a href="/new"><button type="button"
					class="inline-flex items-center px-3 py-2 ml-3 text-sm font-semibold text-white rounded-full shadow-sm bg-harmony hover:bg-harmony focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-harmony">View
					All</button></a>
		</div>
	</div>


	<div class="max-w-full mx-auto overflow-x-hidden">

		<!-- Flex Container -->
		<div class="w-full swiper-container">
			<div class="swiper-wrapper">
				<?php
				$args = array(
					'post_type' => 'news',
					'posts_per_page' => 6,
					'orderby' => 'date',
					'order' => 'DSC'
				);
				$query = new WP_Query( $args );

				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						?>
						<!-- Card -->
						<div class="swiper-slide">
							<a href="<?php the_permalink(); ?>">
								<article
									class="relative isolate flex flex-col justify-end overflow-hidden rounded-xl bg-gray-900 px-8 pb-8 pt-80 sm:pt-48 lg:pt-80 min-w-[250px] h-[200px] group">
									<img src="<?php the_post_thumbnail_url(); ?>" alt=""
										class="absolute inset-0 object-cover w-full h-full -z-10">
									<div class="absolute inset-0 -z-10 bg-gradient-to-t from-gray-900 via-gray-900/40">
									</div>
									<div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-inset ring-gray-900/10">
									</div>

									<!-- Excerpt Layer -->
									<div
										class="absolute inset-0 text-white transition duration-300 ease-in-out bg-gray-900 bg-opacity-50 opacity-0 backdrop-blur-md group-hover:opacity-100">
										<p class="p-4">
											<?php echo get_the_excerpt(); ?>
										</p>
										<button type="button"
											class="m-4 rounded-full bg-harmony px-3.5 py-2 text-xs font-semibold text-white shadow-sm hover:bg-harmony focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-harmony">Read
											Story</button>

									</div>

									<div
										class="flex flex-wrap items-center overflow-hidden text-sm leading-6 text-gray-300 gap-y-1">
										<time datetime="<?php echo get_the_date( 'Y-m-d' ); ?>" class="mr-8">
											<?php echo get_the_date(); ?>
										</time>
										<div class="flex items-center -ml-4 gap-x-4">

										</div>
									</div>
									<h3 class="mt-3 text-lg font-semibold leading-6 text-white whitespace-normal">
										<a href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
										</a>
									</h3>
								</article>

							</a>
						</div>
						<!-- End Card -->

						<?php
					}
				} else {
					echo '<p>No posts found.</p>';
				}

				wp_reset_postdata();
				?>
			</div>
			<!-- End Flex Container -->

		</div>


	</div>

	<script>
		var swiper = new Swiper('.swiper-container', {
			slidesPerView: 'auto',
			centeredSlides: false,
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			keyboard: {
				enabled: true,
				onlyInViewport: false,
			},
			breakpoints: {
				320: {
					slidesPerView: 1.2,
					spaceBetween: 10
				},
				420: {
					slidesPerView: 2.5,
					spaceBetween: 10
				},
				768: {
					slidesPerView: 4.25,
					spaceBetween: 8
				}
			},
		});
	</script>