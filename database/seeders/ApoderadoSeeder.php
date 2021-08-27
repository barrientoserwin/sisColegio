<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Apoderado;

class ApoderadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Primero A de secundaria
        Apoderado::create(['nombre' => 'ALEX','apellidos' => 'AGUILAR AQUIRRE','fecha_nac' => '1992-01-12','dni' => '8205950','ocupacion' => 'albañil','telefono' => '78490475',]);
        Apoderado::create(['nombre' => 'GERARDO','apellidos' => 'AGUILAR CHAMO','fecha_nac' => '1992-08-11','dni' => '8215951','ocupacion' => 'albañil','telefono' => '78490476',]);
        Apoderado::create(['nombre' => 'PEDRO LUIS','apellidos' => 'ALBORTA CALIZAYA','fecha_nac' => '1993-11-01','dni' => '8235952','ocupacion' => 'pescador','telefono' => '78490477',]);
        Apoderado::create(['nombre' => 'ADRIAN','apellidos' => 'CAMACHO CAYO','fecha_nac' => '1994-09-12','dni' => '8245953','ocupacion' => 'pescador','telefono' => '78490478',]);
        Apoderado::create(['nombre' => 'NEIDY','apellidos' => 'ALVAREZ CORONEL','fecha_nac' => '1993-06-17','dni' => '8255954','ocupacion' => 'chofer','telefono' => '78490479',]);

        //Primero B de secundaria        
        Apoderado::create(['nombre' => 'FERNANDO','apellidos' => 'ARIAS FLORES','fecha_nac' => '1992-02-12','dni' => '8265955','ocupacion' => 'chofer','telefono' => '78490480',]);
        Apoderado::create(['nombre' => 'LUIS ENRRIQUE','apellidos' => 'ARIAS HURTADO','fecha_nac' => '1992-03-11','dni' => '8275956','ocupacion' => 'guardia','telefono' => '78490481',]);
        Apoderado::create(['nombre' => 'EMILIO','apellidos' => 'AVENDAÑO JIMENES','fecha_nac' => '1985-12-02','dni' => '8285957','ocupacion' => 'guardia','telefono' => '78490482',]);
        Apoderado::create(['nombre' => 'MARGARITA','apellidos' => 'BARRIOS LOPEZ','fecha_nac' => '1986-10-13','dni' => '8295958','ocupacion' => 'profesor','telefono' => '78490483',]);
        Apoderado::create(['nombre' => 'LEANDRO','apellidos' => 'BARTALAMA ALBINO','fecha_nac' => '1988-05-17','dni' => '8305959','ocupacion' => 'profesor','telefono' => '78490484',]);

    }
}
