<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Articulo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];


    protected $fillable = [
        'descripcion', 
        'precio', 
        'stock'
    ];


    // funciones publicas
    public function obtenerObjDatos():array{
        return [
            'id' => $this->id,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'stock' => $this->stock,
            'idCategoria' => $this->idCategoria,
            'idUnidadMedida' => $this->idUnidadMedida,
        ];
    }
}
