<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlAsistenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_asistencia', function (Blueprint $table) {
            $table->foreignId('id_asistencia'); 
            $table->foreignId('id_alumno'); 
            $table->boolean('estado')->default(0);
            $table->foreign('id_asistencia')->references('id')->on('asistencia');
            $table->foreign('id_alumno')->references('id')->on('alumno');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('control_asistencia');
    }
}
