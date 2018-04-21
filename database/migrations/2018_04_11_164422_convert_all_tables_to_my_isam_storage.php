<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConvertAllTablesToMyIsamStorage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $dbSchemaManager = Schema::getConnection()->getDoctrineSchemaManager();
        
        foreach ($dbSchemaManager->listTableNames() as $tableName) {
            DB::statement(sprintf('ALTER TABLE %s ENGINE = MyISAM', $tableName));        
        }        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
