<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_venta', function (Blueprint $table) {
            $table->id();
            $table->decimal('impuesto', 10,2);
            $table->decimal('total', 10,2);
            $table->timestamps();
            $table->foreignId('tipo_comprobante_id')->constrained('tb_tipo_comprobante');
            $table->foreignId('metodo_pago_id')->constrained('tb_metodo_pago');
            $table->foreignId('users_id')->constrained('users');
        });

        DB::table('tb_venta')->insert([
            [
                'impuesto' => 1.50,
                'total' => 18.99,
                'created_at' => now(),
                'updated_at' => now(),
                'tipo_comprobante_id' => 1,
                'metodo_pago_id' => 2,
                'users_id' => 2, 
            ],
            [
                'impuesto' => 2.20,
                'total' => 10.24,
                'created_at' => now(),
                'updated_at' => now(),
                'tipo_comprobante_id' => 1,
                'metodo_pago_id' => 3,
                'users_id' => 1,
            ],
        ]);
        
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_venta');
    }
};
