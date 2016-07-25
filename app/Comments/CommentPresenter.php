<?php
namespace Barryvanveen\Comments;

use Carbon\Carbon;
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

    /**
     * @return string
     */
    public function name()
    {
        return $this->wrappedObject->name;
    }

    /**
     * @return string
     */
    public function email()
    {
        return $this->wrappedObject->email;
    }

    /**
     * @return string
     */
    public function ip()
    {
        return $this->wrappedObject->ip;
    }

    /**
     * @return string
     */
    public function fingerprint()
    {
        return $this->wrappedObject->fingerprint;
    }

    /**
     * @return string
     */
    public function created_at_formatted()
    {
        $date = new Carbon($this->wrappedObject->created_at);

        return $date->format('Y-m-d H:i:s');
    }

    /**
     * @return string
     */
    public function created_at_formatted_rfc3339()
    {
        $date = new Carbon($this->wrappedObject->created_at);

        return $date->toRfc3339String();
    }

}
