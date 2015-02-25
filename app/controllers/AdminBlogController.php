<?php

use Barryvanveen\Blogs\BlogRepository;

class AdminBlogController extends BaseController
{
    /** @var BlogRepository */
    private $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index()
    {
        Head::title('Blog');

        $blogs = $this->blogRepository->all();

        return View::make('pages.admin.blog', compact('blogs'));
    }
}
