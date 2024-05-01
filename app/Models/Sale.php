<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['impuesto', 'total', 'tipo_comprobante_id', 'metodo_pago_id', 'users_id'];
    protected $table = 'tb_venta';

    public function tipocomprobante(){
        return $this->belongsTo(VoucherType::class, 'tipo_comprobante_id'); 
        
    }

    public function metodoPago(){
        return $this->belongsTo(PaymentMethod::class, 'metodo_pago_id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'users_id');
    }

    protected static function booted()
    {
        static::deleting(function ($sale) {
            // Antes de eliminar la venta, elimina todos los detalles de venta asociados
            $sale->detalleVenta()->delete();
        });
    }

    // Relación con DetalleVenta
    public function detalleVenta()
    {
        return $this->hasMany(SaleDetail::class, 'sale_id');
    }
}
