<?php
namespace Barryvanveen\Jobs\Blogs;

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Blogs\BlogRepository;
use Barryvanveen\Jobs\Markdown\MarkdownToHtml;
use Barryvanveen\Jobs\Rss\CreateRssFeed;
use Barryvanveen\Rss\ChannelData;
use Barryvanveen\Rss\FeedData;
use Barryvanveen\Rss\ItemData;
use Carbon\Carbon;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

class CreateBlogRssFeed implements SelfHandling
{
    use DispatchesJobs;

    /** @var  BlogRepository */
    private $blogRepository;

    /**
     * Handle the CreateBlogRssFeed command.
     *
     * @param BlogRepository $blogRepository
     *
     * @return string
     */
    public function handle(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;

        return $this->dispatch(
            new CreateRssFeed(
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
                new MarkdownToHtml($blog->summary)
            );

            $items[] = new ItemData(
                $blog->title,
                $link,
                $link,
                $blog['updated_at'],
                $summary_html
            );
        }

        return $items;
    }
}
