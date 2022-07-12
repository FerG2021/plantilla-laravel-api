<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presupuestacion extends Model
{
    use HasFactory;

    protected $primaryKey = 'presupuestacion_id';

    protected $fillable = [
        'presupuestacion_id',
        'presupuestacion_plan_id',
        'presupuestacion_rubro_id',
        'presupuestacion_rubro_nombre',
        'presupuestacion_fecha_incio',
        'presupuestacion_fecha_fin'     
    ];
}
