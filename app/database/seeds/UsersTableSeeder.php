<?php

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        User::truncate();

        $this->createEnvUser();
        $this->createFakeUsers();
    }

    protected function createEnvUser()
    {
        $user = new User();
        $user->first_name = $_ENV['USER_FIRST_NAME'];
        $user->last_name = $_ENV['USER_LAST_NAME'];
        $user->email = $_ENV['USER_EMAIL'];
        $user->password = $_ENV['USER_PASS'];
        $user->save();
    }

    protected function createFakeUsers()
    {
        $faker = Faker::create();

        for($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->first_name = $faker->firstName;
            $user->last_name = $faker->lastName;
            $user->email = $faker->email;
            $user->password = $faker->password;
            $user->save();
        }
    }


}
