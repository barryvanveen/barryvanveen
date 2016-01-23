window.Barryvanveen = window.Barryvanveen || {};

window.Barryvanveen.main = function() {
	window.Barryvanveen.smoothScrollToHash();
	window.Barryvanveen.initScrollUp();
	window.Barryvanveen.initOutgoingLinkListeners();

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

        // track clicks to external websites
        ga('send', 'event', 'outbound', 'click', e.target.href, {'hitCallback':
            function () {
                document.location = e.target.href;
            }
        });
    });

};

/**
 * start scripts
 */
window.Barryvanveen.main();