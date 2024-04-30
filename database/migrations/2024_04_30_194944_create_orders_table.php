<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_pedido', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->decimal('costoTotal', 10,2);
            $table->foreignId('id_usuario')->constrained('users');
            $table->foreignId('id_proveedor')->constrained('tb_proveedor');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_pedido');
    }
};
