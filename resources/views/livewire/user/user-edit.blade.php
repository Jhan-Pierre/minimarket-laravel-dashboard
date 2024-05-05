<div class="py-8 px-4 lg:py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 xl:mb-4 gap-8">
        <div class="xl:col-span-1">
            <div class="flex items-center space-x-4 mt-4 xl:mb-4 xl:mt-5">
                <a href="{{ route('admin.users.index')}}" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-[20px] h-[20px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                      </svg>  
                    Regresar
                </a>
            </div>
        </div>
        <div class="xl:col-span-1">
            <div class="flex items-center justify-center space-x-4 mb-4 xl:my-4 xl:mb-6">
                <h2 class="text-4xl font-bold dark:text-white">Editar Usuario</h2>
            </div>
        </div>
    </div>
    <form wire:submit="update">
        @csrf
        @method('PUT')
        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
            <div class="w-full">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                <input wire:model="userEdit.name" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="nombre">
                <x-input-error-flow for='userEdit.name'/>
            </div>
            <div class="w-full">
                <x-label-flow>Estados</x-label-flow>
                <x-select-flow wire:model="userEdit.estado_id">
                    <option selected="">Selecione una opcion</option>
                    @foreach ($userEdit->states as $state)
                        <option value="{{ $state->id }}">{{ $state->nombre }}</option>
                    @endforeach
                </x-select-flow>
                <x-input-error-flow for='userEdit.estado_id'/>
            </div>
            <div class="sm:col-span-2">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo</label>
                <input wire:model="userEdit.email" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="correo">
                <x-input-error-flow for='userEdit.email'/>
            </div>
            <div class="w-full">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nueva Contraseña</label>
                <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••">
                <x-input-error-flow for='userEdit.password'/>
            </div>
            <div class="w-full">
                <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar Contraseña</label>
                <input type="password" id="confirm_password" name="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••">
                <x-input-error-flow for='userEdit.passwordConfirmation'/>
            </div>
            <div class="sm:col-span-2">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Asignar Roles</h2>
            </div>
            @foreach ($userEdit->roles as $role)
            <div class="w-full ">
                <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                    <input wire:model.defer="userEdit.selectedRoles" id="bordered-checkbox-{{ $role->id }}" type="checkbox" name="selectedRoles[]" value="{{ $role->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="bordered-checkbox-{{ $role->id }}" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"> {{ $role->name }} </label>
                </div>
            </div>
            @endforeach
            <x-input-error-flow for='userEdit.selectedRoles'/>
        </div>
        <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
            Guardar Cambios
        </button>
    </form>
</div>