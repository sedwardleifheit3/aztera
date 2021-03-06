<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSensorCommandsTableValueNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sensor_commands', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->string('value')->nullable()->change();            
        });         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sensor_commands', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->string('value')->nullable(true)->change();            
        });         
    }
}
