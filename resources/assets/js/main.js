window.LaravelInstall = window.LaravelInstall || {};

$('document').ready(function(){

	window.LaravelInstall.smoothScrollToHash();
	window.LaravelInstall.initSnackbar();

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