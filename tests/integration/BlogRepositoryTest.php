<?php

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Blogs\BlogRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function testPublishedReturnsOnlyPublishedArticlesInTheRightOrder()
    {
        /** @var Blog $blog1 */
        $blog1 = factory(Barryvanveen\Blogs\Blog::class)->create([
            'publication_date' => '2015-01-01 12:00:00',
            'online'           => 0,
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

        $blogs = $repository->published()->toArray();

        $this->assertCount(2, $blogs);
        $this->assertEquals($blog3->title, $blogs[0]['title']);
        $this->assertEquals($blog2->title, $blogs[1]['title']);
        $this->assertNotContains($blog1, $blogs);
    }

    public function testAllRetrievesAllBlogpostsInTheRightOrder()
    {
        /** @var Blog $blog1 */
        $blog1 = factory(Barryvanveen\Blogs\Blog::class)->create([
            'publication_date' => Carbon::now()->addYear()->toDateTimeString(),
            'online'           => 1,
        ]);

        /** @var Blog $blog2 */
        $blog2 = factory(Barryvanveen\Blogs\Blog::class)->create([
            'publication_date' => '2015-01-03 12:00:00',
            'online'           => 0,
        ]);

        /** @var Blog $blog3 */
        $blog3 = factory(Barryvanveen\Blogs\Blog::class)->create([
            'publication_date' => '2015-01-01 12:00:00',
            'online'           => 1,
        ]);

        /** @var BlogRepository $repository */
        $repository = App::make(BlogRepository::class);

        $blogs = $repository->all()->toArray();

        $this->assertCount(3, $blogs);
        $this->assertEquals($blog1->title, $blogs[0]['title']);
        $this->assertEquals($blog2->title, $blogs[1]['title']);
        $this->assertEquals($blog3->title, $blogs[2]['title']);
    }

    public function testFindPublishedByIdFindsPublishedBlogpost()
    {
        /** @var Blog $blog */
        $blog = factory(Barryvanveen\Blogs\Blog::class)->create([
            'publication_date' => '2015-01-01 12:00:00',
            'online'           => 1,
        ]);

        /** @var BlogRepository $repository */
        $repository = App::make(BlogRepository::class);

        $blogFromRepository = $repository->findPublishedById($blog->id);

        $this->assertEquals($blog->id, $blogFromRepository->id);
    }

    public function testFindPublishedByIdThrowsErrorForOfflineBlogpost()
    {
        /** @var Blog $blog */
        $blog = factory(Barryvanveen\Blogs\Blog::class)->create([
            'publication_date' => '2015-01-01 12:00:00',
            'online'           => 0,
        ]);

        /** @var BlogRepository $repository */
        $repository = App::make(BlogRepository::class);

        $this->setExpectedException(ModelNotFoundException::class);

        $repository->findPublishedById($blog->id);
    }

    public function testFindPublishedByIdThrowsErrorForUnpublishedBlogpost()
    {
        /** @var Blog $blog */
        $blog = factory(Barryvanveen\Blogs\Blog::class)->create([
            'publication_date' => Carbon::now()->addYear()->toDateTimeString(),
            'online'           => 1,
        ]);

        /** @var BlogRepository $repository */
        $repository = App::make(BlogRepository::class);

        $this->setExpectedException(ModelNotFoundException::class);

        $repository->findPublishedById($blog->id);
    }

    public function testFindAnyByIdFindsUnpublishedBlogpost()
    {
        /** @var Blog $blog */
        $blog = factory(Barryvanveen\Blogs\Blog::class)->create([
            'publication_date' => Carbon::now()->addYear()->toDateTimeString(),
            'online'           => 0,
        ]);

        /** @var BlogRepository $repository */
        $repository = App::make(BlogRepository::class);

        $blogFromRepository = $repository->findAnyById($blog->id);

        $this->assertEquals($blog->id, $blogFromRepository->id);
    }

    /**
     * retrieve the most recently updated blogpost.
     *
     * @return Blog
     */
    public function testLastUpdatedAtReturnsPublishedBlogpostWithLatestUpdatedAt()
    {
        /** @var Blog $blog1 */
        $blog1 = factory(Barryvanveen\Blogs\Blog::class)->create([
            'publication_date' => '2015-01-01 12:00:00',
            'updated_at'       => '2015-01-02 12:00:00',
            'online'           => 1,
        ]);

        /** @var Blog $blog2 */
        $blog2 = factory(Barryvanveen\Blogs\Blog::class)->create([
            'publication_date' => '2015-01-01 12:00:00',
            'updated_at'       => '2015-01-01 12:00:00',
            'online'           => 1,
        ]);

        /** @var Blog $blog3 */
        $blog3 = factory(Barryvanveen\Blogs\Blog::class)->create([
            'publication_date' => '2015-01-05 12:00:00',
            'online'           => 0,
        ]);

        /** @var BlogRepository $repository */
        $repository = App::make(BlogRepository::class);

        $blogFromRepository = $repository->lastUpdatedAt();

        $this->assertEquals($blog1->id, $blogFromRepository->id);
    }
}
