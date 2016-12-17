<?php

use Faker\Factory as Faker;
use Barryvanveen\Pages\Page;
use Illuminate\Database\Seeder;
use Barryvanveen\Faker\Providers\LoremMarkdown;

class PagesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('en_EN');
        $faker->addProvider(new LoremMarkdown($faker));

        Page::create([
            'title'  => 'About me',
            'text'   => $faker->markdownText(),
            'online' => 1,
        ]);

        Page::create([
            'title'  => 'Books that I have read',
            'text'   => $faker->markdownText(),
            'online' => 1,
        ]);

        foreach (range(1, 5) as $index) {
            Page::create([
                'title'  => $faker->sentence(),
                'text'   => $faker->markdownText(),
                'online' => (rand(0, 10) % 10) ? 1 : 0,
            ]);
        }
    }
}
