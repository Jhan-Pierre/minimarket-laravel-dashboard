<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_categoria_producto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->timestamps();
        });

        DB::table('tb_categoria_producto')->insert([
            ['nombre' => 'Enlatados'],
            ['nombre' => 'Frutas'],
            ['nombre' => 'Bebidas'],
            ['nombre' => 'Snacks y golosinas'],
            ['nombre' => 'Productos de limpieza'],
            ['nombre' => 'Lácteos'],
            ['nombre' => 'Verduras'],
            ['nombre' => 'Cervezas'],
            ['nombre' => 'Cuidado personal'],
            ['nombre' => 'Helados'],
            ['nombre' => 'Panadería'],
            ['nombre' => 'Carnes y pescados'],
            
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_products');
    }
};
