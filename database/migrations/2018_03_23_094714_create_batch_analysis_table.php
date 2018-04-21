<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_analyses', function (Blueprint $table) {
           // Schema::disableForeignKeyConstraints();                             
            $table->increments('id');
            $table->string('temperature')->nullable();
            $table->string('ph')->nullable();
            $table->string('volatile_acidity')->nullable();
            $table->string('co2_level')->nullable();
            $table->string('malic_acid')->nullable();
            $table->string('gluconic_acid')->nullable();
            $table->string('alchohol')->nullable();
            $table->string('tartaric_acid')->nullable();
            $table->string('dissolved_oxygen')->nullable();
            $table->string('lactic_acid')->nullable();
            $table->string('conductivity')->nullable();
            $table->string('assimble_amino_nitrogen')->nullable();
            $table->string('total_so2')->nullable();
            $table->string('ammonia_nitrogen')->nullable();
            $table->string('yeast_assimble_nitrogen')->nullable();
            $table->string('od280')->nullable();
            $table->string('titratable_acidity')->nullable();
            $table->string('acetaldehyde')->nullable();
            $table->string('potassium')->nullable();
            $table->string('copper')->nullable();
            $table->string('free_so2')->nullable();
            $table->string('sugar')->nullable();
            $table->string('od280_au')->nullable();
            $table->string('od280_mg_l')->nullable();
            $table->string('od520')->nullable();
            $table->string('od420')->nullable();
            $table->string('od620')->nullable();
            $table->string('glucose_fructose')->nullable();
            $table->string('iron')->nullable();
            $table->string('methanol')->nullable();
            $table->string('turbidity')->nullable();
            $table->string('total_anthocyanins')->nullable();
            $table->string('free_anthocyanins')->nullable();
            $table->string('total_phenolics_ipt')->nullable();
            $table->string('total_tannin')->nullable();

            $table->unsignedInteger('batch_id');                                    
            $table->timestamps();
            $table->softDeletes();
                          
           // $table->foreign('batch_id')->references('id')->on('batches');            
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
        Schema::dropIfExists('batch_analyses');
    }
}
