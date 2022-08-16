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
        Schema::create('presupuestacion', function (Blueprint $table) {
            $table->increments('presupuestacion_id');
            $table->integer('presupuestacion_plan_id');
            $table->string('presupuestacion_plan_nombre');
            $table->integer('presupuestacion_rubro_id');
            $table->string('presupuestacion_rubro_nombre');
            $table->dateTime('presupuestacion_fecha_incio');
            $table->dateTime('presupuestacion_fecha_fin');
            $table->dateTime('presupuestacion_fecha_limite');
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
        Schema::dropIfExists('presupuestacions');
    }
};
