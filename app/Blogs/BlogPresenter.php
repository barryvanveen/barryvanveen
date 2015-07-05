<?php
namespace Barryvanveen\Blogs;

use Barryvanveen\Jobs\Markdown\MarkdownToHtml;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;
use McCool\LaravelAutoPresenter\BasePresenter;

class BlogPresenter extends BasePresenter
{
    use DispatchesJobs;

    /**
     * @param Blog $resource
     */
    public function __construct(Blog $resource)
    {
        $this->resource = $resource;
    }

    /**
     * Get route to edit blog in admin section.
     *
     * @return string
     */
    public function admin_edit_url()
    {
        return route('admin.blog-edit', [$this->resource->id]);
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
                $this->resource->summary
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
     * Get publication date in proper Dutch format.
     *
     * @return string
     */
    public function publication_date_formatted()
    {
        $date = new Carbon($this->resource->publication_date);

        return $date->format('d-m-Y H:i');
    }

    /**
     * Get publication date in a diffForHumans format.
     *
     * @return string
     */
    public function publication_date_for_humans()
    {
        $date = new LocalizedCarbon($this->resource->publication_date);

        return $date->diffForHumans();
    }

    /**
     * Retrieve summary markdown.
     *
     * @return string
     */
    public function summary()
    {
        return $this->resource->summary;
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
     * Get route to blog-item.
     *
     * @return string
     */
    public function url()
    {
        return route('blog-item', ['id' => $this->resource->id, 'slug' => $this->resource->slug]);
    }
}
