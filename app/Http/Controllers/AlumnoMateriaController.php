<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlumnoMateria;
use DB;

class AlumnoMateriaController extends Controller
{
    public function guardar(Request $request){
        try{
            DB::beginTransaction(); 
            $detalles = $request->data;
            foreach($detalles as $ep=>$det){
                $obj = new AlumnoMateria();
                $obj->nota=$det['nota'];
                $obj->id_alumno=$det['id_alumno'];
                $obj->id_curso_paralelo=$det['id_curso_paralelo'];
                $obj->id_periodo=$det['id_periodo'];
                $obj->save();
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function listarAlumnos(Request $request){
        $id_curso_paralelo = $request->id_curso_paralelo;

        $alumno_materia= AlumnoMateria::join('alumno as a','alumno_materia.id_alumno','=','a.id')
        ->select('a.matricula','a.nombre','a.apellidos','alumno_materia.nota')
        ->where('alumno_materia.id_curso_paralelo','=',$id_curso_paralelo)
        ->get();

        return $alumno_materia;
    }

    private function listarGestionCursoInscritos($matricula,$curso,$periodo){
        $notas = DB::table('alumno_materia as am')
        ->join('alumno as a','am.id_alumno','=','a.id')
        ->join('curso_paralelo as cp','am.id_curso_paralelo','=','cp.id')
        ->join('curso_materia as cm','cp.id_curso_materia','=','cm.id')
        ->join('materia as m','cm.id_materia','=','m.id')
        ->select('m.id','m.nombre','am.nota')
        ->where('a.matricula','=',$matricula)
        ->where('cm.id_gestion_curso','=',$curso)
        ->where('am.id_periodo','=',$periodo)
        ->orderBy('m.id','asc')
        ->get();
        return $notas;       
    }

    public function boletin(Request $request){
        $matricula=$request->matricula;
        $curso=$request->id_gestion_curso;
        
        $nota1=$this->listarGestionCursoInscritos($matricula,$curso,1);

        $data= Array();
        foreach($nota1 as $det){
 			$data[]=array( 		 				
 				"id_materia"=>$det->id,
                "materia"=>$det->nombre,
 				"nota1"=>$det->nota,	
 				"nota2"=>0,
                "nota3"=>0,
 				"promedio"=>0,
 			);
 		}

        $nota2=$this->listarGestionCursoInscritos($matricula,$curso,2);
        $i=0;
        foreach($nota2 as $det){
            $data[$i]['nota2']=$det->nota;
            $i=$i+1;
 		}

        $nota3=$this->listarGestionCursoInscritos($matricula,$curso,3);
        $c=0;
        foreach($nota3 as $det){
            $data[$c]['nota3']=$det->nota;
            $promedio=($data[$c]['nota1']+$data[$c]['nota2']+$data[$c]['nota3'])/3;
            $data[$c]['promedio']=round($promedio,2);
            $c=$c+1;
 		}

        return $data;    
    }
}