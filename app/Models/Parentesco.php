<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parentesco extends Model
{
    use HasFactory;
    protected $table = 'parentesco';
    protected $fillable = [ 
        'id_apoderado',
        'id_alumno',
        'descripcion'
    ];
    public $timestamps = false;
}
