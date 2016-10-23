window.Barryvanveen = window.Barryvanveen || {};

window.Barryvanveen.main = function() {
	window.Barryvanveen.initScrollToTop();
	window.Barryvanveen.initAutosizeTextareas();
	window.Barryvanveen.initFingerprint();
	window.Barryvanveen.initGameoflife();

	Prism.highlightAll();
};

/**
 * limit the amount of function calls
 *
 * copied from https://davidwalsh.name/javascript-debounce-function
 */
window.Barryvanveen.debounce = function debounce(func, wait, immediate) {
	var timeout;
	return function () {
		var context = this, args = arguments;
		var later = function () {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};
		var callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow) func.apply(context, args);
	};
};

/**
 * init scroll-to-top button with scrollup-plugin
 */
window.Barryvanveen.initScrollToTop = function() {

	$('a[href*=#top]').click(function() {
		$('html,body').animate({
			scrollTop: 0
		}, 400);
	});

	this.showBackToTopElement = window.Barryvanveen.debounce(function() {
		if ($(document).scrollTop() > 300) {
			$('.js-backtotop').addClass('backtotop--visible');
			return;
		}
		$('.js-backtotop').removeClass('backtotop--visible');
	}, 100);

	$(window).scroll(this.showBackToTopElement);

};

/**
 * init autosize on textareas
 */
window.Barryvanveen.initAutosizeTextareas = function() {

	autosize($('textarea'));

};

window.Barryvanveen.initFingerprint = function() {

	var $hashField = $("input[name='hash']");

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