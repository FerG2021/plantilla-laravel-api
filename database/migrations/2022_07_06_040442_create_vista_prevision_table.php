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
        Schema::create('vista_prevision', function (Blueprint $table) {
            $table->increments('prevision_id');
            $table->integer('plan_id');
            $table->integer('producto_id');
            $table->dateTime('prevision_periodo');
            $table->string('producto_nombre');
            $table->integer('producto_codigo');
            $table->decimal('producto_puc', 8, 2);
            $table->dateTime('producto_fpuc');
            $table->string('producto_unidad');
            $table->string('prevision_unidad');
            $table->integer('prevision_cantidad');
            $table->string('rubro_nombre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vista_prevision');
    }
};
