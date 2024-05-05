<div class="max-w-screen-xl px-4 mx-auto lg:px-12 w-full">
    <div class="grid grid-cols-1 xl:grid-cols-3 xl:mb-4 gap-8">
        <div class="xl:col-span-1">
            <div class="flex items-center space-x-4 mt-4 xl:mb-4 xl:mt-5">
                <a href="{{ route('admin.sale.index')}}" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-[20px] h-[20px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                      </svg>  
                    Regresar
                </a>
            </div>
        </div>
        <div class="col-span-1 xl:col-span-2">
            <div class="flex items-center space-x-4 justify-center mb-4 xl:justify-start xl:my-4 xl:mb-6">
                <h2 class="text-4xl font-bold dark:text-white">{{ $supplier->name }}</h2>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <div class="xl:col-span-1">
                <div class="p-6">
                    <h1 class="text-3xl font-bold text-white">  ({{ $supplier->id }})</h1>
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
