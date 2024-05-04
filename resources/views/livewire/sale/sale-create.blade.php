<div>
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <div class="xl:col-span-2">
            <livewire:basket.basket-form  wire:model.live="saleCreate.total"/>
        </div>
        <div class="xl:col-span-1">
            <form wire:submit="store">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div class="w-full">
                        <label for="igv" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" >IGV</label>
                        <input disabled type="number" wire:model="saleCreate.igv" id="igv" name="igv" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.0" required >
                        <x-input-error-flow for='saleCreate.igv'/>
                    </div>
                    <div class="w-full">
                        <label for="total" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total</label>
                        <input wire:model.live="saleCreate.total" disabled type="number" id="total" name="total" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.0" required >
                        <x-input-error-flow for='saleCreate.total'/>
                    </div>
                    <div>
                        <x-label-flow for="metodo_pago_id">Metodos de pago</x-label-flow>
                        <x-select-flow name="metodo_pago_id" id="metodo_pago_id" wire:model="saleCreate.metodo_pago_id">
                            <option selected="">Selecione una opción</option>
                            @foreach ($paymmentMethods as $paymmentMethod)
                                <option  value="{{ $paymmentMethod->id }}">{{ $paymmentMethod->metodo_pago }}</option>
                            @endforeach
                        </x-select-flow>
                        <x-input-error-flow for='saleCreate.metodo_pago_id'/>
                    </div>
                    <div>
                        <x-label-flow for="tipo_comprobante_id">Tipo de Comprobante</x-label-flow>
                        <x-select-flow name="tipo_comprobante_id" id="tipo_comprobante_id" wire:model="saleCreate.tipo_comprobante_id">
                            <option selected="">Selecione una opcion</option>
                            @foreach ($voucherTypes as $voucherType)
                                <option value="{{ $voucherType->id }}">{{ $voucherType->comprobante }}</option>
                            @endforeach
                        </x-select-flow>
                        <x-input-error-flow for='saleCreate.tipo_comprobante_id'/>
                    </div>
                </div>
                <div class="flex items-center space-x-4 mb-4">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Registrar
                    </button>
                </div>
            </form>  
        </div>
    </div>
</div>
