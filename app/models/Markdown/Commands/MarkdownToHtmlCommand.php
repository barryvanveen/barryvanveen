<?php namespace Barryvanveen\Markdown\Commands;

class MarkdownToHtmlCommand
{

    public $markdown;

    /**
     * @param $markdown
     *
     * @see MarkdownToHtmlHandler
     */
    function __construct($markdown)
    {
        $this->markdown = $markdown;
    }

}