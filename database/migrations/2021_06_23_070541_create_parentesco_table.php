<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentescoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parentesco', function (Blueprint $table) {
            $table->foreignId('id_apoderado');
            $table->foreignId('id_alumno'); 
            $table->string('descripcion',50);
            $table->primary(['id_apoderado', 'id_alumno']);
            $table->foreign('id_apoderado')->references('id')->on('apoderado');
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
        Schema::dropIfExists('parentesco');
    }
}
