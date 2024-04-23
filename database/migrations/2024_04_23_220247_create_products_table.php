<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_categoria_producto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('descripcion');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique();
            $table->string("codigoBarras", 50)->unique();
            $table->decimal('precio_compra', 10,2);
            $table->decimal('precio_venta', 10,2);
            $table->integer('stock_disponible');
            $table->foreignId('id_categoria_producto')->constrained('tb_categoria_producto');
            $table->foreignId('id_estado')->constrained('tb_estado');
            $table->timestamps();
        });

        DB::table('tb_categoria_producto')->insert([
            ['nombre' => 'Enlatados', 'descripcion' => 'Productos enlatados como conservas de frutas, verduras, pescados y otros.'],
            ['nombre' => 'Frutas', 'descripcion' => 'Productos frescos como manzanas, bananas, y naranjas.'],
            ['nombre' => 'Bebidas', 'descripcion' => 'Incluye agua embotellada, jugos, refrescos y bebidas energéticas.'],
            ['nombre' => 'Snacks y golosinas', 'descripcion' => 'Productos como papas fritas, galletas, caramelos y chocolates.'],
            ['nombre' => 'Productos de limpieza', 'descripcion' => 'Incluye detergentes, desinfectantes, y productos para la limpieza del hogar.'],
            ['nombre' => 'Lácteos', 'descripcion' => 'Productos lácteos como leche, yogur, queso y mantequilla.'],
            ['nombre' => 'Verduras', 'descripcion' => 'Productos frescos como zanahorias, lechuga, y tomates.'],
            ['nombre' => 'Cervezas', 'descripcion' => 'Productos relacionados con la fabricación y venta de cervezas, tanto artesanales como comerciales.'],
            ['nombre' => 'Cuidado personal', 'descripcion' => 'Productos como jabón, champú, pasta de dientes y papel higiénico.'],
            ['nombre' => 'Helados', 'descripcion' => 'Productos relacionados con la fabricación y venta de helados, incluyendo diferentes sabores y presentaciones.'],
            ['nombre' => 'Panadería', 'descripcion' => 'Productos horneados como pan blanco, pan integral y pastelería.'],
            ['nombre' => 'Carnes y pescados', 'descripcion' => 'Incluye carne de res, pollo, pescado fresco y mariscos.'],
            
        ]);

        // Inserciones para tb_producto
        DB::table('products')->insert([
            ['nombre' => 'Atún enlatado', 'precio_compra' => 3.1, 'precio_venta' => 3.99, 'stock_disponible' => 50, 'codigoBarras' => '0123456789099', 'id_categoria_producto' => 1, 'id_estado' => 1],
            ['nombre' => 'Sopa de fideos enlatada', 'precio_compra' => 0.8, 'precio_venta' => 1.75, 'stock_disponible' => 80, 'codigoBarras' => '1234567890188', 'id_categoria_producto' => 1, 'id_estado' => 1],
            ['nombre' => 'Maíz enlatado', 'precio_compra' => 0.95, 'precio_venta' => 1.49, 'stock_disponible' => 60, 'codigoBarras' => '2345678901277', 'id_categoria_producto' => 1, 'id_estado' => 1],
            ['nombre' => 'Manzanas', 'precio_compra' => 1.98, 'precio_venta' => 2.99, 'stock_disponible' => 50, 'codigoBarras' => '1234567890166', 'id_categoria_producto' => 2, 'id_estado' => 1],
            ['nombre' => 'Plátanos', 'precio_compra' => 0.97, 'precio_venta' => 1.75, 'stock_disponible' => 80, 'codigoBarras' => '2345678901255', 'id_categoria_producto' => 2, 'id_estado' => 1],
            ['nombre' => 'Naranjas', 'precio_compra' => 0.85, 'precio_venta' => 1.49, 'stock_disponible' => 60, 'codigoBarras' => '3456789012344', 'id_categoria_producto' => 2, 'id_estado' => 1],
            ['nombre' => 'Coca-Cola', 'precio_compra' => 1.2, 'precio_venta' => 1.99, 'stock_disponible' => 100, 'codigoBarras' => '1234567890133', 'id_categoria_producto' => 3, 'id_estado' => 1],
            ['nombre' => 'Pepsi', 'precio_compra' => 0.94, 'precio_venta' => 1.75, 'stock_disponible' => 120, 'codigoBarras' => '2345678901222', 'id_categoria_producto' => 3, 'id_estado' => 1],
            ['nombre' => 'Sprite', 'precio_compra' => 0.80, 'precio_venta' => 1.49, 'stock_disponible' => 80, 'codigoBarras' => '3456789012311', 'id_categoria_producto' => 3, 'id_estado' => 1],
            ['nombre' => 'Papas Fritas', 'precio_compra' => 0.96, 'precio_venta' => 1.99, 'stock_disponible' => 100, 'codigoBarras' => '1234567890197', 'id_categoria_producto' => 4, 'id_estado' => 1],
            ['nombre' => 'Galletas', 'precio_compra' => 0.95, 'precio_venta' => 1.75, 'stock_disponible' => 120, 'codigoBarras' => '2345678901264', 'id_categoria_producto' => 4, 'id_estado' => 1],
            ['nombre' => 'Chocolate', 'precio_compra' => 0.60, 'precio_venta' => 1.49, 'stock_disponible' => 80, 'codigoBarras' => '3456789012331', 'id_categoria_producto' => 4, 'id_estado' => 1],
            ['nombre' => 'Detergente líquido', 'precio_compra' => 1.63, 'precio_venta' => 3.99, 'stock_disponible' => 50, 'codigoBarras' => '1994567890123', 'id_categoria_producto' => 5, 'id_estado' => 1],
            ['nombre' => 'Lejía', 'precio_compra' => 1.62, 'precio_venta' => 2.75, 'stock_disponible' => 80, 'codigoBarras' => '2345678901234', 'id_categoria_producto' => 5, 'id_estado' => 1],
            ['nombre' => 'Limpiador multiusos', 'precio_compra' => 0.95, 'precio_venta' => 1.99, 'stock_disponible' => 60, 'codigoBarras' => '3886789012345', 'id_categoria_producto' => 5, 'id_estado' => 1],
            ['nombre' => 'Mantequilla', 'precio_compra' => 1.84, 'precio_venta' => 2.25, 'stock_disponible' => 90, 'codigoBarras' => '4777890123456', 'id_categoria_producto' => 6, 'id_estado' => 1],
            ['nombre' => 'Yogur natural', 'precio_compra' => 0.96, 'precio_venta' => 1.75, 'stock_disponible' => 80, 'codigoBarras' => '2665678901234', 'id_categoria_producto' => 6, 'id_estado' => 1],
            ['nombre' => 'Queso fresco', 'precio_compra' => 1.67, 'precio_venta' => 3.99, 'stock_disponible' => 60, 'codigoBarras' => '3556789012345', 'id_categoria_producto' => 6, 'id_estado' => 1],
            ['nombre' => 'Zanahorias', 'precio_compra' => 0.45, 'precio_venta' => 0.99, 'stock_disponible' => 80, 'codigoBarras' => '8441234567890', 'id_categoria_producto' => 7, 'id_estado' => 1],
            ['nombre' => 'Tomates', 'precio_compra' => 1.1, 'precio_venta' => 1.49, 'stock_disponible' => 50, 'codigoBarras' => '7833123456789', 'id_categoria_producto' => 7, 'id_estado' => 1],
            ['nombre' => 'Espinacas', 'precio_compra' => 0.96, 'precio_venta' => 1.25, 'stock_disponible' => 70, 'codigoBarras' => '9022345678901', 'id_categoria_producto' => 7, 'id_estado' => 1],
            ['nombre' => 'Pilsen', 'precio_compra' => 1.21, 'precio_venta' => 2.99, 'stock_disponible' => 100, 'codigoBarras' => '1114567890123', 'id_categoria_producto' => 8, 'id_estado' => 1],
            ['nombre' => 'Cristal', 'precio_compra' => 1.94, 'precio_venta' => 3.25, 'stock_disponible' => 120, 'codigoBarras' => '2005678901234', 'id_categoria_producto' => 8, 'id_estado' => 1],
            ['nombre' => 'Cusqueña', 'precio_compra' => 1.84, 'precio_venta' => 3.49, 'stock_disponible' => 80, 'codigoBarras' => '3456798012345', 'id_categoria_producto' => 8, 'id_estado' => 1],
            ['nombre' => 'Champú', 'precio_compra' => 2.61, 'precio_venta' => 4.99, 'stock_disponible' => 50, 'codigoBarras' => '1234561290123', 'id_categoria_producto' => 9, 'id_estado' => 1],
            ['nombre' => 'Jabón de baño', 'precio_compra' => 1.6, 'precio_venta' => 1.75, 'stock_disponible' => 80, 'codigoBarras' => '2345673901234', 'id_categoria_producto' => 9, 'id_estado' => 1],
            ['nombre' => 'Crema hidratante', 'precio_compra' => 2.63, 'precio_venta' => 3.49, 'stock_disponible' => 60, 'codigoBarras' => '3456749012345', 'id_categoria_producto' => 9, 'id_estado' => 1],
            ['nombre' => 'Helado de vainilla', 'precio_compra' => 1.95, 'precio_venta' => 2.99, 'stock_disponible' => 70, 'codigoBarras' => '4567870123456', 'id_categoria_producto' => 10, 'id_estado' => 1],
            ['nombre' => 'Helado de chocolate', 'precio_compra' => 2.1, 'precio_venta' => 3.25, 'stock_disponible' => 80, 'codigoBarras' => '5678081234567', 'id_categoria_producto' => 10, 'id_estado' => 1],
            ['nombre' => 'Helado de fresa', 'precio_compra' => 1.94, 'precio_venta' => 3.49, 'stock_disponible' => 90, 'codigoBarras' => '6789010645678', 'id_categoria_producto' => 10, 'id_estado' => 1],
            ['nombre' => 'Pan de molde', 'precio_compra' => 0.98, 'precio_venta' => 1.99, 'stock_disponible' => 50, 'codigoBarras' => '1234505890123', 'id_categoria_producto' => 11, 'id_estado' => 1],
            ['nombre' => 'Croissants', 'precio_compra' => 0.57, 'precio_venta' => 1.25, 'stock_disponible' => 60, 'codigoBarras' => '2345678041234', 'id_categoria_producto' => 11, 'id_estado' => 1],
            ['nombre' => 'Baguettes', 'precio_compra' => 1.21, 'precio_venta' => 2.49, 'stock_disponible' => 40, 'codigoBarras' => '3456780312345', 'id_categoria_producto' => 11, 'id_estado' => 1],
            ['nombre' => 'Filete de pollo', 'precio_compra' => 3.58, 'precio_venta' => 5.99, 'stock_disponible' => 70, 'codigoBarras' => '4567894023456', 'id_categoria_producto' => 12, 'id_estado' => 1],
            ['nombre' => 'Filete de salmón', 'precio_compra' => 7.12, 'precio_venta' => 8.25, 'stock_disponible' => 80, 'codigoBarras' => '5678900034567', 'id_categoria_producto' => 12, 'id_estado' => 1],
            ['nombre' => 'Lomo de cerdo', 'precio_compra' => 5.12, 'precio_venta' => 6.49, 'stock_disponible' => 90, 'codigoBarras' => '6789011745678', 'id_categoria_producto' => 12, 'id_estado' => 1],
        ]);

    }

    public function down(): void
    {
        Schema::dropIfExists('tb_producto');
        Schema::dropIfExists('tb_categoria_producto');
    }
};
