<?php

use Barryvanveen\Blogs\BlogRepository;

class PagesController extends BaseController
{

    /** @var BlogRepository */
    protected $blogRepository;

    public function __construct(BlogRepository $blogRepository) {
        $this->blogRepository = $blogRepository;
    }

    public function home()
    {
        Head::title('Blog, projecten en persoonlijke website van Barry van Veen', false);

        $blogs = $this->blogRepository->latest();

        return View::make('pages.home', compact('blogs'));
    }

    public function overMij()
    {
        Head::title('Wie is Barry van Veen en hoe kun je contact met hem opnemen?', false);

        return View::make('pages.over-mij');
    }

    public function elements()
    {
        Head::title('Elements');

        return View::make('pages.elements');
    }
}
