// Set the Preflight flag based on the build target.
const includePreflight = 'editor' === process.env._TW_TARGET ? false : true;

const Color = require('color');

module.exports = {
	darkMode: 'class',
	presets: [
		// Manage Tailwind Typography's configuration in a separate file.
		require('./tailwind-typography.config.js'),
	],
	content: [
		// Ensure changes to PHP files and `theme.json` trigger a rebuild.
		'./theme/**/*.php',
		'./theme/theme.json',
		'wp-content/themes/singforhope/node_modules/preline/dist/preline.js',
		'wp-content/themes/singforhope/node_modules/flowbite/**/*.js',
	],
	safelist: [
		'w-64',
		'w-1/2',
		'rounded-l-lg',
		'rounded-r-lg',
		'bg-gray-200',
		'grid-cols-4',
		'grid-cols-7',
		'h-6',
		'leading-6',
		'h-9',
		'leading-9',
		'shadow-lg',
	],
	theme: {
		// Extend the default Tailwind theme.
		extend: {
			transitionDelay: {
				0: '0ms',
				2000: '2000ms',
			},
			borderRadius: {
				DEFAULT: '8px',
			},
			colors: {
				harmony: '#339933',
				harmonylight: '#EFFEEF',
				harmonydark: '#226622',
				resonance: '#221F20',
				melody: '#DA4680',
				melodylight: '#FFEDF4',
				melodydark: '#932e54',
				rhythm: '#54749E',
				rhythmlight: '#EFF6FF',
				rhythmdark: '#38516a',
				sonata: '#FDD05E',
				sonatalight: '#FFF9EA',
				sonatadark: '#b38c41',
				symphony: '#3A3F42',
				symphonylight: '#F3F3F3',
				symphonydark: '#262829',
				lightbg: '#f9fafb',
			},
			fontFamily: {
				sans: [
					'Inter',
					'system-ui',
					'BlinkMacSystemFont',
					'-apple-system',
					'Segoe UI',
					'Roboto',
					'Helvetica Neue',
					'Arial',
					'Noto Sans',
					'sans-serif',
					'Apple Color Emoji',
					'Segoe UI Emoji',
					'Segoe UI Symbol',
					'Noto Color Emoji',
				],
				montserrat: [
					'Montserrat',
					'Georgia',
					'Cambria',
					'Times New Roman',
					'Times',
					'serif',
				],
			},
			minHeight: {
				'5px': '5px',
			},
			width: {
				82: '82px',
				72: '74px',
			},
		},
	},
	corePlugins: {
		// Disable Preflight base styles in builds targeting the editor.
		preflight: includePreflight,
	},
	plugins: [
		// Extract colors and widths from `theme.json`.
		require('@_tw/themejson')(require('../theme/theme.json')),

		// Add Tailwind Typography.
		require('@tailwindcss/typography'),

		// Uncomment below to add additional first-party Tailwind plugins.
		require('@tailwindcss/forms'),
		require('@tailwindcss/aspect-ratio'),
		require('@tailwindcss/container-queries'),

		require('preline/plugin'),

		require('flowbite/plugin'),
	],
};
