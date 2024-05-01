<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryBasket extends Model
{
    use HasFactory;

    protected $fillable = ['precio_unitario', 'cantidad', 'subtotal', 'product_id', 'user_id'];
    protected $table = 'tb_cesta_temporal';

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
