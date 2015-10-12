<?php

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Pages\Page;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PublicPagesTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * Test visiting the blog overview and an item page.
     */
    public function testBlogOverviewAndItem()
    {

        /** @var Blog $blog */
        $blog = factory(Barryvanveen\Blogs\Blog::class)->create(
            [
                'publication_date' => Carbon::now()->subDay()->toDateTimeString(),
                'online'           => 1,
            ]
        );

        $this->visit(route('home'))
            ->see('Alle artikelen')
            ->see($blog->title)
            ->see($blog->summary);

        $this->click($blog->title);

        $this->seePageIs(
            route(
                'blog-item',
                [
                    'id'   => $blog->id,
                    'slug' => $blog->slug,
                ]
            )
        );

        $this->see($blog->title)
            ->see($blog->text);
    }

    /**
     * Test visiting the blogs RSS feed.
     */
    public function testBlogRssFeed()
    {

        /** @var Blog $blog */
        $blog = factory(Barryvanveen\Blogs\Blog::class)->create(
            [
                'publication_date' => Carbon::now()->subDay()->toDateTimeString(),
                'online'           => 1,
            ]
        );

        $this->visit(route('blog-rss'));

        $this->see('<rss version="2.0"')
            ->see('<title>'.$blog->title.'</title>');
    }

    /**
     * Test visiting the over-mij page.
     */
    public function testOverMij()
    {

        /** @var Page $page */
        $page = factory(Barryvanveen\Pages\Page::class)->create(
            [
                'slug'   => 'over-mij',
                'online' => 1,
            ]
        );

        $this->visit(route('over-mij'));

        $this->see($page->title);
        $this->see($page->text);
    }

    /**
     * Test visiting the boeken page.
     */
    public function testOverMijBoeken()
    {

        /** @var Page $page */
        $page = factory(Barryvanveen\Pages\Page::class)->create(
            [
                'slug'   => 'boeken-die-ik-heb-gelezen',
                'online' => 1,
            ]
        );

        $this->visit(route('boeken'));

        $this->see($page->title);
        $this->see($page->text);
    }

    /**
     * Test visiting the blogs RSS feed.
     */
    public function testLuckyTvRssFeed()
    {
        $this->visit(route('luckytv-rss'));

        $this->see('<rss version="2.0"');
    }

    /**
     * Test visiting the sitemap.
     */
    public function testSitemap()
    {

        /** @var Blog $blog */
        $blog = factory(Barryvanveen\Blogs\Blog::class)->create(
            [
                'publication_date' => Carbon::now()->subDay()->toDateTimeString(),
                'online'           => 1,
            ]
        );

        factory(Barryvanveen\Pages\Page::class)->create(
            [
                'slug'   => 'over-mij',
                'online' => 1,
            ]
        );

        factory(Barryvanveen\Pages\Page::class)->create(
            [
                'slug'   => 'boeken-die-ik-heb-gelezen',
                'online' => 1,
            ]
        );

        $this->visit(route('sitemap'))
             ->see('<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"')
             ->see(route('blog-item', [
                 'id'   => $blog->id,
                 'slug' => $blog->slug,
             ]))
             ->see(route('over-mij'))
             ->see(route('boeken'));
    }
}
