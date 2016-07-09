<?php
namespace Barryvanveen\Comments;

use McCool\LaravelAutoPresenter\BasePresenter;

class CommentPresenter extends BasePresenter
{
    /** Comment $wrappedObject */
    protected $wrappedObject;

    /**
     * Get route to edit blog in admin section.
     *
     * @return string
     */
    public function admin_edit_url()
    {
        return route('admin.comments-edit', [$this->wrappedObject->id]);
    }

    /**
     * @return int
     */
    public function id()
    {
        return $this->wrappedObject->id;
    }

    /**
     * @return string
     */
    public function text()
    {
        return $this->wrappedObject->text;
    }
}
