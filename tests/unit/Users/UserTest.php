<?php

use Barryvanveen\Users\User;
use Barryvanveen\Users\UserPresenter;

class UserTest extends TestCase
{
    public function testPasswordIsHashed()
    {
        $user           = new User();
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
