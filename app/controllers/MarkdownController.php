<?php

use Barryvanveen\Markdown\Commands\MarkdownToHtmlCommand;
use Flyingfoxx\CommandCenter\CommandBus;

class MarkdownController extends BaseController
{
    /** @var CommandBus $commandBus */
    protected $commandBus;

    /**
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * Return json-object containing parsed html from the given markdown.
     */
    public function parse()
    {
        $html = $this->commandBus->execute(
            new MarkdownToHtmlCommand(
                Input::get('markdown', '')
            )
        );

        return Response::json(['html' => $html]);
    }
}
