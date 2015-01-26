<?php

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Faker\Providers\LoremHtml;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BlogsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('nl_NL');
        $faker->addProvider(new LoremHtml($faker));

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
                'summary'          => $faker->htmlParagraph(5),
                'text'             => $faker->htmlText(),
                'image'            => $image,
                'publication_date' => $faker->dateTimeBetween('-1 year', '+3 weeks'),
                // 1 on 10 events is offline
                'online'           => (rand(0, 10) % 10) ? 1 : 0,
            ]);
        }
    }
}
