<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('tb_proveedor', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80)->unique();
            $table->char('ruc', 11)->unique();
            $table->string('descripcion', 250);
            $table->char('telefono', 9)->unique();
            $table->string('correo', 60)->unique();
            $table->string('direccion', 100)->unique();
            $table->foreignId('estado_id')->constrained('tb_estado');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_proveedor');
    }
};
