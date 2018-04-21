<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SensorTableSeeder extends Seeder
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
        DB::table('sensors')->truncate();

  
        for ($i = 0; $i < 5; $i++) {
                $sensors[] = [
                    'name' => 'sensor - ' . $faker->randomDigitNotNull,
                    'description' => $faker->text(120),
                    'is_active' => 1,
                    'created_at'     => $timestamp,
                    'updated_at'     => $timestamp
                ];
        }

        DB::table('sensors')->insert($sensors);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');        
    }
}
