<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAquaponicFieldsToCropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crops', function (Blueprint $table) {
            // Hacer los campos actuales acepten null
            $table->string('name')->nullable()->change();
            $table->integer('sown_area')->nullable()->change();
            $table->date('seed_time')->nullable()->change();
            $table->integer('density')->nullable()->change();
            $table->foreignId('variety_id')->nullable()->change();
            $table->date('finish_date')->nullable()->change();

            // Campos que se van a agregar nuevos 
            $table->date('date')->nullable();
            $table->unsignedBigInteger('species_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->enum('status', ['Cultivado', 'Seguimiento', 'Cosechado'])->nullable()->default('Cultivado');

            // Relación con 
            $table->foreign('species_id')->references('id')->on('species');

            // Relación con aquaponic_systems
            $table->unsignedBigInteger('aquaponic_system_id')->nullable();
            $table->foreign('aquaponic_system_id')->references('id')->on('aquaponic_systems');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crops', function (Blueprint $table) {
            // Eliminar relaciones
            $table->dropForeign(['species_id']);
            $table->dropColumn('species_id');

            $table->dropForeign(['aquaponic_system_id']);
            $table->dropColumn('aquaponic_system_id');

            // Eliminar columnas agregadas
            $table->dropColumn('date');
            $table->dropColumn('quantity');
            $table->dropColumn('status');

            // Si quieres, puedes volver los campos originales a NOT NULL (opcional)
            $table->string('name')->nullable(false)->change();
            $table->integer('sown_area')->nullable(false)->change();
            $table->date('seed_time')->nullable(false)->change();
            $table->integer('density')->nullable(false)->change();
            $table->foreignId('variety_id')->nullable(false)->change();
        });
    }
}
