<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apoderado;
use App\Models\Parentesco;
use DB;

class ApoderadoController extends Controller
{
    public function index(Request $request){
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if($buscar==''){
            $apoderado = Apoderado::paginate(15);
        }
        else{
            $apoderado = Apoderado::where('apoderado.'.$criterio, 'like', '%'.$buscar.'%')
            ->paginate(15);       
        }        
        return $apoderado;
    }

    public function listarAlumnoApoderado(Request $request){
        $id_apoderado = $request->id;
        $apoderado = Parentesco::join('alumno','parentesco.id_alumno','=','alumno.id')
        ->select('alumno.nombre','alumno.apellidos','parentesco.descripcion as parentesco')
        ->where('parentesco.id_apoderado', '=', $id_apoderado)
        ->get();        
        return $apoderado;
    }

    public function guardar(Request $request){
        try{
            DB::beginTransaction();  
            $datos = $request->datos;          
            $apoderado = new Apoderado();
            $apoderado->nombre=$datos['nombre'];
            $apoderado->apellidos=$datos['apellidos'];
            $apoderado->fecha_nac=$datos['fecha_nac'];
            $apoderado->dni=$datos['dni'];
            $apoderado->ocupacion=$datos['ocupacion'];
            $apoderado->telefono=$datos['telefono'];
            $apoderado->save();  

            $detalles = $request->detalle;
            foreach($detalles as $ep=>$det){
                $obj = new Parentesco();
                $obj->id_apoderado=$apoderado->id;
                $obj->id_alumno=$det['id_alumno'];
                $obj->descripcion=$det['parentesco'];
                $obj->save();
            }
            DB::commit();
            return[
                'id'=>$apoderado->id
            ];
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function desactivar(Request $request){
        $apoderado = Apoderado::findOrFail($request->id);
        $apoderado->estado=0;
        $apoderado->save();
    }

    public function activar(Request $request){
        $apoderado = Apoderado::findOrFail($request->id);
        $apoderado->estado=1;
        $apoderado->save();
    }
}
