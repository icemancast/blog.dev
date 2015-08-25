<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder {

    public function run()
    {
        Post::truncate();

        $faker = Faker::create();

        for($i=1; $i<=23; $i++)
        {
            $post = new Post();
            $post->title = $faker->catchPhrase;
            $post->body  = $faker->realText;
            $post->save();
        }
    }

}
