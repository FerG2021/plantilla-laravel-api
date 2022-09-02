<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Proveedor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'proveedor_id';



    protected $fillable = [
        'proveedor_id',
        'proveedor_codigo',
        'proveedor_nombre',
        'proveedor_razonsocial',
        'proveedor_cuit',
        'proveedor_email',
        'proveedor_activo'
    ];

    // funciones publicas
    public function obtenerObjDatos():array{
        return [
            'proveedor_id' => $this->proveedor_id,
            'proveedor_nombre' => $this->proveedor_nombre,
            'proveedor_codigo' => $this->proveedor_codigo,
            'proveedor_razonsocial' => $this->proveedor_razonsocial,
            'proveedor_cuit' => $this->proveedor_cuit,
            'proveedor_email' => $this->proveedor_email,
            'proveedor_activo' => $this->proveedor_activo,
        ];
    }

    public function rubros(){
        return $this->belongsToMany(Rubro::class, 'proveedor_rubro');
    }
}
