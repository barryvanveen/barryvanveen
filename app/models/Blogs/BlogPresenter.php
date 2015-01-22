<?php namespace Barryvanveen\Blogs;

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
     * Get publication date in a diffForHumans format
     *
     * @return string
     */
    public function presentPublicationDateFormatted()
    {
        $date = new LocalizedCarbon($this->publication_date);

        return $date->diffForHumans();
    }
}
