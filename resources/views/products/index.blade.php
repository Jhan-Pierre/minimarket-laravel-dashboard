<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            
                <div class="mb-4">
                    <a href="{{ route('products.create') }}" class="bg-cyan-500 dark:bg-cyan-700 hover:bg-cyan-600 dark:hover:bg-cyan-800 text-white font-bold py-2 px-4 rounded">Create Student</a>
                </div>

                <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">ID</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Nombre</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Codigo Barras</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Precio Compra</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Precio venta</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Stock</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">ID categoria</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">ID estado</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $product->id }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $product->name }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $product->barcode }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">S/. {{ $product->purchase_price }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">S/. {{ $product->sale_price }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $product->stock }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $product->category_id }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $product->state_id }}</td>
                                <td class="border px-4 py-2 text-center">
                                    <div class="flex justify-cente">
                                        <a href="#" class="bg-violet-500 dark:bg-violet-700 hover:bg-violet-600 dark:hover:bg-violet-800 text-white font-bold py-2 px-4 rounded mr-2">Editar</a>
                                        <button type="button" class="bg-pink-400 dark:bg-pink-600 hover:bg-pink-500 dark:hover:bg-pink-700 text-white font-bold py-2 px-4 rounded" onclick="confirmDelete('{{ $product->id }}')">Eliminar</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function confirmDelete(id){
        alertify.confirm("¿Deseas eliminar el registro?", 
        function (e) {
            let form = document.createElement('form');
            form.method = "POST";
            form.action = `/products/` + id;
            form.innerHTML = '@csrf @method("DELETE")'
            document.body.appendChild(form)
            form.submit();
            alertify.success('Ok');
        });
    }
</script>