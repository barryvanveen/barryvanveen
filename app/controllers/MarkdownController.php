<?php

use Barryvanveen\Markdown\Commands\MarkdownToHtmlCommand;
use Flyingfoxx\CommandCenter\CommandBus;

class MarkdownController extends BaseController
{

    /** @var CommandBus $commandBus */
    protected $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function parse()
    {
        dd(Input::get('markdown'));

        $html = $this->commandBus->execute(
            new MarkdownToHtmlCommand(
                'asdasd'
            )
        );

    }
}
