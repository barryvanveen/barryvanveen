<?php
namespace Barryvanveen\Blogs;

use Barryvanveen\Markdown\Commands\MarkdownToHtmlCommand;
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
     * Retrieve the html belonging to the summary markdown.
     *
     * @return string
     */
    public function html_summary()
    {
        return $this->dispatch(
            new MarkdownToHtmlCommand(
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
            new MarkdownToHtmlCommand(
                $this->resource->text
            )
        );
    }
}
