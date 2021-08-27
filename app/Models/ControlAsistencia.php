<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlAsistencia extends Model
{
    use HasFactory;
    protected $table = 'control_asistencia';
    protected $fillable = [ 
        'id_asistencia',
        'id_alumno',
        'estado'
    ];
    public $timestamps = false;
}
