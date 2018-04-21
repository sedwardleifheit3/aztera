<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
            UserTableSeeder::class,
            RolesTableSeeder::class,     
            RoleUserTableSeeder::class,           
            SystemTableSeeder::class,           
            SystemConfigurationTableSeeder::class,           
            SensorTableSeeder::class,
            SensorInformationTableSeeder::class,
            SensorStatesTableSeeder::class,
            SensorTypesTableSeeder::class,
            BatchesTableSeeder::class,
            BatchInformationsTableSeeder::class,
            UnitsTableSeeder::class,
            SensorCommandTypesTableSeeder::class,
            SensorReadingsTableSeeder::class
         ]);
    }
}
