window.Barryvanveen = window.Barryvanveen || {};

$('document').ready(function(){

    // timers to keep track of ajax-calls that are scheduled
    window.Barryvanveen.callTimer = [];

	window.Barryvanveen.smoothScrollToHash();
	window.Barryvanveen.initScrollUp();
	window.Barryvanveen.initClickableTableRows();
    window.Barryvanveen.initAutosizeTextareas();
	window.Barryvanveen.initMarkdownEditors();
    window.Barryvanveen.initDatetimepickers();
    window.Barryvanveen.initLogModal();

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
 * cancel all posts to a named queue
 */
window.Barryvanveen.abortPostQueue = function(queue) {

    $.ajaxq.abort(queue);

};


/**
 * turn an element into a markdown editor
 *
 * @param element
 */
window.Barryvanveen.MarkdownEditor = function(element) {

    // store elements
    var $input = $(element);
    var $preview = $('div[data-markdown-editor-name=' + element.name + ']');
    var inputname = $input.attr('name');

    // update the html-preview
    this.updateMarkdownEditor = function () {

        // clear any timers for this inputname
        if (typeof(window.Barryvanveen.callTimer[inputname]) !== "undefined") {
            clearTimeout(window.Barryvanveen.callTimer[inputname]);
        }

        // start a timer for this particular input, once the timer runs out
        // the html will be requested from the server
        window.Barryvanveen.callTimer[inputname] = setTimeout(function() {

            // abort all pending requests for this input field
            Barryvanveen.abortPostQueue($input.attr('name'));

            // make a new ajax post to retrieve html for this markdown
            $.postq(inputname, Barryvanveen.markdownToHtmlRoute, {markdown: $input.val()}, function(data) {

                // update the preview with retrieved html
                $preview.html(data.html);

            }, 'json');

        }, 1000);

    };

    // update the html preview on keyUp
    $input.keyup(this.updateMarkdownEditor);

    // start with filling the preview
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


/**
 * init datetimepicker fields
 */
window.Barryvanveen.initDatetimepickers = function() {

    $('.js-datetimepicker').datetimepicker({
        locale: 'nl',
        icons: {
            time:       "icon icon--clock",
            date:       "icon icon--calendar",
            up:         "icon icon--arrowUp",
            down:       "icon icon--arrowDown",
            previous:   "icon icon--arrowLeft",
            next:       "icon icon--arrowRight"
        }
    });

};


/**
 * init log table
 */
window.Barryvanveen.initLogModal = function() {

    // handle clicks to open a bootstrap modal with full exception stack
    $('#logModal').on('show.bs.modal', function (event) {

        // Button that triggered the modal
        var button = $(event.relatedTarget);

        // Extract info from data-* attributes
        var level = button.data('level');
        var text = button.data('text');
        var file = button.data('file');
        var stack = button.data('stack');

        // Update the modal's content
        var modal = $(this);
        modal.find('.modal-title').html(level + ": " + text);
        modal.find('.modal-body').html("<small>In file " + file + "<br><br>" + stack + "</small>");

    })


};
