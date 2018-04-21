<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SensorTypesTableSeeder extends Seeder
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
        DB::table('sensor_types')->truncate();


        $sensorTypes = [
            [
                'name' => 'dosing point',
                'description' => 'A sensor for measuring oxygen flow into a batch.',
                'created_at' => $timestamp
            ],
        ];

        DB::table('sensor_types')->insert($sensorTypes);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');                   
    }
}
