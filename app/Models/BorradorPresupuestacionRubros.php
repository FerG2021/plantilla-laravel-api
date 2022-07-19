<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorradorPresupuestacionRubros extends Model
{
    use HasFactory;

    protected $primaryKey = 'borrador_presupuestacion_rubros_id';

    protected $fillable = [
        'borrador_presupuestacion_rubros_id',
        'borrador_presupuestacion_id',
        'borrador_presupuestacion_rubro_id',
        'borrador_presupuestacion_nombre_nombre',
    ];
}
