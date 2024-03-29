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
        Schema::create('orden_compras', function (Blueprint $table) {
            $table->increments('ordenes_compras_id');
            $table->integer('ordenes_compras_proveedor_id');
            $table->integer('ordenes_compras_presupuestacion_id');
            $table->integer('ordenes_compras_presupuestacion_plan_id');
            $table->string('ordenes_compras_proveedor_nombre');
            $table->string('ordenes_compras_proveedor_mail');
            $table->boolean('ordenes_compras_proveedor_factura_A');
            $table->integer('ordenes_compras_proveedor_forma_de_pago');
            $table->decimal('ordenes_compras_descuentos_bonificaciones', 14, 2);
            $table->decimal('ordenes_compras_monto_flete', 14, 2);
            $table->decimal('ordenes_compras_monto_total_PP', 14, 2);
            $table->decimal('ordenes_compras_monto_total_homogeneo', 14, 2);
            $table->integer('ordenes_compras_presupuestacion_proveedor_id');
            $table->integer('ordenes_compras_presupuestacion_proveedor_rubro_id');
            $table->decimal('ordenes_compras_monto_total', 14, 2);   
            $table->integer('ordenes_compras_estado');         
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
        Schema::dropIfExists('orden_compras');
    }
};
