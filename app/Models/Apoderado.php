<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apoderado extends Model
{
    use HasFactory;
    protected $table = 'apoderado';
    protected $fillable = [ 
        'id',
        'nombre',
        'apellidos',
        'fecha_nac',
        'dni',
        'ocupacion',
        'telefono',
        'estado'
    ];
    public $timestamps = false;
}
