<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_estado', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 30)->unique();
        });

         // Insert statements
         DB::table('tb_estado')->insert([
            ['nombre' => 'Activo'],
            ['nombre' => 'Suspendido'],
            ['nombre' => 'Eliminado'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_estado');
    }
};
