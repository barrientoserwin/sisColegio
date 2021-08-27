<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            AlumnoSeeder::class,
            MateriaSeeder::class,
            GestionSeeder::class,
            CursoSeeder::class,
            GestionCursoSeeder::class,
            ApoderadoSeeder::class,
            ParentescoSeeder::class,
            SecretariaSeeder::class,
            ProfesorSeeder::class,
            ParaleloSeeder::class,
            InscripcionSeeder::class,
            InscripcionGestionSeeder::class,
            CursoMateriaSeeder::class,
            CursoParaleloSeeder::class,
            PeriodoSeeder::class,
            AlumnoMateriaSeeder::class
        ]);
    }
}
