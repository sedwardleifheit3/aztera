<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchInformationUserUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_information_user_unit', function (Blueprint $table) {
            //Schema::disableForeignKeyConstraints();                             
            $table->increments('id');
            $table->string('name');
            $table->string('group');
            $table->unsignedInteger('user_id');                        
            $table->unsignedInteger('unit_id')->nullable();                      
            $table->timestamps();
            $table->softDeletes();              

           // $table->foreign('user_id')->references('id')->on('users');            
           // $table->foreign('unit_id')->references('id')->on('units');            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       // Schema::disableForeignKeyConstraints();                             
        Schema::dropIfExists('batch_information_user_unit');
    }
}
