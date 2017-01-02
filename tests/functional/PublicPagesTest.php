<?php

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Pages\Page;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PublicPagesTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test visiting the about-me page.
     */
    public function testAboutMe()
    {
        /** @var Page $page */
        $page = factory(Barryvanveen\Pages\Page::class)->create(
            [
                'title'  => 'About me',
                'online' => 1,
            ]
        );

        $this->visit(route('about-me'));

        $this->see($page->title);
        $this->see($page->text);
    }

    /**
     * Test visiting the books page.
     */
    public function testAboutMeBooks()
    {
        /** @var Page $page */
        $page = factory(Barryvanveen\Pages\Page::class)->create(
            [
                'title'  => 'Books that I have read',
                'online' => 1,
            ]
        );

        $this->visit(route('books'));

        $this->see($page->title);
        $this->see($page->text);
    }

    /**
     * Test visiting the blogs RSS feed.
     */
    public function testLuckyTvRssFeed()
    {
        $this->visit(route('luckytv-rss'));

        $this->see('<title>'.trans('general.luckytv-rss-title').'</title>');
    }

    /**
     * Test visiting the sitemap.
     */
    public function testSitemap()
    {
        /** @var Blog $blog */
        $blog = factory(Barryvanveen\Blogs\Blog::class, 'published')->create();

        factory(Barryvanveen\Pages\Page::class)->create(
            [
                'title'  => 'About me',
                'online' => 1,
            ]
        );

        factory(Barryvanveen\Pages\Page::class)->create(
            [
                'title'  => 'Books that I have read',
                'online' => 1,
            ]
        );

        $this->visit(route('sitemap'))
             ->see(route('blog-item', [
                 'id'   => $blog->id,
                 'slug' => $blog->slug,
             ]))
             ->see(route('about-me'))
             ->see(route('books'));
    }
}
