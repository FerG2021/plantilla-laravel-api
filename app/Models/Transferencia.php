<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Transferencia extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'transferencia_id';

    protected $fillable = [
        'transferencia_id',
        'transferencia_presupuestacion_id',
        'transferencia_borrador_id',
        'transferencia_deposito_id',
        'transferencia_deposito_producto_id',
        'transferencia_producto_activo',
        'transferencia_producto_id',
        'transferencia_producto_nombre',
        'transferencia_producto_stock',
        'transferencia_producto_unidad',
        'transferencia_producto_rubro_id',
        'transferencia_cantidad_utilizar',
    ];

    // funciones publicas
    public function obtenerObjDatos():array{
        return [
            'transferencia_id' => $this->transferencia_id,
            'transferencia_presupuestacion_id' => $this->transferencia_presupuestacion_id,
            'transferencia_borrador_id' => $this->transferencia_borrador_id,
            'transferencia_deposito_id' => $this->transferencia_deposito_id,
            'transferencia_deposito_producto_id' => $this->transferencia_deposito_producto_id,
            'transferencia_producto_activo' => $this->transferencia_producto_activo,
            'transferencia_producto_id' => $this->transferencia_producto_id,
            'transferencia_producto_nombre' => $this->transferencia_producto_nombre,
            'transferencia_producto_stock' => $this->transferencia_producto_stock,
            'transferencia_producto_unidad' => $this->transferencia_producto_unidad,
            'transferencia_producto_rubro_id' => $this->transferencia_producto_rubro_id,
            'transferencia_cantidad_utilizar' => $this->transferencia_cantidad_utilizar,
        ];
    }

}
