<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresupuestacionProductos extends Model
{
    use HasFactory;

    protected $primaryKey = 'presupuestacion_producto_id';

    protected $fillable = [
        'presupuestacion_producto_id',
        'presupuestacion_id',
        'presupuestacion_plan_id',
        'producto_id',
        'producto_nombre',
        'producto_cantidad_a_comprar',
        'producto_cantidad_real_a_comprar',
        'precio_png',
        'iva',
        'precio_pu',
        'precio_pp'
    ];

    // funciones publicas
    public function obtenerObjDatos():array{
        return [
            'presupuestacion_producto_id' => $this->presupuestacion_producto_id,
            'presupuestacion_id' => $this->presupuestacion_id,
            'presupuestacion_plan_id' => $this->presupuestacion_plan_id,
            'producto_id' => $this->producto_id,
            'producto_nombre' => $this->producto_nombre,
            'producto_rubro_id' => $this->producto_rubro_id,
            'producto_rubro_nombre' => $this->producto_rubro_nombre,
            'producto_cantidad_a_comprar' => $this->producto_cantidad_a_comprar,
            'producto_cantidad_real_a_comprar' => $this->producto_cantidad_real_a_comprar,
            'precio_png' => $this->precio_png,
            'iva' => $this->iva,
            'precio_pu' => $this->precio_pu,
            'precio_pp' => $this->precio_pp,
            'producto_observaciones' => $this->producto_observaciones
        ];
    }
}
