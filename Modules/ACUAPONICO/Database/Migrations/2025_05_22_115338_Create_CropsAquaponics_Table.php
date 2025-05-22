<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCropsAquaponicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cropsaquaponics', function (Blueprint $table) {
            $table->id(); 
            $table->date('date');
            $table->unsignedBigInteger('species_id');
            $table->unsignedBigInteger('lot_id');
            $table->integer('quantity');
            $table->enum('status', ['Cultivado', 'Seguimiento', 'Cosechado'])->default('Cultivado');
            
           
            $table->foreign('species_id')->references('id')->on('speciesaquaponics');
            $table->foreign('lot_id')->references('id')->on('lots');
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
        Schema::dropIfExists('crocropsaquaponicsps');
    }
}
