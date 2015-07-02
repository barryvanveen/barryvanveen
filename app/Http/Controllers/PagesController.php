<?php
namespace Barryvanveen\Http\Controllers;

use Artisan;
use Barryvanveen\Blogs\BlogRepository;
use Barryvanveen\Markdown\Commands\MarkdownToHtmlCommand;
use Barryvanveen\Pages\PageRepository;
use Cache;
use Response;
use View;

class PagesController extends Controller
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

        parent::__construct();
    }

    public function overMij()
    {
        $page = $this->pageRepository->findPublishedBySlug('over-mij');

        $text_html = $this->dispatch(
            new MarkdownToHtmlCommand($page->text)
        );

        $this->setPageTitle($page->title);
        $this->setMetaDescription($text_html);

        return View::make('pages.item', compact('page'));
    }

    public function boeken()
    {
        $page = $this->pageRepository->findPublishedBySlug('boeken-die-ik-heb-gelezen');

        $text_html = $this->dispatch(
            new MarkdownToHtmlCommand($page->text)
        );

        $this->setPageTitle($page->title);
        $this->setMetaDescription($text_html);

        return View::make('pages.item', compact('page'));
    }

    public function luckytv()
    {
        if (!Cache::has('luckytv-rss')) {
            Artisan::call('update-luckytv-rss-feed');
        };

        // todo: fix RSS
        /** @var Rss $rss */
        $rss = Cache::get('luckytv-rss');

        return Response::make($rss, 200, ['Content-Type' => 'text/xml']);
    }
}
