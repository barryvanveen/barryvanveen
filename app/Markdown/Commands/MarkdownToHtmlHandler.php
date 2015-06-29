<?php
namespace Barryvanveen\Markdown\Commands;

use cebe\markdown\GithubMarkdown;
use Flyingfoxx\CommandCenter\CommandHandler;

class MarkdownToHtmlHandler implements CommandHandler
{
    protected $parser;

    /**
     * @param GithubMarkdown $parser
     *
     * @see MarkdownToHtmlCommand
     */
    public function __construct(GithubMarkdown $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Handle the command.
     *
     * @param MarkdownToHtmlCommand $command
     *
     * @return string
     */
    public function handle($command)
    {
        $this->parser->html5               = true;
        $this->parser->keepListStartNumber = true;
        $this->parser->enableNewlines      = true; // only available for GithubMarkdown
        return $this->parser->parse($command->markdown);
    }
}
