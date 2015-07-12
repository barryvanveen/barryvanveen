<?php
namespace Barryvanveen\Jobs\Sitemap;

use Barryvanveen\Blogs\BlogRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Route;

class CreateSitemap implements SelfHandling
{
    /** @var array  */
    protected $sitemap_routes = [];

    /** @var BlogRepository */
    private $blogRepository;

    /**
     * @param BlogRepository $blogRepository
     */
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    /**
     * Handle a command.
     *
     * @return string
     */
    public function handle()
    {
        $this->getRoutes();

        dd($this->sitemap);

        return 'asd';
    }

    protected function getRoutes()
    {
        $routes = Route::getRoutes();

        /** @var \Illuminate\Routing\Route $route */
        foreach($routes->getIterator() as $route) {
            $action = $route->getAction();

            // if this is not a GET-route
            if (!in_array('GET', $route->getMethods())) {
                continue;
            }

            // if this is a route containing url parameters
            if (strpos($route->getUri(), '{') !== false) {
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
            $this->sitemap_routes[] = [
                'loc' => url($route->getUri()),
            ];
        }
    }

    protected function addBlogRoutes()
    {

    }
}
