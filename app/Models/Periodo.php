<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;
    protected $table = 'periodo';
    protected $fillable = [ 
        'id',
        'nombre',
        'tipo_periodo',
        'descripcion',
        'estado',
    ];
    public $timestamps = false;
}
