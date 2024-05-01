<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherType extends Model
{
    use HasFactory;
    protected $fillable = ['comprobante'];
    protected $table = 'tb_tipo_comprobante';
}
