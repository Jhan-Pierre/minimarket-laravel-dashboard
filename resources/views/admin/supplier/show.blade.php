<x-app-layout>
    <div class="max-w-screen-xl px-4 mx-auto lg:px-12 w-full">
        <x-slot name="header" >
            <h2 class="p-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">
                {{ __('Lista de Proveedor') }}
            </h2>
        </x-slot>
        @livewire('supplier.show', ['supplier' => $supplier->id])
    </div>
</x-app-layout>