<?php

namespace Tests\Functional;

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Pages\Page;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\BrowserKitTestCase;

class PublicPagesTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    /**
     * Test visiting the about-me page.
     */
    public function testAboutMe()
    {
        /** @var Page $page */
        $page = factory(Page::class)->create(
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
        $page = factory(Page::class)->create(
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
     * Test visiting the sitemap.
     */
    public function testSitemap()
    {
        /** @var Blog $blog */
        $blog = factory(Blog::class, 'published')->create();

        factory(Page::class)->create(
            [
                'title'  => 'About me',
                'online' => 1,
            ]
        );

        factory(Page::class)->create(
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
