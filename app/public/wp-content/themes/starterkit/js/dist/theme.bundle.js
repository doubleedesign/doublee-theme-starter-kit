function animateIntoView(settings) {
    const elements = document.querySelectorAll(settings.selector);
    const options = {
        threshold: settings.threshold ? settings.threshold : 0.75
    };
    const observer = new IntersectionObserver(function (entries) {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('aiv-visible');
                observer.unobserve(entry.target);
            }
        });
    }, options);
    [...elements].forEach(function (element) {
        // Detect if a custom selector has been passed in, and apply the relevant classes
        if (settings.selector !== '.animate-into-view') {
            element.classList.add('animate-into-view');
            if (settings.type) {
                element.classList.add(`aiv-${settings.type}`);
            }
            else {
                element.classList.add(`aiv-fadeIn`);
                console.warn(`No animation type specified for ${settings.selector}. Defaulted to fadeIn.`);
            }
        }
        observer.observe(element);
    });
}
// This is for the basic CSS and SCSS implementations
document.addEventListener('DOMContentLoaded', function () {
    animateIntoView({
        selector: '.animate-into-view',
        threshold: 0.75
    });
});

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

// noinspection ES6UnusedImports
// import { initGoogleMaps } from './theme/gmaps.js';

document.addEventListener('DOMContentLoaded', function() {

	initResponsiveNavigation();
	// initGoogleMaps();
});

//# sourceMappingURL=theme.bundle.js.map
