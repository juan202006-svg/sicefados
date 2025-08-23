<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHarvestsAquaponicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harvestsaquaponics', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('aquaponic_system_id')->nullable();
            $table->foreign('aquaponic_system_id')->references('id')->on('aquaponic_systems');

            // Relación polimórfica
            $table->unsignedBigInteger('harvestable_id');
            $table->string('harvestable_type');

            $table->integer('quantity');
            $table->enum('unit', ['Kilogramos', 'Gramos'])->default('Gramos');
            $table->integer('mortality');
            $table->string('destination');
            $table->text('notes')->nullable();
            $table->timestamps();

            // Índices para consultas más rápidas
            $table->index(['harvestable_id', 'harvestable_type']);
        });
    }


    public function down()
    {
        Schema::dropIfExists('harvestsaquaponics');
    }
}
