<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    protected $table = 'tb_detalle_venta';

    public function producto()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
}
