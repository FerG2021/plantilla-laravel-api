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
        Schema::create('borrador_presupuestacion_productos', function (Blueprint $table) {
            $table->increments('borrador_presupuestacion_producto_id');
            $table->integer('borrador_presupuestacion_id');
            $table->integer('borrador_presupuestacion_plan_id');
            $table->integer('borrador_producto_id');
            $table->string('borrador_producto_nombre');
            $table->integer('borrador_producto_rubro_id');
            $table->string('borrador_producto_rubro_nombre');
            $table->decimal('borrador_producto_cantidad_a_comprar', 8, 2);
            $table->decimal('borrador_producto_cantidad_deposito', 8, 2);
            $table->decimal('borrador_producto_cantidad_real_a_comprar', 8, 2);
            $table->string('borrador_producto_observaciones');
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
        Schema::dropIfExists('borrador_presupuestacion_productos');
    }
};
