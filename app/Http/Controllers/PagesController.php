<?php

namespace Barryvanveen\Http\Controllers;

use Artisan;
use Barryvanveen\Jobs\Markdown\MarkdownToHtml;
use Barryvanveen\LastfmApi\LastfmApiClient;
use Barryvanveen\Pages\PageRepository;
use Cache;
use Response;
use View;

class PagesController extends Controller
{
    /** @var PageRepository */
    protected $pageRepository;

    /**
     * @param PageRepository $pageRepository
     */
    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;

        parent::__construct();
    }

    public function aboutMe()
    {
        $page = $this->pageRepository->findPublishedBySlug('about-me');

        $text_html = $this->dispatch(
            new MarkdownToHtml($page->text)
        );

        $this->setPageTitle($page->title);
        $this->setMetaDescription($text_html);

        return View::make('pages.item', compact('page'));
    }

    public function books()
    {
        $page = $this->pageRepository->findPublishedBySlug('books-that-i-have-read');

        $text_html = $this->dispatch(
            new MarkdownToHtml($page->text)
        );

        $this->setPageTitle($page->title);
        $this->setMetaDescription($text_html);

        return View::make('pages.item', compact('page'));
    }

    public function music()
    {
        $lastfmApiClient = new LastfmApiClient();
        $lastfmApiClient->userTopAlbums('barryvanveen')
                        ->period('7day')
                        ->limit(10)
                        //->page(1)
                        ->get();

        /*$lastfmApiClient->user('username')
                        ->topArtists();

        $lastfmApiClient->user('username')
                        ->info();

        $lastfmApiClient->user('username')
                        ->recentTracks()
                        ->limit(10);*/

    }


    public function luckytv()
    {
        if (! Cache::has('luckytv-rss')) {
            Artisan::call('update-luckytv-rss-feed');
        }

        $xml = Cache::get('luckytv-rss');

        return Response::make($xml, 200, ['Content-Type' => 'text/xml']);
    }
}
