<?php
namespace Barryvanveen\Http\Controllers;

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Blogs\BlogRepository;
use Barryvanveen\Comments\Comment;
use Barryvanveen\Http\Requests\CreateCommentRequest;
use Barryvanveen\Jobs\Blogs\GetBlogRssXml;
use Barryvanveen\Jobs\Comments\CreateComment;
use Barryvanveen\Jobs\Markdown\MarkdownToHtml;
use Barryvanveen\Pagination\SimplePaginatorPresenter;
use Flash;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Redirect;
use Request;
use Response;
use View;

class BlogController extends Controller
{
    use ValidatesRequests;

    /** @var BlogRepository */
    private $blogRepository;

    /**
     * @param BlogRepository $blogRepository
     */
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;

        parent::__construct();
    }

    /**
     * display full-list of blog items.
     *
     * @return View
     */
    public function index()
    {
        $blogs     = $this->blogRepository->paginatedPublished();
        $presenter = new SimplePaginatorPresenter($blogs);

        $this->setPageTitle(trans('meta.pagetitle-blog'));
        $this->setMetaDescription(trans('meta.description-blog'));

        if (Request::has('page') && Request::get('page') > 1) {
            $this->setPageTitle(trans('meta.pagetitle-pagination', ['page' => Request::get('page')]));
            $this->setMetaDescription(trans('meta.pagetitle-pagination', ['page' => Request::get('page')]) . '. '
                . trans('meta.description-blog'));
        }

        return View::make('blog.full-list', compact('blogs', 'presenter'));
    }

    /**
     * display blog item.
     *
     * @param int    $id
     * @param string $slug
     *
     * @return View
     */
    public function show($id, $slug)
    {
        $blog = $this->findBlogOrRedirect($id, $slug);

        if ($blog instanceof RedirectResponse) {
            return $blog;
        }

        $summary_html = $this->dispatch(
            new MarkdownToHtml($blog->summary)
        );

        $this->setPageTitle($blog->title);
        $this->setMetaDescription($summary_html);

        return View::make('blog.item', compact('blog'));
    }

    /**
     * @param int                  $id
     * @param string               $slug
     * @param CreateCommentRequest $request
     *
     * @return Blog|RedirectResponse
     */
    public function createComment($id, $slug, CreateCommentRequest $request)
    {
        $blog = $this->findBlogOrRedirect($id, $slug);

        if ($blog instanceof RedirectResponse) {
            return $blog;
        }

        /** @var Comment $comment */
        $comment = $this->dispatch(
            new CreateComment(
                $id,
                $request->get('email'),
                $request->get('name'),
                $request->get('text')
            )
        );

        Flash::success(trans('flash.comment-created'));

        return Redirect::route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug, '#comment-'.$comment->id]);
    }

    /**
     * display RSS feed of all blog items.
     *
     * @return \Illuminate\Http\Response
     */
    public function rss()
    {
        $xml = $this->dispatch(
            new GetBlogRssXml()
        );

        return Response::make($xml, 200, ['Content-Type' => 'text/xml']);
    }

    /**
     * @param int    $id
     * @param string $slug
     *
     * @return RedirectResponse|Blog
     */
    protected function findBlogOrRedirect($id, $slug)
    {
        /** @var Blog $blog */
        $blog = $this->blogRepository->findPublishedById($id);

        // redirect to url with valid slug
        if ($slug !== $blog->slug) {
            return Redirect::route('blog-item', ['id' => $id, 'slug' => $blog->slug], 301);
        }

        return $blog;
    }
}
