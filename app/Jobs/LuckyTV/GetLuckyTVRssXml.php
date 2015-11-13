<?php
namespace Barryvanveen\Jobs\LuckyTV;

use Barryvanveen\Jobs\Rss\GetRssXml;
use Barryvanveen\Rss\ChannelData;
use Barryvanveen\Rss\FeedData;
use Barryvanveen\Rss\ItemData;
use Cache;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\DomCrawler\Crawler;

class GetLuckyTVRssXml implements SelfHandling
{
    use DispatchesJobs;

    const URL = 'http://www.luckymedia.nl/luckytv/category/dwdd/';

    /** @var string */
    protected $html;

    /** @var array */
    protected $posts;

    /**
     * Handle a command.
     *
     * @return string
     */
    public function handle()
    {
        $this->html = $this->getHtmlFromUrl();

        $this->posts = $this->getPostsFromHtml();

        $rss = $this->createRssFeedFromPosts();

        Cache::put('luckytv-rss', $rss, 60);
    }

    protected function getHtmlFromUrl()
    {
        $client = new Client([
            'connect_timeout' => 10,
            'timeout'         => 10,
        ]);

        $response = $client->get(self::URL);

        return $response->getBody()->getContents();
    }

    protected function getPostsFromHtml()
    {
        $crawler = new Crawler($this->html);

        $posts = $crawler->filter('div#content div.post')->each(function (Crawler $node) {
            $title = $node->filter('div.meta h3.title a')->text();
            $link = $node->filter('div.meta h3.title a')->attr('href');
            $date = $node->filter('div.meta div.date')->text();
            $image = $node->filter('a img')->attr('src');

            // derive original image from thumbnail
            $original_start = strpos($image, '?src=') + 5;
            $original_end = strpos($image, '&w=');
            $image = substr($image, $original_start, $original_end - $original_start);
            $image = '<img src="'.$image.'" alt="'.$title.'">';

            return compact('title', 'link', 'date', 'image');
        });

        return $posts;
    }

    protected function createRssFeedFromPosts()
    {
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
        return new ChannelData(
            trans('general.luckytv-rss-title'),
            trans('general.luckytv-rss-description'),
            route('luckytv-rss'),
            Carbon::now()->toRfc2822String()
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

        foreach ($this->posts as $post) {
            $items[] = new ItemData(
                $post['title'],
                $post['link'],
                $post['link'],
                Carbon::createFromFormat('d-m-Y', $post['date'])->toRfc2822String(),
                $post['image']
            );
        }

        return $items;
    }
}
