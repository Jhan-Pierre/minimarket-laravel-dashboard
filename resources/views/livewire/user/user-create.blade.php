<div class="max-w-screen-xl px-4 mx-auto lg:px-12 w-full">
    <h2 class="my-4 text-xl font-bold text-gray-900 dark:text-white">Agregar un usuario</h2>
    <form wire:submit="store">
        @csrf
        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
            <div class="w-full">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                <input type="text" wire:model="userCreate.name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="nombre" ="">
                <x-input-error-flow for='userCreate.name'/>
            </div>
            <div class="w-full">
                <x-label-flow>Estados</x-label-flow>
                <x-select-flow wire:model="userCreate.estado_id">
                    <option selected="">Selecione una opcion</option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}">{{ $state->nombre }}</option>
                    @endforeach
                </x-select-flow>
            </div>
            <div class="sm:col-span-2">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo</label>
                <input type="email" wire:model="userCreate.email"  id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="correo" ="">
                <x-input-error-flow for='userCreate.email'/>
            </div>
            <div class="w-full">
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
              <input type="password" id="password" wire:model="userCreate.password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••"  >
              <x-input-error-flow for='userCreate.password'/>
            </div>
            <div class="w-full">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar Contraseña</label>
                <input type="password" id="password" wire:model="userCreate.passwordConfirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••"  >
                <x-input-error-flow for='userCreate.passwordConfirmation'/>
            </div>
            <div class="sm:col-span-2">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Asignar Roles</h2>
            </div>
            
            @foreach ($roles as $role)
            <div class="w-full ">
                <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                    <input id="bordered-checkbox-{{ $role->id }}" wire:model="userCreate.selectedRoles" type="checkbox" value="{{ $role->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="bordered-checkbox-{{ $role->id }}"  class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"> {{ $role->name }} </label>
                </div>
            </div>
            @endforeach
            <x-input-error-flow for='userCreate.selectedRoles'/>
        </div>
        <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
            Agregar
        </button>
    </form>
</div>