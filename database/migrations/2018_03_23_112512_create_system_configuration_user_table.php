<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemConfigurationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_configuration_users', function (Blueprint $table) {
            //Schema::disableForeignKeyConstraints();                 
            $table->increments('id');
            $table->string('name');
            $table->string('group');
            $table->unsignedInteger('user_id');                        
            $table->unsignedInteger('unit_id')->nullable();                          
            //$table->foreign('unit_id')->references('id')->on('units');            
            //$table->foreign('user_id')->references('id')->on('users');            
            $table->timestamps();
            $table->softDeletes();            
            
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
        Schema::dropIfExists('system_configuration_users');
    }
}
