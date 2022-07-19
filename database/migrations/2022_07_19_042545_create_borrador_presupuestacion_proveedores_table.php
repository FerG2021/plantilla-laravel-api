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
        Schema::create('borrador_presupuestacion_proveedores', function (Blueprint $table) {
            $table->increments('borrador_presupuestacion_proveedor_id');
            $table->integer('borrador_presupuestacion_id');
            $table->integer('borrador_presupuestacion_plan_id');
            $table->integer('borrador_proveedor_id');
            $table->string('borrador_proveedor_nombre');
            $table->integer('borrador_proveedor_rubro_id');
            $table->string('borrador_proveedor_mail');
            $table->decimal('borrador_proveedor_monto_totalPP', 8, 2);
            $table->decimal('borrador_proveedor_monto_flete', 8, 2);
            $table->boolean('borrador_proveedor_factura_A');
            $table->integer('borrador_proveedor_forma_de_pago');
            $table->decimal('borrador_proveedor_monto_descuentos_bonificaciones', 8, 2);
            $table->decimal('borrador_proveedor_monto_total_homogeneo', 8, 2);
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
        Schema::dropIfExists('borrador_presupuestacion_proveedores');
    }
};
