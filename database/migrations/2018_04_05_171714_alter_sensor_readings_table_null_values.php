<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSensorReadingsTableNullValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sensor_readings', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->string('dosing_rate')->nullable()->change();
            $table->string('dosed_amount')->nullable()->change();
            $table->string('dosed_duration')->nullable()->change();
            $table->string('temperature')->nullable()->change();
            $table->string('inlet_pressure')->nullable()->change();
            $table->string('outlet_pressure')->nullable()->change();
            
        });            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sensor_readings', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->string('dosing_rate')->nullable(false)->change();
            $table->string('dosed_amount')->nullable(false)->change();
            $table->string('dosed_duration')->nullable(false)->change();
            $table->string('temperature')->nullable(false)->change();
            $table->string('inlet_pressure')->nullable(false)->change();
            $table->string('outlet_pressure')->nullable(false)->change();
        });            
    }
}
