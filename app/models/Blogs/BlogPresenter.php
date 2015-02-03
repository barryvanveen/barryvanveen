<?php namespace Barryvanveen\Blogs;

use Carbon\Carbon;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;
use Robbo\Presenter\Presenter;

class BlogPresenter extends Presenter
{
    /**
     * Get date to blog-item
     *
     * @return string
     */
    public function presentUrl()
    {
        return route('blog-item', ['blog' => $this->slug]);
    }

    /**
     * Get publication date in proper Dutch format
     *
     * @return string
     */
    public function presentPublicationDateFormatted()
    {
        $date = new Carbon($this->publication_date);

        return $date->format('d-m-Y H:i');
    }

    /**
     * Get publication date in a diffForHumans format
     *
     * @return string
     */
    public function presentPublicationDateForHumans()
    {
        $date = new LocalizedCarbon($this->publication_date);

        return $date->diffForHumans();
    }
}
