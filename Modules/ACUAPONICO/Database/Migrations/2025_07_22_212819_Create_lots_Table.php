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
<<<<<<<< HEAD:Modules/ACUAPONICO/Database/Migrations/2025_08_02_164935_Create_Lots_table.php
            $table->enum('state', ['disponible', 'ocupado', 'no disponible'])->default('disponible');
            $table->string('image')->nullable();
========
            $table->string('image')->nullable(); // Campo para imagen
            $table->text('description')->nullable(); // Campo para descripción
             $table->enum('state', ['disponible', 'ocupado', 'no disponible'])->default('disponible');
>>>>>>>> ae8055158991911aeef9b496fc04c0cb1cf9e67e:Modules/ACUAPONICO/Database/Migrations/2025_07_22_212819_Create_lots_Table.php
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
