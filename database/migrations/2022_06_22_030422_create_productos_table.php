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
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('producto_auto');
            $table->integer('producto_id')->unique();
            $table->integer('producto_codigo');
            $table->string('producto_nombre');
            $table->decimal('producto_puc', 8, 2);
            $table->date('producto_fpuc');
            $table->string('producto_unidad');
            $table->boolean('producto_activo');
            $table->integer('rubro_id');
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
        Schema::dropIfExists('productos');
    }
};
