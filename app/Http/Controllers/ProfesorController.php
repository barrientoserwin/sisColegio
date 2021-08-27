<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesor;
use App\Models\User;
use DB;

class ProfesorController extends Controller
{
    public function index(Request $request){
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if($buscar==''){
            $profesor = Profesor::join('users','profesor.id','=','users.id')
            ->select('users.id','nombre','apellidos','fecha_nac','dni','gmail','telefono','login','rol_usuario','estado')
            ->paginate(15);
        }
        else{
            $profesor = Profesor::join('users','profesor.id','=','users.id')
            ->select('users.id','nombre','apellidos','fecha_nac','dni','gmail','telefono','login','rol_usuario','estado')
            ->where('profesor.'.$criterio, 'like', '%'.$buscar.'%')
            ->paginate(15);       
        }        
        return $profesor;
    }

    public function listarSinPaginate(Request $request){
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if($buscar==''){
            $profesor = Profesor::all();
        }
        else{
            $profesor = Profesor::where('profesor.'.$criterio, 'like', '%'.$buscar.'%')->get();       
        }        
        return $profesor;
    }

    public function guardar(Request $request){
        try{
            DB::beginTransaction();  
            $usuario = new User();
            $usuario->login=$request->login;
            $usuario->password=bcrypt($request->password);
            $usuario->rol_usuario=$request->rol_usuario;
            $usuario->estado='1';
            $usuario->save();

            $profesor=new Profesor();
            $profesor->id=$usuario->id;
            $profesor->nombre=$request->nombre;
            $profesor->apellidos=$request->apellidos;
            $profesor->fecha_nac=$request->fecha_nac;
            $profesor->dni=$request->dni;
            $profesor->gmail=$request->gmail;
            $profesor->telefono=$request->telefono;
            $profesor->save();

            DB::commit();
            return[
                'id'=>$usuario->id
            ];
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function modificar(Request $request){
        try{
            DB::beginTransaction();
            $usuario = User::findOrFail($request->id);
            $usuario->login=$request->login;
            $usuario->rol_usuario=$request->rol_usuario;            
            $password = $request->password;
            if ($password){
                $usuario->password = bcrypt($password);
            }        
            $usuario->save();

            $profesor = Profesor::findOrFail($request->id);
            $profesor->nombre=$request->nombre;
            $profesor->apellidos=$request->apellidos;
            $profesor->fecha_nac=$request->fecha_nac;
            $profesor->dni=$request->dni;
            $profesor->gmail=$request->gmail;
            $profesor->telefono=$request->telefono;
            $profesor->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}
