<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deposito extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'deposito_id';

    protected $fillable = [
        'deposito_id',
        'deposito_codigo',
        'deposito_nombre',
        'deposito_direccion'        
    ];

    // funciones publicas
    public function obtenerObjDatos():array{
        return [
            'deposito_id' => $this->deposito_id,
            'deposito_codigo' => $this->deposito_codigo,
            'deposito_nombre' => $this->deposito_nombre,
            'deposito_direccion' => $this->deposito_direccion,
        ];
    }
}
