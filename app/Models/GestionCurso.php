<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GestionCurso extends Model
{
    use HasFactory;
    protected $table = 'gestion_curso';
    protected $fillable = [ 
        'id',
        'id_gestion',
        'id_curso',
    ];
    public $timestamps = false;
}
