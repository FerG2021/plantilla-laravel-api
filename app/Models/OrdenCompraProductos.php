<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenCompraProductos extends Model
{
    use HasFactory;

    protected $primaryKey = 'ordenes_compras_productos_id';

    protected $fillable = [
        'ordenes_compras_productos_id',
        'ordenes_compras_id',
        'ordenes_compras_productos_cantidad_proveedor',
        'ordenes_compras_productos_iva',
        'ordenes_compras_productos_precio_png',
        'ordenes_compras_productos_precio_pp',
        'ordenes_compras_productos_precio_pu',
        'ordenes_compras_productos_presupuestacion_id',
        'ordenes_compras_productos_plan_id',
        'ordenes_compras_productos_producto_id',
        'ordenes_compras_productos_producto_proveedor_id',
        'ordenes_compras_productos_rubro_id',
        'ordenes_compras_productos_rubro_nombre',
        'ordenes_compras_productos_cantidad_a_comprar',
        'ordenes_compras_productos_producto_nombre',
        'ordenes_compras_productos_proveedor_id',
        'ordenes_compras_productos_proveedor_mail',
        'ordenes_compras_productos_proveedor_nombre',
        'ordenes_compras_productos_total_iva',
    ];

    // funciones publicas
    public function obtenerObjDatos():array{
        return [
            'ordenes_compras_productos_id' => $this->ordenes_compras_productos_id,
            'ordenes_compras_id' => $this->ordenes_compras_id,
            'ordenes_compras_productos_cantidad_proveedor' => $this->ordenes_compras_productos_cantidad_proveedor,
            'ordenes_compras_productos_iva' => $this->ordenes_compras_productos_iva,
            'ordenes_compras_productos_precio_png' => $this->ordenes_compras_productos_precio_png,
            'ordenes_compras_productos_precio_pp' => $this->ordenes_compras_productos_precio_pp,
            'ordenes_compras_productos_precio_pu' => $this->ordenes_compras_productos_precio_pu,
            'ordenes_compras_productos_presupuestacion_id' => $this->ordenes_compras_productos_presupuestacion_id,
            'ordenes_compras_productos_plan_id' => $this->ordenes_compras_productos_plan_id,
            'ordenes_compras_productos_producto_id' => $this->ordenes_compras_productos_producto_id,
            'ordenes_compras_productos_producto_proveedor_id' => $this->ordenes_compras_productos_producto_proveedor_id,
            'ordenes_compras_productos_rubro_id' => $this->ordenes_compras_productos_rubro_id,
            'ordenes_compras_productos_rubro_nombre' => $this->ordenes_compras_productos_rubro_nombre,
            'ordenes_compras_productos_cantidad_a_comprar' => $this->ordenes_compras_productos_cantidad_a_comprar,
            'ordenes_compras_productos_producto_nombre' => $this->ordenes_compras_productos_producto_nombre,
            'ordenes_compras_productos_proveedor_id' => $this->ordenes_compras_productos_proveedor_id,
            'ordenes_compras_productos_proveedor_mail' => $this->ordenes_compras_productos_proveedor_mail,
            'ordenes_compras_productos_proveedor_nombre' => $this->ordenes_compras_productos_proveedor_nombre,
            'ordenes_compras_productos_total_iva' => $this->ordenes_compras_productos_total_iva,
        ];
    }
}
