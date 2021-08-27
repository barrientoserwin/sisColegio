<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensualidadInscripcionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensualidad_inscripcion', function (Blueprint $table) {
            $table->foreignId('id_inscripcion');
            $table->foreignId('id_pago_mensual'); 
            $table->date('fecha_pago')->nullable();
            $table->boolean('estado')->default(0);
            $table->primary(['id_inscripcion', 'id_pago_mensual']);
            $table->foreign('id_inscripcion')->references('id')->on('inscripcion');
            $table->foreign('id_pago_mensual')->references('id')->on('pago_mensual');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensualidad_inscripcion');
    }
}
