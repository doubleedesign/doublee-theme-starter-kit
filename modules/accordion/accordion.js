import Collapse from '../../common/js/vendor/bootstrap/collapse.js';

document.addEventListener('DOMContentLoaded', function() {
	initCollapse();
});

function initCollapse() {
	const collapseElementList = document.querySelectorAll('.collapse');
	collapseElementList.forEach(function(collapseEl) {
		const isInitiallyOpen = collapseEl.classList.contains('show');
		const collapse = new Collapse(collapseEl, {
			toggle: false, // Prevent automatic toggling on initialization
		});

		if (isInitiallyOpen) {
			collapse.show();
		}
	});
}
