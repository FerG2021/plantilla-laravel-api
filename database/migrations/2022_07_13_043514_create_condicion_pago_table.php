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
        Schema::create('condicion_pago', function (Blueprint $table) {
            $table->increments('condicionpago_auto');
            $table->integer('condicionpago_id');
            $table->string('condicionpago_codigo');
            $table->string('condicionpago_nombre');
            $table->boolean('condicionpago_activo');
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
        Schema::dropIfExists('condicion_pago');
    }
};
