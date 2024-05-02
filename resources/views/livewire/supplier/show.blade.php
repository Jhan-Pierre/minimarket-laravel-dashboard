<div>
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <div class="xl:col-span-1">
                <div class="p-6">
                    <h1 class="text-3xl font-bold text-white">{{ $supplier->name }}  ({{ $supplier->id }})</h1>
                    <div class="mt-4">
                        <p class="text-xl text-gray-500"><strong>RUC:</strong> {{ $supplier->ruc }} </p>
                        <p class="text-xl text-gray-500"><strong>Descripción:</strong> {{ $supplier->descripcion }}</p>
                        <p class="text-xl text-gray-500"><strong>Teléfono:</strong> {{ $supplier->telefono }}</p>
                        <p class="text-xl text-gray-500"><strong>Correo:</strong> {{ $supplier->correo }}</p>
                        <p class="text-xl text-gray-500"><strong>Dirección:</strong> {{ $supplier->direccion }}</p>
                        <p class="text-xl text-gray-500"><strong>Estado:</strong> {{ $supplier->estado->nombre }}</p>
                    </div>
                </div>
        </div>
        <div class="xl:col-span-2">
            @livewire('product-supplier.products-by-supplier', ['supplier' => $supplier])
        </div>
    </div>
</div>
