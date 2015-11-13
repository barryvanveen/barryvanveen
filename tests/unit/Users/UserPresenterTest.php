<?php

use Barryvanveen\Users\User;
use Barryvanveen\Users\UserPresenter;

class UserPresenterTest extends TestCase
{
    public function testGetFullName() {
        /** @var User $user */
        $user = factory(User::class)->make();

        $presenter = new UserPresenter($user);

        $this->assertEquals($user->firstname.' '.$user->lastname, $presenter->full_name());
    }
}
