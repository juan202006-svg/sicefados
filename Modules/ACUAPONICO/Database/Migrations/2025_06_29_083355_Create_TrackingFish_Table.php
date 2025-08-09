<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackingFishTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackingfish', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tracking_id');
            $table->foreign('tracking_id')->references('id')->on('trackings');
            $table->integer('fish_count'); 
            $table->float('weight_gr'); 
            $table->float('biomass_gr'); 
            $table->float('weight_gain_gr'); 
            $table->integer('mortality'); 
            $table->timestamps(); 
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trackingfish');
    }
}
