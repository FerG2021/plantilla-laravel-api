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
        Schema::create('proveedores_rubros', function (Blueprint $table) {
            $table->increments('proveedorxrubro_auto');
            $table->integer('proveedor_id');
            $table->integer('rubro_id');
            $table->timestamps();
        });

        Schema::table('proveedores_rubros', function (Blueprint $table) {
            $table->foreign('proveedor_id')->references('proveedor_id')->on('proveedores');
            $table->foreign('rubro_id')->references('rubro_id')->on('rubros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores_rubros');
    }
};
