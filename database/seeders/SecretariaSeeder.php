<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Secretaria;

class SecretariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Secretaria::create(['id' => '2','nombre' => 'MAYTE','apellidos' => 'FLORES','fecha_nac' => '1995-02-12','dni' => '8665999','gmail' => 'mayteflores345@gmail.com','telefono' => '78490572',]);
    
    }
}
