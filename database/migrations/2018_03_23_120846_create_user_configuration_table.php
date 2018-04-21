<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_configurations', function (Blueprint $table) {
            
            //Schema::disableForeignKeyConstraints();                 
            $table->increments('id');
            $table->string('group');

            $table->string('dosing_point_gateway');
            $table->string('dosing_point_subnet_mask');            
            $table->string('language');            
            $table->string('recording_interval');            

            $table->unsignedInteger('system_id');                        
            $table->unsignedInteger('unit_id')->nullable();                         
            $table->timestamps();
            $table->softDeletes();            

            //$table->foreign('system_id')->references('id')->on('systems');            
            //$table->foreign('unit_id')->references('id')->on('units');                   
            
            
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
        Schema::dropIfExists('user_configurations');
    }
}
