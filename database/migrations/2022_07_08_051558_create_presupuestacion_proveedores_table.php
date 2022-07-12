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
        Schema::create('presupuestacion_proveedores', function (Blueprint $table) {
            $table->increments('presupuestacion_proveedor_id');
            $table->integer('presupuestacion_id');
            $table->integer('presupuestacion_plan_id');
            $table->integer('proveedor_id');
            $table->string('proveedor_nombre');
            $table->integer('proveedor_rubro_id');
            $table->string('proveedor_mail');
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
        Schema::dropIfExists('presupuestacion_proveedores');
    }
};
