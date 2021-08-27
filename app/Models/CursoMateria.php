<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoMateria extends Model
{
    use HasFactory;
    protected $table = 'curso_materia';
    protected $fillable = [ 
        'id',
        'id_gestion_curso',
        'id_materia',
        'id_profesor'
    ];
    public $timestamps = false;
}
