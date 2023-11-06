<!-- Main container -->
<div class="flex-grow bg-white border border-gray-200 rounded p-5 mt-6 flex flex-col ">

	<!-- Title and description section -->
	<div class="flex-grow ">
		<h1 class="text-base font-semibold leading-6 text-gray-900">Adjudication</h1>
		<p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email
			and role.</p>
	</div>

	<!-- Status section -->
	<div class="flex-grow border-b border-gray-200 pb-6">
		<div>
			<h4 class="sr-only">Status</h4>
			<div class="mt-3" aria-hidden="true">
				<div class="overflow-hidden rounded-full bg-gray-200">
					<!-- Progress bar -->
					<div class="h-2 rounded-full bg-harmony" style="width: 37.5%"></div>
				</div>
				<!-- Status steps -->
				<div class="mt-3 hidden grid-cols-4 text-xs font-medium text-gray-600 sm:grid">
					<div class="text-harmony">Invite Adjudicators</div>
					<div class="text-center text-harmony">Onboard Adjudicators</div>
					<div class="text-center">Adjudication Period</div>
					<div class="text-right">Results</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Adjudicators and Ratings sections -->
	<div class="flex-grow mt-8 flex">

		<!-- Adjudicators section -->
		<div class="w-1/2 bg-white pr-6 border-r border-gray-200">
			<h4 class="text-base font-semibold leading-6 text-gray-900 text-sm">Adjudicators</h4>
			<!-- Adjudicators list -->
			<ul role="list" class="divide-y divide-gray-100">
				<?php if ( have_rows( 'invited_adjudicators' ) ) : ?>
					<?php while ( have_rows( 'invited_adjudicators' ) ) :
						the_row();
						// Get sub field values.
						$adjudicator_name = get_sub_field( 'adjudicator_name' );
						$adjudicator_email = get_sub_field( 'adjudicator_email' );
						?>
						<!-- Single adjudicator item -->
						<li class="relative flex justify-between gap-x-6  py-5 hover:bg-gray-50">
							<!-- Adjudicator details -->
							<div class="flex min-w-0 gap-x-4">
								<img class="h-12 w-12 flex-none rounded-full bg-gray-50"
									src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
									alt="">
								<div class="min-w-0 flex-auto">
									<p class="text-sm font-semibold leading-6 text-gray-900">
										<a href="#">
											<span class="absolute inset-x-0 -top-px bottom-0"></span>
											<?php echo $adjudicator_name; ?>
										</a>
									</p>
									<p class="mt-1 flex text-xs leading-5 text-gray-500">
										<a href="mailto:<?php echo $adjudicator_email; ?>"
											class="relative truncate hover:underline">
											<?php echo $adjudicator_email; ?>
										</a>
									</p>
								</div>
							</div>
							<!-- Adjudicator additional info -->
							<div class="flex shrink-0 items-center gap-x-4">
								<div class="hidden sm:flex sm:flex-col sm:items-end">
									<p class="text-sm leading-6 text-gray-900">Co-Founder / CEO</p>
									<p class="mt-1 text-xs leading-5 text-gray-500">Last seen <time
											datetime="2023-01-23T13:23Z">3h ago</time></p>
								</div>
								<!-- Arrow icon -->
								<svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor"
									aria-hidden="true">
									<path fill-rule="evenodd"
										d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
										clip-rule="evenodd" />
								</svg>
							</div>
						</li>
					<?php endwhile; ?>
				<?php endif; ?>
			</ul>
		</div>


		<!-- Ratings section -->
		<div class="w-1/2 bg-white p-2 pl-6">
			<h4 class="text-base font-semibold leading-6 text-gray-900 text-sm">Adjudication Ratings</h4>
			<!-- Ratings list -->
			<ul role="list" class="divide-y divide-gray-100">
				<!-- Single rating item -->
				<li class="flex flex-wrap items-center justify-between gap-x-3 gap-y-2 py-5 sm:flex-nowrap">
					<!-- Rating details -->
					<div class="">
						<p class="text-sm font-semibold leading-6 text-gray-900">
							<a href="#" class="hover:underline">Artist Design</a>
						</p>
						<div class="mt-0 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
							<p>
								<a href="#" class="hover:underline">Leslie Alexander</a>
							</p>
							<!-- Divider -->
							<svg viewBox="0 0 2 2" class="h-0.5 w-0.5 fill-current">
								<circle cx="1" cy="1" r="1" />
							</svg>
							<p><time datetime="2023-01-23T22:34Z">2d ago</time></p>
						</div>
					</div>
					<!-- Rating value and commenters -->
					<dl class="flex w-full flex-none justify-between gap-x-4 sm:w-auto">
						<!-- Commenters avatars -->
						<div class="flex -space-x-0.5">
							<dt class="sr-only">Commenters</dt>
							<dd>
								<img class="h-6 w-6 rounded-full bg-gray-50 ring-2 ring-white"
									src="https://images.unsplash.com/photo-1505840717430-882ce147ef2d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
									alt="Emma Dorsey">
							</dd>
							<!-- Other commenters avatars... -->
						</div>
						<!-- Rating stars and value -->
						<div class="flex w-16 gap-x-2.5">
							<div class="flex items-center">
								<!-- Stars icons... -->
							</div>
							<dd class="text-sm leading-6 text-gray-900">4.5</dd>
						</div>
					</dl>
				</li>
			</ul>
		</div>
	</div>
</div>