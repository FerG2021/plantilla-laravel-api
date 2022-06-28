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
        Schema::create('proveedor', function (Blueprint $table) {
            $table->increments('proveedor_auto');
            $table->integer('proveedor_id')->unique();
            $table->string('proveedor_codigo');
            $table->string('proveedor_nombre');
            $table->string('proveedor_razonsocial');
            $table->string('proveedor_cuit');
            $table->string('proveedor_email');
            $table->boolean('proveedor_activo');
            $table->softDeletes(); 
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
        Schema::dropIfExists('proveedor');
    }
};
