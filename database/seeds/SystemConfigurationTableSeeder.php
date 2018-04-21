<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SystemConfigurationTableSeeder extends Seeder
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
        DB::table('system_configurations')->truncate();

        $system = [
            [
                'group'           => 'main',
                'dosing_point_gateway'    => $faker->ipv4,
                'dosing_point_subnet_mask'    => $faker->ipv4,
                'recording_interval'    => 1,
                'language'    => "English",
                'created_at'     => $timestamp,
                'updated_at'     => $timestamp
            ]

        ];


        DB::table('system_configurations')->insert($system);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');        
        
    }
}
