<?php
/*
Template Name: Static App Dashboard Template
*/

get_header();
?>

<div class="pb-12">
	<div class="border-b border-gray-200 dark:border-gray-700">
		<nav class="flex px-8 space-x-6" aria-label="Tabs" role="tablist">
			<button type="button"
				class="hs-tab-active:font-semibold hs-tab-active:border-harmony hs-tab-active:text-harmony py-4 px-1 inline-flex items-center gap-2 border-b-[3px] border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-harmony "
				id="tabs-with-badges-item-1" data-hs-tab="#tabs-with-badges-1" aria-controls="tabs-with-badges-1"
				role="tab">
				Dashboard
			</button>
			<button type="button"
				class="hs-tab-active:font-semibold hs-tab-active:border-harmony hs-tab-active:text-harmony py-4 px-1 inline-flex items-center gap-2 border-b-[3px] border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-harmony"
				id="tabs-with-badges-item-2" data-hs-tab="#tabs-with-badges-2" aria-controls="tabs-with-badges-2"
				role="tab">
				Pianos
			</button>
			<button type="button"
				class="hs-tab-active:font-semibold hs-tab-active:border-harmony hs-tab-active:text-harmony py-4 px-1 inline-flex items-center gap-2 border-b-[3px] border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-harmony"
				id="tabs-with-badges-item-3" data-hs-tab="#tabs-with-badges-3" aria-controls="tabs-with-badges-3"
				role="tab">
				Documentation
				<span
					class="inline px-2 py-1 text-xs font-semibold text-gray-500 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-400">v12.7</span>
			</button>
			<button type="button"
				class="hs-tab-active:font-semibold hs-tab-active:border-harmony hs-tab-active:text-harmony py-4 px-1 inline-flex items-center gap-2 border-b-[3px] border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-harmony"
				id="tabs-with-badges-item-4" data-hs-tab="#tabs-with-badges-4" aria-controls="tabs-with-badges-4"
				role="tab">
				Email
			</button>
		</nav>
	</div>

	<div class="px-8 mt-3">
		<div id="tabs-with-badges-1" role="tabpanel" aria-labelledby="tabs-with-badges-item-1">
			<?php include( 'dashboard.php' ); ?>
		</div>
		<div id="tabs-with-badges-2" class="hidden" role="tabpanel" aria-labelledby="tabs-with-badges-item-2">
			<?php include( 'pianos.php' ); ?>
		</div>
		<div id="tabs-with-badges-3" class="hidden" role="tabpanel" aria-labelledby="tabs-with-badges-item-3">
			<?php include( 'docs.php' ); ?>
		</div>
		<div id="tabs-with-badges-4" class="hidden" role="tabpanel" aria-labelledby="tabs-with-badges-item-4">
			<?php include( 'email.php' ); ?>
		</div>
	</div>

</div>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		// Get all tabs and panels
		const tabs = document.querySelectorAll('[role="tab"]');
		const panels = document.querySelectorAll('[role="tabpanel"]');

		// Check if there's an active tab in localStorage
		let activeTabId = localStorage.getItem('activeTab');

		if (activeTabId) {
			// Hide all panels
			panels.forEach(panel => panel.classList.add('hidden'));

			// Remove active class from all tabs
			tabs.forEach(tab => tab.classList.remove('font-semibold', 'border-harmony', 'text-harmony'));

			// Find the previously active tab and its corresponding panel
			const activeTab = document.querySelector(`[aria-controls="${activeTabId}"]`);
			const activePanel = document.getElementById(activeTabId);

			if (activeTab && activePanel) {
				// Show the active panel and add active class to the active tab
				activePanel.classList.remove('hidden');
				activeTab.classList.add('font-semibold', 'border-harmony', 'text-harmony');
			} else {
				console.error('Could not find elements for activeTabId:', activeTabId);
			}
		} else {
			console.log('No activeTabId in localStorage');
		}

		// Add click event listener to tabs
		tabs.forEach(tab => {
			tab.addEventListener('click', function () {
				// Store the clicked tab's aria-controls attribute in localStorage
				localStorage.setItem('activeTab', this.getAttribute('aria-controls'));
			});
		});
	});


</script>


<?php
get_footer();

