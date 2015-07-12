<?php
namespace Barryvanveen\Jobs\Blogs;

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Blogs\BlogRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateBlog implements SelfHandling
{
    public $title;
    public $summary;
    public $text;
    public $publication_date;
    public $online;

    /**
     * @param $title
     * @param $summary
     * @param $text
     * @param $publication_date
     * @param $online
     */
    public function __construct($title, $summary, $text, $publication_date, $online)
    {
        $this->title            = $title;
        $this->summary          = $summary;
        $this->text             = $text;
        $this->publication_date = $publication_date;
        $this->online           = $online;
    }

    /**
     * Handle a command.
     *
     * @param BlogRepository $blogRepository
     *
     * @return mixed
     */
    public function handle(BlogRepository $blogRepository)
    {
        $blog = new Blog();

        $publication_date = date('Y-m-d H:i:s', strtotime($this->publication_date));

        $blog->title            = $this->title;
        $blog->summary          = $this->summary;
        $blog->text             = $this->text;
        $blog->publication_date = $publication_date;
        $blog->online           = $this->online;

        $blogRepository->save($blog);
    }
}
