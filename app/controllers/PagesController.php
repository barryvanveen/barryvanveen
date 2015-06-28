<?php

use Barryvanveen\Blogs\BlogRepository;
use Barryvanveen\Markdown\Commands\MarkdownToHtmlCommand;
use Barryvanveen\Pages\PageRepository;
use Flyingfoxx\CommandCenter\CommandBus;

class PagesController extends BaseController
{
    /** @var PageRepository */
    protected $pageRepository;

    /** @var BlogRepository */
    private $blogRepository;

    /** @var CommandBus */
    private $commandBus;

    /**
     * @param PageRepository $pageRepository
     * @param BlogRepository $blogRepository
     * @param CommandBus     $commandBus
     */
    public function __construct(PageRepository $pageRepository, BlogRepository $blogRepository, CommandBus $commandBus)
    {
        $this->pageRepository = $pageRepository;
        $this->blogRepository = $blogRepository;
        $this->commandBus     = $commandBus;

        parent::__construct();
    }

    public function overMij()
    {
        $page = $this->pageRepository->findPublishedBySlug('over-mij');

        $text_html = $this->commandBus->execute(
            new MarkdownToHtmlCommand($page->text)
        );

        $this->setPageTitle($page->title);
        $this->setMetaDescription($text_html);

        return View::make('pages.item', compact('page'));
    }

    public function boeken()
    {
        $page = $this->pageRepository->findPublishedBySlug('boeken-die-ik-heb-gelezen');

        $text_html = $this->commandBus->execute(
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

        /** @var Rss $rss */
        $rss = Cache::get('luckytv-rss');

        return Response::make($rss, 200, ['Content-Type' => 'text/xml']);
    }
}
