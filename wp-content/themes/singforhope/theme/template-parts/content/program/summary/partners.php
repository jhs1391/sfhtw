<div class="flex justify-between">
	<h3>Partners</h3>
	<button type="button" class="inline-flex justify-center items-center gap-2 text-melody text-xs"
		data-hs-overlay="#hs-overlay-settings">
		Edit
	</button>
</div>

<div id="hs-overlay-settings"
	class="hs-overlay hs-overlay-open:translate-x-0 hidden translate-x-full fixed top-0 right-0 transition-all duration-300 transform h-full max-w-md w-full z-[60] bg-white border-l dark:bg-gray-800 dark:border-gray-700 overflow-y-auto"
	tabindex="-1">

	<div class="flex justify-between items-center py-3 px-4 border-b dark:border-gray-700">
		<h3 class="font-bold text-gray-800 dark:text-white">
			Edit Program Partners
		</h3>
		<button type="button"
			class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white text-sm dark:text-gray-500 dark:hover:text-gray-400 dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800"
			data-hs-overlay="#hs-overlay-settings">
			<span class="sr-only">Close modal</span>

		</button>
	</div>
	<div class="p-10">
		<p class="text-gray-800 dark:text-gray-400">
			<?php acfe_form( 'edit-piano-program-partners' ); ?>
		</p>
	</div>
</div>
<?php
$partners = get_field( 'program_partners' );
if ( $partners ) : ?>
	<ul role="list" class="mt-4 grid grid-cols-1 gap-2 sm:grid-cols-1 lg:grid-cols-1">
		<?php foreach ( $partners as $partner ) :
			$wp_user = new WP_User( $partner['ID'] );
			?>
			<li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white border border-gray-200">
				<div class="flex w-full items-center justify-between space-x-6 p-3">
					<div class="flex-1 truncate">
						<div class="flex items-center space-x-3">
							<h3 class="truncate text-sm font-medium text-gray-900">
								<?php echo esc_html( $partner['display_name'] ); ?>
							</h3>
							<?php if ( ! empty( $wp_user->roles ) ) :
								foreach ( $wp_user->roles as $role ) :
									$color = '';
									switch ( $role ) {
										case 'administrator':
										case 'staff':
											$color = 'harmony';
											break;
										case 'partner':
											$color = 'melody';
											break;
										case 'artist':
											$color = 'sonata';
											break;
									}
									if ( $color ) : ?>
										<span
											class="inline-flex flex-shrink-0 items-center rounded-full bg-white px-1.5 py-0.5 text-xs font-medium text-<?php echo $color; ?> ring-1 ring-inset ring-<?php echo $color; ?>">
											<?php echo ucfirst( $role ); ?>
										</span>
									<?php endif; endforeach; endif; ?>
						</div>
						<p class="mt-1 truncate text-sm text-gray-500">Regional Paradigm Technician</p>
					</div>
					<?php
					$user_profile_picture = get_field( 'user_profile_picture', 'user_' . $partner['ID'] );
					if ( $user_profile_picture ) : ?>
						<img class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300"
							src="<?php echo esc_url( $user_profile_picture ); ?>" alt="">
					<?php else : ?>
						<img class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300"
							src="<?php echo esc_url( get_avatar_url( $partner['ID'] ) ); ?>" alt="">
					<?php endif; ?>

				</div>

			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>

<!-- <?php acfe_form( 'edit-piano-program-partners' ); ?> -->