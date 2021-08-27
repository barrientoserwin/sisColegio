<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gestion;
use App\Models\GestionCurso;
use DB;

class GestionController extends Controller
{
    public function index(){
        $gestion=Gestion::all();
        return $gestion;    
    }

    public function selectGestion(){
        $gestion=Gestion::select('id','cod_gestion')
        ->where('gestion.estado','=',1)
        ->get();
        return $gestion;    
    }

    public function guardar(Request $request){
        try{
            DB::beginTransaction();
            $datos = $request->datos;          
            $gestion = new Gestion();
            $gestion->cod_gestion=$datos['cod_gestion'];
            $gestion->fecha_inicio=$datos['fecha_inicio'];
            $gestion->fecha_fin=$datos['fecha_fin'];
            $gestion->estado=0;
            $gestion->save();  

            $detalles = $request->detalle;
            foreach($detalles as $ep=>$det){
                $obj = new GestionCurso();
                $obj->id_gestion=$gestion->id;
                $obj->id_curso=$det['id_curso'];
                $obj->save();
            }
            DB::commit();
            return[
                'id'=>$gestion->id
            ];
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function desactivar(Request $request){    
        $gestion= Gestion::findOrFail($request->id);
        $gestion->estado=0;
        $gestion->save();
    }

    public function activar(Request $request){    
        $gestion= Gestion::findOrFail($request->id);
        $gestion->estado=1;
        $gestion->save();
    }
}
