<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'codigoBarras', 'precio_compra', 'precio_venta', 'stock_disponible', 'id_categoria_producto', 'id_estado'];

}
