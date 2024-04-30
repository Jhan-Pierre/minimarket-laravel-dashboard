<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->foreignId('products_id')->constrained('products');
            $table->foreignId('sale_id')->constrained('tb_venta');
        });

        DB::table('tb_detalle_venta')->insert([
            [
                'precio_unitario' => 2.99,
                'subtotal' => 11.96,
                'cantidad' => 4,
                'products_id' => 4,
                'sale_id' => 1,
            ],
            [
                'precio_unitario' => 1.75,
                'subtotal' => 1.75,
                'cantidad' => 1,
                'products_id' => 11,
                'sale_id' => 1,
            ],
            [
                'precio_unitario' => 1.75,
                'subtotal' => 5.25,
                'cantidad' => 3,
                'products_id' => 8,
                'sale_id' => 2,
            ],
            [
                'precio_unitario' => 1.75,
                'subtotal' => 3.5,
                'cantidad' => 2,
                'products_id' => 10,
                'sale_id' => 2,
            ],
            [
                'precio_unitario' => 1.49,
                'subtotal' => 1.49,
                'cantidad' => 1,
                'products_id' => 12,
                'sale_id' => 2,
            ],
        ]);
        
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_detalle_venta');
    }
};
