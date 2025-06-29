<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackingPlantTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('trackingplant', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('tracking_id');
      $table->foreign('tracking_id')->references('id')->on('trackings');
      $table->integer('plant_count');             
      $table->integer('height_cm');               
      $table->string('growth');                   
      $table->integer('comparison_percentage');  
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
    Schema::dropIfExists('trackingplant');
  }
}
