<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SensorInformationTableSeeder extends Seeder
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
        DB::table('sensor_informations')->truncate();

  
        for ($i = 1; $i < 6; $i++) {
                $info[] = [
                    'mac_address'   => $faker->macAddress,
                    'dosing_rate'   => $faker->randomFloat(4),
                    'physical_location'     => $faker->domainWord,
                    'total_duration'     => $faker->randomFloat(4),
                    'max_period_length'     => $faker->randomDigitNotNull,
                    'max_over_flow_rate'     => $faker->randomDigitNotNull,
                    'message'     => $faker->text(40),
                    'sensor_id'  => $i,
                    'batch_id'  => $faker->numberBetween(45,50),
                    'state_id'  => $faker->numberBetween(1,6),
                    'group' => 'main',
                    'type_id' => 1, //dosing point
                    'created_at'     => $timestamp,
                    'updated_at'     => $timestamp
                ];
        }

        DB::table('sensor_informations')->insert($info);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');             

    }
}
