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
        Schema::create('presupuestacion_productos', function (Blueprint $table) {
            $table->increments('presupuestacion_producto_id');
            $table->integer('presupuestacion_id');
            $table->integer('presupuestacion_plan_id');
            $table->integer('producto_id');
            $table->string('producto_nombre');
            $table->integer('producto_rubro_id');
            $table->string('producto_rubro_nombre');
            $table->decimal('producto_cantidad_a_comprar', 8, 2);
            $table->decimal('producto_cantidad_deposito', 8, 2);
            $table->decimal('producto_cantidad_real_a_comprar', 8, 2);
            $table->text('producto_observaciones')->nullable();
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
        Schema::dropIfExists('presupuestacion_productos');
    }
};
