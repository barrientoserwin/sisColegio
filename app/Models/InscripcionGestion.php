<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscripcionGestion extends Model
{
    use HasFactory;
    protected $table = 'inscripcion_gestion';
    protected $fillable = [ 
        'id_inscripcion',
        'id_gestion_curso',
        'paralelo'
    ];
    public $timestamps = false;
}
