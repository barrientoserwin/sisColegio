<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumno;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Primero A de secundaria
        Alumno::create(['nombre' => 'JOSE','apellidos' => 'AGUILAR AÑEZ','fecha_nac' => '2009-01-12','dni' => '8225950','matricula' => '1021015510',]);
        Alumno::create(['nombre' => 'IBER','apellidos' => 'AGUILAR LUIZAGA','fecha_nac' => '2009-08-11','dni' => '8225951','matricula' => '1121015510',]);
        Alumno::create(['nombre' => 'BEIMAR','apellidos' => 'ALBORTA ALCAZAR','fecha_nac' => '2009-11-01','dni' => '8225952','matricula' => '1221015510',]);
        Alumno::create(['nombre' => 'MALDIN','apellidos' => 'CAMACHO MENACHO','fecha_nac' => '2009-09-12','dni' => '8225953','matricula' => '1321015510',]);
        Alumno::create(['nombre' => 'ELIAN','apellidos' => 'ALVAREZ CHOQUE','fecha_nac' => '2009-06-17','dni' => '8225954','matricula' => '1421015510',]);

        //Primero B de secundaria        
        Alumno::create(['nombre' => 'DIEGO','apellidos' => 'ARIAS A¥EZ','fecha_nac' => '2009-02-12','dni' => '8225955','matricula' => '1521015510',]);
        Alumno::create(['nombre' => 'YERAL','apellidos' => 'ARIAS LUIZAGA','fecha_nac' => '2009-03-11','dni' => '8225956','matricula' => '1621015510',]);
        Alumno::create(['nombre' => 'FERNANDO','apellidos' => 'AVENDA¥O A¥EZ','fecha_nac' => '2009-12-02','dni' => '8225957','matricula' => '1721015510',]);
        Alumno::create(['nombre' => 'BAIRO','apellidos' => 'BARRIOS ALCAZAR','fecha_nac' => '2009-10-13','dni' => '8225958','matricula' => '1821015510',]);
        Alumno::create(['nombre' => 'ARTURO','apellidos' => 'BARTALAMA MENACHO','fecha_nac' => '2009-05-17','dni' => '8225959','matricula' => '1921015510',]);

        //Segundo A de secundaria
        Alumno::create(['nombre' => 'JOSUE','apellidos' => 'CARDENAS MAMANI','fecha_nac' => '2008-03-13','dni' => '8225960','matricula' => '2021015510',]);
        Alumno::create(['nombre' => 'KEVIN','apellidos' => 'CARLOS QUISPE','fecha_nac' => '2008-09-16','dni' => '8225961','matricula' => '2121015510',]);
        Alumno::create(['nombre' => 'CESAR','apellidos' => 'CARVAJAL ANGELO','fecha_nac' => '2008-10-11','dni' => '8225962','matricula' => '2221015510',]);
        Alumno::create(['nombre' => 'SAUL','apellidos' => 'CARVAJAL ANGELO','fecha_nac' => '2008-05-15','dni' => '8225963','matricula' => '2321015510',]);
        Alumno::create(['nombre' => 'VALERY','apellidos' => 'CASTRO CASTRO','fecha_nac' => '2008-02-18','dni' => '8225964','matricula' => '2421015510',]);

        //Segundo B de secundaria
        Alumno::create(['nombre' => 'JUAN','apellidos' => 'ALMANZA BALDERRAMA','fecha_nac' => '2008-02-02','dni' => '8225965','matricula' => '2521015510',]);
        Alumno::create(['nombre' => 'DALILLA','apellidos' => 'AQUINO CASORLA','fecha_nac' => '2008-09-21','dni' => '8225966','matricula' => '2621015510',]);
        Alumno::create(['nombre' => 'ARMANDO','apellidos' => 'BARRIGA QUISPE','fecha_nac' => '2008-12-01','dni' => '8225967','matricula' => '2721015510',]);
        Alumno::create(['nombre' => 'ALEJANDRA','apellidos' => 'CALIZAYA SUAREZ','fecha_nac' => '2008-11-12','dni' => '8225968','matricula' => '2821015510',]);
        Alumno::create(['nombre' => 'SEBASTIAN','apellidos' => 'CAMPOS RIVERO','fecha_nac' => '2008-11-17','dni' => '8225969','matricula' => '2921015510',]);

        //Tercero A de secundaria
        Alumno::create(['nombre' => 'LEONARDO','apellidos' => 'CELIZ VARGAS','fecha_nac' => '2007-12-12','dni' => '8225970','matricula' => '3021015510',]);
        Alumno::create(['nombre' => 'CARLOS','apellidos' => 'CUEBAS TERRAZAS','fecha_nac' => '2007-11-11','dni' => '8225971','matricula' => '3121015510',]);
        Alumno::create(['nombre' => 'EDUARDO','apellidos' => 'FERNANDEZ PARADA','fecha_nac' => '2007-12-01','dni' => '8225972','matricula' => '3221015510',]);
        Alumno::create(['nombre' => 'JOSE','apellidos' => 'JAEN CAMACHO','fecha_nac' => '2007-09-14','dni' => '8225973','matricula' => '3321015510',]);
        Alumno::create(['nombre' => 'NATHALIA','apellidos' => 'JUSTINIANO FLORES','fecha_nac' => '2007-06-18','dni' => '8225974','matricula' => '3421015510',]);

        //Tercero B de secundaria
        Alumno::create(['nombre' => 'PERCY','apellidos' => 'LEANDRO MAMANI','fecha_nac' => '2007-12-02','dni' => '8225975','matricula' => '3521015510',]);
        Alumno::create(['nombre' => 'HAROLD','apellidos' => 'LOPEZ RAMIRES','fecha_nac' => '2007-11-01','dni' => '8225976','matricula' => '3621015510',]);
        Alumno::create(['nombre' => 'OSMAR','apellidos' => 'MAMANI FUENTES','fecha_nac' => '2007-11-11','dni' => '8225977','matricula' => '3721015510',]);
        Alumno::create(['nombre' => 'JORGE','apellidos' => 'MANCINI QUINO','fecha_nac' => '2007-09-12','dni' => '8225978','matricula' => '3821015510',]);
        Alumno::create(['nombre' => 'ALEXIS','apellidos' => 'MAQUERA DIAS','fecha_nac' => '2007-09-13','dni' => '8225979','matricula' => '3921015510',]);

        //Cuarto A de secundaria
        Alumno::create(['nombre' => 'CRISTHIAN','apellidos' => 'MOJICA GUTIERREZ','fecha_nac' => '2006-01-02','dni' => '8225980','matricula' => '4021015510',]);
        Alumno::create(['nombre' => 'CARLOS','apellidos' => 'ORTIZ ROCHA','fecha_nac' => '2006-08-03','dni' => '8225981','matricula' => '4121015510',]);
        Alumno::create(['nombre' => 'MAICOL','apellidos' => 'PEÑA CASTEDO','fecha_nac' => '2006-11-04','dni' => '8225982','matricula' => '4221015510',]);
        Alumno::create(['nombre' => 'EDDY','apellidos' => 'QUISPE LUPATI','fecha_nac' => '2006-09-05','dni' => '8225983','matricula' => '4321015510',]);
        Alumno::create(['nombre' => 'ADALID','apellidos' => 'QUISPE VEGAMONTE','fecha_nac' => '2006-06-06','dni' => '8225984','matricula' => '4421015510',]);

        //Cuarto B de secundaria
        Alumno::create(['nombre' => 'MAURICIO','apellidos' => 'REYES ORTIZ','fecha_nac' => '2006-01-13','dni' => '8225985','matricula' => '4521015510',]);
        Alumno::create(['nombre' => 'MAIVER','apellidos' => 'REYNOLDS ORTUÑO','fecha_nac' => '2006-05-12','dni' => '8225986','matricula' => '4621015510',]);
        Alumno::create(['nombre' => 'PATTY','apellidos' => 'ROBLES GONZALES','fecha_nac' => '2006-05-11','dni' => '8225987','matricula' => '4721015510',]);
        Alumno::create(['nombre' => 'ERICK','apellidos' => 'ROJAS SOTO','fecha_nac' => '2006-06-13','dni' => '8225988','matricula' => '4821015510',]);
        Alumno::create(['nombre' => 'FERNANDO','apellidos' => 'SIGLER FERNANDEZ','fecha_nac' => '2006-06-22','dni' => '8225989','matricula' => '4921015510',]);

        //Quinto A de secundaria
        Alumno::create(['nombre' => 'DAVID','apellidos' => 'TORRICO SUAREZ','fecha_nac' => '2005-01-06','dni' => '8225990','matricula' => '5021015510',]);
        Alumno::create(['nombre' => 'IBER','apellidos' => 'TRUJILLO CASTRO','fecha_nac' => '2005-06-06','dni' => '8225991','matricula' => '5121015510',]);
        Alumno::create(['nombre' => 'DAMIAN','apellidos' => 'VACA ANTELO','fecha_nac' => '2005-06-06','dni' => '8225992','matricula' => '5221015510',]);
        Alumno::create(['nombre' => 'JESUS','apellidos' => 'VACA VILLARUEL','fecha_nac' => '2005-07-07','dni' => '8225993','matricula' => '5321015510',]);
        Alumno::create(['nombre' => 'ADRIAN','apellidos' => 'VALDEZ LOPEZ','fecha_nac' => '2005-07-07','dni' => '8225994','matricula' => '5421015510',]);

        //Sexto A de Secundaria
        Alumno::create(['nombre' => 'OMAR','apellidos' => 'VELIZ CASTRO','fecha_nac' => '2004-01-22','dni' => '8225995','matricula' => '5521015510',]);
        Alumno::create(['nombre' => 'FERNANDO','apellidos' => 'VILLCA HUMANA','fecha_nac' => '2004-08-23','dni' => '8225996','matricula' => '5621015510',]);
        Alumno::create(['nombre' => 'NOEMI','apellidos' => 'ZARATE CALIZAYA','fecha_nac' => '2004-11-24','dni' => '8225997','matricula' => '5721015510',]);
        Alumno::create(['nombre' => 'VERONICA','apellidos' => 'ZARATE ONOFRE','fecha_nac' => '2004-09-25','dni' => '8225998','matricula' => '5821015510',]);
        Alumno::create(['nombre' => 'SHIRLEY','apellidos' => 'GUTIERRES AÑEZ','fecha_nac' => '2004-06-26','dni' => '8225999','matricula' => '5921015510',]);
    }
}
