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
        ];
    }
}
