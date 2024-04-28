<x-app-layout>

    <div class="max-w-screen-xl px-4 mx-auto lg:px-12 w-full">
        @if (session('info'))
            <x-alert type="success">
                <x-slot name="title">
                    Exito
                </x-slot>
                {{ session('info') }}
            </x-alert>
        @endif
        <x-slot name="header" >
                <h2 class="p-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">
                    {{ __('Asignar un rol') }}
                </h2>       
        </x-slot>
        <div class="p-4">
            <h2 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">
                Nombre: {{ $user->name }}
            </h2>
        </div>
        
        <form action="{{ route('admin.users.update', $user) }}" method="post">
            @csrf
            @method('put')
            @foreach ($roles as $role)
                <div>
                    <label>
                        <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'checked' : '' }} class="mr-1">
                        {{ $role->name }}
                    </label>
                </div>
            @endforeach
        
            <button type="submit" class="px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                Asignar rol
            </button>
        </form>
        
    </div>
</x-app-layout>