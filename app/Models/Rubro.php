<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Rubro extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = [
        'rubro_id',
        'rubro_nombre',        
    ];

    // funciones publicas
    public function obtenerObjDatos():array{
        return [
            'rubro_id' => $this->rubro_id,
            'rubro_nombre' => $this->rubro_nombre,
        ];
    }


    public function proveedores(){
        return $this->belongsToMany(Proveedor::class, 'proveedor_rubro');
    }
}
