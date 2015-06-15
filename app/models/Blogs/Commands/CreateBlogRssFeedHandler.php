<?php
namespace Barryvanveen\Blogs\Commands;

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Blogs\BlogRepository;
use Barryvanveen\Rss\ChannelData;
use Barryvanveen\Rss\Commands\CreateRssFeedCommand;
use Barryvanveen\Rss\FeedData;
use Barryvanveen\Rss\ItemData;
use Carbon\Carbon;
use Flyingfoxx\CommandCenter\CommandBus;
use Flyingfoxx\CommandCenter\CommandHandler;
use Thujohn\Rss\Rss;

class CreateBlogRssFeedHandler implements CommandHandler
{
    /** @var BlogRepository */
    private $blogRepository;

    /** @var CommandBus */
    private $commandBus;

    /**
     * @param BlogRepository $blogRepository
     * @param CommandBus     $commandBus
     *
     * @see CreateBlogRssFeedCommand
     */
    public function __construct(BlogRepository $blogRepository, CommandBus $commandBus)
    {
        $this->blogRepository = $blogRepository;
        $this->commandBus     = $commandBus;
    }

    /**
     * Handle the CreateBlogRssFeedCommand command.
     *
     * @param CreateBlogRssFeedCommand $command
     *
     * @return mixed|Rss
     */
    public function handle($command)
    {
        return $this->commandBus->execute(
            new CreateRssFeedCommand(
                $this->getFeedData(),
                $this->getChannelData(),
                $this->getItemDataArray()
            )
        );
    }

    /**
     * Build FeedData for this feed.
     *
     * @return FeedData
     */
    protected function getFeedData()
    {
        return new FeedData();
    }

    /**
     * Build ChannelData for this feed.
     *
     * @return ChannelData
     */
    protected function getChannelData()
    {
        $last_updated_blog = $this->blogRepository->lastUpdatedAt();

        return new ChannelData(
            trans('general.blog-rss-title'),
            trans('general.blog-rss-description'),
            url(),
            Carbon::createFromFormat('Y-m-d H:i:s', $last_updated_blog['updated_at'])->format('D, d M Y H:i:s O')
        );
    }

    /**
     * Build array of ItemData objects for this feed.
     *
     * @return array
     */
    protected function getItemDataArray()
    {
        $items = [];

        $blogs = $this->blogRepository->published();

        /** @var Blog $blog */
        foreach ($blogs as $blog) {
            $link = route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]);

            $items[] = new ItemData(
                $blog->title,
                $link,
                $link,
                Carbon::createFromFormat('Y-m-d H:i:s', $blog['updated_at'])->format('D, d M Y H:i:s O'),
                $blog->getPresenter()->presentHtmlSummary()
            );
        }

        return $items;
    }
}
