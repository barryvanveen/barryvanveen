<?php
namespace Barryvanveen\Users;

use McCool\LaravelAutoPresenter\BasePresenter;

class UserPresenter extends BasePresenter
{
    /**
     * @param User $user
     */
    function __construct(User $user)
    {
        $this->resource = $user;
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
