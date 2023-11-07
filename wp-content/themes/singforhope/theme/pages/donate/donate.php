<?php
/*
Template Name: Static Donate Template
*/

get_header();

?>

<script>
	(function (f, u, n, r, a, i, s, e) { var data = { window: window, document: document, tag: "script", data: "funraise", orgId: f, uri: u, common: n, client: r, script: a }; var scripts; var funraiseScript; data.window[data.data] = data.window[data.data] || []; if (data.window[data.data].scriptIsLoading || data.window[data.data].scriptIsLoaded) return; data.window[data.data].loading = true; data.window[data.data].push("init", data); scripts = data.document.getElementsByTagName(data.tag)[0]; funraiseScript = data.document.createElement(data.tag); funraiseScript.async = true; funraiseScript.src = data.uri + data.common + data.script + "?orgId=" + data.orgId; scripts.parentNode.insertBefore(funraiseScript, scripts) })('e7e8612d-7928-4352-934e-95d5525e9d60', 'https://assets.funraise.io', '/widget/common/2.0', '/widget/client', '/inject-form.js');
</script>
<script>
	window.funraise.push('create', { form: 5413 }, {
		selector: '#fr-placed-form-container-5413',
		type: 'grow_contained',
	});
</script>



<section id="primary">
	<main id="main">

		<div class="flex overflow-auto scrollbar-hide whitespace-nowrap max-w-full">
			<img src="https://sfhmedia.nyc3.digitaloceanspaces.com/2022/04/IMG_9273-300x200.jpeg"
				class="h-48 w-1/4 object-cover" />
			<img src="https://sfhmedia.nyc3.digitaloceanspaces.com/2022/09/7drMYw3i-youth-corps-block1-1-300x200.jpeg"
				class="h-48 w-1/4 object-cover" />
			<img src="https://sfhmedia.nyc3.digitaloceanspaces.com/2022/09/dsc5785-2048x1356-1-300x199.jpeg"
				class="h-48 w-1/4 object-cover" />
			<img src="https://sfhmedia.nyc3.digitaloceanspaces.com/2022/09/nyu-langone-6-121515-1-2048x1356-1-300x199.jpeg"
				class="h-48 w-1/4 object-cover" />

		</div>


		<div class="p-8 flex">

			<div class="w-1/2 flex flex-col justify-center">
				<h3 class="text-2xl text-gray-800 font-bold  md:leading-tight lg:leading-tight dark:text-gray-200">We
					can't do it without you.</h3>
				<p>Please donate today and help us bring hope where it’s needed most. Every penny you donate goes to
					support our programming and the communities we serve.
				</p>
				<div class="border-b border-gray-200 px-4 dark:border-gray-700">
					<nav class="flex space-x-2" aria-label="Tabs" role="tablist">
						<button type="button"
							class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-2 border-b-[3px] border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-white active"
							id="basic-tabs-item-1" data-hs-tab="#basic-tabs-1" aria-controls="basic-tabs-1" role="tab">
							Credit/Debit or Apple Pay
						</button>
						<button type="button"
							class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-2 border-b-[3px] border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-white"
							id="basic-tabs-item-2" data-hs-tab="#basic-tabs-2" aria-controls="basic-tabs-2" role="tab">
							PayPal
						</button>

					</nav>
				</div>

				<div class="mt-3 p-4">
					<div id="basic-tabs-1" role="tabpanel" aria-labelledby="basic-tabs-item-1">
						<div id="fr-placed-form-container-5413" style="min-height: 816px;"></div>
					</div>
					<div id="basic-tabs-2" class="hidden" role="tabpanel" aria-labelledby="basic-tabs-item-2">
						<div id="donate-button-container" style="max-width: 180px;">

							<script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"
								data-uid-auto="03b4899b48_mdm6mzc6mdq"></script>
							<script>
								PayPal.Donation.Button({
									env: 'production',
									hosted_button_id: '6YWZCXLLFHUHS',
									image: {
										src: 'https://sfhmedia.nyc3.digitaloceanspaces.com/2022/09/paypal-donate-button.png',
										alt: 'Donate with PayPal button',
										title: 'PayPal - The safer, easier way to pay online!',
									}
								}).render('#donate-button');
							</script>
							<div id="donate-button"><img
									src="https://sfhmedia.nyc3.digitaloceanspaces.com/2022/09/paypal-donate-button.png"
									id="donate-button" style="cursor: pointer;"
									title="PayPal - The safer, easier way to pay online!"
									alt="Donate with PayPal button"></div>
						</div>
					</div>

				</div>

			</div>
			<div class="w-1/2 flex flex-col">
				<div class="rounded p-12 bg-gray-200">
					<h3 class="text-xl text-gray-800 font-bold  md:leading-tight lg:leading-tight dark:text-gray-200">
						Other
						ways to donate</h3>
					<h1
						class="text-3xl text-gray-800 font-bold md:text-4xl md:leading-tight lg:text-5xl lg:leading-tight dark:text-gray-200">
						Mail a Check</h1>
					<p>Please send your donation to:<br>
						Sing for Hope<br>
						c/o CliftonLarsonAllen LLP<br>
						50 Tice Boulevard, Suite 175<br>
						Woodcliff Lake, NJ 07677</p>
				</div>
			</div>
		</div>

	</main>
</section>


<?php
get_footer();