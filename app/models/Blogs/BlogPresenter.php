<?php
namespace Barryvanveen\Blogs;

use Barryvanveen\Markdown\Commands\MarkdownToHtmlCommand;
use Carbon\Carbon;
use Flyingfoxx\CommandCenter\CommandBus;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;
use Robbo\Presenter\Presenter;

class BlogPresenter extends Presenter
{
    protected $commandBus;

    /**
     * @param Blog       $blog
     * @param CommandBus $commandBus
     */
    public function __construct(Blog $blog, CommandBus $commandBus)
    {
        parent::__construct($blog);
        $this->commandBus = $commandBus;
    }

    /**
     * Get route to blog-item.
     *
     * @return string
     */
    public function presentUrl()
    {
        return route('blog-item', ['blog' => $this->slug]);
    }

    /**
     * Get route to edit blog in admin section.
     *
     * @return string
     */
    public function presentAdminEditUrl()
    {
        return route('admin.blog-edit', [$this->id]);
    }

    /**
     * Get publication date in proper Dutch format.
     *
     * @return string
     */
    public function presentPublicationDateFormatted()
    {
        $date = new Carbon($this->publication_date);

        return $date->format('d-m-Y H:i');
    }

    /**
     * Get publication date in a diffForHumans format.
     *
     * @return string
     */
    public function presentPublicationDateForHumans()
    {
        $date = new LocalizedCarbon($this->publication_date);

        return $date->diffForHumans();
    }

    /**
     * Retrieve the html belonging to the summary markdown.
     *
     * @return string
     */
    public function presentHtmlSummary()
    {
        return $this->commandBus->execute(
            new MarkdownToHtmlCommand(
                $this->summary
            )
        );
    }

    /**
     * Retrieve the html belonging to the text markdown.
     *
     * @return string
     */
    public function presentHtmlText()
    {
        return $this->commandBus->execute(
            new MarkdownToHtmlCommand(
                $this->text
            )
        );
    }
}
