<?php
/**
 * Template part for displaying single pianos
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sing_for_Hope
 */

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="flex py-6 space-x-3 bg-gray-100 px-14">
		<!-- Content area -->


		<div class="w-2/3">
			<div class="">
				<div
					class="p-0 bg-center bg-cover border-t border-l border-r h-[400px] border-gray-200 rounded transition-all duration-500 ease-in-out overflow-hidden cursor-pointer"
					id="imageContainer">
					<img id="image" class="object-cover w-full h-full rounded-t" src="<?php echo get_field( 'piano_image' ); ?>"
						alt="<?php the_title(); ?>">
					<span id="tooltip" class="absolute invisible bg-black text-white px-1.5 text-xs">
						Click to expand
					</span>

				</div>
			</div>
			<div class="pt-0">
				<div class="bg-white p-6 rounded-b border-b border-l border-r border-gray-200 min-h-[50px]">
					<?php echo get_field( 'artist_statement' ); ?>
				</div>
			</div>
		</div>

		<!-- Floating Right Sidebar -->
		<div class="w-1/3">
			<div class="sticky p-6 bg-white border border-gray-100 rounded top-3">
				<div class="mb-6 grow">
					<div class="flex justify-start">
						<button type="button"
							class="py-1.5 px-2.5 inline-flex justify-center items-center gap-x-1.5 rounded border border-transparent font-semibold bg-melody text-white text-xs">

							2023
						</button>

					</div>
					<!-- Icon -->
					<div class="flex py-5 gap-x-7 first:pt-0 last:pb-0">
						<img
							src="https://fileserviceuploadsperm.blob.core.windows.net/files/file-1b6s0siMkL0yp5pDp7HCz9f2?se=2023-10-16T21%3A14%3A40Z&sp=r&sv=2021-08-06&sr=b&rscd=attachment%3B%20filename%3Dc172949e-9760-4e68-a9fb-768a42520e19.webp&sig=%2ByFkKcJCr8bInOB%2BrYgWYCMqcagQZMnxK0N4eJf07g4%3D"
							width="60px" height="60px">

						<div>
							<h3 class="font-semibold text-gray-800 dark:text-gray-200">
								Donated
							</h3>
							<p class="text-sm text-gray-500">
								This Sing for Hope Pianos has been Donated to XYZ Organization. </p>
						</div>
					</div>
					<!-- End Icon -->
				</div>
				<?php the_title( '<h1 class="text-3xl font-bold lg:text-4xl lg:text-5xl dark:text-white">', '</h1>' ); ?>
				<div id="artist-info" class="mt-10">
					<h3>Artist</h3>
					<!-- Avatar Media -->
					<div class="flex items-center group gap-x-3 ">
						<!-- <a class="flex-shrink-0 block" href="#">
							<img class="h-[120px] w-[120px] rounded"
								src="https://images.unsplash.com/photo-1669837401587-f9a4cfe3126e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
								alt="Image Description">
						</a> -->

						<h5 class="text-3xl font-semibold group-hover:text-gray-600 text-harmony">
							<?php echo get_field( 'artist_name' ); ?>
						</h5>


					</div>
					<!-- End Avatar Media -->
					<div class="overflow-hidden ">
						<p class="text-sm text-gray-500 line-clamp-3">
							<?php echo get_field( 'artist_bio' ); ?>
						</p>
					</div>
					<button class="mt-2 text-xs text-blue-500 cursor-pointer hover:underline" onclick="toggleReadMore()">
						Read more
					</button>

				</div>

			</div>
		</div>
	</div>

	<div class="flex px-20 py-6 bg-white">

		<!-- Card Blog -->
		<div class="mx-auto">
			<!-- Grid -->
			<div id="slider" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-6">
				<?php
				$args = array(
					'post_type' => 'piano',
					'posts_per_page' => 5,
				);
				$the_query = new WP_Query( $args );
				while ( $the_query->have_posts() ) :
					$the_query->the_post();
					$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
					$artist_name = get_field( 'artist_name' );
					?>
					<!-- Card -->
					<a class="inline-block overflow-hidden group rounded-xl" href="<?php the_permalink(); ?>">
						<div class="relative pt-[50%] sm:pt-[70%] rounded-xl overflow-hidden">
							<img
								class="absolute top-0 left-0 object-cover w-full h-full transition-transform duration-500 ease-in-out group-hover:scale-105 rounded-xl"
								src="<?php echo $image_src[0]; ?>" alt="Image Description">
							<span
								class="absolute top-0 right-0 rounded-tr-xl rounded-bl-xl text-xs font-medium bg-gray-800 text-white py-1.5 px-3 dark:bg-gray-900">
								Sponsored
							</span>
						</div>

						<div class="mt-2">
							<h3 class="text-xl font-semibold text-gray-800 group-hover:text-gray-600 dark:text-gray-200">
								<?php the_title(); ?>
							</h3>
							<div class="flex items-center mt-auto gap-x-3">
								<img class="w-8 h-8 rounded-full" src="<?php echo $image_src[0]; ?>" alt="Image Description">
								<div>
									<h5 class="text-sm text-gray-800 dark:text-gray-200">By
										<?php echo $artist_name; ?>
									</h5>
								</div>
							</div>

						</div>
					</a>
					<!-- End Card -->
					<?php
				endwhile;
				wp_reset_postdata();
				?>

				<!-- Card -->
				<a class="group relative flex flex-col w-full  bg-center bg-cover rounded-xl hover:shadow-lg transition bg-[url('https://images.unsplash.com/photo-1634017839464-5c339ebe3cb4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=3000&q=80')]"
					href="/pianos#gallery">
					<div class="flex-auto p-4 md:p-6">
						<h3 class="text-xl text-white/[.9] group-hover:text-white"><span class="font-bold">Visit</span> the Sing for
							Hope virtual gallery.</h3>
					</div>
					<div class="p-4 pt-0 md:p-6">
						<div class="inline-flex items-center gap-2 text-sm font-medium text-white group-hover:text-white/[.7]">
							Explore 3000+ Pianos
							<svg class="w-2.5 h-2.5" width="16" height="16" viewBox="0 0 16 16" fill="none">
								<path d="M5.27921 2L10.9257 7.64645C11.1209 7.84171 11.1209 8.15829 10.9257 8.35355L5.27921 14"
									stroke="currentColor" stroke-width="2" stroke-linecap="round" />
							</svg>
						</div>
					</div>
				</a>
				<!-- End Card -->
			</div>
			<!-- End Grid -->
		</div>
		<!-- End Card Blog -->

	</div>

</article><!-- #post-${ID} -->

<script>
	function toggleReadMore() {
		const content = document.querySelector('.line-clamp-3');
		content.classList.toggle('line-clamp-none');
	}
	var slider = new Slider('#slider', {
		slidesToShow: 5,
		slidesToScroll: 1,
		infinite: false,
		arrows: true,
	});
	const imageContainer = document.getElementById('imageContainer');
	const image = document.getElementById('image');
	const tooltip = document.getElementById('tooltip');

	let isExpanded = false;

	// Tooltip follows cursor
	imageContainer.addEventListener('mousemove', (e) => {
		tooltip.style.left = e.pageX + 'px';
		tooltip.style.top = e.pageY + 'px';
		tooltip.style.visibility = 'visible';
	});

	// Hide tooltip when not hovering
	imageContainer.addEventListener('mouseleave', () => {
		tooltip.style.visibility = 'hidden';
	});
	// Toggle height on click
	imageContainer.addEventListener('click', () => {
		if (!isExpanded) {
			imageContainer.classList.remove('h-[400px]');
			imageContainer.classList.add('max-h-full');
			isExpanded = true;
		} else {
			imageContainer.classList.remove('h-full');
			imageContainer.classList.add('h-[400px]');
			isExpanded = false;
		}
	});

</script>