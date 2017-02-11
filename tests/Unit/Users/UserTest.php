<?php

namespace Tests\Unit\Users;

use Barryvanveen\Users\User;
use Barryvanveen\Users\UserPresenter;
use Tests\BrowserKitTestCase;

class UserTest extends BrowserKitTestCase
{
    public function testPasswordIsHashed()
    {
        $user = new User();
        $user->password = 'secret';

        $this->assertNotEquals('secret', $user->password);
        $this->assertTrue(password_verify('secret', $user->password));
    }

    public function testGetPresenterClass()
    {
        /** @var User $user */
        $user = factory(User::class)->make();
        $this->assertEquals(UserPresenter::class, $user->getPresenterClass());
    }
}
