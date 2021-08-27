<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CursoMateria;

class CursoMateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Primero de Secundaria
        CursoMateria::create(['id' => '1','id_gestion_curso' => '1','id_materia' => '15','id_profesor' => '17',]);
        CursoMateria::create(['id' => '2','id_gestion_curso' => '1','id_materia' => '20','id_profesor' => '12',]);
        CursoMateria::create(['id' => '3','id_gestion_curso' => '1','id_materia' => '16','id_profesor' => '18',]);
        CursoMateria::create(['id' => '4','id_gestion_curso' => '1','id_materia' => '8','id_profesor' => '10',]);
        CursoMateria::create(['id' => '5','id_gestion_curso' => '1','id_materia' => '3','id_profesor' => '5',]);
        CursoMateria::create(['id' => '6','id_gestion_curso' => '1','id_materia' => '5','id_profesor' => '7',]);
        CursoMateria::create(['id' => '7','id_gestion_curso' => '1','id_materia' => '1','id_profesor' => '3',]);
        CursoMateria::create(['id' => '8','id_gestion_curso' => '1','id_materia' => '9','id_profesor' => '11',]);
        CursoMateria::create(['id' => '9','id_gestion_curso' => '1','id_materia' => '4','id_profesor' => '6',]);
        CursoMateria::create(['id' => '10','id_gestion_curso' => '1','id_materia' => '13','id_profesor' => '15',]);
        CursoMateria::create(['id' => '11','id_gestion_curso' => '1','id_materia' => '17','id_profesor' => '19',]);

        //Segundo de Secundaria
        CursoMateria::create(['id' => '12','id_gestion_curso' => '2','id_materia' => '17','id_profesor' => '19',]);
        CursoMateria::create(['id' => '13','id_gestion_curso' => '2','id_materia' => '4','id_profesor' => '6',]);
        CursoMateria::create(['id' => '14','id_gestion_curso' => '2','id_materia' => '8','id_profesor' => '10',]);
        CursoMateria::create(['id' => '15','id_gestion_curso' => '2','id_materia' => '3','id_profesor' => '5',]);
        CursoMateria::create(['id' => '16','id_gestion_curso' => '2','id_materia' => '16','id_profesor' => '18',]);
        CursoMateria::create(['id' => '17','id_gestion_curso' => '2','id_materia' => '1','id_profesor' => '3',]);
        CursoMateria::create(['id' => '18','id_gestion_curso' => '2','id_materia' => '9','id_profesor' => '11',]);
        CursoMateria::create(['id' => '19','id_gestion_curso' => '2','id_materia' => '20','id_profesor' => '12',]);
        CursoMateria::create(['id' => '20','id_gestion_curso' => '2','id_materia' => '5','id_profesor' => '7',]);
        CursoMateria::create(['id' => '21','id_gestion_curso' => '2','id_materia' => '13','id_profesor' => '15',]);
        CursoMateria::create(['id' => '22','id_gestion_curso' => '2','id_materia' => '15','id_profesor' => '17',]);

        //Tercero de Secundaria
        CursoMateria::create(['id' => '23','id_gestion_curso' => '3','id_materia' => '1','id_profesor' => '3',]);
        CursoMateria::create(['id' => '24','id_gestion_curso' => '3','id_materia' => '18','id_profesor' => '20',]);
        CursoMateria::create(['id' => '25','id_gestion_curso' => '3','id_materia' => '2','id_profesor' => '4',]);
        CursoMateria::create(['id' => '26','id_gestion_curso' => '3','id_materia' => '15','id_profesor' => '17',]);
        CursoMateria::create(['id' => '27','id_gestion_curso' => '3','id_materia' => '4','id_profesor' => '6',]);
        CursoMateria::create(['id' => '28','id_gestion_curso' => '3','id_materia' => '6','id_profesor' => '8',]);
        CursoMateria::create(['id' => '29','id_gestion_curso' => '3','id_materia' => '8','id_profesor' => '10',]);
        CursoMateria::create(['id' => '30','id_gestion_curso' => '3','id_materia' => '7','id_profesor' => '9',]);
        CursoMateria::create(['id' => '31','id_gestion_curso' => '3','id_materia' => '13','id_profesor' => '15',]);
        CursoMateria::create(['id' => '32','id_gestion_curso' => '3','id_materia' => '17','id_profesor' => '19',]);
        CursoMateria::create(['id' => '33','id_gestion_curso' => '3','id_materia' => '3','id_profesor' => '5',]);
        CursoMateria::create(['id' => '34','id_gestion_curso' => '3','id_materia' => '16','id_profesor' => '18',]);

        //Cuarto de Secundaria
        CursoMateria::create(['id' => '35','id_gestion_curso' => '4','id_materia' => '8','id_profesor' => '10',]);
        CursoMateria::create(['id' => '36','id_gestion_curso' => '4','id_materia' => '4','id_profesor' => '6',]);
        CursoMateria::create(['id' => '37','id_gestion_curso' => '4','id_materia' => '16','id_profesor' => '18',]);
        CursoMateria::create(['id' => '38','id_gestion_curso' => '4','id_materia' => '6','id_profesor' => '8',]);
        CursoMateria::create(['id' => '39','id_gestion_curso' => '4','id_materia' => '1','id_profesor' => '3',]);
        CursoMateria::create(['id' => '40','id_gestion_curso' => '4','id_materia' => '7','id_profesor' => '9',]);
        CursoMateria::create(['id' => '41','id_gestion_curso' => '4','id_materia' => '18','id_profesor' => '20',]);
        CursoMateria::create(['id' => '42','id_gestion_curso' => '4','id_materia' => '17','id_profesor' => '19',]);
        CursoMateria::create(['id' => '43','id_gestion_curso' => '4','id_materia' => '3','id_profesor' => '5',]);
        CursoMateria::create(['id' => '44','id_gestion_curso' => '4','id_materia' => '13','id_profesor' => '15',]);
        CursoMateria::create(['id' => '45','id_gestion_curso' => '4','id_materia' => '2','id_profesor' => '4',]);
        CursoMateria::create(['id' => '46','id_gestion_curso' => '4','id_materia' => '15','id_profesor' => '17',]);

        //Quinto de Secundaria
        CursoMateria::create(['id' => '47','id_gestion_curso' => '5','id_materia' => '16','id_profesor' => '18',]);
        CursoMateria::create(['id' => '48','id_gestion_curso' => '5','id_materia' => '13','id_profesor' => '15',]);
        CursoMateria::create(['id' => '49','id_gestion_curso' => '5','id_materia' => '4','id_profesor' => '6',]);
        CursoMateria::create(['id' => '50','id_gestion_curso' => '5','id_materia' => '1','id_profesor' => '3',]);
        CursoMateria::create(['id' => '51','id_gestion_curso' => '5','id_materia' => '17','id_profesor' => '19',]);
        CursoMateria::create(['id' => '52','id_gestion_curso' => '5','id_materia' => '8','id_profesor' => '10',]);
        CursoMateria::create(['id' => '53','id_gestion_curso' => '5','id_materia' => '6','id_profesor' => '8',]);
        CursoMateria::create(['id' => '54','id_gestion_curso' => '5','id_materia' => '7','id_profesor' => '9',]);
        CursoMateria::create(['id' => '55','id_gestion_curso' => '5','id_materia' => '15','id_profesor' => '17',]);
        CursoMateria::create(['id' => '56','id_gestion_curso' => '5','id_materia' => '2','id_profesor' => '4',]);
        CursoMateria::create(['id' => '57','id_gestion_curso' => '5','id_materia' => '18','id_profesor' => '20',]);
        CursoMateria::create(['id' => '58','id_gestion_curso' => '5','id_materia' => '3','id_profesor' => '5',]);

        //Sexto de Secundaria
        CursoMateria::create(['id' => '59','id_gestion_curso' => '6','id_materia' => '6','id_profesor' => '8',]);
        CursoMateria::create(['id' => '60','id_gestion_curso' => '6','id_materia' => '16','id_profesor' => '18',]);
        CursoMateria::create(['id' => '61','id_gestion_curso' => '6','id_materia' => '4','id_profesor' => '6',]);
        CursoMateria::create(['id' => '62','id_gestion_curso' => '6','id_materia' => '7','id_profesor' => '9',]);
        CursoMateria::create(['id' => '63','id_gestion_curso' => '6','id_materia' => '8','id_profesor' => '10',]);
        CursoMateria::create(['id' => '64','id_gestion_curso' => '6','id_materia' => '1','id_profesor' => '3',]);
        CursoMateria::create(['id' => '65','id_gestion_curso' => '6','id_materia' => '13','id_profesor' => '15',]);
        CursoMateria::create(['id' => '66','id_gestion_curso' => '6','id_materia' => '17','id_profesor' => '19',]);
        CursoMateria::create(['id' => '67','id_gestion_curso' => '6','id_materia' => '15','id_profesor' => '17',]);
        CursoMateria::create(['id' => '68','id_gestion_curso' => '6','id_materia' => '2','id_profesor' => '4',]);
        CursoMateria::create(['id' => '69','id_gestion_curso' => '6','id_materia' => '18','id_profesor' => '20',]);
        CursoMateria::create(['id' => '70','id_gestion_curso' => '6','id_materia' => '3','id_profesor' => '5',]);
    }
}