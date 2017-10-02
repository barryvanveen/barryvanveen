<?php

namespace Barryvanveen\Http\Controllers;

use Artisan;
use Barryvanveen\Jobs\Markdown\MarkdownToHtml;
use Barryvanveen\Lastfm\Constants;
use Barryvanveen\Lastfm\Lastfm;
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

    /**
     * @param Lastfm $lastfm
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function music(Lastfm $lastfm)
    {
        $nowListening = $lastfm->nowListening('barryvanveen');

        if (Cache::has('lastfm-user')) {
            $user = Cache::get('lastfm-user');
        } else {
            $user = $lastfm->userInfo('barryvanveen')->get();
            Cache::put('lastfm-user', $user, 4 * 60);
        }

        if (Cache::has('lastfm-artists')) {
            $artists = Cache::get('lastfm-artists');
        } else {
            $artists = $lastfm->userTopArtists('barryvanveen')->limit(5)->period(Constants::PERIOD_MONTH)->get();
            Cache::put('lastfm-artists', $artists, 24 * 60);
        }

        if (Cache::has('lastfm-albums')) {
            $albums = Cache::get('lastfm-albums');
        } else {
            $albums = $lastfm->userTopAlbums('barryvanveen')->limit(5)->period(Constants::PERIOD_MONTH)->get();
            Cache::put('lastfm-albums', $albums, 24 * 60);
        }

        $this->setPageTitle(trans('music.page-title'));
        $this->setMetaDescription(trans('music.page-description'));

        return View::make('pages.music', compact('nowListening', 'user', 'artists', 'albums'));
    }

    public function luckytv()
    {
        if (! Cache::has('luckytv-rss') || 'testing' === config('app.env')) {
            Artisan::call('update-luckytv-rss-feed');
        }

        $xml = Cache::get('luckytv-rss');

        return Response::make($xml, 200, ['Content-Type' => 'text/xml']);
    }
}
