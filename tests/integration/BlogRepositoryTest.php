<?php

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Blogs\BlogRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BlogRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testLatestReturnsTheLatestBlogposts()
    {
        /** @var Blog $blog1 */
        $blog1 = factory(Barryvanveen\Blogs\Blog::class)->create([
            'publication_date' => '2015-01-01 12:00:00',
            'online'           => 1,
        ]);

        /** @var Blog $blog2 */
        $blog2 = factory(Barryvanveen\Blogs\Blog::class)->create([
            'publication_date' => '2015-01-02 12:00:00',
            'online'           => 1,
        ]);

        /** @var Blog $blog3 */
        $blog3 = factory(Barryvanveen\Blogs\Blog::class)->create([
            'publication_date' => '2015-01-03 12:00:00',
            'online'           => 1,
        ]);

        /** @var BlogRepository $repository */
        $repository = App::make(BlogRepository::class);

        $blogs = $repository->latest(2)->toArray();

        $this->assertCount(2, $blogs);
        $this->assertEquals($blog3->title, $blogs[0]['title']);
        $this->assertEquals($blog2->title, $blogs[1]['title']);
        $this->assertNotContains($blog1, $blogs);
    }
}
