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
        Schema::create('borrador_presupuestacion_rubros', function (Blueprint $table) {
            $table->increments('borrador_presupuestacion_rubros_id');
            $table->integer('borrador_presupuestacion_id');
            $table->integer('borrador_presupuestacion_rubro_id');
            $table->string('borrador_presupuestacion_rubro_nombre');
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
        Schema::dropIfExists('borrador_presupuestacion_rubros');
    }
};
