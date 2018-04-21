<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
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
        DB::table('roles')->truncate();
        DB::table('roles')->insert([
          [
            'name' => 'Admin',
            'slug' => 'admin',
            'created_at' => $timestamp,
            'updated_at' => $timestamp
          ],
          [
            'name' => 'Developer',
            'slug' => 'dev',
            'created_at' => $timestamp,
            'updated_at' => $timestamp
          ],
          [
            'name' => 'Basic User',
            'slug' => 'basic',
            'created_at' => $timestamp,
            'updated_at' => $timestamp
          ],
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');    
    }
}
