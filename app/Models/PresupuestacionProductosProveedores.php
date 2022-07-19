<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresupuestacionProductosProveedores extends Model
{
    use HasFactory;

    protected $primaryKey = 'presupuestacion_productos_proveedores_id';

    protected $fillable = [
        'presupuestacion_productos_proveedores_id',
        'presupuestacion_producto_id',
        'presupuestacion_id',
        'presupuestacion_plan_id',
        'presupuestacion_rubro_id',
        'presupuestacion_rubro_nombre',
        'proveedor_id',
        'proveedor_nombre',
        'proveedor_mail',
        'producto_id',
        'producto_nombre',
        'producto_cantidad_a_comprar',
        'precio_png',
        'iva',
        'precio_pu',
        'precio_pp',
    ];
}
