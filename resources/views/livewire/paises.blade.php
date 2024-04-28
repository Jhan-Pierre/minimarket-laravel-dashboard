<div>
    
    @livewire('hijo')

    <x-button class="mb-4" wire:click="$toggle('enable')">Resetear</x-button>

    <form class="mb-4" wire:submit="save">
        <input wire:model="pais" type="text" class="mr-4" />

        <button>agregar</button>
    </form>
     
    @if ($enable)
        <ul class="list-disc list-inside space-y-2">
            @foreach ($paises as $index => $pais)
                <li wire:key="pais-{{$index}}">{{ $index}} {{ $pais}}</li>
                <x-danger-button wire:click="delete({{$index}})">eliminar</x-danger-button>
            @endforeach
        </ul>   
    @endif
    

    <span class="mb-4">
        {{ $count }}
    </span>

</div>