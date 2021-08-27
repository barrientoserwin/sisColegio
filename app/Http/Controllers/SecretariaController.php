<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Secretaria;
use App\Models\User;
use DB;

class SecretariaController extends Controller
{
    public function index(Request $request){
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if($buscar==''){
            $secretaria = Secretaria::join('users','secretaria.id','=','users.id')
            ->select('users.id','nombre','apellidos','fecha_nac','dni','telefono','gmail','login','rol_usuario','estado')->paginate(15);
        }
        else{
            $secretaria = Secretaria::join('users','secretaria.id','=','users.id')
            ->select('users.id','nombre','apellidos','fecha_nac','dni','telefono','gmail','login','rol_usuario','estado')
            ->where('secretaria.'.$criterio, 'like', '%'.$buscar.'%')
            ->paginate(15);       
        }        
        return $secretaria;
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

            $secretaria=new Secretaria();
            $secretaria->id=$usuario->id;
            $secretaria->nombre=$request->nombre;
            $secretaria->apellidos=$request->apellidos;
            $secretaria->fecha_nac=$request->fecha_nac;
            $secretaria->dni=$request->dni;
            $secretaria->gmail=$request->gmail;
            $secretaria->telefono=$request->telefono;
            $secretaria->save();

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

            $secretaria = Secretaria::findOrFail($request->id);
            $secretaria->nombre=$request->nombre;
            $secretaria->apellidos=$request->apellidos;
            $secretaria->fecha_nac=$request->fecha_nac;
            $secretaria->dni=$request->dni;
            $secretaria->telefono=$request->telefono;
            $secretaria->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}
