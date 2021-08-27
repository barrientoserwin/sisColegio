<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',50);
            $table->date('fecha_pago');
            $table->time('hora_pago');
            $table->foreignId('id_inscripcion');
            $table->foreignId('id_mensualidad');  
            $table->foreign('id_inscripcion')->references('id')->on('inscripcion');
            $table->foreign('id_mensualidad')->references('id')->on('pago_mensual');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factura');
    }
}
