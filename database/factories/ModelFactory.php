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

    $factory->defineAs(Barryvanveen\Blogs\Blog::class, 'published', function ($faker) use ($factory) {
        /* @var Faker\Generator $faker */
        $blog = $factory->raw(Barryvanveen\Blogs\Blog::class);

        $blog['publication_date'] = $faker->dateTime;
        $blog['online'] = 1;

        return $blog;
    });

    $factory->defineAs(Barryvanveen\Blogs\Blog::class, 'unpublished-offline', function ($faker) use ($factory) {
        /* @var Faker\Generator $faker */
        $blog = $factory->raw(Barryvanveen\Blogs\Blog::class);

        $blog['publication_date'] = $faker->dateTime;
        $blog['online'] = 0;

        return $blog;
    });

    $factory->defineAs(Barryvanveen\Blogs\Blog::class, 'unpublished-future', function ($faker) use ($factory) {
        /* @var Faker\Generator $faker */
        $blog = $factory->raw(Barryvanveen\Blogs\Blog::class);

        $blog['publication_date'] = $faker->dateTimeBetween('+1 day', '+2 days');
        $blog['online'] = 1;

        return $blog;
    });

$factory->define(Barryvanveen\Comments\Comment::class, function ($faker) {
    /* @var Faker\Generator $faker */
    return [
        'email'       => $faker->email,
        'name'        => $faker->name,
        'text'        => $faker->unique()->paragraph,
        'ip'          => $faker->ipv4,
        'fingerprint' => $faker->randomNumber(),
        'online'      => (rand(0, 10) % 10) ? 1 : 0,
    ];
});

    $factory->defineAs(Barryvanveen\Comments\Comment::class, 'online', function ($faker) use ($factory) {
        /* @var Faker\Generator $faker */
        $comment = $factory->raw(Barryvanveen\Comments\Comment::class);

        $comment['online'] = 1;

        return $comment;
    });

    $factory->defineAs(Barryvanveen\Comments\Comment::class, 'offline', function ($faker) use ($factory) {
        /* @var Faker\Generator $faker */
        $comment = $factory->raw(Barryvanveen\Comments\Comment::class);

        $comment['online'] = 0;

        return $comment;
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
