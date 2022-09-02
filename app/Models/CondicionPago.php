<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CondicionPago extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'condicionpago_id';

    protected $fillable = [
        'condicionpago_auto',
        'condicionpago_id',
        'condicionpago_codigo',
        'condicionpago_nombre',
        'condicionpago_activo',
    ];

    // funciones publicas
    public function obtenerObjDatos():array{
        return [
            'condicionpago_auto' => $this->condicionpago_auto,
            'condicionpago_id' => $this->condicionpago_id,
            'condicionpago_codigo' => $this->condicionpago_codigo,
            'condicionpago_nombre' => $this->condicionpago_nombre,
            'condicionpago_activo' => $this->condicionpago_activo,
        ];
    }
}
