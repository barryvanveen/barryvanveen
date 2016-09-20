<?php

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Users\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PrivatePagesTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test if authorization works properly on the admin section.
     */
    public function testAuthorizationNeeded()
    {
        /** @var User $user */
        $user = factory(Barryvanveen\Users\User::class)->create();

        /** @var Blog $blog */
        $blog = factory(Barryvanveen\Blogs\Blog::class)->create();

        $this->visit(route('admin.blog'))
            ->seePageIs(route('admin.login'));

        $this->actingAs($user);

        $this->visit(route('admin.blog'))
            ->seePageIs(route('admin.blog'))
            ->see($blog->title);
    }

    /**
     * Test logging in to the admin section.
     */
    public function testLoginForm()
    {
        $email    = 'mymail@example.org';
        $password = 'secret';

        /** @var Barryvanveen\Users\User $user */
        $user = factory(Barryvanveen\Users\User::class)->create([
            'email'    => $email,
            'password' => $password,
        ]);

        $this->visit(route('admin.login'))
             ->see(trans('login.button'));

        $this->type($email, 'email')
             ->type($password, 'password')
             ->press(trans('login.button'));

        $this->seePageIs(route('admin.dashboard'))
             ->see(trans('nav.signed-in-as').' '.$user->firstname.' '.$user->lastname);

        $this->assertTrue(Auth::check());
    }

    /**
     * Test logging out of the admin section.
     */
    public function testLogoutAction()
    {
        $user = factory(Barryvanveen\Users\User::class)->create();

        $this->actingAs($user);

        $this->visit(route('admin.dashboard'))
             ->see(trans('nav.sign-out'));

        $this->assertTrue(Auth::check());

        $this->click(trans('nav.sign-out'))
             ->seePageIs(route('home'));

        $this->assertFalse(Auth::check());
    }
}
