<?php
namespace Barryvanveen\Pages\Commands;

use Barryvanveen\Pages\Page;
use Barryvanveen\Pages\PageRepository;
use Flyingfoxx\CommandCenter\CommandHandler;

class CreatePageHandler implements CommandHandler
{
    /** @var PageRepository */
    private $pageRepository;

    /**
     * @param PageRepository $pageRepository
     *
     * @see CreatePageCommand
     */
    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * Handle a command.
     *
     * @param CreatePageCommand $command
     *
     * @return mixed
     */
    public function handle($command)
    {
        $page = new Page();

        $page->title  = $command->title;
        $page->text   = $command->text;
        $page->online = $command->online;

        $this->pageRepository->save($page);
    }
}
