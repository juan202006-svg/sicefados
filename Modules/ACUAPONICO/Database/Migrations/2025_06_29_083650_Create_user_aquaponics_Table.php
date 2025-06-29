<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAquaponicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
Schema::create('user_aquaponics', function (Blueprint $table) {
    $table->id();
    $table->string('first_name');
    $table->string('last_name');
    $table->enum('role', ['pasante', 'instructor']);
    $table->unsignedBigInteger('productive_unit_id')->nullable();
    $table->string('status')->default('activo');
    $table->timestamps();

    $table->foreign('productive_unit_id')->references('id')->on('productive_units');
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_aquaponics');
    }
}
