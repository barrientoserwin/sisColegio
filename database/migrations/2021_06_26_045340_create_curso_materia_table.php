<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursoMateriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_materia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_gestion_curso');
            $table->foreignId('id_materia');
            $table->foreignId('id_profesor')->nullable();
            $table->foreign('id_gestion_curso')->references('id')->on('gestion_curso');
            $table->foreign('id_materia')->references('id')->on('materia');
            $table->foreign('id_profesor')->references('id')->on('profesor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curso_materia');
    }
}
