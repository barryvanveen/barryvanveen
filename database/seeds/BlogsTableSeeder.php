<?php

use Barryvanveen\Blogs\Blog;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BlogsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('nl_NL');

        // destination for uploads
        $uploads = 'public_html/uploads/blogs';
        File::makeDirectory($uploads, 755, true, true);
        array_map('unlink', glob($uploads.'/*.*'));

        foreach (range(1, 20) as $index) {
            // pick a random upload to attach to blog
            $image = $faker->file('database/seeds/images/blogs', $uploads);
            $image = str_replace('public_html/', '', $image);

            Blog::create([
                'title'            => $faker->sentence(),
                'summary'          => $faker->text(500),
                'text'             => $faker->text(2000),
                'image'            => $image,
                'publication_date' => $faker->dateTimeBetween('-1 year', '+3 weeks'),
                // 1 on 10 events is offline
                'online'           => (rand(0, 10) % 10) ? 1 : 0,
            ]);
        }
    }
}
