<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'barcode', 'purchase_price', 'sale_price', 'stock', 'category_id', 'state_id'];
    protected $table = 'products';

    public function categoria()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_id');
    }

    public function estado()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}
