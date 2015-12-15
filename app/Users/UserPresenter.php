<?php
namespace Barryvanveen\Users;

use McCool\LaravelAutoPresenter\BasePresenter;

class UserPresenter extends BasePresenter
{
    /** @var User $resource */
    protected $resource;

    /**
     * @param User $resource
     */
    public function __construct(User $resource)
    {
        $this->resource = $resource;
    }

    /**
     * Get the full name of the user.
     *
     * @return string
     */
    public function full_name()
    {
        return $this->resource->firstname.' '.$this->resource->lastname;
    }
}
