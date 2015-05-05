<?php
namespace Barryvanveen\Pages;

use Barryvanveen\Markdown\Commands\MarkdownToHtmlCommand;
use Carbon\Carbon;
use Flyingfoxx\CommandCenter\CommandBus;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;
use Robbo\Presenter\Presenter;

class PagePresenter extends Presenter
{
    protected $commandBus;

    /**
     * @param Page       $page
     * @param CommandBus $commandBus
     */
    public function __construct(Page $page, CommandBus $commandBus)
    {
        parent::__construct($page);
        $this->commandBus = $commandBus;
    }

    /**
     * Get route to page-item.
     *
     * @return string
     */
    public function presentUrl()
    {
        return route('page-item', ['page' => $this->slug]);
    }

    /**
     * Get route to edit page in admin section.
     *
     * @return string
     */
    public function presentAdminEditUrl()
    {
        return route('admin.page-edit', [$this->id]);
    }

    /**
     * Get date of latest update in proper Dutch format.
     *
     * @return string
     */
    public function presentUpdatedAtFormatted()
    {
        $date = new Carbon($this->updated_at);

        return $date->format('d-m-Y H:i');
    }

    /**
     * Get date of latest update in a diffForHumans format.
     *
     * @return string
     */
    public function presentUpdatedAtForHumans()
    {
        $date = new LocalizedCarbon($this->updated_at);

        return $date->diffForHumans();
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
