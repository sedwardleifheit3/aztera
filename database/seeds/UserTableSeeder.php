<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = date('Y-m-d H:i:s');
        $faker     = Faker::create();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();

        $users = [
            [
                'email'          => 'admin@enartis.com',
                'password'       => bcrypt('password1'),
                'name'           => 'enartis admin',
                'remember_token' => str_random(10),
                'created_at'     => $timestamp,
                'updated_at'     => $timestamp
            ]

        ];

        for ($i = 0; $i < 5; $i++) {
                $users[] = [
                    'email'          => $faker->safeEmail,
                    'password'       => bcrypt('password1'),
                    'name'     => $faker->firstName,
                    'remember_token' => str_random(10),
                    'created_at'     => $timestamp,
                    'updated_at'     => $timestamp
                ];
        }

        DB::table('users')->insert($users);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
