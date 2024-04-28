<x-app-layout>

    <div class="max-w-screen-xl px-4 mx-auto lg:px-12 w-full">
        <x-slot name="header" >
            <h2 class="text-4xl font-bold dark:text-white">
                {{ __('Products List') }}
            </h2>
        </x-slot>
        @livewire('product.product-form')
         
    </div>

</x-app-layout>