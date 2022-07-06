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
        Schema::create('prevision', function (Blueprint $table) {
            $table->increments('prevision_id');
            $table->integer('plan_id');
            $table->integer('producto_id');
            $table->decimal('prevision_cantidad', 8, 2);
            $table->string('prevision_unidad');
            $table->dateTime('prevision_periodo');
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
        Schema::dropIfExists('prevision');
    }
};
