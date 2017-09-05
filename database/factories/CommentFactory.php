<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Barryvanveen\Comments\Comment::class, function (Faker $faker) {
    return [
        'email'       => $faker->email,
        'name'        => $faker->name,
        'text'        => $faker->unique()->paragraph,
        'ip'          => $faker->ipv4,
        'fingerprint' => $faker->randomNumber(),
        'online'      => (rand(0, 10) % 10) ? 1 : 0,
    ];
});

$factory->defineAs(Barryvanveen\Comments\Comment::class, 'online', function () use ($factory) {
    $comment = $factory->raw(Barryvanveen\Comments\Comment::class);

    $comment['online'] = 1;

    return $comment;
});

$factory->defineAs(Barryvanveen\Comments\Comment::class, 'offline', function () use ($factory) {
    $comment = $factory->raw(Barryvanveen\Comments\Comment::class);

    $comment['online'] = 0;

    return $comment;
});
