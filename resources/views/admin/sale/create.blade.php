<x-app-layout>

    <div class="max-w-screen-xl px-4 mx-auto lg:px-12 w-full">
        <h2 class="my-4 text-xl font-bold text-gray-900 dark:text-white">Registrar Venta</h2>
       
        <form method="POST" action="{{ route('admin.sale.store') }}">
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div>
                    <x-label-flow>Metodos de pago</x-label-flow>
                    <x-select-flow  wire:model="metodo_pago_id">
                        <option selected="">Selecione una opción</option>
                        @foreach ($paymmentMethods as $paymmentMethod)
                            <option value="{{ $paymmentMethod->id }}">{{ $paymmentMethod->metodo_pago }}</option>
                        @endforeach
                    </x-select-flow>
                </div>
                <div>
                    <x-label-flow>Tipo de Comprobante</x-label-flow>
                    <x-select-flow wire:model="tipo_comprobante_id">
                        <option selected="">Selecione una opcion</option>
                        @foreach ($voucherTypes as $voucherType)
                            <option value="{{ $voucherType->id }}">{{ $voucherType->comprobante }}</option>
                        @endforeach
                    </x-select-flow>
                </div>
            </div>

            

            <div class="flex items-center space-x-4 mb-4">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Crear
                </button>
                <a href="{{ Route('admin.sale.index') }}" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                    Cancelar
                </a>
            </div>
        </form>

        @livewire('basket.basket-form')
    </div>

</x-app-layout>