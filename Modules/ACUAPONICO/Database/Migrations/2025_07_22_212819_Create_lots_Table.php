<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotsTable extends Migration
{
    public function up()
    {
        Schema::create('lots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aquaponic_system_id'); // Clave foránea
            $table->date('date');
            $table->string('name');
            $table->integer('capacity');
            $table->string('image')->nullable(); // Campo para imagen
            $table->text('description')->nullable(); // Campo para descripción
             $table->enum('state', ['disponible', 'ocupado', 'no disponible'])->default('disponible');
            $table->timestamps();

            // Restricción de clave foránea
            $table->foreign('aquaponic_system_id')->references('id')->on('aquaponic_systems');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lots');
    }
}
