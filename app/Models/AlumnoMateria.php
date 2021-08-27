<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoMateria extends Model
{
    use HasFactory;
    protected $table = 'alumno_materia';
    protected $fillable = [ 
        'id',
        'nota',
        'id_alumno',
        'id_curso_paralelo',
        'id_periodo'
    ];
    public $timestamps = false;
}
