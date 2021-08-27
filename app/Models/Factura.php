<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $table = 'factura';
    protected $fillable = [ 
        'id',
        'codigo',
        'fecha_pago',
        'hora_pago',
        'id_inscripcion',
        'id_mensualidad'
    ];
    public $timestamps = false;
}
