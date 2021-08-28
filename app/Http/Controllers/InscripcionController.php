<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Models\InscripcionGestion;
use DB;

class InscripcionController extends Controller
{
    public function index(Request $request){
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if($buscar == ''){
            $inscripcion = DB::table('inscripcion as i')
            ->join('alumno as a', 'i.id_alumno', '=', 'a.id')
            ->join('users as u', 'i.id_usuario', '=', 'u.id')
            ->join('inscripcion_gestion as ig', 'i.id', '=', 'ig.id_inscripcion')
            ->join('gestion_curso as gc', 'gc.id', '=', 'ig.id_gestion_curso')
            ->join('curso as c', 'gc.id_curso', '=', 'c.id')
            ->join('gestion as g', 'gc.id_gestion', '=', 'g.id')
            ->select('i.id','a.matricula','a.nombre as alumno','i.fecha_inscripcion','i.estado','u.login as secretaria','c.nombre as curso','g.cod_gestion','ig.paralelo')
            ->orderBy('i.id','desc')
            ->paginate(20);
        }
        else{
            $inscripcion = DB::table('inscripcion as i')
            ->join('alumno as a', 'i.id_alumno', '=', 'a.id')
            ->join('users as u', 'i.id_usuario', '=', 'u.id')
            ->join('inscripcion_gestion as ig', 'i.id', '=', 'ig.id_inscripcion')
            ->join('gestion_curso as gc', 'gc.id', '=', 'ig.id_gestion_curso')
            ->join('curso as c', 'gc.id_curso', '=', 'c.id')
            ->join('gestion as g', 'gc.id_gestion', '=', 'g.id')
            ->select('i.id','a.matricula','a.nombre as alumno','i.fecha_inscripcion','i.estado','u.login as secretaria','c.nombre as curso','g.cod_gestion','ig.paralelo')
            ->where($criterio,'LIKE' , '%' . $buscar . '%')
            ->orderBy('i.id','desc')
            ->paginate(20);
        }
        return $inscripcion;
    }

    public function findPeriodo($id_curso_paralelo){
        $periodo = DB::table('curso_paralelo as cp')
        ->join('paralelo as p','cp.id_paralelo','=','p.id')
        ->select('p.nombre')
        ->where('cp.id','=',$id_curso_paralelo)
        ->get();
        return $periodo[0]->nombre; 
    }

    public function alumnoInscripcion(Request $request){
        $id_gestion_curso = $request->id_gestion_curso;
        $paralelo = $this->findPeriodo($request->id_curso_paralelo);
        $alumno= Inscripcion::join('alumno','inscripcion.id_alumno','=','alumno.id')
        ->join('inscripcion_gestion','inscripcion.id','=','inscripcion_gestion.id_inscripcion')
        ->select('alumno.id','alumno.nombre','alumno.apellidos','alumno.matricula')
        ->where('inscripcion_gestion.id_gestion_curso','=',$id_gestion_curso)
        ->where('inscripcion_gestion.paralelo','=',$paralelo)
        ->get();

        return $alumno;
    }

    public function alumnoInscripcion2(Request $request){
        $alumno= Inscripcion::join('alumno','inscripcion.id_alumno','=','alumno.id')
        ->join('inscripcion_gestion','inscripcion.id','=','inscripcion_gestion.id_inscripcion')
        ->select('inscripcion.id as id_inscripcion','alumno.id','alumno.nombre','alumno.apellidos','alumno.matricula','alumno.dni')
        ->where('inscripcion_gestion.id_gestion_curso','=',$request->id_gestion_curso)
        ->where('inscripcion_gestion.paralelo','=',$request->paralelo)
        ->get();

        return $alumno;
    }

    public function guardar(Request $request){
        try{
            DB::beginTransaction();
            $inscripcion=new Inscripcion();
            $inscripcion->fecha_inscripcion=$request->fecha_inscripcion;
            $inscripcion->costo_inscripcion=$request->costo_inscripcion;
            $inscripcion->estado='1';
            $inscripcion->id_alumno=$request->id_alumno;
            $inscripcion->id_usuario=\Auth::user()->id;
            $inscripcion->save();

            $inscrip_gest=new InscripcionGestion();
            $inscrip_gest->id_inscripcion=$inscripcion->id;
            $inscrip_gest->id_gestion_curso=$request->id_gestion_curso;
            $inscrip_gest->paralelo=$request->paralelo;
            $inscrip_gest->save();

            DB::commit();
            return[
                'id'=>$inscripcion->id
            ];
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function desactivar(Request $request) {
        $inscripcion = Inscripcion::findOrFail($request->id);
        $inscripcion->estado = 0;
        $inscripcion->save();
    }

    public function activar(Request $request){
        $inscripcion = Inscripcion::findOrFail($request->id);
        $inscripcion->estado = 1;
        $inscripcion->save();
    }
}
