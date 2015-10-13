<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PrivatePagesTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * Test logging in to the admin section
     */
    public function testLoginForm()
    {
        $email = 'mymail@example.org';
        $password = 'secret';

        /** @var Barryvanveen\Users\User $user */
        $user = factory(Barryvanveen\Users\User::class)->create([
            'email' => $email,
            'password' => $password,
        ]);

        $this->visit(route('admin.login'))
             ->see('Inloggen');

        $this->type($email, 'email')
             ->type($password, 'password')
             ->press('Inloggen');

        $this->seePageIs(route('admin.dashboard'))
             ->see('Ingelogd als '.$user->firstname.' '.$user->lastname);

        $this->assertTrue(Auth::check());
    }

    /**
     * Test logging out of the admin section
     */
    public function testLogoutAction()
    {
        $user = factory(Barryvanveen\Users\User::class)->create();

        $this->actingAs($user);

        $this->visit(route('admin.dashboard'))
             ->see('Uitloggen');

        $this->assertTrue(Auth::check());

        $this->click('Uitloggen')
             ->seePageIs(route('home'));

        $this->assertFalse(Auth::check());
    }
}
