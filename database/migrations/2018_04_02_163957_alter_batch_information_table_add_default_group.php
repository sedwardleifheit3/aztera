<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBatchInformationTableAddDefaultGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('batch_informations', function (Blueprint $table) {
            //Schema::disableForeignKeyConstraints();
            $table->string('group')->nullable()->default('main')->change();
            $table->string('current_o2')->nullable()->change();
            $table->string('o2_rate')->nullable()->change();
            $table->string('dose_start')->nullable()->change();
            $table->string('o2_duration')->nullable()->change();
            $table->string('time_dosed')->nullable()->change();
        });   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('batch_informations', function (Blueprint $table) {
           // Schema::disableForeignKeyConstraints();
            $table->string('group')->nullable(false)->default('')->change();
            $table->string('current_o2')->nullable(false)->change();
            $table->string('o2_rate')->nullable(false)->change();
            $table->string('dose_start')->nullable(false)->change();
            $table->string('o2_duration')->nullable(false)->change();
            $table->string('time_dosed')->nullable(false)->change();            
        });   
    }
}
