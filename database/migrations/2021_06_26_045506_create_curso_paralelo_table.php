<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursoParaleloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_paralelo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_curso_materia');
            $table->foreignId('id_paralelo');
            $table->foreign('id_curso_materia')->references('id')->on('curso_materia');
            $table->foreign('id_paralelo')->references('id')->on('paralelo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curso_paralelo');
    }
}
