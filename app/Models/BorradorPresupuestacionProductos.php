<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;


class BorradorPresupuestacionProductos extends Model
{
    use HasFactory;
    use softDeletes;


    protected $primaryKey = 'borrador_presupuestacion_producto_id';

    protected $fillable = [
        'borrador_presupuestacion_producto_id',
        'borrador_presupuestacion_id',
        'borrador_presupuestacion_plan_id',
        'borrador_producto_id',
        'borrador_producto_nombre',
        'borrador_producto_rubro_id',
        'borrador_producto_rubro_nombre',
        'borrador_producto_cantidad_a_comprar',
        'borrador_producto_cantidad_deposito',
        'borrador_producto_cantidad_real_a_comprar',
    ];

    public function obtenerObjDatos():array{
        return [
            'borrador_presupuestacion_producto_id' => $this->borrador_presupuestacion_producto_id,
            'borrador_presupuestacion_id' => $this->borrador_presupuestacion_id,
            'borrador_presupuestacion_plan_id' => $this->borrador_presupuestacion_plan_id,
            'borrador_producto_id' => $this->borrador_producto_id,
            'borrador_producto_nombre' => $this->borrador_producto_nombre,
            'borrador_producto_rubro_id' => $this->borrador_producto_rubro_id,
            'borrador_producto_rubro_nombre' => $this->borrador_producto_rubro_nombre,
            'borrador_producto_cantidad_a_comprar' => $this->borrador_producto_cantidad_a_comprar,
            'borrador_producto_cantidad_deposito' => $this->borrador_producto_cantidad_deposito,
            'borrador_producto_cantidad_real_a_comprar' => $this->borrador_producto_cantidad_real_a_comprar,
        ];
    }
}
