<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systems', function (Blueprint $table) {            
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->unsignedInteger('system_configuration_id');
            $table->timestamps();
          //  $table->foreign('system_configuration_id')->references('id')->on('system_configurations');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('systems');
    }
}
