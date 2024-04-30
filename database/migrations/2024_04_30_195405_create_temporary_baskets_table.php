<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('tb_cesta_temporal', function (Blueprint $table) {
            $table->id();
            $table->decimal('precio_unitario', 10,2);
            $table->integer('cantidad');
            $table->decimal('subtotal', 10,2);
            $table->timestamps();
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('user_id')->constrained('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_cesta_temporal');
    }
};
