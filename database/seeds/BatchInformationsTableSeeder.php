<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BatchInformationsTableSeeder extends Seeder
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
        DB::table('batch_informations')->truncate();

  
        for ($i = 0; $i < 50; $i++) {
                $batcheInfos[] = [
                    'group' => 'main',
                    'batch_id' => ($i + 1),
                    'wine_id' => $faker->word,
                    'vintage' => $faker->year($max = 'now'),
                    'varietal' => $faker->randomDigit,
                    'tank' => $faker->randomDigit,
                    'current_o2' => $faker->randomDigit,
                    'o2_rate' => $faker->randomDigit,
                    'dose_start' => $faker->dateTimeThisYear('now', 'UTC'),
                    'dose_end' => $faker->dateTimeThisYear('2018-12-29', 'UTC'),
                    'o2_duration' => $faker->randomDigit,
                    'time_dosed' => $faker->randomDigit,
                    'batch_size' => $faker->numberBetween(1000, 10000),
                    'created_at'     => $timestamp,
                    'updated_at'     => $timestamp
                ];
        }

        DB::table('batch_informations')->insert($batcheInfos);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');               
    }
}
