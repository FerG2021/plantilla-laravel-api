<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorradorComparativaProveedores extends Model
{
    use HasFactory;

    protected $primaryKey = 'borrador_comparativa_proveedores_id';

    protected $fillable = [
        'borrador_comparativa_proveedores_id',
        'borrador_comparativa_id',
        'presupuestacion_id',
        'presupuestacion_plan_id',
        'proveedor_id',
        'proveedor_nombre',
        'proveedor_rubro_id',
        'proveedor_mail',
        'proveedor_monto_totalPP',
        'proveedor_monto_flete',
        'proveedor_factura_A',
        'proveedor_monto_factura_A',
        'proveedor_forma_de_pago',
        'proveedor_monto_descuentos_bonificaciones',
        'proveedor_monto_total_homogeneo',
    ];
}
