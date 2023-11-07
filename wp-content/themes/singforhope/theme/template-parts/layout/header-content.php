<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sing_for_Hope
 */

?>

<?php
// Get current user data
$current_user = wp_get_current_user();
// Get user avatar from ACF field
$user_avatar = get_field( 'user_profile_picture', 'user_' . $current_user->ID );
?>

<div id="top-bar" class="sticky top-0 z-50 flex items-center justify-center text-white bg-resonance min-h-5px">
	<?php include( 'header/top-banner.php' ); ?>
</div>

<div id="main-nav" class="sticky z-50 bg-white shadow top-1">

	<div class="relative flex items-center justify-between px-1 sm:px-6 lg:px-6">

		<!-- Logo and Navigation -->
		<div class="flex items-center space-x-4 ">

			<!-- Logo -->
			<div class="z-[90] flex-shrink-0 -mt-1 -mb-1 z- w-82 aspect-square">
				<a id="logo-link" href="/">
					<img src="https://singforhope.org/logo" alt="Sing for Hope" class="">
				</a>
			</div>



			<!-- Nav links -->
			<nav class="w-full px-0 pl-2 mx-auto sm:flex sm:items-center sm:justify-between" aria-label="Global">
				<div class="flex items-center justify-between ">
					<div class=" sm:hidden">
						<button type="button"
							class="inline-flex items-center justify-center gap-2 p-2 text-sm font-medium text-gray-700 align-middle transition-all bg-white border rounded-md shadow-sm hs-collapse-toggle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-harmony"
							data-hs-collapse="#navbar-collapse-basic" aria-controls="navbar-collapse-basic"
							aria-label="Toggle navigation">
							<svg class="w-4 h-4 hs-collapse-open:hidden" width="16" height="16" fill="currentColor"
								viewBox="0 0 16 16">
								<path fill-rule="evenodd"
									d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
							</svg>
							<svg class="hidden w-4 h-4 hs-collapse-open:block" width="16" height="16"
								fill="currentColor" viewBox="0 0 16 16">
								<path
									d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
							</svg>
						</button>
					</div>
				</div>

				<div id="navbar-collapse-basic" class="hidden basis-full grow sm:block">
					<div class="flex flex-col gap-4 mt-5 sm:flex-row sm:items-center sm:justify-end sm:mt-0">

						<div
							class="hs-dropdown [--strategy:static] sm:[--strategy:fixed] [--adaptive:none] sm:[--trigger:hover] sm:py-4">

							<a class="text-sm text-gray-600 transition-all duration-500 cursor-pointer hover:text-harmony delay-2000"
								href="/about">
								About
							</a>

							<div class="
							hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[250ms] hs-dropdown-open:opacity-100 opacity-0 md:w-[505px] lg:w-[550px] hidden z-10 top-full left-8 overflow-hidden bg-white md:shadow-2xl rounded-lg before:absolute before:-top-5 before:left-0 before:w-full before:h-5
							">
								<div class="grid grid-cols-2 ">
									<div class="">
										<div class="flex flex-col px-3 py-6 md:px-6">
											<div class="space-y-4 ">
												<span class="mb-2 text-xs font-semibold text-gray-800 uppercase ">About
													us</span>

												<a class="flex text-gray-800 gap-x-4 hover:text-harmony" href="/about">

													<div class="grow">
														<p>Our Mission</p>
													</div>
												</a>

												<a class="flex text-gray-800 gap-x-4 hover:text-harmony"
													href="/about#leadership">

													<div class="grow">
														<p>Leadership</p>
													</div>
												</a>

												<a class="flex text-gray-800 gap-x-4 hover:text-harmony"
													href="/about#board">

													<div class="grow">
														<p>Board of Directors</p>
													</div>
												</a>

												<a class="flex text-gray-800 gap-x-4 hover:text-harmony"
													href="/about#reports">

													<div class="grow">
														<p>Annual Reports & Financials</p>
													</div>
												</a>

											</div>
										</div>
									</div>

									<div class="">
										<div class="flex flex-col p-6 bg-gray-50">
											<span class="text-xs font-semibold text-gray-800 uppercase ">Customer
												stories</span>
											<a class="mt-4 group" href="#">
												<div class=" aspect-w-16 aspect-h-9">
													<img class="object-cover w-full rounded-lg "
														src="http://sfhtw.local/wp-content/uploads/2023/11/53201127973_a16b7c365e_o-scaled.jpg"
														alt="Image Description">
												</div>
												<div class="mt-2 ">
													<p class="text-gray-800 ">Preline Projects has proved to be most
														efficient cloud based project tracking and bug tracking tool.
													</p>
													<p
														class="inline-flex items-center mt-3 text-sm font-semibold text-gray-800 gap-x-2">
														Learn more

													</p>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>

						<a class="text-sm text-gray-600 hover:text-harmony" href="/news">News</a>

						<a class="text-sm text-gray-600 hover:text-harmony" href="#">Jessney</a>
					</div>
				</div>
			</nav>

		</div>


		<!-- Icons -->
		<div class="flex space-x-1">

			<?php
			if ( is_user_logged_in() ) {
				$current_user = wp_get_current_user();
				$user_profile_picture = get_field( 'user_profile_picture', 'user_' . $current_user->ID );
				?>

				<div class="relative inline-flex pr-2 hs-dropdown">
					<button id="hs-dropdown-custom-trigger" type="button"
						class="inline-flex items-center justify-center gap-2 py-1 pl-1 pr-3 text-sm font-medium text-gray-700 align-middle transition-all bg-white border rounded-full shadow-sm hs-dropdown-toggle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-harmony">
						<img class="w-8 h-auto border rounded-full border-harmonylite"
							src="<?php echo $user_profile_picture; ?>" alt="<?php echo $current_user->user_firstname; ?>">
						<span class="
						text-gray-600 font-medium truncate max-w-[7.5rem] 
						">
							<?php echo $current_user->user_firstname; ?>
						</span>
						<svg class="hs-dropdown-open:rotate-180 w-2.5 h-2.5 text-gray-600" width="16" height="16"
							viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
								stroke="currentColor" stroke-width="2" stroke-linecap="round" />
						</svg>
					</button>


					<div class="
					hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-[15rem] bg-white shadow-md rounded-lg p-2 mt-2 
					" aria-labelledby="hs-dropdown-custom-trigger">
						<div class="px-5 py-3 -m-2 bg-gray-100 rounded-t-lg ">
							<p class="text-sm text-gray-500 ">
								Signed in as</p>
							<p class="text-sm font-medium text-gray-800 ">
								<?php echo $current_user->user_email; ?>
							</p>
						</div>
						<div class="py-3 ">
							<a class="
							flex items-center gap-x-3.5 py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500
							" href="/app">
								App
							</a>
						</div>
						<div class="py-2 first:pt-0 last:pb-0">
							<span class="
							block px-2 text-[.6rem] font-medium uppercase text-gray-400
							">
								Account
							</span>
							<a class="
							flex items-center gap-x-3.5 py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500
							" href="#">

								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 2500 2500"
									version="1.1">

								</svg>Settings
							</a>
							<a class="
							flex items-center gap-x-3.5 py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500
							" href="<?php echo wp_logout_url(); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 2500 2500"
									version="1.1">

								</svg>Logout
							</a>
						</div>
					</div>
				</div>
			<?php } else {
				?>

				<div class="">
					<button type="button" class="
						rounded-full bg-white px-4 py-2.5 text-sm font-semibold text-melody shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-melodydark transition ease-in duration-100
						" aria-current="" data-hs-overlay="#hs-modal-signin">
						Login</button>
				</div>
			<?php } ?>
			<div class="pr-1">
				<a href="/donate">
					<button type="button"
						class="rounded-full bg-melody px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-melodydark focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-melodydark">Donate</button>
				</a>
			</div>
		</div>
	</div>
</div>

<?php include( 'header/programs-nav.php' ); ?>



<script>

</script>