<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curso;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Curso::create(['nombre' => '1ro de Primaria','grado' => 'Primaria',]);
        Curso::create(['nombre' => '2do de Primaria','grado' => 'Primaria',]);
        Curso::create(['nombre' => '3ro de Primaria','grado' => 'Primaria',]);
        Curso::create(['nombre' => '4to de Primaria','grado' => 'Primaria',]);
        Curso::create(['nombre' => '5to de Primaria','grado' => 'Primaria',]);
        Curso::create(['nombre' => '6to de Primaria','grado' => 'Primaria',]);
        Curso::create(['nombre' => '1ro de Secundaria','grado' => 'Secundaria',]);
        Curso::create(['nombre' => '2do de Secundaria','grado' => 'Secundaria',]);
        Curso::create(['nombre' => '3ro de Secundaria','grado' => 'Secundaria',]);
        Curso::create(['nombre' => '4to de Secundaria','grado' => 'Secundaria',]);
        Curso::create(['nombre' => '5to de Secundaria','grado' => 'Secundaria',]);
        Curso::create(['nombre' => '6to de Secundaria','grado' => 'Secundaria',]);
    }
}
