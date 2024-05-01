<div>
    <div class="flex">
        <div class="flex-grow">
            <input wire:model="codbarras" type="text" name="codbarras" id="codbarras" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="nombre" required="">
        </div>
        <div class="flex-grow-8">
            <x-button-flow wire:click="store({{ Auth::user()->id }})" >Agregar</x-button-flow>
        </div>
    </div>

    <div class="flex items-center space-x-4 mb-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Producto
                </th>
                <th scope="col" class="px-6 py-3">
                    Precio Unitario
                </th>
                <th scope="col" class="px-6 py-3">
                    Cantidad
                </th>
                <th scope="col" class="px-6 py-3">
                    SubTotal
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <span class="sr-only">Eliminar</span>
                </th>
            </thead>
            <tbody>
                
                @foreach ($baskets as $basket)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" wire:key="{{ $basket->id }}-product">
                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $basket->id }}</th>
                        <td class="px-6 py-3">{{ $basket->product_id }}</td>
                        <td class="px-6 py-3">{{ $basket->precio_unitario }}</td>
                        <td class="px-6 py-3">{{ $basket->cantidad }}</td>
                        <td class="px-6 py-3">{{ $basket->precio_unitario }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

