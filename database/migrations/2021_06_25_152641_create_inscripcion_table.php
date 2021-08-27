<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscripcionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripcion', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inscripcion');
            $table->decimal('costo_inscripcion',11,2);
            $table->boolean('estado')->default(1);
            $table->foreignId('id_alumno');
            $table->foreignId('id_usuario');
            $table->foreign('id_alumno')->references('id')->on('alumno');
            $table->foreign('id_usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscripcion');
    }
}
