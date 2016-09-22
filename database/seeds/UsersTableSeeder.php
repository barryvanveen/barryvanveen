<?php

use Barryvanveen\Users\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $user = new User();

        $user->firstname = 'Your';
        $user->lastname = 'Name';
        $user->email = 'admin@example.com';
        $user->password = 'secret';

        $user->save();
    }
}
