<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnoMateriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno_materia', function (Blueprint $table) {
            $table->id();
            $table->decimal('nota',8,2);
            $table->foreignId('id_alumno');
            $table->foreignId('id_curso_paralelo');
            $table->foreignId('id_periodo'); 
            $table->foreign('id_alumno')->references('id')->on('alumno');
            $table->foreign('id_curso_paralelo')->references('id')->on('curso_paralelo');
            $table->foreign('id_periodo')->references('id')->on('periodo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumno_materia');
    }
}
