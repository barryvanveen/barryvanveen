<?php
namespace Barryvanveen\Comments;

use McCool\LaravelAutoPresenter\BasePresenter;

class CommentPresenter extends BasePresenter
{
    /** Blog $resource */
    protected $resource;

    /**
     * @param Comment $resource
     */
    public function __construct(Comment $resource)
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
        return route('admin.comment-edit', [$this->resource->id]);
    }

    /**
     * @return int
     */
    public function id()
    {
        return $this->resource->id;
    }

    /**
     * @return string
     */
    public function text()
    {
        return $this->resource->text;
    }
}
