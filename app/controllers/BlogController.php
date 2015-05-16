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
     * display full-list of blog.
     *
     * @return View
     */
    public function index()
    {
        $blogs = $this->blogRepository->published();

        Head::title('Blog');
        Head::description('Een blog van Barry van Veen over programmeren, PHP, Laravel Framework en aanverwante zaken
        .');

        return View::make('blog.full-list', compact('blogs'));
    }

    /**
     * edit blog item.
     *
     * @return mixed
     */
    public function show($slug)
    {
        $blog = $this->blogRepository->findPublishedBySlug($slug);

        // redirect to url with valid slug
        if ($slug !== $blog->slug) {
            return Redirect::route('blog-item', ['blog' => $blog->slug], 301);
        }

        Head::title($blog->title);
        Head::description($blog->summary);

        return View::make('blog.item', compact('blog'));
    }
}
