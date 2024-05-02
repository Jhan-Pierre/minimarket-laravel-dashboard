<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    //protected $fillable = ['precio_unitario', 'cantidad', 'cantidad', 'products_id', 'products_id'];
    protected $table = 'tb_detalle_venta';
}
