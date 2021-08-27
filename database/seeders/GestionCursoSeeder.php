<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GestionCurso;

class GestionCursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GestionCurso::create(['id' => '1','id_gestion' => '1','id_curso' => '7',]);
        GestionCurso::create(['id' => '2','id_gestion' => '1','id_curso' => '8',]);
        GestionCurso::create(['id' => '3','id_gestion' => '1','id_curso' => '9',]);
        GestionCurso::create(['id' => '4','id_gestion' => '1','id_curso' => '10',]);
        GestionCurso::create(['id' => '5','id_gestion' => '1','id_curso' => '11',]);
        GestionCurso::create(['id' => '6','id_gestion' => '1','id_curso' => '12',]);
    }
}
