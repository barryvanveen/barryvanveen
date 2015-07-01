<?php
namespace Barryvanveen\Blogs\Commands;

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Blogs\BlogRepository;
use Barryvanveen\Markdown\Commands\MarkdownToHtmlCommand;
use Barryvanveen\Rss\ChannelData;
use Barryvanveen\Rss\Commands\CreateRssFeedCommand;
use Barryvanveen\Rss\FeedData;
use Barryvanveen\Rss\ItemData;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Thujohn\Rss\Rss;

class CreateBlogRssFeedHandler
{
    use DispatchesJobs;

    /** @var BlogRepository */
    private $blogRepository;

    /**
     * @param BlogRepository $blogRepository
     *
     * @see CreateBlogRssFeedCommand
     */
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
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
        return $this->dispatch(
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

            $summary_html = $this->dispatch(
                new MarkdownToHtmlCommand($blog->summary)
            );

            $items[] = new ItemData(
                $blog->title,
                $link,
                $link,
                Carbon::createFromFormat('Y-m-d H:i:s', $blog['updated_at'])->format('D, d M Y H:i:s O'),
                $summary_html
            );
        }

        return $items;
    }
}
