<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VistaPrevision extends Model
{
    use HasFactory;

    protected $primaryKey = 'prevision_id';

    protected $fillable = [
        'prevision_id',
        'plan_id',
        'producto_id',
        'prevision_periodo',
        'producto_nombre',
        'producto_codigo',
        'producto_puc',
        'producto_fpuc',
        'producto_unidad',
        'prevision_unidad',
        'prevision_cantidad',
        'rubro_nombre',
    ];

     // funciones publicas
     public function obtenerObjDatos():array{
        return [
            'prevision_id' => $this->prevision_id,
            'plan_id' => $this->plan_id,
            'producto_id' => $this->producto_id,
            'prevision_periodo' => $this->prevision_periodo,
            'producto_nombre' => $this->producto_nombre,
            'producto_codigo' => $this->producto_codigo,
            'producto_puc' => $this->producto_puc,
            'producto_fpuc' => $this->producto_fpuc,
            'producto_unidad' => $this->producto_unidad,
            'prevision_unidad' => $this->prevision_unidad,
            'prevision_cantidad' => $this->prevision_cantidad,
            'rubro_nombre' => $this->rubro_nombre,
        ];
    }

}
