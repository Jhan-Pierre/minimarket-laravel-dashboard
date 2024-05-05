<section>
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-semibold leading-none text-gray-900 md:text-2xl dark:text-white">Información de {{ $user->name }}</h2>
        <dl class="flex items-center space-x-6">
            <div>
                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Correo electronico</dt>
                <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $user->email }}</dd>
            </div>
            <div>
                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Roles</dt>
                <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $user->roles->pluck('name')->join(', ') }}</dd>
            </div>
            <div>
                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Estado</dt>
                <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $user->estado ? $user->estado->nombre : 'Sin estado' }}</dd>
            </div>
        </dl>
        <dl class="flex items-center space-x-6">
            <div>
                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Creado</dt>
                <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $user->created_at }}</dd>
            </div>
            <div>
                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Ultimo cambio</dt>
                <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $user->updated_at }}</dd>
            </div>
        </dl>

        <div class="flex items-center space-x-4">
            <button type="button" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                Edit
            </button>   
            <button type="button" class="inline-flex items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                Regresar
            </button> 
        </div>
    </div>
  </section>