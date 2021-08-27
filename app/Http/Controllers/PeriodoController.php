<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periodo;

class PeriodoController extends Controller
{
    public function selectPeriodo(){
        $periodo=Periodo::select('id','nombre')
        ->where('periodo.estado','=',1)
        ->get();
        return $periodo; 
    }
}
