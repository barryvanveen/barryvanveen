<?php
namespace Barryvanveen\LuckyTV\Commands;

use Barryvanveen\Rss\ChannelData;
use Barryvanveen\Rss\Commands\CreateRssFeedCommand;
use Barryvanveen\Rss\FeedData;
use Barryvanveen\Rss\ItemData;
use Cache;
use Carbon\Carbon;
use Flyingfoxx\CommandCenter\CommandBus;
use Flyingfoxx\CommandCenter\CommandHandler;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Thujohn\Rss\Rss;

class CreateLuckyTVRssFeedHandler implements CommandHandler
{
    const URL = 'http://www.luckymedia.nl/luckytv/category/dwdd/';

    /** @var string */
    protected $html;

    /** @var array */
    protected $posts;

    /** @var CommandBus */
    protected $commandBus;

    /**
     * @see CreateLuckyTVRssFeedCommand
     *
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * Handle a command.
     *
     * @param CreateLuckyTVRssFeedCommand $command
     *
     * @return Rss
     */
    public function handle($command)
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

        $posts = $crawler->filter('div#content div.post div.meta')->each(function (Crawler $node) {
            $title = $node->filter('h3.title a')->text();
            $link = $node->filter('h3.title a')->attr('href');
            $date = $node->filter('div.date')->text();

            return compact('title', 'link', 'date');
        });

        return $posts;
    }

    protected function createRssFeedFromPosts()
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
        return new ChannelData(
            trans('general.luckytv-rss-title'),
            trans('general.luckytv-rss-description'),
            route('luckytv-rss'),
            Carbon::now()->format('D, d M Y H:i:s O')
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
                Carbon::createFromFormat('d-m-Y', $post['date'])->format('D, d M Y H:i:s O')
            );
        }

        return $items;
    }
}
