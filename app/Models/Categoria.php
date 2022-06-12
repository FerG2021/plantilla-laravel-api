<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;


class Categoria extends Model
{
    use HasFactory;
    use softDeletes;


    protected $fillable = [
        'nombre'        
    ];

    // funciones publicas
    public function obtenerObjDatos():array{
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
        ];
    }
}
