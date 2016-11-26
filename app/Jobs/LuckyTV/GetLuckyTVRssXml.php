<?php

namespace Barryvanveen\Jobs\LuckyTV;

use Barryvanveen\Jobs\Rss\GetRssXml;
use Barryvanveen\Rss\ChannelData;
use Barryvanveen\Rss\FeedData;
use Barryvanveen\Rss\ItemData;
use Cache;
use Carbon\Carbon;
use DateTime;
use GuzzleHttp\Client;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\DomCrawler\Crawler;

class GetLuckyTVRssXml
{
    use DispatchesJobs;

    const URL = 'http://www.luckytv.nl/afleveringen/?order_by=date';

    /** @var string */
    protected $html;

    /** @var array */
    protected $posts;

    /**
     * Handle a command.
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

        $posts = $crawler->filter('div.archive__items article.video')->each(function (Crawler $node) {
            $title = $node->filter('div.video__meta a.video__title')->text();
            $link = $node->filter('div.video__meta a.video__title')->attr('href');
            $date = $node->filter('div.video__meta time.video__date')->text();
            $image = $node->filter('img.video__thumb')->attr('src');

            $date = GetLuckyTVRssXml::getFormattedDate($date);
            $image = '<img src="'.$image.'" alt="'.$title.'">';

            return compact('title', 'link', 'date', 'image');
        });

        $posts = $this->fillMissingDates($posts);

        return $posts;
    }

    /**
     * Format the given Dutch date into a proper English date.
     *
     * @param $date
     *
     * @return DateTime|string
     */
    public static function getFormattedDate($date)
    {
        $datetime = DateTime::createFromFormat('D j M Y', self::translateDateFromDutchToEnglish($date));

        return ($datetime !== false) ? $datetime->format('d-m-Y') : $datetime;
    }

    public static function translateDateFromDutchToEnglish($date)
    {
        $replacements = [
            // weekdays
            'Ma' => 'Mon',
            'Di' => 'Tue',
            'Wo' => 'Wed',
            'Do' => 'Thu',
            'Vr' => 'Fri',
            'Za' => 'Sat',
            'Zo' => 'Sun',
            // months
            'jan' => 'Jan',
            'feb' => 'Feb',
            'mrt' => 'Mar',
            'apr' => 'Apr',
            'mei' => 'May',
            'jun' => 'Jun',
            'jul' => 'Jul',
            'aug' => 'Aug',
            'sep' => 'Sep',
            'okt' => 'Oct',
            'nov' => 'Nov',
            'dec' => 'Dec',
        ];

        return str_replace(array_keys($replacements), array_values($replacements), $date);
    }

    /**
     * @param $posts
     *
     * @return array
     */
    protected function fillMissingDates($posts)
    {
        $number_of_posts = count($posts);

        for($i=0; $i<$number_of_posts; $i++) {
            if ($posts[$i]['date'] !== false) {
                 continue;
            }

            // forward lookup for date
            for($j=$i+1; $j<$number_of_posts; $j++) {
                if ($posts[$j]['date'] !== false) {
                    $posts[$i]['date'] = $posts[$j]['date'];
                    break;
                }
            }

            if ($posts[$i]['date'] !== false) {
                continue;
            }

            // backward lookup for date
            for($j=$i-1; $j>=0; $j--) {
                if ($posts[$j]['date'] !== false) {
                    $posts[$i]['date'] = $posts[$j]['date'];
                    break;
                }
            }
        }

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
                '<a href="'.$post['link'].'">'.$post['image'].'</a>'
            );
        }

        return $items;
    }
}
