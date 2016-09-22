<?php

namespace Barryvanveen\Http\Controllers\Admin;

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Blogs\BlogRepository;
use Barryvanveen\Http\Controllers\Controller;
use Barryvanveen\Jobs\Blogs\CreateBlog;
use Barryvanveen\Jobs\Blogs\UpdateBlog;
use Flash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Redirect;
use View;

class AdminBlogController extends Controller
{
    /** @var BlogRepository */
    private $blogRepository;

    /** @var Request */
    private $request;

    /** @var array */
    private $rules = [
        'title'            => 'required',
        'summary'          => 'required',
        'text'             => 'required',
        'publication_date' => 'required',
        'online'           => 'required',
    ];

    /** @var array */
    private $messages;

    /**
     * @param BlogRepository $blogRepository
     * @param Request        $request
     */
    public function __construct(BlogRepository $blogRepository, Request $request)
    {
        $this->blogRepository = $blogRepository;
        $this->request = $request;

        $this->messages = [
            'title.required'            => trans('validation.title-required'),
            'summary.required'          => trans('validation.summary-required'),
            'text.required'             => trans('validation.text-required'),
            'publication_date.required' => trans('validation.publication-date-required'),
            'online.required'           => trans('validation.online-required'),
        ];

        parent::__construct();
    }

    /**
     * Return all blogs.
     *
     * @return View
     */
    public function index()
    {
        $this->setPageTitle(trans('meta.pagetitle-admin-blog'));

        $blogs = $this->blogRepository->all();

        return View::make('blog.admin.index', compact('blogs'));
    }

    /**
     * Create blogpost.
     *
     * @return View
     */
    public function create()
    {
        $this->setPageTitle(trans('meta.pagetitle-admin-blog-create'));

        // empty blog to populate form
        $blog = new Blog();

        return View::make('blog.admin.create', compact('blog'));
    }

    /**
     * Store a new blogpost.
     *
     * @return View
     */
    public function store()
    {
        $this->validate($this->request,  $this->rules, $this->messages);

        $this->dispatch(
            new CreateBlog(
                $this->request->get('title'),
                $this->request->get('summary'),
                $this->request->get('text'),
                $this->request->get('publication_date'),
                $this->request->get('online')
            )
        );

        Flash::success(trans('flash.blog-created'));

        return Redirect::route('admin.blog');
    }

    /**
     * Edit blogpost by its id.
     *
     * @param $id
     *
     * @return View
     */
    public function edit($id)
    {
        $this->setPageTitle(trans('meta.pagetitle-admin-blog-edit'));

        $blog = $this->blogRepository->findAnyById($id);

        return View::make('blog.admin.edit', compact('blog'));
    }

    /**
     * Update blogpost with posted data.
     *
     * @param $id
     *
     * @return RedirectResponse
     */
    public function update($id)
    {
        $this->validate($this->request,  $this->rules, $this->messages);

        $this->dispatch(
            new UpdateBlog(
                $id,
                $this->request->get('title'),
                $this->request->get('summary'),
                $this->request->get('text'),
                $this->request->get('publication_date'),
                $this->request->get('online')
            )
        );

        Flash::success(trans('flash.blog-updated'));

        return Redirect::route('admin.blog');
    }
}
