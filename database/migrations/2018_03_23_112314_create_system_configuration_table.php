<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_configurations', function (Blueprint $table) {
            //Schema::disableForeignKeyConstraints();                 
            $table->increments('id');
            $table->string('group')->default('main');

            $table->string('dosing_point_gateway');
            $table->string('dosing_point_subnet_mask');            
            $table->string('language');            
            $table->string('recording_interval');            

            $table->unsignedInteger('unit_id')->nullable();                         
            $table->timestamps();
            $table->softDeletes();            

            //table->foreign('unit_id')->references('id')->on('units');            
            
            
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
        Schema::dropIfExists('system_configurations');
    }
}
