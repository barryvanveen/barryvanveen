<?php

namespace Barryvanveen\Jobs\Blogs;

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Blogs\BlogRepository;
use Barryvanveen\Jobs\Markdown\MarkdownToHtml;
use Barryvanveen\Jobs\Rss\GetRssXml;
use Barryvanveen\Rss\ChannelData;
use Barryvanveen\Rss\FeedData;
use Barryvanveen\Rss\ItemData;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;

class GetBlogRssXml
{
    use DispatchesJobs;

    /** @var BlogRepository */
    private $blogRepository;

    /**
     * Handle the GetBlogRssXml command.
     *
     * @param BlogRepository $blogRepository
     *
     * @return string
     */
    public function handle(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;

        return $this->dispatch(
            new GetRssXml(
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
            trans('general.blog-description'),
            url(''),
            Carbon::createFromFormat('Y-m-d H:i:s', $last_updated_blog['updated_at'])->toRfc2822String()
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

        $blogs = $this->blogRepository->paginatedPublished();

        $analytics_parameters = '?'.implode('&', [
            'utm_source=rss',
            'utm_medium=rss',
            'utm_campaign=rss',
        ]);

        /** @var Blog $blog */
        foreach ($blogs as $blog) {
            $link = route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]);
            $link_including_analytics = $link.$analytics_parameters;

            $summary_html = $this->dispatch(
                new MarkdownToHtml($blog->summary)
            );

            $summary_html .= '<p><a href="'.$link_including_analytics.'">'.trans('general.read-more-on-the-website').'</a>.</p>';

            $items[] = new ItemData(
                $blog->title,
                $link_including_analytics,
                $link,
                $blog['updated_at'],
                $summary_html
            );
        }

        return $items;
    }
}
