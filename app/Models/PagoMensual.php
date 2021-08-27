<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoMensual extends Model
{
    use HasFactory;
    protected $table = 'pago_mensual';
    protected $fillable = [ 
        'id',
        'plazo_fecha',
        'mes',
        'monto',
        'id_gestion_curso'
    ];
    public $timestamps = false;
}
