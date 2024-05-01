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
}
