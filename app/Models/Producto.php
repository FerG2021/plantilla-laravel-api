<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'producto_id';


    protected $fillable = [
        'producto_id',
        'producto_codigo',
        'producto_nombre',
        'producto_puc',
        'producto_fpuc',
        'producto_unidad',
        'producto_activo',
        'rubro_id',
    ];

    // funciones publicas
    public function obtenerObjDatos():array{
        return [
            'producto_id' => $this->producto_id,
            'producto_codigo' => $this->producto_codigo,
            'producto_nombre' => $this->producto_nombre,
            'producto_puc' => $this->producto_puc,
            'producto_fpuc' => $this->producto_fpuc,
            'producto_unidad' => $this->producto_unidad,
            'producto_activo' => $this->producto_activo,
            'rubro_id' => $this->rubro_id
        ];
    }

}
