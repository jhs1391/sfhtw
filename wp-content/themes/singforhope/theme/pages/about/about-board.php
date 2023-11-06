<!-- Team section -->
<div class="mx-auto px-6">
	<div class="mx-auto max-w-2xl lg:mx-0">
		<h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Our Board of Directors</h2>
	</div>
	<ul role="list"
		class="mx-auto mt-20 grid max-w-2xl grid-cols-2 gap-x-8 gap-y-16 text-center sm:grid-cols-3 md:grid-cols-4 lg:mx-0 lg:max-w-none lg:grid-cols-5 xl:grid-cols-6">
		<?php if ( have_rows( 'board_of_directors' ) ) : ?>
			<?php while ( have_rows( 'board_of_directors' ) ) :
				the_row();
				// get acf data
				$name = get_sub_field( 'board_member_full_name' );
				$title = get_sub_field( 'board_member_title' );
				$image = get_sub_field( 'board_member_photo' );
				?>
				<li>
					<img class="mx-auto h-24 w-24 rounded-full object-cover" src="<?php echo $image; ?>" alt="">
					<h3 class="mt-6 text-base font-semibold leading-7 tracking-tight text-gray-900">
						<?php echo $name; ?>
					</h3>
					<p class="text-sm leading-6 text-gray-600">
						<?php echo $title; ?>
					</p>
				</li>
			<?php endwhile; ?>
		<?php endif; ?>
	</ul>
</div>