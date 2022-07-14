import { initResponsiveNavigation } from './theme/navigation.js';
import { initGoogleMaps } from './theme/gmaps.js';

document.addEventListener('DOMContentLoaded', function() {
	'use strict';
	// eslint-disable-next-line no-undef
	const $ = jQuery.noConflict();

	initResponsiveNavigation();
	initGoogleMaps($);
});
