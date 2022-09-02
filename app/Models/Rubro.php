<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rubro extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $primaryKey = 'rubro_id';

    protected $fillable = [
        'rubro_id',
        'rubro_nombre', 
        'rubro_codigo',        
    ];

    // funciones publicas
    public function obtenerObjDatos():array{
        return [
            'rubro_id' => $this->rubro_id,
            'rubro_nombre' => $this->rubro_nombre,
            'rubro_codigo' => $this->rubro_codigo,
        ];
    }


    public function proveedores(){
        return $this->belongsToMany(Proveedor::class, 'proveedor_rubro');
    }
}
