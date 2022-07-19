<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresupuestacionProveedores extends Model
{
    use HasFactory;

    protected $primaryKey = 'presupuestacion_proveedor_id';

    protected $fillable = [
        'presupuestacion_proveedor_id',
        'presupuestacion_id',
        'presupuestacion_plan_id',
        'proveedor_id',
        'proveedor_nombre',
        'proveedor_rubro_id',
        'proveedor_mail', 
        'proveedor_monto_totalPP',
        'proveedor_monto_flete',
        'proveedor_factura_A',
        'proveedor_forma_de_pago',
        'proveedor_monto_descuentos_bonificaciones',
        'proveedor_monto_total_homogeneo',
    ];

    // funciones publicas
    public function obtenerObjDatos():array{
        return [
            'presupuestacion_proveedor_id' => $this->presupuestacion_proveedor_id,
            'presupuestacion_id' => $this->presupuestacion_id,
            'presupuestacion_plan_id' => $this->presupuestacion_plan_id,
            'proveedor_id' => $this->proveedor_id,
            'proveedor_nombre' => $this->proveedor_nombre,
            'proveedor_rubro_id' => $this->proveedor_rubro_id,
            'proveedor_mail' => $this->proveedor_mail, 
            'proveedor_monto_totalPP' => $this->proveedor_monto_totalPP,
            'proveedor_monto_flete' => $this->proveedor_monto_flete,
            'proveedor_factura_A' => $this->proveedor_factura_A,
            'proveedor_forma_de_pago' => $this->proveedor_forma_de_pago,
            'proveedor_monto_descuentos_bonificaciones' => $this->proveedor_monto_descuentos_bonificaciones,
            'proveedor_monto_total_homogeneo'  => $this->proveedor_monto_total_homogeneo,
        ];
    }
}
