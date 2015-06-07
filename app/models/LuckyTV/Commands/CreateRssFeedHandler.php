<?php
namespace Barryvanveen\LuckyTV\Commands;

use Cache;
use Carbon\Carbon;
use Flyingfoxx\CommandCenter\CommandHandler;
use Symfony\Component\DomCrawler\Crawler;
use Thujohn\Rss\Rss;

class CreateRssFeedHandler implements CommandHandler
{

    const URL = 'http://www.luckymedia.nl/luckytv/category/dwdd/';

    /**
     * @see CreateRssFeedCommand
     */
    public function __construct()
    {

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

        // todo: handle exceptions, timeouts, errors

        $html = $this->getHtmlFromUrl(self::URL);

        $posts = $this->getPostsFromHtml($html);

        $rss = $this->createRssFeedFromPosts($posts);

        Cache::forever('luckytv-rss', $rss);
    }

    protected function getHtmlFromUrl($url)
    {
        $ch = curl_init();
        $timeout = 5;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    protected function getPostsFromHtml($html)
    {
        $crawler = new Crawler($html);

        $posts = $crawler->filter('div#content div.post div.meta')->each(function (Crawler $node, $i) {
            $title = $node->filter('h3.title a')->text();
            $link = $node->filter('h3.title a')->attr('href');
            $date = $node->filter('div.date')->text();

            return compact('title', 'link', 'date');
        });

        return $posts;
    }

    // todo: make a more abstract command to create a feed?
    protected function createRssFeedFromPosts($posts)
    {
        $rss = new Rss();
        $rss->feed('2.0', 'UTF-8');

        $rss->channel([
            'title'       => 'LuckyTV RSS feed',
            'description' => 'Alle afleveringen van LuckyTV op een rijtje',
            'link'        => route('luckytv-rss'),
        ]);

        foreach ($posts as $post) {
            $rss->item([
                'title'   => $post['title'],
                'link'    => $post['link'],
                'guid'    => $post['link'],
                'pubDate' => Carbon::createFromFormat('d-m-Y', $post['date'])->format('D, d M Y H:i:s O'),
            ]);
        }

        return $rss;
    }
}
