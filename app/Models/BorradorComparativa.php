<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorradorComparativa extends Model
{
    use HasFactory;

    protected $primaryKey = 'borrador_comparativa_id';

    protected $fillable = [
        'borrador_comparativa_id',
        'borrador_comparativa_presupuestacion_id',
    ];
}
