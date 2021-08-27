<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    use HasFactory;
    protected $table = 'gestion';
    protected $fillable = [ 
        'id',
        'cod_gestion',
        'fecha_inicio',
        'fecha_fin',
        'estado',
    ];
    public $timestamps = false;
}
