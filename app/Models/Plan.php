<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Plan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'plan_id';

    protected $fillable = [
        'plan_id',
        'plan_activo',
        'plan_nombre',
        'plan_fdesde',
        'plan_fhasta',
        'plan_plazo',
        'cliente_id',
        'deposito_id',
        'transaccion_id'
    ];

    // funciones publicas
    public function obtenerObjDatos():array{
        return [
            'plan_id' => $this->plan_id,
            'plan_activo' => $this->plan_activo,
            'plan_nombre' => $this->plan_nombre,
            'plan_fdesde' => $this->plan_fdesde,
            'plan_fhasta' => $this->plan_fhasta,
            'plan_plazo' => $this->plan_plazo,
            'cliente_id' => $this->cliente_id,
            'deposito_id' => $this->deposito_id,
            'transaccion_id' => $this->transaccion_id
        ];
    }
}
