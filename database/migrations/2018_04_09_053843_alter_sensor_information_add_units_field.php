<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSensorInformationAddUnitsField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sensor_informations', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->string('dosing_rate_unit')->nullable();
            $table->string('duration_unit')->nullable();            
        });            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sensor_informations', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropColumn('dosing_rate_unit');
            $table->dropColumn('duration_unit');
        });            
    }
}
