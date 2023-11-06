<?php
/**
 * Template part for displaying single programs
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sing_for_Hope
 */
?>

<?php
$view = isset( $_COOKIE['view'] ) ? $_COOKIE['view'] : 'Staff View';
?>

<style>
	#programs-nav {
		display: none;
	}
</style>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_user_logged_in() ) : ?>
		<div id="programnav" class="px-8 py-1 bg-gray-100 flex justify-between">
			<div>
				<ol class="py-1 flex items-center whitespace-nowrap min-w-0" aria-label="Breadcrumb">
					<li class="text-xs">
						<a class="flex items-center text-gray-500 hover:text-blue-600" href="/pianos">
							Pianos
							<svg class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400 dark:text-gray-600"
								width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
									stroke="currentColor" stroke-width="2" stroke-linecap="round" />
							</svg>
						</a>
					</li>
					<li class="text-xs">
						<div class="hs-dropdown relative inline-flex [--strategy:absolute]">
							<button id="hs-dropdown-left-but-right-on-lg" type="button"
								class="hs-dropdown-toggle flex items-center text-gray-500 hover:text-blue-600"
								onclick="toggleDropdown()">
								Programs
								<svg class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400 dark:text-gray-600"
									width="16" height="16" viewBox="0 0 16 16" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
										stroke="currentColor" stroke-width="2" stroke-linecap="round" />
								</svg>

							</button>

							<div id="dropdown-menu"
								class="hs-dropdown-menu hs-dropdown-open:opacity-100 w-72 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden z-10 transition-[margin,opacity] opacity-0 duration-300 mt-2 min-w-[15rem] bg-white shadow-md rounded-lg p-2 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700"
								aria-labelledby="hs-dropdown-left-but-right-on-lg">
								<?php
								$args = array(
									'post_type' => 'program',
									'posts_per_page' => -1 // get all posts
								);
								$programs = get_posts( $args );
								foreach ( $programs as $program ) {
									setup_postdata( $program );
									?>
									<a class="flex items-center gap-x-3.5 py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
										href="<?php echo get_permalink( $program->ID ); ?>">
										<?php echo get_the_title( $program->ID ); ?>
									</a>

									<?php
								}
								wp_reset_postdata();
								?>
							</div>


						</div>

					</li>
					<li class="text-xs font-semibold text-gray-800 truncate dark:text-gray-200" aria-current="page">
						<?php echo get_the_title(); ?>
					</li>
				</ol>

			</div>
			<div>
				<select id="viewSelect" onchange="setViewCookie()"
					class="py-1 px-2 pr-3 block w-[120px] z-50 border-gray-200 rounded-md text-xs focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
					<option <?php if ( $view == 'Staff View' )
						echo 'selected'; ?>>Staff View</option>
					<option <?php if ( $view == 'Partner View' )
						echo 'selected'; ?>>Partner View</option>
					<option <?php if ( $view == 'Public View' )
						echo 'selected'; ?>>Public View</option>
				</select>
			</div>
		</div>
	<?php endif; ?>

	<?php include 'program/program-hero.php'; ?>

	<div class=" px-8 pb-20 min-h-screen">
		<?php
		if ( ! is_user_logged_in() ) {
			include 'program/program-publicview.php';
		} elseif ( $view == 'Staff View' ) {
			include 'program/program-staff.php';
		} elseif ( $view == 'Partner View' ) {
			include 'program/program-partner.php';
		} else {
			include 'program/program-publicview.php';
		}
		?>
	</div>


</article>
<script>

	function setViewCookie() {
		var view = document.getElementById('viewSelect').value;
		document.cookie = "view=" + view + ";path=/";
		location.reload();
	}



	var dropdownButton = document.getElementById('hs-dropdown-left-but-right-on-lg');
	var dropdownMenu = document.getElementById('dropdown-menu');

	function toggleDropdown() {
		if (dropdownMenu.classList.contains('hidden')) {
			dropdownMenu.classList.remove('hidden');
			dropdownMenu.classList.add('block');
		} else {
			dropdownMenu.classList.add('hidden');
			dropdownMenu.classList.remove('block');
		}
	};

	// Add an event listener to the document
	document.addEventListener('click', function (event) {
		var isClickInsideButton = dropdownButton.contains(event.target);
		var isClickInsideMenu = dropdownMenu.contains(event.target);

		if (!isClickInsideButton && !isClickInsideMenu) {
			// The click was outside the dropdown button and menu, close it!
			dropdownMenu.classList.add('hidden');
			dropdownMenu.classList.remove('block');
		}
	});
</script>