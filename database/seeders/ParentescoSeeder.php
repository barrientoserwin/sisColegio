<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Parentesco;

class ParentescoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parentesco::create(['id_apoderado' => '1','id_alumno' => '1','descripcion' => 'Padre',]);
        Parentesco::create(['id_apoderado' => '2','id_alumno' => '2','descripcion' => 'Padre',]);
        Parentesco::create(['id_apoderado' => '3','id_alumno' => '3','descripcion' => 'Padre',]);
        Parentesco::create(['id_apoderado' => '4','id_alumno' => '4','descripcion' => 'Padre',]);
        Parentesco::create(['id_apoderado' => '5','id_alumno' => '5','descripcion' => 'Madre',]);
        Parentesco::create(['id_apoderado' => '6','id_alumno' => '6','descripcion' => 'Padre',]);
        Parentesco::create(['id_apoderado' => '7','id_alumno' => '7','descripcion' => 'Padre',]);
        Parentesco::create(['id_apoderado' => '8','id_alumno' => '8','descripcion' => 'Padre',]);
        Parentesco::create(['id_apoderado' => '9','id_alumno' => '9','descripcion' => 'Madre',]);
        Parentesco::create(['id_apoderado' => '10','id_alumno' => '10','descripcion' => 'Padre',]);
    }
}
