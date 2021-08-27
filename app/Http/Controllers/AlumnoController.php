<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;

class AlumnoController extends Controller
{
    public function index(Request $request){
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if($buscar==''){
            $alumno= Alumno::orderBy('alumno.id','desc')->paginate(25);
        }
        else{
            $alumno= Alumno::where('alumno.'.$criterio, 'like', '%'.$buscar.'%')
            ->orderBy('alumno.id','desc')->paginate(25);         
        }
        return $alumno;
    }

    public function listarSinPaginate(Request $request){
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if($buscar==''){
            $alumno= Alumno::all();
        }
        else{
            $alumno= Alumno::where('alumno.'.$criterio, 'like', '%'.$buscar.'%')->get();         
        }
        return $alumno;
    }

    public function guardar(Request $request){
        $alumno = new Alumno();
        $alumno->nombre=$request->nombre;
        $alumno->apellidos=$request->apellidos;
        $alumno->fecha_nac=$request->fecha_nac;
        $alumno->dni=$request->dni;
        $alumno->matricula=$request->matricula;
        $alumno->save();
    }

    public function guardarInscripcion(Request $request){
        $alumno = new Alumno();
        $alumno->nombre=$request->nombre;
        $alumno->apellidos=$request->apellidos;
        $alumno->fecha_nac=$request->fecha_nac;
        $alumno->dni=$request->dni;
        $alumno->matricula=$request->matricula;
        $alumno->save();

        $obj= Alumno::select('id','nombre','apellidos')->where('id','=',$alumno->id)->get();
        return $obj;
    }

    public function modificar(Request $request){    
        $alumno= Alumno::findOrFail($request->id);
        $alumno->nombre=$request->nombre;
        $alumno->apellidos=$request->apellidos;
        $alumno->fecha_nac=$request->fecha_nac;
        $alumno->dni=$request->dni;
        $alumno->matricula=$request->matricula;
        $alumno->save();
    }

    public function desactivar(Request $request){    
        $alumno= Alumno::findOrFail($request->id);
        $alumno->estado=0;
        $alumno->save();
    }

    public function activar(Request $request){    
        $alumno= Alumno::findOrFail($request->id);
        $alumno->estado=1;
        $alumno->save();
    }
}
