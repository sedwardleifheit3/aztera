<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     * @since the existing database has user table instead of users, use `user` singular
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
          //  Schema::disableForeignKeyConstraints();                 
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            $table->unsignedInteger('language_id')->nullable();            
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->string('api_token', 60)->unique()->nullable();
           // $table->foreign('language_id')->references('id')->on('languages');


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
        Schema::dropIfExists('users');
    }
}
