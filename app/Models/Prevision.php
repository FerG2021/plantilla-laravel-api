<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;


class Prevision extends Model
{
    use HasFactory;
    use softDeletes;

    protected $primaryKey = 'prevision_id';

    protected $fillable = [
        'prevision_id',
        'plan_id',
        'producto_id',
        'prevision_cantidad',
        'prevision_periodo',
        'prevision_unidad'
    ];

    
}
