<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrador_presupuestacion', function (Blueprint $table) {
            $table->increments('borrador_presupuestacion_id');
            $table->integer('borrador_presupuestacion_plan_id');
            $table->string('borrador_presupuestacion_plan_nombre');
            $table->dateTime('borrador_presupuestacion_fecha_incio');
            $table->dateTime('borrador_presupuestacion_fecha_fin');
            $table->boolean('borrador_presupuestado');
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
        Schema::dropIfExists('borrador_presupuestacion');
    }
};
