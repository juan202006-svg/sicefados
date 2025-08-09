<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAquaponicSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aquaponic_systems', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the aquaponic system
            $table->text('description')->nullable(); // Optional description
            $table->string('location')->nullable(); // Optional location
            $table->string('image')->nullable(); // Path to uploaded image
            $table->integer('lot_capacity')->nullable(); // Optional lot capacity
            $table->boolean('active')->default(true); // System active status
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
        Schema::dropIfExists('aquaponic_systems');
    }
}
