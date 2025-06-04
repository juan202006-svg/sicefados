<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {
            $table->id(); 
            $table->date('date'); 
            $table->unsignedBigInteger('crop_id'); 
            $table->integer('days_elapsed')->nullable(); 
            $table->text('notes')->nullable(); 
            $table->timestamps();
            $table->foreign('crop_id')->references('id')->on('cropsaquaponics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trackings');
    }
}
