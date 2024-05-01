<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'ruc', 'descripcion', 'telefono', 'correo', 'direccion', 'estado_id'];
    protected $table = 'tb_proveedor';

    public function estado()
    {
        return $this->belongsTo(State::class, 'estado_id');
    }
}
