<?php
namespace Barryvanveen\Pages\Commands;

use Barryvanveen\Pages\PageRepository;

class UpdatePageHandler
{
    /** @var PageRepository */
    private $pageRepository;

    /**
     * @param PageRepository $pageRepository
     *
     * @see UpdatePageCommand
     */
    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * Handle a command.
     *
     * @param UpdatePageCommand $command
     *
     * @return mixed
     */
    public function handle($command)
    {
        $page = $this->pageRepository->findAnyById($command->id);

        $page->title  = $command->title;
        $page->text   = $command->text;
        $page->online = $command->online;

        $this->pageRepository->save($page);
    }
}
