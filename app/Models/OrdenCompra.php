<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
    use HasFactory;

    protected $primaryKey = 'ordenes_compras_id';

    protected $fillable = [
        'ordenes_compras_id',
        'ordenes_compras_proveedor_id',
        'ordenes_compras_presupuestacion_id',
        'ordenes_compras_presupuestacion_plan_id',
        'ordenes_compras_proveedor_nombre',
        'ordenes_compras_proveedor_mail',
        'ordenes_compras_proveedor_factura_A',
        'ordenes_compras_proveedor_forma_de_pago',
        'ordenes_compras_descuentos_bonificaciones',
        'ordenes_compras_monto_flete',
        'ordenes_compras_monto_total_PP',
        'ordenes_compras_monto_total_homogeneo',
        'ordenes_compras_presupuestacion_proveedor_id',
        'ordenes_compras_presupuestacion_proveedor_rubro_id',
        'ordenes_compras_monto_total',
        'ordenes_compras_estado',
    ];

    // funciones publicas
    public function obtenerObjDatos():array{
        return [
            'ordenes_compras_id' => $this->ordenes_compras_id,
            'ordenes_compras_proveedor_id' => $this->ordenes_compras_proveedor_id,
            'ordenes_compras_presupuestacion_id' => $this->ordenes_compras_presupuestacion_id,
            'ordenes_compras_presupuestacion_plan_id' => $this->ordenes_compras_presupuestacion_plan_id,
            'ordenes_compras_proveedor_nombre' => $this->ordenes_compras_proveedor_nombre,
            'ordenes_compras_proveedor_mail' => $this->ordenes_compras_proveedor_mail,
            'ordenes_compras_proveedor_factura_A' => $this->ordenes_compras_proveedor_factura_A,
            'ordenes_compras_proveedor_forma_de_pago' => $this->ordenes_compras_proveedor_forma_de_pago,
            'ordenes_compras_descuentos_bonificaciones' => $this->ordenes_compras_descuentos_bonificaciones,
            'ordenes_compras_monto_flete' => $this->ordenes_compras_monto_flete,
            'ordenes_compras_monto_total_PP' => $this->ordenes_compras_monto_total_PP,
            'ordenes_compras_monto_total_homogeneo' => $this->ordenes_compras_monto_total_homogeneo,
            'ordenes_compras_presupuestacion_proveedor_id' => $this->ordenes_compras_presupuestacion_proveedor_id,
            'ordenes_compras_presupuestacion_proveedor_rubro_id' => $this->ordenes_compras_presupuestacion_proveedor_rubro_id,
            'ordenes_compras_monto_total' => $this->ordenes_compras_monto_total,
            'ordenes_compras_estado' => $this->ordenes_compras_estado,
        ];
    }
}
