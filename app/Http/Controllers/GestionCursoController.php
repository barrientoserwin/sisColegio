<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GestionCurso;
use DB;

class GestionCursoController extends Controller
{
    public function detalleCursoGestion(Request $request){
        $gestion = $request->id;
        $obj=GestionCurso::join('curso as c','gestion_curso.id_curso','=','c.id')
        ->join('gestion as g','gestion_curso.id_gestion','=','g.id')
        ->select('gestion_curso.id','c.nombre','c.grado')
        ->where('g.id','=',$gestion)
        ->get();
        return $obj;
    }

    public function selectCursoGestion(Request $request){
        $gestion = $request->cod_gestion;
        $obj=GestionCurso::join('curso as c','gestion_curso.id_curso','=','c.id')
        ->join('gestion as g','gestion_curso.id_gestion','=','g.id')
        ->select('gestion_curso.id','c.nombre')
        ->where('g.cod_gestion','=',$gestion)
        ->where('g.estado','=',1)
        ->get();
        
        return $obj;
    }

    public function listarGestionCurso(){
        $gestion_curso = DB::table('gestion_curso as gc')
        ->join('gestion as g','gc.id_gestion','=','g.id')
        ->join('curso as c','gc.id_curso','=','c.id')
        ->join('curso_materia as cm','gc.id','=','cm.id_gestion_curso')
        ->select('gc.id','g.cod_gestion','c.nombre as curso','c.grado',DB::raw('COUNT(cm.id_materia) as cantMateria'))
        ->groupBy('gc.id','g.cod_gestion','c.nombre','c.grado')
        ->get();
        return $gestion_curso;       
    }

    public function listarGestionCursoInscritos(){
        $gestion_curso = DB::table('gestion_curso as gc')
        ->join('gestion as g','gc.id_gestion','=','g.id')
        ->join('curso as c','gc.id_curso','=','c.id')
        ->join('inscripcion_gestion as ig','gc.id','=','ig.id_gestion_curso')
        ->select('g.cod_gestion','c.nombre as curso','c.grado','ig.paralelo',DB::raw('COUNT(ig.id_inscripcion) as cantInscrito'))
        ->groupBy('g.cod_gestion','c.nombre','c.grado','ig.paralelo')
        ->get();
        return $gestion_curso;       
    }
}
