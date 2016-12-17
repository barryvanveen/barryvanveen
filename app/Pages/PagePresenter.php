<?php

namespace Barryvanveen\Pages;

use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Barryvanveen\Jobs\Markdown\MarkdownToHtml;
use McCool\LaravelAutoPresenter\BasePresenter;

class PagePresenter extends BasePresenter
{
    use DispatchesJobs;

    /** @var Page $wrappedObject */
    protected $wrappedObject;

    /**
     * @param Page $resource
     */
    public function __construct(Page $resource)
    {
        $this->wrappedObject = $resource;
    }

    /**
     * Get route to edit page in admin section.
     *
     * @return string
     */
    public function admin_edit_url()
    {
        return route('admin.page-edit', [$this->wrappedObject->id]);
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
                $this->wrappedObject->text
            )
        );
    }

    /**
     * @return int
     */
    public function id()
    {
        return $this->wrappedObject->id;
    }

    /**
     * @return bool
     */
    public function online()
    {
        return $this->wrappedObject->online;
    }

    /**
     * @return Carbon
     */
    public function publication_date()
    {
        return $this->wrappedObject->publication_date;
    }

    /**
     * Retrieve text markdown.
     *
     * @return string
     */
    public function text()
    {
        return $this->wrappedObject->text;
    }

    /**
     * @return string
     */
    public function title()
    {
        return $this->wrappedObject->title;
    }

    /**
     * @return Carbon
     */
    public function updated_at()
    {
        return $this->wrappedObject->updated_at;
    }

    /**
     * Get date of latest update in proper Dutch format.
     *
     * @return string
     */
    public function updated_at_formatted()
    {
        $date = new Carbon($this->wrappedObject->updated_at);

        return $date->format('d-m-Y H:i');
    }

    /**
     * Get date of last update in RFC-3339 format, which is used for schema.org microdata.
     *
     * @return string
     */
    public function updated_at_formatted_rfc3339()
    {
        $date = new Carbon($this->wrappedObject->updated_at);

        return $date->toRfc3339String();
    }

    /**
     * Get date of latest update in a diffForHumans format.
     *
     * @return string
     */
    public function updated_at_for_humans()
    {
        $date = new Carbon($this->wrappedObject->updated_at);

        return $date->diffForHumans();
    }

    /**
     * Get route to page-item.
     *
     * @return string
     */
    public function url()
    {
        return route('page-item', ['page' => $this->wrappedObject->slug]);
    }
}
