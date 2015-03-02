window.Barryvanveen = window.Barryvanveen || {};

$('document').ready(function(){

	window.Barryvanveen.smoothScrollToHash();
	window.Barryvanveen.initScrollUp();
	window.Barryvanveen.initClickableTableRows();
    window.Barryvanveen.initAutosizeTextareas();
	window.Barryvanveen.initMarkdownEditors();

});


/**
 * zet eventlisteners om geanimeerd te scrollen naar een anchor-link
 */
window.Barryvanveen.smoothScrollToHash = function() {

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
		 scrollText: 'Terug naar boven', // Text for element, can contain HTML
		 scrollTitle: false,          	// Set a custom <a> title if required.
		 scrollImg: false,            	// Set true to use image
		 activeOverlay: false,      	// Set CSS color to display scrollUp active point, e.g '#00FFFF'
		 zIndex: 2147483647           	// Z-Index for the overlay
	 });

};


/**
 * init clickable table rows
 */
window.Barryvanveen.initClickableTableRows = function() {

    $('.js-clickable-row').mousedown(function(e) {
        e.preventDefault();
        // middle mouseclick, open in new window
        if (e.which == 2) {
            var win = window.open($(this).data('href'), '_blank');
            if (win) {
                win.focus();
            }
            return;
        }
        window.document.location = $(this).data("href");
    });

};


/**
 * init autosize on textareas
 */
window.Barryvanveen.initAutosizeTextareas = function() {

    autosize($('textarea'));

};



/**
 * turn an element into a markdown editor
 *
 * @param element
 */
window.Barryvanveen.MarkdownEditor = function(element) {

    var $input = $(element);
    var $preview = $('div[data-markdown-editor-name=' + element.name + ']');

    this.updateMarkdownEditor = function () {
        $preview.html(markdown.toHTML($input.val()));
    };

    $input.keyup(this.updateMarkdownEditor);

    this.updateMarkdownEditor();

};


/**
 * init markdown editors
 */
window.Barryvanveen.initMarkdownEditors = function() {

    $('textarea.js-markdown-editor').each(function(index, element) {
        window.Barryvanveen.editor = new window.Barryvanveen.MarkdownEditor(element);
    });

};