<?php

namespace Barryvanveen\Jobs\Pages;

use Barryvanveen\Pages\Page;
use Barryvanveen\Pages\PageRepository;

class CreatePage
{
    public $title;
    public $text;
    public $online;

    /**
     * @param $title
     * @param $text
     * @param $online
     */
    public function __construct($title, $text, $online)
    {
        $this->title = $title;
        $this->text = $text;
        $this->online = $online;
    }

    /**
     * Handle a command.
     *
     * @param PageRepository $pageRepository
     *
     * @return void
     */
    public function handle(PageRepository $pageRepository)
    {
        $page = new Page();

        $page->title = $this->title;
        $page->text = $this->text;
        $page->online = $this->online;

        $pageRepository->save($page);
    }
}
