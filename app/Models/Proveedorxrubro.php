<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Proveedorxrubro extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'proveedorxrubro_auto';

    protected $fillable = [
        'proveedor_id',
        'rubro_id'
    ];
}
