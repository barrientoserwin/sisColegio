<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscripcionGestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripcion_gestion', function (Blueprint $table) {
            $table->foreignId('id_inscripcion');
            $table->foreignId('id_gestion_curso'); 
            $table->char('paralelo',1);
            $table->primary(['id_inscripcion', 'id_gestion_curso']);
            $table->foreign('id_inscripcion')->references('id')->on('inscripcion');
            $table->foreign('id_gestion_curso')->references('id')->on('gestion_curso');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscripcion_gestion');
    }
}
