<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Prevision extends Model
{
    use HasFactory;
    use SoftDeletes;

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
