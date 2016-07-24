window.Barryvanveen = window.Barryvanveen || {};

window.Barryvanveen.main = function() {
	window.Barryvanveen.smoothScrollToHash();
	window.Barryvanveen.initScrollUp();
	window.Barryvanveen.initSubmitCommentListener();
	window.Barryvanveen.initGameoflife();

	Prism.highlightAll();

};

/**
 * set event listeners for smooth scrolling to an anchor link
 */
window.Barryvanveen.smoothScrollToHash = function() {

	// listen to clicks that go to an anchor
	$('a[href*=#]:not([href=#]):not([noscroll])').click(function() {

		// if this is not an outgoing link
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {

			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');

			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top
				}, 500);
				return false;
			}
		}
	});

	// do not animate when we use the noscroll directive
	$('a[href*=#][noscroll]').click(function(e){
		location.hash = $(this).attr('href');
		window.scrollTo(0, 0);

		e.preventDefault();
	});

};

/**
 * init scroll-to-top button with scrollup-plugin
 */
window.Barryvanveen.initScrollUp = function() {

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
		 scrollText: 'Back to top',     // Text for element, can contain HTML
		 scrollTitle: false,          	// Set a custom <a> title if required.
		 scrollImg: false,            	// Set true to use image
		 activeOverlay: false,      	// Set CSS color to display scrollUp active point, e.g '#00FFFF'
		 zIndex: 2147483647           	// Z-Index for the overlay
	 });

};

window.Barryvanveen.initSubmitCommentListener = function() {

	$(".js-submit-comment").click(function() {
		window.Barryvanveen.setHash();
	});

};

window.Barryvanveen.setHash = function() {

	var $hashField = $("input[name='_hash']");

	try {
		new Fingerprint2().get(function(result){
			$hashField.val(result);
		});
	} catch(err) {
		$hashField.val(err);
	}

};

window.Barryvanveen.initGameoflife = function() {

	if ($("#gameoflife_canvas").length == 0) {
		return;
	}

	LazyLoad.js('dist/js/gameoflife.js', window.Barryvanveen.startGameoflife);
	
};

window.Barryvanveen.startGameoflife = function() {

	window.Barryvanveen.gameoflife = new GameOfLife({
		num_cols: 111,
		num_rows: 51,
		cell_size: 5,
		color_cell_alive: '#4582ec'
	});

	$('.js-gameoflife-start').click(function() {window.Barryvanveen.gameoflife.start();});
	$('.js-gameoflife-step').click(function() {window.Barryvanveen.gameoflife.step();});
	$('.js-gameoflife-stop').click(function() {window.Barryvanveen.gameoflife.stop();});
	$('.js-gameoflife-reset').click(function() {window.Barryvanveen.gameoflife.reset();});
	$('.js-gameoflife-gun').click(function() {window.Barryvanveen.gameoflife.setState([
			{col: 1, row: 21},
			{col: 1, row: 22},
			{col: 2, row: 21},
			{col: 2, row: 22},
			{col: 11, row: 21},
			{col: 11, row: 22},
			{col: 11, row: 23},
			{col: 12, row: 20},
			{col: 12, row: 24},
			{col: 13, row: 19},
			{col: 13, row: 25},
			{col: 14, row: 19},
			{col: 14, row: 25},
			{col: 15, row: 22},
			{col: 16, row: 20},
			{col: 16, row: 24},
			{col: 17, row: 21},
			{col: 17, row: 22},
			{col: 17, row: 23},
			{col: 18, row: 22},
			{col: 21, row: 19},
			{col: 21, row: 20},
			{col: 21, row: 21},
			{col: 22, row: 19},
			{col: 22, row: 20},
			{col: 22, row: 21},
			{col: 23, row: 18},
			{col: 23, row: 22},
			{col: 25, row: 17},
			{col: 25, row: 18},
			{col: 25, row: 22},
			{col: 25, row: 23},
			{col: 35, row: 19},
			{col: 35, row: 20},
			{col: 36, row: 19},
			{col: 36, row: 20}
		]);
	});

};

/**
 * start scripts
 */
window.Barryvanveen.main();