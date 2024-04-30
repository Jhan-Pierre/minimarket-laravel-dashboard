<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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

        DB::table('tb_proveedor')->insert([
            ['name' => 'Distribuidora Alfa Enlatados', 'ruc' => '22345678901', 'descripcion' => 'Proveedor de alimentos enlatados', 'telefono' => '987954329', 'correo' => 'info@alfa.com', 'direccion' => 'Calle Principal #123', 'estado_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Distribuidora frut S.A.', 'ruc' => '28768432101', 'descripcion' => 'Proveedor de frutas', 'telefono' => '954321987', 'correo' => 'ventas@productosfrescos.com', 'direccion' => 'Avenida Central #456', 'estado_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bebidas Refrescantes Ltda.', 'ruc' => '26789052301', 'descripcion' => 'Proveedor de bebidas gaseosas y aguas embotelladas', 'telefono' => '921654981', 'correo' => 'pedidos@bebidasrefrescantes.com', 'direccion' => 'Calle Secundaria #789', 'estado_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'PepsiCO S.A.', 'ruc' => '20987654721', 'descripcion' => 'Proveedor de golosinas, chocolates y snacks', 'telefono' => '989012345', 'correo' => 'contacto@dulcesygolosinas.com', 'direccion' => 'Avenida Sur #234', 'estado_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Distribuidora FyN Limpieza', 'ruc' => '23456719012', 'descripcion' => 'Proveedor de productos de limpieza, detergentes y desinfectantes', 'telefono' => '919344678', 'correo' => 'ventas@articulosdelimpieza.com', 'direccion' => 'Calle Norte #567', 'estado_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lácteos Deliciosos S.A.', 'ruc' => '28765472109', 'descripcion' => 'Proveedor de productos lácteos frescos y saludables', 'telefono' => '987654321', 'correo' => 'ventas@lacteosdeliciosos.com', 'direccion' => 'Avenida Norte #456', 'estado_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Verduras Orgánicas Ltda.', 'ruc' => '21934667890', 'descripcion' => 'Proveedor de verduras frescas y orgánicas', 'telefono' => '912395698', 'correo' => 'ventas@verdurasorganicas.com', 'direccion' => 'Calle Verde #789', 'estado_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cervecería Backus S.A.', 'ruc' => '21294567810', 'descripcion' => 'Proveedor de cervezas de alta calidad y variedad', 'telefono' => '992345678', 'correo' => 'contacto@cervezabackus.com', 'direccion' => 'Avenida Cervecera #123', 'estado_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Productos de Higiene Personal S.A.', 'ruc' => '22375688971', 'descripcion' => 'Proveedor de productos de higiene personal, como jabones, champús y cremas', 'telefono' => '123456789', 'correo' => 'ventas@higienepersonal.com', 'direccion' => 'Calle Higiene #456', 'estado_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Heladería Donofrio S.A.', 'ruc' => '22347618901', 'descripcion' => 'Proveedor de helados artesanales y postres helados', 'telefono' => '991476189', 'correo' => 'ventas@heladeriadelicias.com', 'direccion' => 'Calle Principal #990', 'estado_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Panadería PanDuro S.A.', 'ruc' => '22345078501', 'descripcion' => 'Proveedor de productos de panadería frescos y variados', 'telefono' => '983416719', 'correo' => 'ventas@panaderiapanDulce.com', 'direccion' => 'Calle del Pan #789', 'estado_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Carnes y Pescados Frescos S.A.', 'ruc' => '28795032009', 'descripcion' => 'Proveedor de carnes y pescados frescos y de calidad', 'telefono' => '987154821', 'correo' => 'ventas@carnespescadosfrescos.com', 'direccion' => 'Avenida del Mar #789', 'estado_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);

    }

    public function down(): void
    {
        Schema::dropIfExists('tb_proveedor');
    }
};
