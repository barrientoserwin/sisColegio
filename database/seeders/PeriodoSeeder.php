<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Periodo;

class PeriodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Periodo::create(['id' => '1','nombre' => '1er Trimestre','tipo_periodo' => 'Trimestral','descripcion' => 'Periodo de 3 Meses','estado' => 1]);
        Periodo::create(['id' => '2','nombre' => '2do Trimestre','tipo_periodo' => 'Trimestral','descripcion' => 'Periodo de 3 Meses','estado' => 1]);
        Periodo::create(['id' => '3','nombre' => '3er Trimestre','tipo_periodo' => 'Trimestral','descripcion' => 'Periodo de 3 Meses','estado' => 1]);
        Periodo::create(['id' => '4','nombre' => '1er Bimestre','tipo_periodo' => 'Bimestral','descripcion' => 'Periodo de 2 Meses','estado' => 0]);
        Periodo::create(['id' => '5','nombre' => '2do Bimestre','tipo_periodo' => 'Bimestral','descripcion' => 'Periodo de 2 Meses','estado' => 0]);
        Periodo::create(['id' => '6','nombre' => '3er Bimestre','tipo_periodo' => 'Bimestral','descripcion' => 'Periodo de 2 Meses','estado' => 0]);
        Periodo::create(['id' => '7','nombre' => '4to Bimestre','tipo_periodo' => 'Bimestral','descripcion' => 'Periodo de 2 Meses','estado' => 0]);
    }
}
