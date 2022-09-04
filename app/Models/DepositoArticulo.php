<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DepositoArticulo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'deposito_producto_id';

    protected $fillable = [
        'deposito_producto_id',
        'deposito_id',
        'producto_id',
        'producto_nombre',
        'producto_stock',
        'producto_unidad',
        'producto_activo',
        'rubro_id' 
    ];
}
