<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorInformationUserUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensor_information_user_units', function (Blueprint $table) {
            //Schema::disableForeignKeyConstraints();                             
            $table->increments('id');
            $table->string('group');                        
            $table->string('name');                        
            $table->unsignedInteger('user_id');                      
            $table->unsignedInteger('unit_id')->nullable();                      
            
            //$table->foreign('unit_id')->references('id')->on('units');         
            //$table->foreign('user_id')->references('id')->on('users');               
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensor_information_user_units');
    }
}
