<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_producto_proveedor', function (Blueprint $table) {
            $table->foreignId('producto_id')->constrained('products');
            $table->foreignId('proveedor_id')->constrained('tb_proveedor');
            $table->primary(['producto_id', 'proveedor_id']); // Clave primaria compuesta
        });
        

        DB::table('tb_producto_proveedor')->insert([
            ['producto_id' => 1, 'proveedor_id' => 1],
            ['producto_id' => 2, 'proveedor_id' => 2],
            ['producto_id' => 5, 'proveedor_id' => 1],
            ['producto_id' => 1, 'proveedor_id' => 2],
        ]);
    }
    public function down(): void
    {
        Schema::dropIfExists('tb_producto_proveedor');
    }
};
