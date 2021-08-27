<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\ControlAsistencia;
use DB;

class AsistenciaController extends Controller
{
    private function findPeriodo($id_curso_paralelo){
        $periodo = DB::table('curso_paralelo as cp')
        ->join('paralelo as p','cp.id_paralelo','=','p.id')
        ->select('p.nombre')
        ->where('cp.id','=',$id_curso_paralelo)
        ->get();
        return $periodo[0]->nombre; 
    }

    public function guardar(Request $request){
        $paralelo=$this->findPeriodo($request->id_curso_paralelo);
        $inscritos = DB::table('inscripcion')
        ->join('inscripcion_gestion','inscripcion.id','=','inscripcion_gestion.id_inscripcion')
        ->where('inscripcion.estado', '=', 1)
        ->where('inscripcion_gestion.id_gestion_curso', '=', $request->id_gestion_curso)
        ->where('inscripcion_gestion.paralelo','=',$paralelo)
        ->pluck('id_alumno');

        $asistencia = new Asistencia();
        $asistencia->fecha=  $request->fecha;
        $asistencia->hora=  $request->hora;
        $asistencia->descripcion=  $request->descripcion;
        $asistencia->id_curso_paralelo=  $request->id_curso_paralelo;
        $asistencia->save();

        foreach($inscritos as $id_alumno){
            $obj = new ControlAsistencia();
            $obj->id_asistencia=$asistencia->id;
            $obj->id_alumno= $id_alumno;
            $obj->save();
        }
    }

    public function controlAsistencia(Request $request){
        $control= ControlAsistencia::join('alumno as a','control_asistencia.id_alumno','=','a.id')
        ->select('a.id','a.nombre','a.apellidos','control_asistencia.estado')
        ->where('control_asistencia.id_asistencia','=',$request->id_asistencia)
        ->get();

        return $control;
    }
}
