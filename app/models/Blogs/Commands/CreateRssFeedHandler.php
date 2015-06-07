<?php
namespace Barryvanveen\Blogs\Commands;

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Blogs\BlogRepository;
use Carbon\Carbon;
use Flyingfoxx\CommandCenter\CommandHandler;
use Thujohn\Rss\Rss;

class CreateRssFeedHandler implements CommandHandler
{
    /** @var BlogRepository */
    private $blogRepository;

    /**
     * @param BlogRepository $blogRepository
     *
     * @see CreateRssFeedCommand
     */
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    /**
     * Handle a command.
     *
     * @param CreateRssFeedCommand $command
     *
     * @return mixed|Rss
     */
    public function handle($command)
    {
        $rss = new Rss();
        $rss->feed('2.0', 'UTF-8');

        $rss->channel([
            'title'       => trans('general.rss-title'),
            'description' => trans('general.description'),
            'link'        => url(),
        ]);

        $blogs = $this->blogRepository->published();

        /** @var Blog $blog */
        foreach ($blogs as $blog) {
            $link = route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]);

            $rss->item([
                'title'             => $blog->title,
                'description|cdata' => $blog->getPresenter()->presentHtmlSummary(),
                'link'              => $link,
                'guid'              => $link,
                'pubDate'           => Carbon::createFromFormat('Y-m-d H:i:s', $blog['publication_date'])
                                           ->format('D, d M Y H:i:s O'),
            ]);
        }

        return $rss;
    }
}
