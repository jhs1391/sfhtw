<?php
/*
Template Name: Static About Template
*/

get_header();
?>

<main>
	<?php include( 'about-header.php' ); ?>

	<div class="">
		<div x-data="{ openTab: window.location.hash ? Number(window.location.hash.replace('#', '')) : 1 }" class="p-6">
			<ul class="flex justify-center">
				<li class="-mb-px mr-1">
					<a :class="{ 'border-harmony text-harmony': openTab === 1 }"
						class="bg-white inline-block py-2 px-4 font-semibold cursor-pointer hover:text-harmony"
						@click="openTab = 1; window.location.hash = 1;">Overview</a>
				</li>
				<li class="mr-1">
					<a :class="{ 'border-harmony text-harmony': openTab === 2 }"
						class="bg-white inline-block py-2 px-4 font-semibold cursor-pointer hover:text-harmony"
						@click="openTab = 2; window.location.hash = 2;">Leadership</a>
				</li>
				<li class="mr-1">
					<a :class="{ 'border-harmony text-harmony': openTab === 3 }"
						class="bg-white inline-block py-2 px-4 font-semibold cursor-pointer hover:text-harmony"
						@click="openTab = 3; window.location.hash = 3;">Board</a>
				</li>
				<li class="mr-1">
					<a :class="{ 'border-harmony text-harmony': openTab === 4 }"
						class="bg-white inline-block py-2 px-4 font-semibold cursor-pointer hover:text-harmony"
						@click="openTab = 4; window.location.hash = 4;">Reports</a>
				</li>
			</ul>
			<div class="w-full pt-4">
				<div x-show="openTab === 1">
					<p class="text-gray-600">
						<?php include( 'about-content.php' ); ?>
					</p>
				</div>
				<div x-show="openTab === 2" style="display: none;">
					<p class="text-gray-600">
						<?php include( 'about-leadership.php' ); ?>
					</p>
				</div>
				<div x-show="openTab === 3" style="display: none;">
					<p class="text-gray-600">
						<?php include( 'about-board.php' ); ?>
					</p>
				</div>
				<div x-show="openTab === 4" style="display: none;">
					<p class="text-gray-600">
						<?php include( 'about-reports.php' ); ?>
					</p>
				</div>
			</div>
		</div>
	</div>


</main>

<?php
get_footer();
?>