<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materia;

class MateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Materia::create(['nombre' => 'Matematicas','area' => 'Ciencia, Tecnologia y Produccion',]);
        Materia::create(['nombre' => 'Fisica','area' => 'Vida, Tierra, Territorio',]);
        Materia::create(['nombre' => 'Educacion Fisica','area' => 'Comunidad y Sociedad',]);
        Materia::create(['nombre' => 'Estudios Sociales','area' => 'Comunidad y Sociedad',]);
        Materia::create(['nombre' => 'Ciencias Naturales','area' => 'Vida, Tierra, Territorio',]);
        Materia::create(['nombre' => 'Biologia','area' => 'Vida, Tierra, Territorio',]);
        Materia::create(['nombre' => 'Quimica','area' => 'Vida, Tierra, Territorio',]);
        Materia::create(['nombre' => 'Lenguaje','area' => 'Vida, Tierra, Territorio',]);
        Materia::create(['nombre' => 'Psicologia','area' => 'Cosmos y Pensamiento',]);
        Materia::create(['nombre' => 'Historia','area' => 'Comunidad y Sociedad',]);
        Materia::create(['nombre' => 'Bio_Geografia','area' => 'Comunidad y Sociedad',]);
        Materia::create(['nombre' => 'Idiomas Originarios','area' => 'Comunidad y Sociedad',]);
        Materia::create(['nombre' => 'Idioma Extranjero','area' => 'Comunidad y Sociedad',]);
        Materia::create(['nombre' => 'Educacion Civica','area' => 'Comunidad y Sociedad',]);
        Materia::create(['nombre' => 'Educacin Musical','area' => 'Comunidad y Sociedad',]);
        Materia::create(['nombre' => 'Artes Plasticas','area' => 'Comunidad y Sociedad',]);
        Materia::create(['nombre' => 'Religion y Moral','area' => 'Cosmos y Pensamiento',]);
        Materia::create(['nombre' => 'Filosofia','area' => 'Cosmos y Pensamiento',]);
        Materia::create(['nombre' => 'Computacion','area' => 'Ciencia, Tecnologia y Produccion',]);
        Materia::create(['nombre' => 'TCP','area' => 'Ciencia, Tecnologia y Produccion',]);
    }
}
