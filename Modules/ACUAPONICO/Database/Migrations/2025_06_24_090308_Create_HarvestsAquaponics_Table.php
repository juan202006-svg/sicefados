<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHarvestsAquaponicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harvestaquaponics', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('crop_id');
            $table->foreign('crop_id')->references('id')->on('cropsaquaponics');
            $table->integer('quantity');
            $table->integer('mortality');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('harvestaquaponics');
    }
}
