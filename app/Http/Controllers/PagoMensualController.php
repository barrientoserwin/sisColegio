<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PagoMensual;
use App\Models\MensualidadInscripcion;
use DB;

class PagoMensualController extends Controller
{
    public function programarPago(Request $request){
        $pago = PagoMensual::select('mes','id_gestion_curso')
        ->where('pago_mensual.id_gestion_curso','=',$request->id_gestion_curso)
        ->where('pago_mensual.mes','=',$request->mes)
        ->get();

        $valor=0;
        if(count($pago)>0){
           $valor =1;
        }
        else{
            $valor =0;
            $inscritos = DB::table('inscripcion')
            ->join('inscripcion_gestion','inscripcion.id','=','inscripcion_gestion.id_inscripcion')
            ->where('inscripcion.estado', '=', 1)
            ->where('inscripcion_gestion.id_gestion_curso', '=', $request->id_gestion_curso)
            ->pluck('id');

            $pago = new PagoMensual();
            $pago->plazo_fecha=  $request->plazo_fecha;
            $pago->mes=  $request->mes;
            $pago->monto=  $request->monto;
            $pago->id_gestion_curso=  $request->id_gestion_curso;
            $pago->save();

            foreach($inscritos as $id_inscripcion){
                $obj = new MensualidadInscripcion();
                $obj->id_inscripcion= $id_inscripcion;
                $obj->id_pago_mensual=$pago->id;
                $obj->save();
            }
        }

        return $valor;
    }

}
