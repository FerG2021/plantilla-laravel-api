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
        Schema::create('transferencias', function (Blueprint $table) {
            $table->increments('transferencia_id');
            $table->integer('transferencia_presupuestacion_id')->nullable();
            $table->integer('transferencia_borrador_id')->nullable();
            $table->integer('transferencia_deposito_id');
            $table->integer('transferencia_deposito_producto_id');
            $table->integer('transferencia_producto_activo');    
            $table->integer('transferencia_producto_id');  
            $table->string('transferencia_producto_nombre');    
            $table->decimal('transferencia_producto_stock', 8, 2);
            $table->string('transferencia_producto_unidad');
            $table->integer('transferencia_producto_rubro_id');
            $table->decimal('transferencia_cantidad_utilizar', 8, 2);
            $table->SoftDeletes(); 
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
        Schema::dropIfExists('transferencias');
    }
};
