<?php

use Illuminate\Database\Seeder;

class SensorCommandTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = date('Y-m-d H:i:s');

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('sensor_command_types')->truncate();
        $sensorCommandTypes = [
            [
                'name' => 'fill',
                'description' => 'Request that the dosing point fill its dosing line.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'empty',
                'description' => 'Request that the dosing point empty its line.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'update',
                'description' => 'Request that the sensor update its primary parameter.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'start',
                'description' => 'Request that the dosing point begin dosing.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'stop',
                'description' => 'Request that the dosing point stop dosing.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'pause',
                'description' => 'Request that the dosing point pause dosing.',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'push configuration',
                'description' => 'Request that the sensor configuration be pushed to the sensor',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'status',
                'description' => 'Request that the sensor update the database with its status',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];
  
   

        DB::table('sensor_command_types')->insert($sensorCommandTypes);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');             
        
    }
}
