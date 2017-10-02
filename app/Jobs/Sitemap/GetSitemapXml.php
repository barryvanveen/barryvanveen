<?php

namespace Barryvanveen\Jobs\Sitemap;

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Blogs\BlogRepository;
use Barryvanveen\Pages\PageRepository;
use Carbon\Carbon;
use Route;
use View;

class GetSitemapXml
{
    /** @var array */
    protected $items = [];

    /** @var array */
    protected $lastmod = [];

    /** @var BlogRepository */
    private $blogRepository;

    /** @var PageRepository */
    private $pageRepository;

    /**
     * Handle a command.
     *
     * @param BlogRepository $blogRepository
     * @param PageRepository $pageRepository
     *
     * @return string
     */
    public function handle(BlogRepository $blogRepository, PageRepository $pageRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->pageRepository = $pageRepository;

        $this->getLastmodData();

        $this->getStaticRoutes();

        $this->getDynamicRoutes();

        return View::make('templates.sitemap', ['items' => $this->items]);
    }

    /**
     * Collect last modification dates for static routes.
     */
    protected function getLastmodData()
    {
        // home
        $blog = $this->blogRepository->lastUpdatedAt();
        $this->lastmod['home'] = $this->getFormattedDatetime($blog->updated_at);

        // about-me
        $page = $this->pageRepository->findPublishedBySlug('about-me');
        $this->lastmod['about-me'] = $this->getFormattedDatetime($page->updated_at);

        // books
        $page = $this->pageRepository->findPublishedBySlug('books-that-i-have-read');
        $this->lastmod['books'] = $this->getFormattedDatetime($page->updated_at);
    }

    /**
     * Get sitemap data for static routes.
     */
    protected function getStaticRoutes()
    {
        $routes = Route::getRoutes();

        /** @var \Illuminate\Routing\Route $route */
        foreach ($routes->getIterator() as $route) {
            $action = $route->getAction();

            // if this is not a GET-route
            if (! in_array('GET', $route->methods())) {
                continue;
            }

            // if this is a route containing url parameters
            if (false !== strpos($route->uri(), '{')) {
                continue;
            }

            // if this route is configured as hidden in routes.php
            if (isset($action['sitemap']) && isset($action['sitemap']['hidden']) && $action['sitemap']['hidden'] ===
                true) {
                continue;
            }

            // if this is the sitemap.xml route itself
            if ($route->getName() == Route::getCurrentRoute()->getName()) {
                continue;
            }

            // otherwise, add this route to the sitemap
            $this->items[] = [
                'loc'     => url($route->uri()),
                'lastmod' => in_array($route->getName(), $this->lastmod) ? $this->lastmod[$route->getName()] : false,
            ];
        }
    }

    /**
     * Get sitemap data for dynamic routes.
     */
    protected function getDynamicRoutes()
    {
        $blogs = $this->blogRepository->allPublished();

        /** @var Blog $blog */
        foreach ($blogs as $blog) {
            $this->items[] = [
                'loc'     => url(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug])),
                'lastmod' => $this->getFormattedDatetime($blog->updated_at),
            ];
        }
    }

    /**
     * Get a formatted datetime string from a standard datetime string.
     * Format is 2015-07-13T22:20:15+02:00.
     *
     * @param string $date
     *
     * @return string
     */
    protected function getFormattedDatetime($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->toRfc3339String();
    }
}
