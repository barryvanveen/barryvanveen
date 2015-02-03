window.LaravelInstall = window.LaravelInstall || {};

$('document').ready(function(){

	window.LaravelInstall.smoothScrollToHash();
	window.LaravelInstall.initSnackbar();
	window.LaravelInstall.initScrollUp();

});


/**
 * zet eventlisteners om geanimeerd te scrollen naar een anchor-link
 */
window.LaravelInstall.smoothScrollToHash = function() {

	// luister naar clicks die naar een hash gaan
	$('a[href*=#]:not([href=#]):not([noscroll])').click(function() {
		// als we op hetzelfde domein blijven
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			// pak het element met de hash
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				// scroll naar het element met de hash
				$('html,body').animate({
					scrollTop: target.offset().top
				}, 500);
				return false;
			}
		}
	});

	$('a[href*=#][noscroll]').click(function(e){

		location.hash = $(this).attr('href');
		window.scrollTo(0, 0);

		e.preventDefault();
	});
};

/**
 * init snackbar-alerts
 */
window.LaravelInstall.initSnackbar = function() {
	if(typeof(LaravelInstall.alert) == 'undefined') {
		return;
	}

	var options =  {
		content: LaravelInstall.alert.message,
		style: 'alert-' + LaravelInstall.alert.level,
		timeout: 5000
	};

	$.snackbar(options);

};

/**
 * init scroll-to-top button with scrollup-plugin
 */
window.LaravelInstall.initScrollUp = function() {

     $.scrollUp({
		 scrollName: 'scrollUp',      	// Element ID
		 scrollDistance: 300,         	// Distance from top/bottom before showing element (px)
		 scrollFrom: 'top',           	// 'top' or 'bottom'
		 scrollSpeed: 300,            	// Speed back to top (ms)
		 easingType: 'linear',        	// Scroll to top easing (see http://easings.net/)
		 animation: 'fade',           	// Fade, slide, none
		 animationSpeed: 200,         	// Animation speed (ms)
		 scrollTrigger: false,        	// Set a custom triggering element. Can be an HTML string or jQuery object
		 scrollTarget: false,         	// Set a custom target element for scrolling to. Can be element or number
		 scrollText: 'Terug naar boven', // Text for element, can contain HTML
		 scrollTitle: false,          	// Set a custom <a> title if required.
		 scrollImg: false,            	// Set true to use image
		 activeOverlay: false,      	// Set CSS color to display scrollUp active point, e.g '#00FFFF'
		 zIndex: 2147483647           	// Z-Index for the overlay
	 });

};