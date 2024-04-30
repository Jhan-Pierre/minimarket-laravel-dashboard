<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('tb_tipo_comprobante', function (Blueprint $table) {
            $table->id();
            $table->string('comprobante', 50)->unique();
            $table->timestamps();
        });

        DB::table('tb_tipo_comprobante')->insert([
            ['comprobante' => 'factura'],
            ['comprobante' => 'boleta'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_tipo_comprobante');
    }
};
