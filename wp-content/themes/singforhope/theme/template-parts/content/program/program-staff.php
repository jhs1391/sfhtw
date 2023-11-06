<div id="staff">
	<div class="flex flex-row justify-end space-x-6 ">
		<div class="w-3/4 overflow-visible">
			<div class="border-b border-gray-200 dark:border-gray-700">
				<nav class="flex space-x-6" aria-label="Tabs" role="tablist">
					<button type="button"
						class="font-semibold hs-tab-active:border-harmony hs-tab-active:text-harmony py-4 px-1 inline-flex items-center gap-2 border-b-[3px] border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-harmony"
						id="tabs-with-underline-item-1" data-hs-tab="#tabs-with-underline-1"
						aria-controls="tabs-with-underline-1" role="tab">Summary</button>

					<button type="button"
						class="hs-tab-active:font-semibold hs-tab-active:border-harmony hs-tab-active:text-harmony py-4 px-1 inline-flex items-center gap-2 border-b-[3px] border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-harmony "
						id="tabs-with-underline-item-2" data-hs-tab="#tabs-with-underline-2"
						aria-controls="tabs-with-underline-2" role="tab">Artists</button>
					<button type="button"
						class="hs-tab-active:font-semibold hs-tab-active:border-harmony hs-tab-active:text-harmony py-4 px-1 inline-flex items-center gap-2 border-b-[3px] border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-harmony "
						id="tabs-with-underline-item-3" data-hs-tab="#tabs-with-underline-3"
						aria-controls="tabs-with-underline-3" role="tab">Studio</button>
					<button type="button"
						class="hs-tab-active:font-semibold hs-tab-active:border-harmony hs-tab-active:text-harmony py-4 px-1 inline-flex items-center gap-2 border-b-[3px] border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-harmony "
						id="tabs-with-underline-item-4" data-hs-tab="#tabs-with-underline-4"
						aria-controls="tabs-with-underline-4" role="tab">Pianos</button>
					<button type="button"
						class="hs-tab-active:font-semibold hs-tab-active:border-harmony hs-tab-active:text-harmony py-4 px-1 inline-flex items-center gap-2 border-b-[3px] border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-harmony "
						id="tabs-with-underline-item-5" data-hs-tab="#tabs-with-underline-5"
						aria-controls="tabs-with-underline-5" role="tab">Public</button>
					<button type="button"
						class="hs-tab-active:font-semibold hs-tab-active:border-harmony hs-tab-active:text-harmony py-4 px-1 inline-flex items-center gap-2 border-b-[3px] border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-harmony "
						id="tabs-with-underline-item-6" data-hs-tab="#tabs-with-underline-6"
						aria-controls="tabs-with-underline-6" role="tab">Donation</button>
					<button type="button"
						class="hs-tab-active:font-semibold hs-tab-active:border-harmony hs-tab-active:text-harmony py-4 px-1 inline-flex items-center gap-2 border-b-[3px] border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-harmony "
						id="tabs-with-underline-item-7" data-hs-tab="#tabs-with-underline-7"
						aria-controls="tabs-with-underline-7" role="tab">Content</button>
				</nav>
			</div>

			<div class="mt-3">
				<div id="tabs-with-underline-1" role="tabpanel" aria-labelledby="tabs-with-underline-item-1">
					<?php include( 'program-summary.php' ); ?>
				</div>

				<div id="tabs-with-underline-2" role="tabpanel" aria-labelledby="tabs-with-underline-item-2"
					class="hidden">
					<?php include( 'program-artists.php' ); ?>
				</div>
				<div id="tabs-with-underline-3" role="tabpanel" aria-labelledby="tabs-with-underline-item-3"
					class="hidden">
					<?php include( 'program-studio.php' ); ?>
				</div>
				<div id="tabs-with-underline-4" role="tabpanel" aria-labelledby="tabs-with-underline-item-4"
					class="hidden">
					<?php include( 'program-pianos.php' ); ?>
				</div>
				<div id="tabs-with-underline-5" role="tabpanel" aria-labelledby="tabs-with-underline-item-5"
					class="hidden">
					<?php include( 'program-public.php' ); ?>
				</div>
				<div id="tabs-with-underline-6" role="tabpanel" aria-labelledby="tabs-with-underline-item-6"
					class="hidden">
					<?php include( 'program-donation.php' ); ?>
				</div>
				<div id="tabs-with-underline-7" role="tabpanel" aria-labelledby="tabs-with-underline-item-7"
					class="hidden">
					<?php include( 'program-content.php' ); ?>
				</div>
			</div>
		</div>

		<div class="sticky top-0 w-1/4 p-6 pt-4 -mt-10 border border-gray-100 rounded bg-gray-50">
			<?php include 'program-timeline.php'; ?>
		</div>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', () => {
		const tabs = document.querySelectorAll('[role="tab"]');
		let activeTabId = localStorage.getItem('activeTab');

		// If there's no active tab in localStorage, set the first one as active
		if (!activeTabId && tabs.length > 0) {
			activeTabId = tabs[0].id;
			localStorage.setItem('activeTab', activeTabId);
		}

		// Store current tab in localStorage on click
		tabs.forEach(tab => {
			tab.addEventListener('click', () => {
				// Remove active class from all tabs
				tabs.forEach(t => t.classList.remove('hs-tab-active'));

				// Add active class to clicked tab
				tab.classList.add('hs-tab-active');

				// Store current tab in localStorage
				localStorage.setItem('activeTab', tab.id);

				// Hide all tab panels
				document.querySelectorAll('[role="tabpanel"]').forEach(panel => {
					panel.classList.add('hidden');
				});

				// Show the associated tab panel
				var panelId = tab.getAttribute('data-hs-tab');
				var panel = document.querySelector(panelId);
				if (panel) {
					panel.classList.remove('hidden');
				}
			});

			// If this tab is the active tab, click it
			if (tab.id === activeTabId) {
				tab.click();
			}
		});

		// If this tab is the active tab, click it
		if (activeTabId) {
			document.getElementById(activeTabId).click();
		} else if (tabs.length > 0) {
			tabs[0].click(); // click the first tab if no active tab in local storage
		}

	});
</script>