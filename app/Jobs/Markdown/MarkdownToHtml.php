<?php
namespace Barryvanveen\Jobs\Markdown;

use cebe\markdown\GithubMarkdown;
use Illuminate\Contracts\Bus\SelfHandling;

class MarkdownToHtml implements SelfHandling
{
    public $markdown;

    /**
     * @param $markdown
     *
     * @see MarkdownToHtmlCommandHandler
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
        $parser->html5               = true;
        $parser->keepListStartNumber = true;
        $parser->enableNewlines      = true; // only available for GithubMarkdown
        return $parser->parse($this->markdown);
    }
}
