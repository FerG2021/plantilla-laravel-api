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
        Schema::create('plan', function (Blueprint $table) {
            $table->increments('plan_auto');
            $table->integer('plan_id')->unique();
            $table->boolean('plan_activo');
            $table->string('plan_nombre');
            $table->dateTime('plan_fdesde');
            $table->dateTime('plan_fhasta');
            $table->decimal('plan_plazo', 8, 2);
            $table->integer('cliente_id');
            $table->integer('deposito_id');
            $table->integer('transaccion_id');
            $table->string('empresa_codigo');
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
        Schema::dropIfExists('plan');
    }
};
