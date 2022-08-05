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
        Schema::create('presupuestacion_productos_proveedores', function (Blueprint $table) {
            $table->increments('presupuestacion_productos_proveedores_id');
            $table->integer('presupuestacion_producto_id');
            $table->integer('presupuestacion_id');
            $table->integer('presupuestacion_plan_id');
            $table->integer('presupuestacion_rubro_id');
            $table->string('presupuestacion_rubro_nombre');
            $table->integer('proveedor_id');
            $table->string('proveedor_nombre');
            $table->string('proveedor_mail');
            $table->integer('producto_id');
            $table->string('producto_nombre');
            $table->decimal('producto_cantidad_a_comprar', 8, 2);
            $table->decimal('factor', 8, 2);
            $table->decimal('cantidad_proveedor', 8, 2);
            $table->decimal('precio_png', 8, 2);
            $table->decimal('iva', 8, 2);
            $table->decimal('total_iva', 8, 2);
            $table->decimal('precio_pu', 8, 2);
            $table->decimal('precio_pp', 8, 2);
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
        Schema::dropIfExists('presupuestacion_productos_proveedores');
    }
};
