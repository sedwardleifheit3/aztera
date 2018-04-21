<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            //Schema::disableForeignKeyConstraints();                             
            $table->increments('id');
            $table->string('name')->nullable();      
            $table->text('description')->nullable();                  
            $table->tinyInteger('is_active');
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
        Schema::dropIfExists('sensors');
    }
}
