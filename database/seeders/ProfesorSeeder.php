<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profesor;

class ProfesorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profesor::create(['id' => '3','nombre' => 'LEONELY','apellidos' => 'CASTRO CHOLIMA','fecha_nac' => '1980-11-15','dni' => '8601999','gmail' => 'castrocholima347@gmail.com','telefono' => '76658205',]);
        Profesor::create(['id' => '4','nombre' => 'MILTON','apellidos' => 'CRUZ CASTRO','fecha_nac' => '1988-10-15','dni' => '8602999','gmail' => 'cruzcastro348@gmail.com','telefono' => '76658215',]);
        Profesor::create(['id' => '5','nombre' => 'ALEX','apellidos' => 'CERVANTES ANAVI','fecha_nac' => '1985-09-15','dni' => '8603999','gmail' => 'carvantes349@gmail.com','telefono' => '76658225',]);
        Profesor::create(['id' => '6','nombre' => 'ADAN','apellidos' => 'CESPEDES LLANOS','fecha_nac' => '1988-08-15','dni' => '8604999','gmail' => 'cespedes350@gmail.com','telefono' => '76658235',]);
        Profesor::create(['id' => '7','nombre' => 'AILEEN','apellidos' => 'CHAMBY GONZALES','fecha_nac' => '1980-07-15','dni' => '8605999','gmail' => 'chamby351@gmail.com','telefono' => '76658245',]);
        Profesor::create(['id' => '8','nombre' => 'ALEXANDER','apellidos' => 'CHOQUE ACARAPI','fecha_nac' => '1988-06-15','dni' => '8606999','gmail' => 'choque352@gmail.com','telefono' => '76658255',]);
        Profesor::create(['id' => '9','nombre' => 'YHORDI','apellidos' => 'CHOQUE ESPINOZA','fecha_nac' => '1980-05-15','dni' => '8607999','gmail' => 'cocaarias536@gmail.com','telefono' => '76658265',]);
        Profesor::create(['id' => '10','nombre' => 'ALEXI','apellidos' => 'COCA ARIAS','fecha_nac' => '1980-04-15','dni' => '8608999','gmail' => 'cochamanidis354@gmail.com','telefono' => '76658275',]);
        Profesor::create(['id' => '11','nombre' => 'VICTOR','apellidos' => 'COCHAMANIDIS GUTIERREZ','fecha_nac' => '1980-03-15','dni' => '8609999','gmail' => 'copajira355@gmail.com','telefono' => '76658285',]);
        Profesor::create(['id' => '12','nombre' => 'BRAYAN','apellidos' => 'COPAJIRA VILLEGAS','fecha_nac' => '1981-02-15','dni' => '8610999','gmail' => 'corzo357@gmail.com','telefono' => '76658295',]);
        Profesor::create(['id' => '13','nombre' => 'JOSE','apellidos' => 'CORZO ESCOBAR','fecha_nac' => '1982-01-15','dni' => '8611999','gmail' => 'cuellarsuarez358@gmail.com','telefono' => '76658305',]);
        Profesor::create(['id' => '14','nombre' => 'MICHELL','apellidos' => 'CUELLAR SUAREZ','fecha_nac' => '1983-01-15','dni' => '8612999','gmail' => 'durangabriel359@gmail.com','telefono' => '76658315',]);
        Profesor::create(['id' => '15','nombre' => 'ALEJANDRO','apellidos' => 'DURAN GABRIEL','fecha_nac' => '1984-02-15','dni' => '8613999','gmail' => 'gabriel360@gmail.com','telefono' => '76658325',]);
        Profesor::create(['id' => '16','nombre' => 'RONALDO','apellidos' => 'ESPINOZA TORRICO','fecha_nac' => '1985-03-15','dni' => '8614999','gmail' => 'espinozatorrico361@gmail.com','telefono' => '76658335',]);
        Profesor::create(['id' => '17','nombre' => 'BRUNO','apellidos' => 'FABIAN YUCRA','fecha_nac' => '1986-04-15','dni' => '8615999','gmail' => 'yucrafabian362@gmail.com','telefono' => '76658345',]);
        Profesor::create(['id' => '18','nombre' => 'ARMANDO','apellidos' => 'CAPRILES NOGALES','fecha_nac' => '1987-05-15','dni' => '8616999','gmail' => 'capriles363@gmail.com','telefono' => '76658355',]);
        Profesor::create(['id' => '19','nombre' => 'FRANCISCO','apellidos' => 'FERNANDEZ PEÑARANDA','fecha_nac' => '1988-06-15','dni' => '8617999','gmail' => 'fernandez364@gmail.com','telefono' => '76658365',]);
        Profesor::create(['id' => '20','nombre' => 'ALEJANDRA','apellidos' => 'FIGUEROA HUANCA','fecha_nac' => '1989-07-15','dni' => '8618999','gmail' => 'figueroa365@gmail.com','telefono' => '76658375',]);
        Profesor::create(['id' => '21','nombre' => 'MARIO','apellidos' => 'FLAMBURY RIBERO','fecha_nac' => '1990-08-15','dni' => '8619999','gmail' => 'flambury366@gmail.com','telefono' => '76658385',]);
    }
}
