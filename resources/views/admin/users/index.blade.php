<x-app-layout>

    <div class="max-w-screen-xl px-4 mx-auto lg:px-12 w-full">
        <x-slot name="header" >
            <h2 class="text-4xl font-bold dark:text-white">
                {{ __('Lista de Usuarios') }}
            </h2>
        </x-slot>

        @livewire('user.user-form')
         
    </div>
</x-app-layout>