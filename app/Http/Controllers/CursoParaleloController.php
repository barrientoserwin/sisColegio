<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CursoMateria;
use App\Models\CursoParalelo;

class CursoParaleloController extends Controller
{
    public function guardar(Request $request){
        $curso_materia = CursoMateria::where('curso_materia.id_gestion_curso', '=', $request->id_gestion_curso)
        ->pluck('id');

        foreach($curso_materia as $id_curso_materia){
            $obj = new CursoParalelo();
            $obj->id_curso_materia=$id_curso_materia;
            $obj->id_paralelo=$request->id_paralelo;
            $obj->save();
        }
    }

    public function selectCursoParalelo(Request $request){
        $curso_paralelo = CursoParalelo::join('paralelo','curso_paralelo.id_paralelo','=','paralelo.id')
        ->select('curso_paralelo.id','paralelo.nombre')
        ->where('curso_paralelo.id_curso_materia', '=', $request->id_curso_materia)
        ->get();        
        return $curso_paralelo;
    }
}
