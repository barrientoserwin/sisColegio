<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{
    use HasFactory;
    protected $table = 'secretaria';
    protected $fillable = [ 
        'id',
        'nombre',
        'apellidos',
        'fecha_nac',
        'dni',
        'gmail',
        'telefono'
    ];
    public $timestamps = false;
}
