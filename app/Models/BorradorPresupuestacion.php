<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorradorPresupuestacion extends Model
{
    use HasFactory;

    protected $primaryKey = 'borrador_presupuestacion_id';

    protected $fillable = [
        'borrador_presupuestacion_id',
        'borrador_presupuestacion_plan_id',
        'borrador_presupuestacion_fecha_incio',
        'borrador_presupuestacion_fecha_fin',
        'borrador_presupuestado',    
    ];
}
