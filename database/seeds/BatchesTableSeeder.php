<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BatchesTableSeeder extends Seeder
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
        DB::table('batches')->truncate();

  
        for ($i = 0; $i < 50; $i++) {
                $batches[] = [
                    'name' => 'batch - ' . $faker->randomDigitNotNull,
                    'description' => $faker->text(120),
                    'created_at'     => $timestamp,
                    'updated_at'     => $timestamp
                ];
        }

        DB::table('batches')->insert($batches);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');                
    }
}
