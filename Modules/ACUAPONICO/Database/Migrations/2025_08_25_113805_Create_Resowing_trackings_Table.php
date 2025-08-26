<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResowingTrackingsTable extends Migration
{
    public function up()
    {
        Schema::create('resowing_trackings', function (Blueprint $table) {
            $table->id();
            $table->date('date'); // Fecha del seguimiento
            $table->unsignedBigInteger('aquaponic_system_id'); // Sistema acuapónico
            $table->unsignedBigInteger('resowing_id'); // Relación con resiembras
            $table->integer('days_elapsed')->nullable(); // Días transcurridos
            $table->integer('plant_count'); // Cantidad de plantas
            $table->integer('height_cm'); // Altura en cm
            $table->string('color_tone', 12)->nullable(); // Ej: "#28a745"
            $table->string('growth'); // Estado de crecimiento
            $table->integer('mortality'); // Mortalidad
            $table->text('notes')->nullable(); // Notas
            $table->timestamps();

            // Relaciones foráneas
            $table->foreign('aquaponic_system_id')->references('id')->on('aquaponic_systems');
            $table->foreign('resowing_id')->references('id')->on('resowings');
        });
    }

    public function down()
    {
        Schema::dropIfExists('resowing_trackings');
    }
}
