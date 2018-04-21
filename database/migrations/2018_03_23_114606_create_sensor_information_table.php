<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensor_informations', function (Blueprint $table) {
           //Schema::disableForeignKeyConstraints();                             
            $table->increments('id');
            $table->string('group')->default('main');                        
            $table->string('mac_address')->nullable();                        
            $table->string('dosing_rate')->nullable();   
            $table->string('physical_location')->nullable();     
            $table->string('total_duration')->nullable();   
            $table->string('max_period_length')->nullable();    
            $table->string('max_over_flow_rate')->nullable();  
            $table->string('message')->nullable();  
            
            
            $table->timestamps();
            $table->softDeletes();              
            $table->unsignedInteger('sensor_id');                      
            $table->unsignedInteger('state_id');                      
            $table->unsignedInteger('batch_id');                      

            $table->unsignedInteger('unit_id')->nullable();                        
            $table->unsignedInteger('type_id')->nullable();                      
             
            /*
            $table->foreign('unit_id')->references('id')->on('units');         
            $table->foreign('sensor_id')->references('id')->on('sensors');   
            $table->foreign('type_id')->references('id')->on('sensor_types');   

            $table->foreign('state_id')->references('id')->on('sensor_states');   
            $table->foreign('batch_id')->references('id')->on('batches');   
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::disableForeignKeyConstraints();                             
        Schema::dropIfExists('sensor_informations');
    }
}
