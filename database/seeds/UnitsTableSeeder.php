<?php

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
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
        DB::table('units')->truncate();
        $units = [
            [
                'type' => '',
                'name' => 'no units',
                'abbreviation' => 'n/a',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'type' => 'time',
                'name' => 'milliseconds',
                'abbreviation' => 'ms',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'type' => 'time',
                'name' => 'seconds',
                'abbreviation' => 's',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'type' => 'time',
                'name' => 'minutes',
                'abbreviation' => 'm',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'type' => 'time',
                'name' => 'hours',
                'abbreviation' => 'h',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'type' => 'mass',
                'name' => 'milligrams',
                'abbreviation' => 'mg',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'type' => 'mass',
                'name' => 'grams',
                'abbreviation' => 'g',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'type' => 'volume',
                'name' => 'liters',
                'abbreviation' => 'l',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'type' => 'volume',
                'name' => 'gallons',
                'abbreviation' => 'gal',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'type' => 'flow',
                'name' => 'milligrams / liter',
                'abbreviation' => 'mg/L',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'type' => 'flow',
                'name' => 'nanograms / second',
                'abbreviation' => 'ng/s',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'type' => 'range',
                'name' => 'percent',
                'abbreviation' => '%',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'type' => 'temperature',
                'name' => 'Celsius',
                'abbreviation' => 'C',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'type' => 'pressure',
                'name' => 'PSI',
                'abbreviation' => 'PSI',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
        ];
  

        DB::table('units')->insert($units);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
