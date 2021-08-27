<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    protected $table = 'alumno';
    protected $fillable = [ 
        'id',
        'nombre',
        'apellidos',
        'fecha_nac',
        'dni',
        'matricula',
        'estado'
    ];
    public $timestamps = false;
}
