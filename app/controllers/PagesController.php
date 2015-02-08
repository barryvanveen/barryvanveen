<?php

use Barryvanveen\Blogs\BlogRepository;
use Carbon\Carbon;

class PagesController extends BaseController
{
    /** @var BlogRepository */
    protected $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
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
        Head::title('Over mij');

        $age           = Carbon::createFromDate(1987, 4, 16)->diffInYears();
        $workingAtSwis = Carbon::createFromDate(2013, 1, 14)->diffInYears();

        return View::make('pages.over-mij', compact('age', 'workingAtSwis'));
    }

    public function elements()
    {
        Head::title('Elements');

        return View::make('pages.elements');
    }
}
