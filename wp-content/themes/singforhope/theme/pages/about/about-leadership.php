<!-- Team section -->
<div class="mx-auto px-6 ">
	<div class="mx-auto max-w-2xl lg:mx-0 mb-6 items-center justify-center">
		<h2 class="text-3xl font-bold tracking-tight text-black sm:text-4xl items-center">Our Leadership Team</h2>
	</div>

	<div class="flex">
		<div class="w-1/2 flex">
			<img class="h-[300px] w-[300px] rounded-2xl object-cover"
				src="https://sfhtw.local/wp-content/uploads/2023/11/Camille-Zamora-1.jpeg">
			<div class="flex p-6 flex-col">
				<h2 class="text-4xl font-semibold leading-8 tracking-tight text-black">
					Camille Zamora</h2>
				<p class="text-lg mt-3 font-semibold">Co-Founder and Co-Executive Director</p>
				<p class="text-sm">Raised in Texas and Mexico, Camille Zamora is the Co-Founder and Co-Executive
					Director of Sing for
					Hope.
					An internationally acclaimed soprano, she has appeared with collaborators ranging from Yo-Yo Ma to
					Sting, ensembles including London Symphony Orchestra and Glimmerglass Opera, and live broadcasts on
					NPR
					and BBC. Her last two albums (Si la noche se hace oscura/ If the night grows dark and Le dernier
					sorcier/The Last Sorcerer) debuted on Billboard’s Top Ten Classical Chart. Camille has been
					recognized
					by the Congressional Hispanic Caucus, received a 100 Hispanic Women Community Pride Award, and been
					named NY1’s “New Yorker of the Week,” one of the “Top 50 Americans in Philanthropy” by Town &
					Country,
					and one of CNN’s “Most Intriguing People.” She has been the Housewright Eminent Artist-Scholar in
					Residence at Florida State University, the inaugural Reflexions Artist in Residence at University of
					Arkansas, and given masterclasses and guest lectures at Juilliard, Harvard, NYU, Claremont Graduate
					University, and others. A graduate of The Juilliard School and a leading voice in the “artist as
					citizen” discussion, Camille has performed and spoken at Skoll World Forum for Social
					Entrepreneurship,
					The World Summit of Nobel Peace Laureates, Fortune Most Powerful Women Summit, Aspen Ideas Festival,
					and
					The United Nations.</p>
			</div>
		</div>
		<div class="w-1/2 flex">
			<img class="h-[300px] w-[300px] rounded-2xl object-cover object-center"
				src="https://sfhtw.local/wp-content/uploads/2023/11/Monica-Yunus-1.jpeg">
			<div class="flex p-6 flex-col">
				<h2 class="text-4xl font-semibold leading-8 tracking-tight text-black">
					Monica Yunus</h2>
				<p class="text-lg mt-3 font-semibold">Co-Founder and Co-Executive Director</p>
				<p class="text-sm">Born in Chittagong, Bangladesh and raised in New Jersey, Monica Yunus is the
					Co-Founder and
					Co-Executive Director of Sing for Hope. Monica has performed with the world’s leading opera
					companies, including Washington National Opera, Glimmerglass Opera, and The Metropolitan Opera,
					where she spent ten seasons as a principal artist. She has performed in concert and recital in
					Spain, Guatemala, Bangkok, and Lebanon’s Zouk Festival. Monica has been honored with a 21st Century
					Leaders Award and named a Young Global Leader of the World Economic Forum, a “New Yorker of the
					Week” by NY1, and one of the “Top 50 Americans in Philanthropy” by Town & Country. A leading voice
					in the “artist as citizen” discussion, she has performed and spoken at Skoll World Forum for Social
					Entrepreneurship, The World Summit of Nobel Peace Laureates, Fortune Most Powerful Women Summit,
					Aspen Ideas Festival, and The United Nations. She is an Artist Lecturer at Carnegie Mellon
					University, and has been the Housewright Eminent Artist-Scholar in Residence at Florida State
					University and the inaugural Reflexions Artist in Residence at University of Arkansas. The daughter
					of Nobel Peace Laureate Muhammad Yunus, Monica is a graduate of The Juilliard School.
				</p>
			</div>
		</div>
	</div>

	<ul role="list"
		class="mx-auto mt-20 grid grid-cols-1 gap-x-8 gap-y-14 sm:grid-cols-6 lg:mx-0 lg:max-w-none lg:grid-cols-7 xl:grid-cols-8">
		<?php if ( have_rows( 'leadership' ) ) : ?>
			<?php while ( have_rows( 'leadership' ) ) :
				the_row();
				// get acf data
				$image = get_sub_field( 'leadership_photo' );
				$name = get_sub_field( 'leadership_full_name' );
				$title = get_sub_field( 'leadership_title' );
				$bio = get_sub_field( 'leadership_bio' );
				?>
				<li>
					<img class="aspect-[14/13] h-32 w-32 rounded-2xl object-cover" src="<?php echo esc_url( $image['url'] ); ?>"
						alt="<?php echo esc_attr( $image['alt'] ); ?>">
					<h3 class="mt-6 text-lg font-semibold leading-8 tracking-tight text-black">
						<?php echo $name; ?>
					</h3>
					<p class="text-base leading-7 text-gray-800">
						<?php echo $title; ?>
					</p>
					<div id="content" class="overflow-hidden max-h-48 transition-max-height duration-500 ease-in-out">
						<a href="#" class="expandable-bio text-sm leading-6 text-gray-800">
							<?php echo $bio; ?>
						</a>
					</div>
					<button id="readMoreBtn" onclick="toggleReadMore()"
						class="mt-2 text-blue-600 hover:text-blue-800 focus:outline-none transition duration-300 ease-in-out">
						Read More
					</button>
				</li>
			<?php endwhile; ?>
		<?php endif; ?>
	</ul>
</div>

<script>
	function toggleReadMore(contentId, btnId) {
		const content = document.getElementById(contentId);
		const btn = document.getElementById(btnId);
		content.classList.toggle('max-h-48');
		btn.innerText = content.classList.contains('max-h-48') ? 'Read More' : 'Read Less';
	}
</script>