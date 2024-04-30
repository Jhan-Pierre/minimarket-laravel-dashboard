<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('tb_detalle_venta', function (Blueprint $table) {
            $table->id();
            $table->decimal('precio_unitario', 10,2);
            $table->decimal('cantidad', 10,2);
            $table->decimal('subtotal', 10,2);
            $table->timestamps();
            $table->foreignId('users_id')->constrained('users');
            $table->foreignId('products_id')->constrained('products');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_detalle_venta');
    }
};
