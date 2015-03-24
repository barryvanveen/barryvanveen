<?php namespace Barryvanveen\Blogs;

use Carbon\Carbon;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;
use Robbo\Presenter\Presenter;

class BlogPresenter extends Presenter
{
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
}
