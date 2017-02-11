<?php

namespace Tests\Unit\Users;

use Barryvanveen\Users\User;
use Barryvanveen\Users\UserPresenter;
use Tests\BrowserKitTestCase;

class UserPresenterTest extends BrowserKitTestCase
{
    public function testGetFullName()
    {
        /** @var User $user */
        $user = factory(User::class)->make();

        $presenter = new UserPresenter($user);

        $this->assertEquals($user->firstname.' '.$user->lastname, $presenter->full_name());
    }
}
