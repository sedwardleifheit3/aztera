<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSensorInformationsTableNullableFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sensor_informations', function (Blueprint $table) {
            //Schema::disableForeignKeyConstraints();
            $table->unsignedInteger('state_id')->nullable()->change();
            $table->unsignedInteger('batch_id')->nullable()->change();
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            //Schema::disableForeignKeyConstraints();
            $table->unsignedInteger('state_id')->nullable(false)->change();
            $table->unsignedInteger('batch_id')->nullable(false)->change();
        });        
    }
}
