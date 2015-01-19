<?php

use Barryvanveen\Blogs\Blog;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BlogsTableSeeder extends Seeder
{

    public function run()
    {

        $uploads = 'public_html/uploads/blogs';
        File::makeDirectory($uploads, 755, true, true);

        // First, empty upload directory
        array_map('unlink', glob($uploads . '/*.*'));

        $faker = Faker::create('nl_NL');

        foreach (range(1, 10) AS $index) {

            // todo: fix image
            /*$image = $faker->file('database/seeds/images/blogs', $uploads);
            $image = str_replace('public_html/', '', $image);*/

            Blog::create([
                'title'            => $faker->sentence(),
                'summary'          => $faker->paragraph(),
                'text'             => $faker->text(500),
                //'image'            => $image,
                'publication_date' => $faker->dateTimeBetween('-1 year', '+3 weeks'),
                // 1 on 10 events is offline
                'online'           => (rand(0, 10) % 10) ? 1 : 0
            ]);
        }

    }

}
