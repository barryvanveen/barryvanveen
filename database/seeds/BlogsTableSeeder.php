<?php

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Faker\Providers\LoremMarkdown;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BlogsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('en_EN');
        $faker->addProvider(new LoremMarkdown($faker));

        foreach (range(1, 20) as $index) {
            Blog::create([
                'title'            => $faker->sentence,
                'summary'          => $faker->markdownParagraph(5),
                'text'             => $faker->markdownText(),
                'publication_date' => $faker->dateTimeBetween('-1 year', '+3 weeks'),
                'online'           => (rand(0, 10) % 10) ? 1 : 0,
            ]);
        }
    }
}
