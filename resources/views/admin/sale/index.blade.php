<x-app-layout>

    <div class="max-w-screen-xl px-4 mx-auto lg:px-12 w-full">
        <x-slot name="header" >
            <h2 class="p-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">
                {{ __('Listar ventas') }}
            </h2>
        </x-slot>
        @livewire('sale.sale-form')
         
    </div>

</x-app-layout>