<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Barryvanveen\Blogs\Blog::class, function (Faker $faker) {
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

$factory->defineAs(Barryvanveen\Blogs\Blog::class, 'published', function (Faker $faker) use ($factory) {
    $blog = $factory->raw(Barryvanveen\Blogs\Blog::class);

    $blog['publication_date'] = $faker->dateTime;
    $blog['online'] = 1;

    return $blog;
});

$factory->defineAs(Barryvanveen\Blogs\Blog::class, 'unpublished-offline', function (Faker $faker) use ($factory) {
    $blog = $factory->raw(Barryvanveen\Blogs\Blog::class);

    $blog['publication_date'] = $faker->dateTime;
    $blog['online'] = 0;

    return $blog;
});

$factory->defineAs(Barryvanveen\Blogs\Blog::class, 'unpublished-future', function (Faker $faker) use ($factory) {
    $blog = $factory->raw(Barryvanveen\Blogs\Blog::class);

    $blog['publication_date'] = $faker->dateTimeBetween('+1 day', '+2 days');
    $blog['online'] = 1;

    return $blog;
});
