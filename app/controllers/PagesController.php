<?php

use Barryvanveen\Blogs\BlogRepository;
use Barryvanveen\Pages\PageRepository;

class PagesController extends BaseController
{
    /** @var PageRepository */
    protected $pageRepository;

    /** @var BlogRepository */
    private $blogRepository;

    /**
     * @param PageRepository $pageRepository
     * @param BlogRepository $blogRepository
     */
    public function __construct(PageRepository $pageRepository, BlogRepository $blogRepository)
    {
        $this->pageRepository = $pageRepository;
        $this->blogRepository = $blogRepository;
    }

    public function overMij()
    {
        $page = $this->pageRepository->findPublishedBySlug('over-mij');

        Head::title($page->title);
        Head::description($page->text);

        return View::make('pages.item', compact('page'));
    }

    public function boeken()
    {
        $page = $this->pageRepository->findPublishedBySlug('boeken-die-ik-heb-gelezen');

        Head::title($page->title);
        Head::description($page->text);

        return View::make('pages.item', compact('page'));
    }

}
