<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="{{ asset('js/alertify.min.js') }}"></script>

        <!-- Styles -->
        @livewireStyles
        <link rel="stylesheet" href="{{ asset('css/alertify.min.css') }}">


    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @livewire('navigation-menu')

            

            <!-- Page Content -->
            <main>
                <div class="p-4 sm:ml-64">
                    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
                        <!-- Main Heading -->
                        @if (isset($header))
                            <div class="flex items-center justify-center mb-4 rounded bg-gray-50 dark:bg-gray-800">
                                {{ $header }}
                            </div>
                        @endif
                        
                        <div class="flex items-center justify-center mb-4 rounded bg-gray-50 dark:bg-gray-800">
                            {{ $slot }}
                        </div>
                    </div>
                </div>        
            </main>
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

        @stack('modals')

        @livewireScripts
    </body>
</html>
