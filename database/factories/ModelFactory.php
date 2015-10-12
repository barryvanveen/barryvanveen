<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var Illuminate\Database\Eloquent\Factory $factory */
use Illuminate\Support\Str;

$factory->define(Barryvanveen\Users\User::class, function ($faker) {
    /* @var Faker\Generator $faker */
    return [
        'firstname'      => $faker->firstName,
        'lastname'       => $faker->lastName,
        'email'          => $faker->safeEmail,
        'password'       => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Barryvanveen\Blogs\Blog::class, function ($faker) {
    /* @var Faker\Generator $faker */
    $title = $faker->sentence;

    return [
        'title'            => $title,
        'slug'             => Str::slug($title),
        'summary'          => $faker->paragraph,
        'text'             => $faker->paragraph,
        'publication_date' => $faker->dateTimeBetween('-1 month', '+1 month'),
        'online'           => $faker->boolean(),
    ];
});

$factory->define(Barryvanveen\Pages\Page::class, function ($faker) {
    /* @var Faker\Generator $faker */
    $title = $faker->sentence;

    return [
        'title'  => $title,
        'slug'   => Str::slug($title),
        'text'   => $faker->paragraph,
        'online' => $faker->boolean(),
    ];
});
