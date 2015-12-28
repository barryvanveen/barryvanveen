<?php

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Blogs\BlogRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Pagination\Paginator;

class BlogRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    /** @var BlogRepository $repository */
    private $repository;

    public function setUp()
    {
        parent::setUp();

        $this->repository = App::make(BlogRepository::class);
    }

    public function testPublishedReturnsPaginator()
    {
        $blogs = $this->repository->published();

        $this->assertInstanceOf(Paginator::class, $blogs);
    }

    public function testPublishedPaginatesResults()
    {
        factory(Barryvanveen\Blogs\Blog::class, 20)->create([
            'publication_date' => '2015-01-01 12:00:00',
            'online'           => 1,
        ]);

        $paginator = $this->repository->published(5);

        $this->assertCount(5, $paginator->items());
        $this->assertTrue($paginator->hasMorePages());
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

        $blogs = $this->repository->published(5)->items();

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

        $blogs = $this->repository->all()->toArray();

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

        $blogFromRepository = $this->repository->findPublishedById($blog->id);

        $this->assertEquals($blog->id, $blogFromRepository->id);
    }

    public function testFindPublishedByIdThrowsErrorForOfflineBlogpost()
    {
        /** @var Blog $blog */
        $blog = factory(Barryvanveen\Blogs\Blog::class)->create([
            'publication_date' => '2015-01-01 12:00:00',
            'online'           => 0,
        ]);

        $this->setExpectedException(ModelNotFoundException::class);

        $this->repository->findPublishedById($blog->id);
    }

    public function testFindPublishedByIdThrowsErrorForUnpublishedBlogpost()
    {
        /** @var Blog $blog */
        $blog = factory(Barryvanveen\Blogs\Blog::class)->create([
            'publication_date' => Carbon::now()->addYear()->toDateTimeString(),
            'online'           => 1,
        ]);

        $this->setExpectedException(ModelNotFoundException::class);

        $this->repository->findPublishedById($blog->id);
    }

    public function testFindAnyByIdFindsUnpublishedBlogpost()
    {
        /** @var Blog $blog */
        $blog = factory(Barryvanveen\Blogs\Blog::class)->create([
            'publication_date' => Carbon::now()->addYear()->toDateTimeString(),
            'online'           => 0,
        ]);

        $blogFromRepository = $this->repository->findAnyById($blog->id);

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

        $blogFromRepository = $this->repository->lastUpdatedAt();

        $this->assertEquals($blog1->id, $blogFromRepository->id);
    }
}