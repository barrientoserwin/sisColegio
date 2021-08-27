<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $table = 'asistencia';
    protected $fillable = [ 
        'id',
        'fecha',
        'hora',
        'descripcion',
        'estado',
        'id_curso_paralelo'
    ];
    public $timestamps = false;
}
