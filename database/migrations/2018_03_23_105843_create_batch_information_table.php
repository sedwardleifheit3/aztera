<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_informations', function (Blueprint $table) {
          //  Schema::disableForeignKeyConstraints();                             
            $table->increments('id');
            $table->string('group');

            $table->string('wine_id');
            $table->string('vintage');
            $table->string('varietal');
            $table->string('tank');
            $table->string('batch_size');
            $table->string('current_o2');
            $table->string('o2_rate');
            $table->string('dose_start');
            $table->string('o2_duration');
            $table->string('time_dosed');

            $table->unsignedInteger('batch_id');                        
            $table->unsignedInteger('unit_id')->nullable();                       
            $table->timestamps();
            $table->softDeletes();         
                 

           // $table->foreign('batch_id')->references('id')->on('batches');            
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
        //Schema::disableForeignKeyConstraints();                             
        Schema::dropIfExists('batch_informations');
    }
}
