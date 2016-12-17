<?php

namespace Barryvanveen\Blogs;

use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Barryvanveen\Jobs\Markdown\MarkdownToHtml;
use McCool\LaravelAutoPresenter\BasePresenter;

class BlogPresenter extends BasePresenter
{
    use DispatchesJobs;

    /** Blog $wrappedObject */
    protected $wrappedObject;

    /**
     * Get route to edit blog in admin section.
     *
     * @return string
     */
    public function admin_edit_url()
    {
        return route('admin.blog-edit', [$this->wrappedObject->id]);
    }

    /**
     * Retrieve the html belonging to the summary markdown.
     *
     * @return string
     */
    public function html_summary()
    {
        return $this->dispatch(
            new MarkdownToHtml(
                $this->wrappedObject->summary
            )
        );
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
     * @return string
     */
    public function publication_date()
    {
        return $this->wrappedObject->publication_date;
    }

    /**
     * Get publication date in "Feb 6, 2016" format.
     *
     * @return string
     */
    public function publication_date_formatted()
    {
        $date = new Carbon($this->wrappedObject->publication_date);

        return $date->toFormattedDateString();
    }

    /**
     * Get publication date in RFC-3339 format, which is used for schema.org microdata.
     *
     * @return string
     */
    public function publication_date_formatted_rfc3339()
    {
        $date = new Carbon($this->wrappedObject->publication_date);

        return $date->toRfc3339String();
    }

    /**
     * Get publication date in a diffForHumans format.
     *
     * @return string
     */
    public function publication_date_for_humans()
    {
        $date = new Carbon($this->wrappedObject->publication_date);

        return $date->diffForHumans();
    }

    /**
     * Retrieve summary markdown.
     *
     * @return string
     */
    public function summary()
    {
        return $this->wrappedObject->summary;
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
     * Get route to blog-item.
     *
     * @return string
     */
    public function url()
    {
        return route('blog-item', ['id' => $this->wrappedObject->id, 'slug' => $this->wrappedObject->slug]);
    }
}
