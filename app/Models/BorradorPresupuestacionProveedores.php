<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BorradorPresupuestacionProveedores extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $primaryKey = 'borrador_presupuestacion_proveedor_id';

    protected $fillable = [
        'borrador_presupuestacion_proveedor_id',
        'borrador_presupuestacion_id',
        'borrador_presupuestacion_plan_id',
        'borrador_proveedor_id',
        'borrador_proveedor_nombre',
        'borrador_proveedor_rubro_id',
        'borrador_proveedor_mail', 
        'borrador_proveedor_monto_totalPP',
        'borrador_proveedor_monto_flete',
        'borrador_proveedor_factura_A',
        'borrador_proveedor_forma_de_pago',
        'borrador_proveedor_monto_descuentos_bonificaciones',
        'borrador_proveedor_monto_total_homogeneo',
    ];

    // funciones publicas
    public function obtenerObjDatos():array{
        return [
            'borrador_presupuestacion_proveedor_id' => $this->borrador_presupuestacion_proveedor_id,
            'borrador_presupuestacion_id' => $this->borrador_presupuestacion_id,
            'borrador_presupuestacion_plan_id' => $this->borrador_presupuestacion_plan_id,
            'borrador_proveedor_id' => $this->borrador_proveedor_id,
            'borrador_proveedor_nombre' => $this->borrador_proveedor_nombre,
            'borrador_proveedor_rubro_id' => $this->borrador_proveedor_rubro_id,
            'borrador_proveedor_mail' => $this->borrador_proveedor_mail, 
            'borrador_proveedor_monto_totalPP' => $this->borrador_proveedor_monto_totalPP,
            'borrador_proveedor_monto_flete' => $this->borrador_proveedor_monto_flete,
            'borrador_proveedor_factura_A' => $this->borrador_proveedor_factura_A,
            'borrador_proveedor_forma_de_pago' => $this->borrador_proveedor_forma_de_pago,
            'borrador_proveedor_monto_descuentos_bonificaciones' => $this->borrador_proveedor_monto_descuentos_bonificaciones,
            'borrador_proveedor_monto_total_homogeneo'  => $this->borrador_proveedor_monto_total_homogeneo,
        ];
    }
}
