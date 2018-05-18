window.Barryvanveen = window.Barryvanveen || {};

window.Barryvanveen.admin = function () {

    window.Barryvanveen.initClickableTableRows();
    window.Barryvanveen.initMarkdownEditors();
    window.Barryvanveen.initCharacterCounters();
    window.Barryvanveen.initLogModal();

};

/**
 * init clickable table rows
 */
window.Barryvanveen.initClickableTableRows = function () {

    $('.js-clickable-row').mousedown(function (e) {
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
 * turn an element into a markdown editor
 *
 * @param element
 */
window.Barryvanveen.MarkdownEditor = function (element) {

    var $input = $(element);
    var route = $input.data('markdown-route');
    var $preview = $('div[data-markdown-editor-name=' + element.name + ']');

    this.updateMarkdownEditor = window.Barryvanveen.debounce(function () {

        $.post(route, {markdown: $input.val()}, function (data) {

            $preview.html(data.html);
            Prism.highlightAll();

        }, 'json');

    }, 500);

    $input.keyup(this.updateMarkdownEditor);

    this.updateMarkdownEditor();

};

/**
 * init markdown editors
 */
window.Barryvanveen.initMarkdownEditors = function () {

    $('textarea.js-markdown-editor').each(function (index, element) {
        window.Barryvanveen.editor = new window.Barryvanveen.MarkdownEditor(element);
    });

};

/**
 * turn an element into a character counter
 *
 * @param element
 */
window.Barryvanveen.CharacterCounter = function (element) {

    var $counter = $(element);
    var inputname = $counter.data('character-counter-name');
    var $input = $('textarea[name="' + inputname + '"]');

    this.updateCounter = function () {
        $counter.html($input.val().length);
    };

    $input.keyup(this.updateCounter);

    this.updateCounter();

};

/**
 * init character counters
 */
window.Barryvanveen.initCharacterCounters = function () {

    $('.js-character-counter').each(function (index, element) {
        window.Barryvanveen.counter = new window.Barryvanveen.CharacterCounter(element);
    });

};


/**
 * init log table
 */
window.Barryvanveen.initLogModal = function () {

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

    });

};

/**
 * start scripts
 */
window.Barryvanveen.admin();