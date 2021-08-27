<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gestion;

class GestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gestion::create(['cod_gestion' => '2020','fecha_inicio' => '2020-02-01','fecha_fin' => '2020-11-26','estado' => '1',]);
    }
}
