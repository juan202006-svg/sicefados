<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResowingLotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resowing_lot', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('resowing_id');
            $table->unsignedBigInteger('lot_id');
            $table->integer('quantity'); 

            $table->timestamps();

            $table->foreign('resowing_id')->references('id')->on('resowings')->onDelete('cascade');
            $table->foreign('lot_id')->references('id')->on('lots')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resowing_lot');
    }
}
