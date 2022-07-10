function initResponsiveNavigation() {
	const menu = document.querySelector('.site-header__nav');
	const button = document.getElementById('header-menu-button');
	const overlay = document.querySelector('.site-overlay');

	// Return early if the navigation doesn't exist.
	if ((! menu) || ('undefined' === typeof button)) {
		return;
	}

	button.addEventListener('click', function() {
		toggleMenu();
		toggleOverlay();
	});

	overlay.addEventListener('click', function() {
		toggleMenu();
		toggleOverlay();
	});

	function toggleMenu() {
		menu.classList.toggle('site-header__nav--open');
		if (button.getAttribute('aria-expanded') === 'true') {
			button.setAttribute('aria-expanded', 'false');
			button.querySelector('.fa-bars').style.display = 'block';
			button.querySelector('.fa-times').style.display = 'none';
		} else {
			button.setAttribute('aria-expanded', 'true');
			button.querySelector('.fa-bars').style.display = 'none';
			button.querySelector('.fa-times').style.display = 'block';
		}
	}

	function toggleOverlay() {
		overlay.classList.toggle('site-overlay--open');
	}
}

document.addEventListener('DOMContentLoaded', function() {
	// const $ = jQuery.noConflict();

	initResponsiveNavigation();
});
