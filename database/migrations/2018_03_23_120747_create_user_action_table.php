<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_actions', function (Blueprint $table) {
            //Schema::disableForeignKeyConstraints();                             
            $table->increments('id');             
            $table->string('description');                        
            $table->timestamps();
            $table->softDeletes();              

            $table->unsignedInteger('user_action_type_id')->nullable();                        
            $table->unsignedInteger('user_id')->nullable();                        
            
            //$table->foreign('user_action_type_id')->references('id')->on('user_action_types');         
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
        Schema::dropIfExists('user_actions');
    }
}
