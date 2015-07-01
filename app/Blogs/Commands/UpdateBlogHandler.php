<?php
namespace Barryvanveen\Blogs\Commands;

use Barryvanveen\Blogs\BlogRepository;

class UpdateBlogHandler
{
    /** @var BlogRepository */
    private $blogRepository;

    /**
     * @param BlogRepository $blogRepository
     *
     * @see UpdateBlogCommand
     */
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    /**
     * Handle a command.
     *
     * @param UpdateBlogCommand $command
     *
     * @return mixed
     */
    public function handle($command)
    {
        $blog = $this->blogRepository->findAnyById($command->id);

        $publication_date = date('Y-m-d H:i:s', strtotime($command->publication_date));

        $blog->title            = $command->title;
        $blog->summary          = $command->summary;
        $blog->text             = $command->text;
        $blog->publication_date = $publication_date;
        $blog->online           = $command->online;

        $this->blogRepository->save($blog);
    }
}
