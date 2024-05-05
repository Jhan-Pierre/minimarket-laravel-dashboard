<div class="max-w-screen-xl px-4 mx-auto lg:px-12 w-full">
    
    <h2 class="my-4 text-xl font-bold text-gray-900 dark:text-white">Detalle de la venta</h2>

   <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <div class="xl:col-span-2">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                <table class=" w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <th scope="col" class="px-6 py-3">
                            Producto
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Precio Unitario
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cantidad
                        </th>
                        <th scope="col" class="px-6 py-3">
                            SubTotal
                        </th>
                    </thead>
                    <tbody>         
                        <tbody>         
                            @foreach ($sale->detalleVenta as $detalle)
                                @if ($detalle->cantidad > 0)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" wire:key="{{ $detalle->id }}-product">
                                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $detalle->producto->name }}</th>
                                        <td class="px-6 py-3">{{ $detalle->precio_unitario }}</td>
                                        <td class="px-6 py-3">{{ $detalle->cantidad }}</td>
                                        <td class="px-6 py-3">{{ $detalle->subtotal }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>         
                    </tbody>
                </table>
            </div>
        </div>

        <div class="xl:col-span-1">
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div class="w-full">
                    <label for="igv" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" >Usuario</label>
                    <input value="{{ $sale->users->name }}" disabled type="text" id="igv" name="igv" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.0" required >
                </div>
                <div class="w-full">
                    <label for="total" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Venta</label>
                    <input value="{{ $sale->created_at }}" disabled type="datetime" id="total" name="total" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.0" required >
                </div>
            </div>
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div class="w-full">
                    <label for="igv" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" >IGV</label>
                    <input value="{{ $sale->impuesto }}" disabled type="number" id="igv" name="igv" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.0" required >
                </div>
                <div class="w-full">
                    <label for="total" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total</label>
                    <input value="{{ $sale->total }}" disabled type="number" id="total" name="total" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.0" required >
                </div>
            </div>
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div class="w-full">
                    <label for="igv" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" >Metodo de pago</label>
                    <input value="{{ $sale->metodoPago->metodo_pago }}" disabled type="text" id="igv" name="igv" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.0" required >
                </div>
                <div class="w-full">
                    <label for="total" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de comprobante</label>
                    <input value="{{ $sale->tipocomprobante->comprobante }}" disabled type="text" id="total" name="total" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.0" required >
                </div>
            </div>
        </div>
    
    </div> 
</div>

{{-- <h1>Impuesto: {{ $sale->impuesto }}</h1>
    <h1>Total: {{ $sale->total }}</h1>
    <h1>Fecha: {{ $sale->created_at }}</h1>
    @foreach($sale->detalleVenta as $detalle)
        <h1>Cantidad: {{ $detalle->cantidad }}</h1>
    @endforeach
    <h1>{{$sale->metodoPago->metodo_pago}}</h1>
    <h1>{{$sale->tipocomprobante->comprobante}}</h1> --}}