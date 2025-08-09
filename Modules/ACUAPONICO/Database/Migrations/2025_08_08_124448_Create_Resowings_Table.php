<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResowingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resowings', function (Blueprint $table) {
            $table->id();

            // Sistema acuapónico
            $table->unsignedBigInteger('aquaponic_system_id');

            // Cultivo original
            $table->unsignedBigInteger('crop_id');

            // Mortalidad registrada del cultivo (opcional)
            $table->integer('original_mortality')->nullable();

            // Motivo o descripción de la resiembra
            $table->text('description')->nullable();

            // Estado de la resiembra
            $table->enum('status', ['Registrada', 'Seguimiento', 'Cosechada'])->default('Registrada');

            // Fecha de la resiembra
            $table->date('date');

            $table->timestamps();

            // Relaciones
            $table->foreign('aquaponic_system_id')->references('id')->on('aquaponic_systems');
            $table->foreign('crop_id')->references('id')->on('crops');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resowings');
    }
}
