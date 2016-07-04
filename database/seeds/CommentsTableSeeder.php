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

        foreach($blogs as $blog) {
            $has_comments = $faker->numberBetween(0, 1);

            if (!$has_comments) {
                continue;
            }

            $number_of_comments = $faker->numberBetween(0, 10);

            for($i = 0; $i < $number_of_comments; $i++) {
                Comment::create([
                    'blog_id' => $blog->id,
                    'text' => $faker->paragraph(),
                ]);
            }
        }
    }
}
