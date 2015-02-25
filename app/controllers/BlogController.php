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
        $blogs = $this->blogRepository->published();

        Head::title('Blog');

        return View::make('blog.full-list', compact('blogs'));
    }

    /**
     * edit blog item
     *
     * @return mixed
     */
    public function show($slug)
    {
        $blog = $this->blogRepository->findPublishedBySlug($slug);

        Head::title($blog->title);

        return View::make('blog.item', compact('blog'));
    }
}
