<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsForAquaponicToSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('species', function (Blueprint $table) {
            // Modificar campos existentes para que sean opcionales (nullable)
            $table->string('name')->nullable()->change();
            $table->foreignId('productive_unit_id')->nullable()->change();
            
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('scientific_name', 255)->nullable()->after('name');
            $table->string('image')->nullable();
            $table->text('description')->nullable();

            // Clave foránea
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('species', function (Blueprint $table) {
            // Eliminar los campos agregados
            $table->dropForeign(['category_id']);
            $table->dropColumn([
                'category_id',
                'scientific_name',
                'image',
                'description'
            ]);

            // Revertir los campos modificados
            $table->string('name')->nullable(false)->change();
            $table->foreignId('productive_unit_id')->nullable(false)->change();
        });
    }
}
