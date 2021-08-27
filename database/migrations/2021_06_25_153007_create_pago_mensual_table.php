<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagoMensualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_mensual', function (Blueprint $table) {
            $table->id();
            $table->date('plazo_fecha');
            $table->string('mes',30);
            $table->decimal('monto',11,2);
            $table->foreignId('id_gestion_curso'); 
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
        Schema::dropIfExists('pago_mensual');
    }
}
