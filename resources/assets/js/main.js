window.Barryvanveen = window.Barryvanveen || {};

window.Barryvanveen.main = function() {
	window.Barryvanveen.smoothScrollToHash();
	window.Barryvanveen.initScrollUp();
	window.Barryvanveen.initOutgoingLinkListeners();
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

/**
 * init listeners for outgoing links
 */
window.Barryvanveen.initOutgoingLinkListeners = function() {

    $(window).click(function(e) {
        // ignore clicks on all elements excepts links
        if (e.target.nodeName != 'A') {
            return;
        }

        // ignore clicks on links to this website
        if (e.target.href.indexOf(Barryvanveen.baseurl) == 0) {
            return;
        }

		if (typeof(ga) == "undefined") {
			return;
		}

        // track clicks to external websites
        ga('send', 'event', 'outbound', 'click', e.target.href, {'hitCallback':
            function () {
                // redirect if it was a normal mouseclick
                if (e.which == 1)  {
                    document.location = e.target.href;
                }
            }
        });
    });

};

window.Barryvanveen.initGameoflife = function() {

	if ($("#gameoflife_canvas").length == 0) {
		return;
	}

	LazyLoad.js('dist/js/gameoflife.min.js', window.Barryvanveen.startGameoflife);

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

};

/**
 * start scripts
 */
window.Barryvanveen.main();