<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CursoMateria;
use App\Models\CursoParalelo;
use DB;

class CursoMateriaController extends Controller
{
    public function guardar(Request $request){
        try{
            DB::beginTransaction();  
            $detalles = $request->detalle;
            foreach($detalles as $ep=>$det){
                $obj = new CursoMateria();
                $obj->id_gestion_curso=$request->id_gestion_curso;
                $obj->id_materia=$det['idMateria'];
                $obj->save();

                $cursoParalelo = new CursoParalelo();
                $cursoParalelo->id_curso_materia=$obj->id;
                $cursoParalelo->id_paralelo=1;
                $cursoParalelo->save();
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function listarMateriaGestion(Request $request){
        $curso_materia = CursoMateria::join('materia','curso_materia.id_materia','=','materia.id')
        ->select('materia.id','materia.nombre','materia.area')
        ->where('curso_materia.id_gestion_curso', '=', $request->id_gestion_curso)
        ->get();        
        return $curso_materia;
    }

    public function listarCursoMateria(Request $request){
        $curso_materia = CursoMateria::join('materia','curso_materia.id_materia','=','materia.id')
        ->leftJoin('profesor','curso_materia.id_profesor','=','profesor.id')
        ->select('curso_materia.id','materia.nombre','materia.area','profesor.nombre as nombreProfe','profesor.apellidos')
        ->where('curso_materia.id_gestion_curso', '=', $request->id_gestion_curso)
        ->get();        
        return $curso_materia;
    }

    public function asignarProfesor(Request $request){
        $curso_materia = CursoMateria::findOrFail($request->id_curso_materia);
        $curso_materia->id_profesor = $request->id_profesor;
        $curso_materia->save();
    }

    public function selectCursoMateria(Request $request){
        $curso_materia = CursoMateria::join('materia','curso_materia.id_materia','=','materia.id')
        ->select('curso_materia.id','materia.nombre')
        ->where('curso_materia.id_gestion_curso', '=', $request->id_gestion_curso)
        ->get();        
        return $curso_materia;
    }
}
