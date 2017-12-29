<?php

use Barryvanveen\Blogs\BlogRepository;
use Barryvanveen\Comments\Comment;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /** @var BlogRepository */
    private $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function run()
    {
        $faker = Faker::create('en_EN');

        $blogs = $this->blogRepository->all();

        foreach ($blogs as $blog) {
            $has_comments = $faker->numberBetween(0, 1);

            if (! $has_comments) {
                continue;
            }

            $number_of_comments = $faker->numberBetween(0, 10);

            for ($i = 0; $i < $number_of_comments; $i++) {
                $created_at = $faker->dateTimeBetween('-1 year', 'now');

                Comment::create([
                    'blog_id'     => $blog->id,
                    'email'       => $faker->email,
                    'name'        => $faker->name,
                    'text'        => $faker->paragraph,
                    'ip'          => $faker->ipv4,
                    'fingerprint' => $faker->randomNumber(),
                    'online'      => (rand(0, 10) % 10) ? 1 : 0,
                    'created_at'  => $created_at,
                    'updated_at'  => $created_at,
                ]);
            }
        }
    }
}
