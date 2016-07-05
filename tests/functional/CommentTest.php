<?php

use Barryvanveen\Blogs\Blog;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentTest extends TestCase
{
    use DatabaseTransactions;

    public function testViewAllCommentsWithBlog()
    {
        /** @var Blog $blog */
        $blog = factory(Barryvanveen\Blogs\Blog::class, 'published')->create();

        $comments = factory(Barryvanveen\Comments\Comment::class, 5)->create([
            'blog_id' => $blog->id
        ]);

        $this   ->visit(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
                ->see(trans('comments.title'));

        // todo: test individual comments
    }

    public function testViewBlogWithoutComments()
    {
        /** @var Blog $blog */
        $blog = factory(Barryvanveen\Blogs\Blog::class, 'published')->create();

        $this   ->visit(route('blog-item', ['id' => $blog->id, 'slug' => $blog->slug]))
                ->see(trans('comments.title'))
                ->see(trans('comments.no-comments'));
    }
}
