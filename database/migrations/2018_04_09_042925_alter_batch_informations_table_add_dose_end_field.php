<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBatchInformationsTableAddDoseEndField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('batch_informations', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dateTime('dose_start')->nullable()->change();
            $table->dateTime('dose_end')->nullable();            
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
            Schema::disableForeignKeyConstraints();
            $table->dropColumn('dose_start');
            $table->string('dose_end')->nullable()->change();            
        });            
    }
}
