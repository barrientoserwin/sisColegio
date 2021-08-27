<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoParalelo extends Model
{
    use HasFactory;
    protected $table = 'curso_paralelo';
    protected $fillable = [ 
        'id',
        'id_curso_materia',
        'id_paralelo'
    ];
    public $timestamps = false;
}
