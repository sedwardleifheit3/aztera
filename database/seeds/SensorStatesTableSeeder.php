<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SensorStatesTableSeeder extends Seeder
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
        DB::table('sensor_states')->truncate();


        $sensorStates = [
            [
                'name' => 'idle',
                'description' => 'Stopped and waiting for commands',
                'created_at' => $timestamp
            ],
            [
                'name' => 'active',
                'description' => 'Performing primary function',
                'created_at' => $timestamp                
            ],
            [
                'name' => 'paused',
                'description' => 'Activity is on hold',
                'created_at' => $timestamp
            ],
            [
                'name' => 'fault',
                'description' => 'Activity has stopped',
                'created_at' => $timestamp
            ],
            [
                'name' => 'warning',
                'description' => 'Warning condition: non-error',
                'created_at' => $timestamp
            ],
            [
                'name' => 'not connected',
                'description' => 'Connection was dropped/lost',
                'created_at' => $timestamp                
            ],
        ];

        DB::table('sensor_states')->insert($sensorStates);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');             
    }
}
