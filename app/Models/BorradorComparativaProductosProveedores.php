<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorradorComparativaProductosProveedores extends Model
{
    use HasFactory;

    protected $primaryKey = 'borrador_comparativa_productos_proveedores_id';

    protected $fillable = [
        'borrador_comparativa_productos_proveedores_id',
        'borrador_comparativa_id',
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
        'factor',
        'cantidad_proveedor',
        'precio_png',
        'iva',
        'total_iva',
        'precio_pu',
        'precio_pp',
    ];
}
