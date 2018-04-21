<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class SystemTableSeeder extends Seeder
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
        DB::table('systems')->truncate();

        $system = [
            [
                'name'           => 'Main System',
                'description'    => $faker->realText(100),
                'system_configuration_id' => 1,
                'created_at'     => $timestamp,
                'updated_at'     => $timestamp
            ]

        ];


        DB::table('systems')->insert($system);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');        
    }
}
