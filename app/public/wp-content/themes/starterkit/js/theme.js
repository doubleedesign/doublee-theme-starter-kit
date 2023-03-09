// noinspection ES6UnusedImports
// eslint-disable-next-line no-unused-vars
import { animateIntoView } from '../node_modules/@doubleedesign/animate-into-view/dist/animate-into-view.js';
import { initDropdownMenu, initMobileMenu } from './theme/navigation.js';
// import { initGoogleMaps } from './theme/gmaps.js';

document.addEventListener('DOMContentLoaded', function() {
	'use strict';

	initMobileMenu();
	initDropdownMenu();
	// initGoogleMaps();
});
