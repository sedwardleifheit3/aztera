<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class SensorReadingsTableSeeder extends Seeder
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
        DB::table('sensor_readings')->truncate();

  
        for ($i = 1; $i < 2000; $i++) {
                $sensorReadings[] = [
                    'dosing_rate'  => $faker->randomFloat(4,0,5000),
                    'dosed_amount'  => $faker->numberBetween(100,1000),
                    'dosed_duration'  => $faker->numberBetween(100,1000),
                    'temperature'  => $faker->numberBetween(0,60),
                    'inlet_pressure'  => $faker->numberBetween(0,60),
                    'outlet_pressure'  => $faker->numberBetween(0,100),
                    'outlet_pressure'  => $faker->numberBetween(0,100),
                    'sensor_id'  => $faker->numberBetween(1,5),
                    'batch_id'  => $faker->numberBetween(1,50),
                    'unit_id'  => $faker->numberBetween(1,14),
                    'created_at'    => $faker->dateTimeBetween('-30 days', '+30 days'),
                    'updated_at'     => $timestamp
                ];
        }

        DB::table('sensor_readings')->insert($sensorReadings);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');             
    }
}
