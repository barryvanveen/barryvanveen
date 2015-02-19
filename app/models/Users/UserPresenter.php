<?php namespace Barryvanveen\Users;

use Robbo\Presenter\Presenter;

class UserPresenter extends Presenter
{

    /**
     * Get the full name of the user
     *
     * @return string
     */
    public function presentFullName()
    {
        return $this->firstname.' '.$this->lastname;
    }
}
