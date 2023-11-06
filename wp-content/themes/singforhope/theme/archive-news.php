<?php
/*
Template Name: News Template
*/

get_header();

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$args = array(
	'post_type' => 'news',
	'posts_per_page' => 10,
	'paged' => $paged
);

$news_query = new WP_Query( $args );


// Temporarily replace the main query with our custom one
global $wp_query;
$original_query = $wp_query;
$wp_query = $news_query;

if ( $news_query->have_posts() ) :
	?>

	<section id="primary">
		<main id="main">

			<div class="bg-gray-100 pb-6 pt-6 px-8">
				<div class="mx-auto grid grid-cols-1 gap-10 lg:grid-cols-12 lg:gap-8 ">
					<div class="max-w-xl text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl lg:col-span-7">
						<h2 class="inline sm:block lg:inline xl:block text-3xl mt-6">Sing for Hope News</h2>
					</div>

				</div>
			</div>



			<div class="bg-white py-12 px-10">

				<div class="flex">
					<div class="w-2/3">
						<!-- Loop starts here -->
						<?php while ( $news_query->have_posts() ) :
							$news_query->the_post(); ?>

							<article class="relative isolate flex flex-col pt-6 gap-8 lg:flex-row">
								<div class="relative aspect-[2/1] sm:aspect-[2/1] lg:aspect-square lg:w-64 lg:h-64 lg:shrink-0">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'full', [ 'class' => 'absolute inset-0 h-full w-full rounded-2xl bg-gray-50 object-cover' ] ); ?>
									<?php endif; ?>
									<div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
								</div>
								<div class="px-3">
									<div class="flex items-center gap-x-4 text-xs">
										<time datetime="<?php echo get_the_date( 'Y-m-d' ); ?>" class="text-gray-500">
											<?php echo get_the_date(); ?>
										</time>
										<?php
										$categories = get_the_category();
										$cat_colors = array(
											'pianos' => 'harmony',
											'education' => 'melody',
											'health' => 'rythm',
											'diplomacy' => 'sonata',
											'workforce' => 'symphony',
											'reports' => 'symphony'
										);
										foreach ( $categories as $category ) {
											if ( array_key_exists( $category->slug, $cat_colors ) ) {
												echo '<span class="inline-flex items-center rounded-full bg-' . $cat_colors[ $category->slug ] . 'light px-2 py-1 text-xs font-medium text-' . $cat_colors[ $category->slug ] . '">' . $category->name . '</span>';
											}
										}
										?>
									</div>
									<div class="group relative max-w-xl">
										<h3
											class="mt-2 text-2xl font-semibold leading-6 text-gray-800 group-hover:text-gray-600">
											<a href="<?php the_permalink(); ?>">
												<span class="absolute inset-0"></span>
												<?php the_title(); ?>
											</a>
										</h3>

										<div class="mt-2 text-sm leading-4 text-gray-500">
											<?php the_excerpt(); ?>
										</div>
										<button type="button"
											class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 mt-6">Read
											Story
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
												stroke="currentColor" class="h-4 w-4 inline-block ml-1">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													d="M9 5l7 7-7 7"></path>
											</svg>
										</button>
									</div>
								</div>
							</article>

						<?php endwhile; ?>
						<!-- Loop ends here -->

						<!-- Pagination starts here -->
						<div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
							<div class="flex flex-1 justify-between sm:hidden">
								<a href="<?php echo get_previous_posts_page_link(); ?>"
									class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
								<a href="<?php echo get_next_posts_page_link(); ?>"
									class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
							</div>
							<div class="pagination">
								<?php
								echo paginate_links( array(
									'total' => $news_query->max_num_pages,
									'prev_text' => __( '&laquo; Prev', 'text-domain' ),
									'next_text' => __( 'Next &raquo;', 'text-domain' ),
								) );
								?>

							</div>
						</div>
						<!-- Pagination ends here -->

					</div>
					<div class="w-1/3">
						<div class="bg-gray-100 p-5 rounded">
							<form class="w-full max-w-md lg:col-span-5 lg:pt-2">
								<p class="inline sm:block lg:inline xl:block">Sign up for our newsletter.</p>

								<div class="flex gap-x-4">

									<label for="email-address" class="sr-only">Email address</label>
									<input id="email-address" name="email" type="email" autocomplete="email" required
										class="min-w-0 flex-auto rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-harmony sm:text-sm sm:leading-6"
										placeholder="Enter your email">
									<button type="submit"
										class="flex-none rounded-md bg-harmony px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-harmony focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-harmony">Subscribe</button>
								</div>
								<p class="mt-1 text-xs leading-6 text-gray-900">We care about your data. Read our <a
										href="#"
										class="font-semibold text-harmony hover:text-harmony">privacy&nbsp;policy</a>.
								</p>
							</form>
						</div>

					</div>

				</div>

		</main>
	</section>

	<?php
else :
	echo '<p>No news posts found.</p>';
endif;

// Restore the original query
$wp_query = $original_query;
wp_reset_query();

get_footer();


