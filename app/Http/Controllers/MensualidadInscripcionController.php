<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MensualidadInscripcion;
use App\Models\Factura;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;

class MensualidadInscripcionController extends Controller
{
    public function detalleMensualidad(Request $request){
        $id_gestion_curso=$request->id_gestion_curso;
        $mes=$request->mes;

        $mensualidad = DB::table('inscripcion as i')
        ->join('inscripcion_gestion as ig','i.id','=','ig.id_inscripcion')
        ->join('mensualidad_inscripcion as mi','i.id','=','mi.id_inscripcion')
        ->join('pago_mensual as pm','mi.id_pago_mensual','=','pm.id')
        ->join('alumno as a','i.id_alumno','=','a.id')
        ->select('pm.mes','pm.plazo_fecha','mi.fecha_pago','pm.monto','mi.estado','a.nombre','a.apellidos')
        ->where('ig.id_gestion_curso', '=', $id_gestion_curso)
        ->where('pm.mes', '=', $mes)
        ->get();
        return $mensualidad;
    }

    public function detalleCliente(Request $request){
        $id_inscripcion=$request->id_inscripcion;
        $mensualidad = MensualidadInscripcion::join('inscripcion','mensualidad_inscripcion.id_inscripcion','=','inscripcion.id')
        ->join('pago_mensual','mensualidad_inscripcion.id_pago_mensual','=','pago_mensual.id')
        ->select('pago_mensual.plazo_fecha','pago_mensual.mes','pago_mensual.monto','mensualidad_inscripcion.estado',
        'mensualidad_inscripcion.fecha_pago','mensualidad_inscripcion.id_inscripcion','mensualidad_inscripcion.id_pago_mensual')
        ->where('mensualidad_inscripcion.id_inscripcion', '=', $id_inscripcion)
        ->get();        
        return $mensualidad;
    }

    public function pagoMes(Request $request){
        $myDate = Carbon::now('America/La_Paz');

        MensualidadInscripcion::where('id_inscripcion', $request->id_inscripcion)
        ->where('id_pago_mensual', $request->id_pago_mensual)
        ->update(['estado' => 1,'fecha_pago' => $myDate->toDateString()]);

        $factura = new Factura();
        $factura->codigo=Str::random(9);
        $factura->fecha_pago=$myDate->toDateString();
        $factura->hora_pago=$myDate->toTimeString();
        $factura->id_inscripcion=$request->id_inscripcion;
        $factura->id_mensualidad=$request->id_pago_mensual;
        $factura->save();
    }

    public function pagoPDF(Request $request){
        $mensualidad = MensualidadInscripcion::join('inscripcion','mensualidad_inscripcion.id_inscripcion','=','inscripcion.id')
        ->join('pago_mensual','mensualidad_inscripcion.id_pago_mensual','=','pago_mensual.id')
        ->select('pago_mensual.plazo_fecha','pago_mensual.mes','pago_mensual.monto','mensualidad_inscripcion.estado',
        'mensualidad_inscripcion.fecha_pago','mensualidad_inscripcion.id_inscripcion','mensualidad_inscripcion.id_pago_mensual')
        ->where('mensualidad_inscripcion.id_inscripcion', '=', $request->id)
        ->get();     

        $alumno = DB::table('inscripcion as i')
        ->join('alumno as a','i.id_alumno','=','a.id')
        ->select('a.nombre','a.apellidos')
        ->where('i.id', '=', $request->id)
        ->first();

        $pdf = \PDF::loadView('report.factura', [
            'alumno'=>strtoupper($alumno->nombre.' '.$alumno->apellidos),
            'fecha_actual'=>Carbon::now()->locale('es')->translatedFormat('l d \d\e F \d\e\l Y'),
            'mensualidad'=>$mensualidad
        ]);
        return $pdf->stream('extracto.pdf');
    }
}
