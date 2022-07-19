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
            $table->decimal('proveedor_monto_totalPP', 8, 2);
            $table->decimal('proveedor_monto_flete', 8, 2);
            $table->boolean('proveedor_factura_A');
            $table->integer('proveedor_forma_de_pago');
            $table->decimal('proveedor_monto_descuentos_bonificaciones', 8, 2);
            $table->decimal('proveedor_monto_total_homogeneo', 8, 2);
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
