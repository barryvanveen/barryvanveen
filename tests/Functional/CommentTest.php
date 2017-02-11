<?php

namespace Tests\Functional;

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Comments\Comment;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\BrowserKitTestCase;

class CommentTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    public function testViewOnlineCommentsWithBlog()
    {
        /** @var Blog $blog */
        $blog = factory(Blog::class, 'published')->create();

        $online_comments = factory(Comment::class, 'online', 3)->create(
            [
                'blog_id' => $blog->id,
            ]
        );

        $offline_comments = factory(Comment::class, 'offline', 3)->create(
            [
                'blog_id' => $blog->id,
            ]
        );

        $this->visit(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
            ->see(trans('comments.title'));

        /** @var Comment $comment */
        foreach ($online_comments as $comment) {
            $this->see($comment->text);
        }

        foreach ($offline_comments as $comment) {
            $this->dontSee($comment->text);
        }
    }

    public function testViewBlogWithoutComments()
    {
        /** @var Blog $blog */
        $blog = factory(Blog::class, 'published')->create();

        $this->visit(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
            ->see(trans('comments.title'))
            ->see(trans('comments.no-comments'));
    }

    public function testPostNewComment()
    {
        /** @var Blog $blog */
        $blog = factory(Blog::class, 'published')->create();

        $new_comment = 'my newest comment';

        $this->visit(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
            ->see(trans('comments.add-your-comment'))
            ->type('John Doe', 'name')
            ->type('john@example.com', 'email')
            ->type($new_comment, 'text')
            ->press(trans('comments.submit'))
            ->seePageIs(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
            ->see($new_comment);
    }

    public function testPostNewCommentWithFalseInformation()
    {
        /** @var Blog $blog */
        $blog = factory(Blog::class, 'published')->create();

        $this->visit(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
             ->type('asdasd', 'email')
             ->press(trans('comments.submit'))
             ->seePageIs(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
             ->see(trans('validation.email-email'));
    }

    public function testPostNewCommentWithHoneypot()
    {
        /** @var Blog $blog */
        $blog = factory(Blog::class, 'published')->create();

        $new_comment = 'my newest comment';

        $this->visit(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
                ->see(trans('comments.add-your-comment'))
                ->type('John Doe', 'name')
                ->type('john@example.com', 'email')
                ->type($new_comment, 'text')
                ->type('ishouldnotfillthisfield', 'youshouldnotfillthisfield')
                ->press(trans('comments.submit'))
                ->seePageIs(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
                ->see(trans('validation.youshouldnotfillthisfield-size'));
    }

    public function testCommentsDisabled()
    {
        config(['custom.comments_enabled' => false]);

        /** @var Blog $blog */
        $blog = factory(Blog::class, 'published')->create();

        $this->visit(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
             ->see(trans('comments.comments-are-closed'));
    }
}
