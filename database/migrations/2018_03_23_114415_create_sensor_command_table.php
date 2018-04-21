<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorCommandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensor_commands', function (Blueprint $table) {
            //Schema::disableForeignKeyConstraints();                             
            $table->increments('id');
            $table->string('value');                        
            $table->timestamp('transmitted')->nullable();
            $table->timestamp('acknowledged')->nullable();
            $table->timestamp('rejected')->nullable();
            $table->unsignedInteger('sensor_id');                       
            $table->unsignedInteger('sensor_command_type_id');                       
            $table->unsignedInteger('user_id');  
            $table->timestamps();
            $table->softDeletes();

            //$table->foreign('sensor_command_type_id')->references('id')->on('sensor_command_types');         
            //$table->foreign('sensor_id')->references('id')->on('sensors');          
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
        //Schema::disableForeignKeyConstraints();           
        Schema::dropIfExists('sensor_commands');
    }
}
