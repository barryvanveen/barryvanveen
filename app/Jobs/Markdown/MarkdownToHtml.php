<?php

namespace Barryvanveen\Jobs\Markdown;

use cebe\markdown\GithubMarkdown;

class MarkdownToHtml
{
    public $markdown;

    /**
     * @param $markdown
     */
    public function __construct($markdown)
    {
        $this->markdown = $markdown;
    }

    /**
     * Handle the command.
     *
     * @param GithubMarkdown $parser
     *
     * @return string
     */
    public function handle(GithubMarkdown $parser)
    {
        $parser->html5 = true;
        $parser->keepListStartNumber = true;
        $parser->enableNewlines = true; // only available for GithubMarkdown
        return $parser->parse($this->markdown);
    }
}
