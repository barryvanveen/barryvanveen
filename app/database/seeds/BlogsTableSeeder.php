<?php

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Faker\Providers\LoremMarkdown;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BlogsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('nl_NL');
        $faker->addProvider(new LoremMarkdown($faker));

        // destination for uploads
        $uploads = 'public_html/uploads/blogs';
        File::makeDirectory($uploads, 755, true, true);
        array_map('unlink', glob($uploads.'/*.*'));

        foreach (range(1, 20) as $index) {
            // pick a random upload to attach to blog
            $image = $faker->file('app/database/seeds/images/blogs', $uploads);
            $image = str_replace('public_html/', '', $image);

            Blog::create([
                'title'            => $faker->sentence(),
                'summary'          => $faker->markdownParagraph(5),
                'text'             => $faker->markdownText(),
                'image'            => $image,
                'publication_date' => $faker->dateTimeBetween('-1 year', '+3 weeks'),
                'online'           => (rand(0, 10) % 10) ? 1 : 0,
            ]);
        }
    }
}
