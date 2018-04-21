<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorReadingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensor_readings', function (Blueprint $table) {
            //Schema::disableForeignKeyConstraints();                             
            $table->increments('id');
            $table->string('dosing_rate');                        
            $table->string('dosed_amount');                        
            $table->string('dosed_duration');                        
            $table->string('temperature');                        
            $table->string('inlet_pressure');                        
            $table->string('outlet_pressure');                        

            $table->unsignedInteger('sensor_id');                      
            $table->unsignedInteger('unit_id')->nullable();                      
            $table->unsignedInteger('batch_id')->nullable();                     
            $table->timestamps();
            $table->softDeletes();              
            
            //$table->foreign('unit_id')->references('id')->on('units');         
            //$table->foreign('sensor_id')->references('id')->on('sensors');               
            //$table->foreign('batch_id')->references('id')->on('batches');               
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensor_readings');
    }
}
