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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string("barcode", 50)->unique();
            $table->decimal('purchase_price', 10,2);
            $table->decimal('sale_price', 10,2);
            $table->integer('stock');
            $table->foreignId('category_id')->constrained('tb_categoria_producto');
            $table->foreignId('state_id')->constrained('tb_estado');
            $table->timestamps();
        });

        // Inserciones para tb_producto
        DB::table('products')->insert([
            ['name' => 'Atún enlatado', 'purchase_price' => 3.1, 'sale_price' => 3.99, 'stock' => 50, 'barcode' => '0123456789099', 'category_id' => 1, 'state_id' => 1],
            ['name' => 'Sopa de fideos enlatada', 'purchase_price' => 0.8, 'sale_price' => 1.75, 'stock' => 80, 'barcode' => '1234567890188', 'category_id' => 1, 'state_id' => 1],
            ['name' => 'Maíz enlatado', 'purchase_price' => 0.95, 'sale_price' => 1.49, 'stock' => 60, 'barcode' => '2345678901277', 'category_id' => 1, 'state_id' => 1],
            ['name' => 'Manzanas', 'purchase_price' => 1.98, 'sale_price' => 2.99, 'stock' => 50, 'barcode' => '1234567890166', 'category_id' => 2, 'state_id' => 1],
            ['name' => 'Plátanos', 'purchase_price' => 0.97, 'sale_price' => 1.75, 'stock' => 80, 'barcode' => '2345678901255', 'category_id' => 2, 'state_id' => 1],
            ['name' => 'Naranjas', 'purchase_price' => 0.85, 'sale_price' => 1.49, 'stock' => 60, 'barcode' => '3456789012344', 'category_id' => 2, 'state_id' => 1],
            ['name' => 'Coca-Cola', 'purchase_price' => 1.2, 'sale_price' => 1.99, 'stock' => 100, 'barcode' => '1234567890133', 'category_id' => 3, 'state_id' => 1],
            ['name' => 'Pepsi', 'purchase_price' => 0.94, 'sale_price' => 1.75, 'stock' => 120, 'barcode' => '2345678901222', 'category_id' => 3, 'state_id' => 1],
            ['name' => 'Sprite', 'purchase_price' => 0.80, 'sale_price' => 1.49, 'stock' => 80, 'barcode' => '3456789012311', 'category_id' => 3, 'state_id' => 1],
            ['name' => 'Papas Fritas', 'purchase_price' => 0.96, 'sale_price' => 1.99, 'stock' => 100, 'barcode' => '1234567890197', 'category_id' => 4, 'state_id' => 1],
            ['name' => 'Galletas', 'purchase_price' => 0.95, 'sale_price' => 1.75, 'stock' => 120, 'barcode' => '2345678901264', 'category_id' => 4, 'state_id' => 1],
            ['name' => 'Chocolate', 'purchase_price' => 0.60, 'sale_price' => 1.49, 'stock' => 80, 'barcode' => '3456789012331', 'category_id' => 4, 'state_id' => 1],
            ['name' => 'Detergente líquido', 'purchase_price' => 1.63, 'sale_price' => 3.99, 'stock' => 50, 'barcode' => '1994567890123', 'category_id' => 5, 'state_id' => 1],
            ['name' => 'Lejía', 'purchase_price' => 1.62, 'sale_price' => 2.75, 'stock' => 80, 'barcode' => '2345678901234', 'category_id' => 5, 'state_id' => 1],
            ['name' => 'Limpiador multiusos', 'purchase_price' => 0.95, 'sale_price' => 1.99, 'stock' => 60, 'barcode' => '3886789012345', 'category_id' => 5, 'state_id' => 1],
            ['name' => 'Mantequilla', 'purchase_price' => 1.84, 'sale_price' => 2.25, 'stock' => 90, 'barcode' => '4777890123456', 'category_id' => 6, 'state_id' => 1],
            ['name' => 'Yogur natural', 'purchase_price' => 0.96, 'sale_price' => 1.75, 'stock' => 80, 'barcode' => '2665678901234', 'category_id' => 6, 'state_id' => 1],
            ['name' => 'Queso fresco', 'purchase_price' => 1.67, 'sale_price' => 3.99, 'stock' => 60, 'barcode' => '3556789012345', 'category_id' => 6, 'state_id' => 1],
            ['name' => 'Zanahorias', 'purchase_price' => 0.45, 'sale_price' => 0.99, 'stock' => 80, 'barcode' => '8441234567890', 'category_id' => 7, 'state_id' => 1],
            ['name' => 'Tomates', 'purchase_price' => 1.1, 'sale_price' => 1.49, 'stock' => 50, 'barcode' => '7833123456789', 'category_id' => 7, 'state_id' => 1],
            ['name' => 'Espinacas', 'purchase_price' => 0.96, 'sale_price' => 1.25, 'stock' => 70, 'barcode' => '9022345678901', 'category_id' => 7, 'state_id' => 1],
            ['name' => 'Pilsen', 'purchase_price' => 1.21, 'sale_price' => 2.99, 'stock' => 100, 'barcode' => '1114567890123', 'category_id' => 8, 'state_id' => 1],
            ['name' => 'Cristal', 'purchase_price' => 1.94, 'sale_price' => 3.25, 'stock' => 120, 'barcode' => '2005678901234', 'category_id' => 8, 'state_id' => 1],
            ['name' => 'Cusqueña', 'purchase_price' => 1.84, 'sale_price' => 3.49, 'stock' => 80, 'barcode' => '3456798012345', 'category_id' => 8, 'state_id' => 1],
            ['name' => 'Champú', 'purchase_price' => 2.61, 'sale_price' => 4.99, 'stock' => 50, 'barcode' => '1234561290123', 'category_id' => 9, 'state_id' => 1],
            ['name' => 'Jabón de baño', 'purchase_price' => 1.6, 'sale_price' => 1.75, 'stock' => 80, 'barcode' => '2345673901234', 'category_id' => 9, 'state_id' => 1],
            ['name' => 'Crema hidratante', 'purchase_price' => 2.63, 'sale_price' => 3.49, 'stock' => 60, 'barcode' => '3456749012345', 'category_id' => 9, 'state_id' => 1],
            ['name' => 'Helado de vainilla', 'purchase_price' => 1.95, 'sale_price' => 2.99, 'stock' => 70, 'barcode' => '4567870123456', 'category_id' => 10, 'state_id' => 1],
            ['name' => 'Helado de chocolate', 'purchase_price' => 2.1, 'sale_price' => 3.25, 'stock' => 80, 'barcode' => '5678081234567', 'category_id' => 10, 'state_id' => 1],
            ['name' => 'Helado de fresa', 'purchase_price' => 1.94, 'sale_price' => 3.49, 'stock' => 90, 'barcode' => '6789010645678', 'category_id' => 10, 'state_id' => 1],
            ['name' => 'Pan de molde', 'purchase_price' => 0.98, 'sale_price' => 1.99, 'stock' => 50, 'barcode' => '1234505890123', 'category_id' => 11, 'state_id' => 1],
            ['name' => 'Croissants', 'purchase_price' => 0.57, 'sale_price' => 1.25, 'stock' => 60, 'barcode' => '2345678041234', 'category_id' => 11, 'state_id' => 1],
            ['name' => 'Baguettes', 'purchase_price' => 1.21, 'sale_price' => 2.49, 'stock' => 40, 'barcode' => '3456780312345', 'category_id' => 11, 'state_id' => 1],
            ['name' => 'Filete de pollo', 'purchase_price' => 3.58, 'sale_price' => 5.99, 'stock' => 70, 'barcode' => '4567894023456', 'category_id' => 12, 'state_id' => 1],
            ['name' => 'Filete de salmón', 'purchase_price' => 7.12, 'sale_price' => 8.25, 'stock' => 80, 'barcode' => '5678900034567', 'category_id' => 12, 'state_id' => 1],
            ['name' => 'Lomo de cerdo', 'purchase_price' => 5.12, 'sale_price' => 6.49, 'stock' => 90, 'barcode' => '6789011745678', 'category_id' => 12, 'state_id' => 1],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
