<div class="pb-4 pt-6">
    <div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-200 uppercase bg-gray-50 dark:bg-gray-200 dark:text-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3">Nombre</th>
                    <th scope="col" class="px-6 py-3">Código de barras</th>
                    <th scope="col" class="px-6 py-3">Precio de compra</th>
                    <th scope="col" class="px-6 py-3">Precio de venta</th>
                    <th scope="col" class="px-6 py-3">Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td class="px-6 py-3">{{ $product->name }}</td>
                    <td class="px-6 py-3">{{ $product->barcode }}</td>
                    <td class="px-6 py-3">{{ $product->purchase_price }}</td>
                    <td class="px-6 py-3">{{ $product->sale_price }}</td>
                    <td class="px-6 py-3">{{ $product->stock }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>      
    </div>
</div>
