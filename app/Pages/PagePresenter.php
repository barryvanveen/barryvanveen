<?php
namespace Barryvanveen\Pages;

use Barryvanveen\Jobs\Markdown\MarkdownToHtml;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;
use McCool\LaravelAutoPresenter\BasePresenter;

class PagePresenter extends BasePresenter
{
    use DispatchesJobs;

    /**
     * @param Page $resource
     */
    public function __construct(Page $resource)
    {
        $this->resource = $resource;
    }

    /**
     * Get route to edit page in admin section.
     *
     * @return string
     */
    public function admin_edit_url()
    {
        return route('admin.page-edit', [$this->resource->id]);
    }

    /**
     * Retrieve the html belonging to the text markdown.
     *
     * @return string
     */
    public function html_text()
    {
        return $this->dispatch(
            new MarkdownToHtml(
                $this->resource->text
            )
        );
    }

    /**
     * @return int
     */
    public function id()
    {
        return $this->resource->id;
    }

    /**
     * @return bool
     */
    public function online()
    {
        return $this->resource->online;
    }

    /**
     * @return Carbon
     */
    public function publication_date()
    {
        return $this->resource->publication_date;
    }

    /**
     * Retrieve text markdown.
     *
     * @return string
     */
    public function text()
    {
        return $this->resource->text;
    }

    /**
     * @return string
     */
    public function title()
    {
        return $this->resource->title;
    }

    /**
     * @return Carbon
     */
    public function updated_at()
    {
        return $this->resource->updated_at;
    }

    /**
     * Get date of latest update in proper Dutch format.
     *
     * @return string
     */
    public function updated_at_formatted()
    {
        $date = new Carbon($this->resource->updated_at);

        return $date->format('d-m-Y H:i');
    }

    /**
     * Get date of latest update in a diffForHumans format.
     *
     * @return string
     */
    public function updated_at_for_humans()
    {
        $date = new LocalizedCarbon($this->resource->updated_at);

        return $date->diffForHumans();
    }

    /**
     * Get route to page-item.
     *
     * @return string
     */
    public function url()
    {
        return route('page-item', ['page' => $this->resource->slug]);
    }
}
