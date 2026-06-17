/* IUVENTA theme — small front-end interactions. */
(function () {
	'use strict';

	// Mobile navigation toggle.
	var toggle = document.querySelector('.nav-toggle');
	var nav = document.querySelector('.main-nav');
	if (toggle && nav) {
		toggle.addEventListener('click', function () {
			var open = nav.classList.toggle('is-open');
			toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
		});
		nav.querySelectorAll('a').forEach(function (link) {
			link.addEventListener('click', function () {
				nav.classList.remove('is-open');
				toggle.setAttribute('aria-expanded', 'false');
			});
		});
	}

	// FAQ accordion: keep only one item open at a time.
	var faqItems = document.querySelectorAll('.faq-item');
	faqItems.forEach(function (item) {
		item.addEventListener('toggle', function () {
			if (item.open) {
				faqItems.forEach(function (other) {
					if (other !== item) { other.open = false; }
				});
			}
		});
	});

	// If the lead form was just submitted, scroll the result into view.
	if (window.location.hash === '#contact' && /[?&]lead=/.test(window.location.search)) {
		var contact = document.getElementById('contact');
		if (contact) {
			setTimeout(function () { contact.scrollIntoView({ behavior: 'smooth' }); }, 100);
		}
	}
})();
