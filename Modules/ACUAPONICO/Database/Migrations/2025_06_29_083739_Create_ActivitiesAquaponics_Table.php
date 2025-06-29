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
            $table->string('activity_name');
            $table->date('date');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('user_id');
            $table->text('description');
            $table->enum('activity_status', ['Pendiente', 'Completada'])->default('Pendiente');
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
        Schema::dropIfExists('Activities_Aquaponics');
    }
}
