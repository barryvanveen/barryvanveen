<?php

namespace Tests\Integration;

use Barryvanveen\Users\User;
use Barryvanveen\Users\UserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\BrowserKitTestCase;

class UserRepositoryTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    public function testFindsUserByEmail()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        $repository = new UserRepository();

        $userFromRepository = $repository->findByEmail($user->email);

        $this->assertEquals($user->email, $userFromRepository->email);
    }

    public function testReturnsFalseForNonExistingUser()
    {
        $repository = new UserRepository();

        $user = $repository->findByEmail('nonexisting-email@example.org');

        $this->assertEmpty($user);
    }
}
