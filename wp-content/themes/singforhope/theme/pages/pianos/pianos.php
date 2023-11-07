<?php
/*
Template Name: Static Pianos Template
*/

get_header();

?>


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>

<section id="primary">
	<main id="main">
		<?php include( 'pianos-header.php' ); ?>

		<div class="sticky inset-x-0 z-50 flex flex-wrap w-full py-4 text-sm top-1 sm:justify-start sm:flex-nowrap">
			<nav id="navbar" class="max-w-[85rem] py-3 w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between"
				aria-label="Global">

				<div id="navbar-collapse-basic"
					class="hidden overflow-hidden transition-all duration-300 basis-full grow sm:block">
					<div data-hs-scrollspy="#scrollspy-1"
						data-hs-scrollspy-scrollable-parent="#scrollspy-scrollable-parent-1"
						class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-start sm:mt-0 sm:ml-14 sm:pl-4 [--scrollspy-offset:220] max-w-[600px] md:[--scrollspy-offset:270] bg-white">
						<a class="text-sm leading-6 text-gray-700 hover:text-gray-500 dark:text-gray-400 dark:hover:text-gray-500 hs-scrollspy-active:text-harmony dark:hs-scrollspy-active:text-harmony active"
							href="#first">Overview</a>
						<a class="text-sm leading-6 text-gray-700 hover:text-gray-500 dark:text-gray-400 dark:hover:text-gray-500 hs-scrollspy-active:text-harmony dark:hs-scrollspy-active:text-harmony"
							href="#second">Open Locations</a>
						<a class="text-sm leading-6 text-gray-700 hover:text-gray-500 dark:text-gray-400 dark:hover:text-gray-500 hs-scrollspy-active:text-harmony dark:hs-scrollspy-active:text-harmony"
							href="#third">FAQ</a>
						<a class="text-sm leading-6 text-gray-700 hover:text-gray-500 dark:text-gray-400 dark:hover:text-gray-500 hs-scrollspy-active:text-harmony dark:hs-scrollspy-active:text-harmony"
							href="#fourth">SFH Piano Gallery</a>

					</div>
				</div>
			</nav>
		</div>

		<div id="scrollspy-1" class="mt-3 space-y-4">
			<div id="first">
				<?php include( 'pianos-content.php' ); ?>
				<?php include( 'pianos-donate.php' ); ?>
				<?php include( 'pianos-stats.php' ); ?>



			</div>

			<div id="second">
				<?php include( 'pianos-programs.php' ); ?>

			</div>


			<div id="third">
				<?php include( 'pianos-faq.php' ); ?>

			</div>

			<div id="fourth">
				<?php include( 'pianos-gallery.php' ); ?>


			</div>

		</div>


	</main>
</section>

<script>
	document.getElementById('search-bar').addEventListener('input', function (e) {
		const searchText = e.target.value;
		if (searchText.length >= 3) {
			fetch('/wp-admin/admin-ajax.php', {
				method: 'POST',
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				body: `action=get_pianos&search_text=${searchText}`
			})
				.then(response => response.text())
				.then(data => document.getElementById('pianos-list').innerHTML = data);
		}
	});


	$('a[href*="#"]').on('click', function (e) {
		e.preventDefault();

		$('html, body').animate(
			{
				scrollTop: $($(this).attr('href')).offset().top,
			},
			500,
			'linear'
		);
	});

	document.addEventListener('DOMContentLoaded', function () {
		let currentActive = null;

		const observer = new IntersectionObserver(entries => {
			let mostVisible = entries.reduce((prev, curr) => curr.intersectionRatio > prev.intersectionRatio ? curr : prev);

			if (mostVisible.target !== currentActive) {
				if (currentActive) {
					document.querySelector(`div a[href="#${currentActive.getAttribute('id')}"]`).classList.remove('hs-scrollspy-active');
				}
				currentActive = mostVisible.target;
				document.querySelector(`div a[href="#${currentActive.getAttribute('id')}"]`).classList.add('hs-scrollspy-active');
			}
		}, { threshold: [0] });

		// Track all sections that have an 'id' applied
		document.querySelectorAll('div[id]').forEach((div) => {
			observer.observe(div);
		});
	});





</script>

<?php
get_footer();
