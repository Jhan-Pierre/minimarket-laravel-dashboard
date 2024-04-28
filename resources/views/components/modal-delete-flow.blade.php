@props(['id' => null, 'maxWidth' => null])

<x-modal-flow :maxWidth="$maxWidth">
    <div>
        {{ $header }}
    </div>

    <div class="text-center">
        {{ $slot }}
    </div>
    

    <div class="flex justify-center items-center space-x-4">
        {{ $footer }}
    </div>

    
</x-modal-flow>