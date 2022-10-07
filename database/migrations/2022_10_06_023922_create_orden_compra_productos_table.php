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
        Schema::create('orden_compra_productos', function (Blueprint $table) {
            $table->increments('ordenes_compras_productos_id');
            $table->integer('ordenes_compras_id');
            $table->decimal('ordenes_compras_productos_cantidad_proveedor', 14, 2);
            $table->decimal('ordenes_compras_productos_iva', 14, 2);
            $table->decimal('ordenes_compras_productos_precio_png', 14, 2);
            $table->decimal('ordenes_compras_productos_precio_pp', 14, 2);
            $table->decimal('ordenes_compras_productos_precio_pu', 14, 2);
            $table->integer('ordenes_compras_productos_presupuestacion_id');
            $table->integer('ordenes_compras_productos_plan_id');
            $table->integer('ordenes_compras_productos_producto_id');
            $table->integer('ordenes_compras_productos_producto_proveedor_id');
            $table->integer('ordenes_compras_productos_rubro_id');
            $table->string('ordenes_compras_productos_rubro_nombre');
            $table->decimal('ordenes_compras_productos_cantidad_a_comprar', 14, 2);
            $table->string('ordenes_compras_productos_producto_nombre');
            $table->integer('ordenes_compras_productos_proveedor_id');
            $table->string('ordenes_compras_productos_proveedor_mail');
            $table->string('ordenes_compras_productos_proveedor_nombre');
            $table->decimal('ordenes_compras_productos_total_iva', 14, 2);
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
        Schema::dropIfExists('orden_compra_productos');
    }
};
