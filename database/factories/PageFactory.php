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

$factory->define(Barryvanveen\Pages\Page::class, function (Faker $faker) {
    $title = $faker->sentence;

    return [
        'title'  => $title,
        'slug'   => Str::slug($title),
        'text'   => $faker->paragraph,
        'online' => $faker->boolean(),
    ];
});
