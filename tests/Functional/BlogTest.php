<?php

namespace Tests\Functional;

use Barryvanveen\Blogs\Blog;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\BrowserKitTesting\HttpException;
use Tests\BrowserKitTestCase;

class BlogTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    public function testBlogOverview()
    {
        /** @var Blog $blog */
        $blog = factory(Blog::class, 'published')->create();

        $this->visit(route('home'))
            ->see(trans('general.homepage-title'))
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
    }

    public function testOnlineBlogItem()
    {
        /** @var Blog $blog */
        $blog = factory(Blog::class, 'published')->create();

        $this->visit(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
                ->see($blog->title)
                ->see($blog->text);
    }

    public function test404BecauseOfflineBlogItem()
    {
        /** @var Blog $blog */
        $blog = factory(Blog::class, 'unpublished-offline')->create();

        try {
            $this->visit(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
                 ->see($blog->title)
                 ->see($blog->text);
        } catch (Exception $e) {
            $this->assertEquals(HttpException::class, get_class($e));

            return;
        }

        $this->assertTrue(false, 'You shouldn\'t reach this assertion, an exception should have been thrown on form 
        validation');
    }

    public function test404BecauseFutureBlogItem()
    {
        /** @var Blog $blog */
        $blog = factory(Blog::class, 'unpublished-future')->create();

        try {
            $this->visit(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
                ->see($blog->title)
                ->see($blog->text);
        } catch (Exception $e) {
            $this->assertEquals(HttpException::class, get_class($e));

            return;
        }

        $this->assertTrue(false, 'You shouldn\'t reach this assertion, an exception should have been thrown on form 
        validation');
    }

    public function testBlogRssFeed()
    {
        /** @var Blog $blog */
        $blog = factory(Blog::class, 'published')->create();

        $this->visit(route('blog-rss'));

        $this->see('<title>'.$blog->title.'</title>');
    }
}
