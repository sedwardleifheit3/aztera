<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimestampToSensorCommandTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sensor_command_types', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
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
        Schema::table('sensor_command_types', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropColumn('deleted_at');
            $table->dropColumn('created_at');
            $table->dropColumn('update_at');
        });              
    }
}
