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
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->float('precio');
            $table->integer('stock');
            $table->unsignedBigInteger('idCategoria');
            $table->unsignedBigInteger('idUnidadMedida');
            $table->softDeletes(); 
            $table->timestamps();
        });

        Schema::table('articulos', function (Blueprint $table) {
            $table->foreign('idCategoria')->references('id')->on('categorias');
            $table->foreign('idUnidadMedida')->references('id')->on('unidad_medidas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
};
