<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeciesAquaponicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('speciesacuaponics', function (Blueprint $table) {
            $table->id(); 
            $table->date('date');
            $table->unsignedBigInteger('category_id');
            $table->string('scientific_name', 255);
            $table->string('common_name', 255);
            $table->string('life_cycle', 100);
            $table->string('optimal_temperature', 100);

            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');

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
        Schema::dropIfExists('speciesacuaponics');
    }
}
