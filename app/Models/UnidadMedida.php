<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UnidadMedida extends Model
{
    use HasFactory;
    use SoftDeletes;

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
