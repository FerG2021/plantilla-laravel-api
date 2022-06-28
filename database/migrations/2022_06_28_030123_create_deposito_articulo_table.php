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
        Schema::create('deposito_articulo', function (Blueprint $table) {
            $table->increments('deposito_producto_auto');
            $table->integer('deposito_producto_id')->unique();
            $table->integer('deposito_id');
            $table->integer('producto_id');
            $table->string('producto_nombre');
            $table->decimal('producto_stock', 8, 2);
            $table->string('producto_unidad');
            $table->boolean('producto_activo');
            $table->integer('rubro_id');
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
        Schema::dropIfExists('deposito_articulo');
    }
};
