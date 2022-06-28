<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Producto extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = [
        'producto_id',
        'producto_codigo',
        'producto_nombre',
        'producto_puc',
        'producto_fpuc',
        'producto_unidad',
        'producto_activo',
        'rubro_id',
    ];

}
