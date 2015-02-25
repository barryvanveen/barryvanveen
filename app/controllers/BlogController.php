<?php

use Barryvanveen\Blogs\BlogRepository;

class BlogController extends BaseController
{
    /**
     * @var BlogRepository
     */
    private $blogRepository;

    /**
     * @param BlogRepository $blogRepository
     */
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    /**
     * display full-list of blog
     *
     * @return View
     */
    public function index()
    {
        $blogs = $this->blogRepository->pastAndOnline();

        Head::title('Blog');

        return View::make('blog.full-list', compact('blogs'));
    }

    /**
     * display blog item
     *
     * @return mixed
     */
    public function show($slug)
    {
        $blog = $this->blogRepository->findBySlug($slug);

        Head::title($blog->title);

        return View::make('blog.item', compact('blog'));
    }
}
