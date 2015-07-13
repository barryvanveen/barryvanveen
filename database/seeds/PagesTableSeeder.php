<?php

use Barryvanveen\Faker\Providers\LoremMarkdown;
use Barryvanveen\Pages\Page;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('nl_NL');
        $faker->addProvider(new LoremMarkdown($faker));

        Page::create([
            'title'  => 'Over mij',
            'text'   => $faker->markdownText(),
            'online' => 1,
        ]);

        Page::create([
            'title'  => 'Boeken die ik heb gelezen',
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
