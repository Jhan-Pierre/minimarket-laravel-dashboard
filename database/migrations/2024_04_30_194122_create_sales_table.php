<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_venta', function (Blueprint $table) {
            $table->id();
            $table->decimal('impuesto', 10,2);
            $table->decimal('total', 10,2);
            $table->timestamps();
            $table->foreignId('categoria_producto_id')->constrained('tb_tipo_comprobante');
            $table->foreignId('metodo_pago_id')->constrained('tb_metodo_pago');
            $table->foreignId('users_id')->constrained('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_venta');
    }
};
