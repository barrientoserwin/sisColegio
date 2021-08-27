<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MensualidadInscripcion extends Model
{
    use HasFactory;
    protected $table = 'mensualidad_inscripcion';
    protected $fillable = [ 
        'id_inscripcion',
        'id_pago_mensual',
        'fecha_pago',
        'estado'
    ];
    public $timestamps = false;
}
