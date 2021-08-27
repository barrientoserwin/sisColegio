<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;

class UserController extends Controller
{
    public function desactivar(Request $request){
        $usuario = User::findOrFail($request->id);
        $usuario->estado = '0';
        $usuario->save();
    }

    public function activar(Request $request){
        $usuario = User::findOrFail($request->id);
        $usuario->estado = '1';
        $usuario->save();
    }

    public function rolUsuarios(){
        $obj = DB::table('users')
        ->select('users.rol_usuario',DB::raw('count(users.id) as nroUsuarios'))
        ->groupBy('users.rol_usuario')
        ->get();
        return $obj;
    }

    public function personal(Request $request){
        $tipo_usuario=$request->rol_usuario;
        if($tipo_usuario=='profesor'){
            $obj = DB::table('users')
            ->join('profesor', 'profesor.id', '=', 'users.id')
            ->select('profesor.dni','profesor.nombre','profesor.apellidos','profesor.gmail','profesor.telefono')
            ->get();
        }
        else{
            $obj = DB::table('users')
            ->join('secretaria', 'secretaria.id', '=', 'users.id')
            ->select('secretaria.dni','secretaria.nombre','secretaria.apellidos','secretaria.gmail','secretaria.telefono')
            ->get();
        }
        return $obj;
    }
}
