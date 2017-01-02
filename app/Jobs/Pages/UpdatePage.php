<?php

namespace Barryvanveen\Jobs\Pages;

use Barryvanveen\Pages\PageRepository;

class UpdatePage
{
    public $id;
    public $title;
    public $text;
    public $online;

    /**
     * @param $id
     * @param $title
     * @param $text
     * @param $online
     */
    public function __construct($id, $title, $text, $online)
    {
        $this->id = $id;
        $this->title = $title;
        $this->text = $text;
        $this->online = $online;
    }

    /**
     * Handle a command.
     *
     * @param PageRepository $pageRepository
     */
    public function handle(PageRepository $pageRepository)
    {
        $page = $pageRepository->findAnyById($this->id);

        $page->title = $this->title;
        $page->text = $this->text;
        $page->online = $this->online;

        $pageRepository->save($page);
    }
}
