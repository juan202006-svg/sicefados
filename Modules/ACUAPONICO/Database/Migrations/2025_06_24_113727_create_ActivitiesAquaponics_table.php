<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesAquaponicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
Schema::create('activities_aquaponics', function (Blueprint $table) {
    $table->id();
    $table->date('date');
    $table->date('start_date');
    $table->date('end_date');
    $table->unsignedBigInteger('user_id'); // Asegúrate que es unsignedBigInteger
    $table->text('description');
    $table->enum('activity_status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending');
    $table->boolean('enviada')->default(false);
    $table->timestamps();


    $table->foreign('user_id')->references('id')->on('user_aquaponics')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ActivitiesAquaponics');
    }
}
