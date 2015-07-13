<?php
namespace Barryvanveen\Http\Controllers;

use Barryvanveen\Blogs\BlogRepository;
use Barryvanveen\Jobs\Blogs\GetBlogRssXml;
use Barryvanveen\Jobs\Markdown\MarkdownToHtml;
use Redirect;
use Response;
use View;

class BlogController extends Controller
{
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
        $blogs = $this->blogRepository->published();

        $this->setPageTitle('Blog');
        $this->setMetaDescription('Een blog van Barry van Veen over programmeren, PHP, Laravel
        Framework en aanverwante zaken.');

        return View::make('blog.full-list', compact('blogs'));
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
        $blog = $this->blogRepository->findPublishedById($id);

        // redirect to url with valid slug
        if ($slug !== $blog->slug) {
            return Redirect::route('blog-item', ['id' => $id, 'slug' => $blog->slug], 301);
        }

        $summary_html = $this->dispatch(
            new MarkdownToHtml($blog->summary)
        );

        $this->setPageTitle('Blog');
        $this->setPageTitle($blog->title);
        $this->setMetaDescription($summary_html);

        return View::make('blog.item', compact('blog'));
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
}
