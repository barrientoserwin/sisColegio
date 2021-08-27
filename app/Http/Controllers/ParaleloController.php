<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paralelo;

class ParaleloController extends Controller
{
    public function selectParalelo(){
        $paralelo = Paralelo::all();
        return $paralelo;
    }
}
