<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comparativa extends Model
{
    use HasFactory;

    protected $primaryKey = 'comparativa_id';

    protected $fillable = [
        'comparativa_id',
        'comparativa_presupuestacion_id',
    ];
}
