<?php

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Comments\Comment;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentTest extends TestCase
{
    use DatabaseTransactions;

    public function testViewAllCommentsWithBlog()
    {
        /** @var Blog $blog */
        $blog = factory(Barryvanveen\Blogs\Blog::class, 'published')->create();

        $comments = factory(Barryvanveen\Comments\Comment::class, 5)->create(
            [
                'blog_id' => $blog->id
            ]
        );

        $this->visit(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
            ->see(trans('comments.title'));

        /** @var Comment $comment */
        foreach ($comments as $comment) {
            $this->see($comment->text);
        }
    }

    public function testViewBlogWithoutComments()
    {
        /** @var Blog $blog */
        $blog = factory(Barryvanveen\Blogs\Blog::class, 'published')->create();

        $this->visit(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
            ->see(trans('comments.title'))
            ->see(trans('comments.no-comments'));
    }

    public function testPostNewComment()
    {
        /** @var Blog $blog */
        $blog = factory(Barryvanveen\Blogs\Blog::class, 'published')->create();

        $new_comment = 'my newest comment';

        $this->visit(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
            ->see(trans('comments.add-your-comment'))
            ->type('john@example.com', 'email')
            ->type($new_comment, 'text')
            ->press(trans('comments.submit'))
            ->seePageIs(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
            ->see($new_comment);
        //todo: waarom gaat het niet fout terwijl we geen naam invullen?

    }

    public function testPostNewCommentWithFalseInformation()
    {
        /** @var Blog $blog */
        $blog = factory(Barryvanveen\Blogs\Blog::class, 'published')->create();

        $this->visit(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
            ->type('asdasd', 'email')
            ->press(trans('comments.submit'))
            ->seePageIs(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
            ->see(trans('validation.email-email'))
            ->see(trans('validation.message-required'));

    }

    // todo: testen van de honeypot
    public function testPostNewCommentWithHoneypot()
    {
        /** @var Blog $blog */
        $blog = factory(Barryvanveen\Blogs\Blog::class, 'published')->create();

        $this->visit(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
            ->type('asdasd', 'email')
            ->press(trans('comments.submit'))
            ->seePageIs(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
            ->see(trans('validation.email-email'))
            ->see(trans('validation.message-required'));

    }
}