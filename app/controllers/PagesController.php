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

    public function home()
    {
        Head::title('Home');

        $blogs = $this->blogRepository->latest();

        return View::make('pages.home', compact('blogs'));
    }

    public function overMij()
    {
        $page = $this->pageRepository->findPublishedBySlug('over-mij');

        Head::title($page->title);

        // todo: replace placeholders in html with these values
        /*
        $age           = Carbon::createFromDate(1987, 4, 16)->diffInYears();
        $workingAtSwis = Carbon::createFromDate(2013, 1, 14)->diffInYears();
        */

        return View::make('pages.item', compact('page'));
    }

    public function elements()
    {
        Head::title('Elements');

        return View::make('pages.elements');
    }
}
