<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_metodo_pago', function (Blueprint $table) {
            $table->id();
            $table->string('metodo_pago', 50);
            $table->timestamps();
        });

        DB::table('tb_metodo_pago')->insert([
            ['metodo_pago' => 'efectivo'],
            ['metodo_pago' => 'tarjeta credito'],
            ['metodo_pago' => 'tarjeta debito'],
            ['metodo_pago' => 'yape'],
        ]);
        
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_metodo_pago');
    }
};
