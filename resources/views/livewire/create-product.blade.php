<div>

    <x-slot name="header">
        <h1 class="text-4xl font-bold dark:text-white">
            {{ $title }}
        </h1>
    </x-slot>

    {{-- <h2>
        {{ $name }} - {{ $state_id }}
    </h2> --}}

    <div>
        {{-- <input type="text" wire:model.live="name">    --}}
        <input type="text" wire:model="name"> 
        <x-button wire:click="save">Guardar</x-button>
    </div>

    {{ $name }}
    
</div>
