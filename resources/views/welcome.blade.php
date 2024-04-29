<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">

    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid items-center gap-2 py-10 justify-end">
                </header>

                <main class="mt-6">
                    <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
                        <div class="mr-auto place-self-center lg:col-span-7">
                            <h1
                                class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                                <span class="text-white">MINIMARKET</span>
                                <span class="text-orange-500">DON PEPE</span>
                            </h1>
                            <p
                                class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                                En Minimarket Don PEPE, ofrecemos una amplia gama de productos esenciales, desde
                                alimentos frescos hasta artículos de limpieza. Nuestro objetivo es brindarte
                                conveniencia y calidad en cada visita.
                            </p>
                            @auth
                            <!-- Si el usuario está autenticado -->
                            <a href="{{ url('/dashboard') }}"
                                class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:ring-orange-300 dark:focus:ring-orange-900">
                                Dashboard
                                <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            @else
                            <!-- Si el usuario no está autenticado -->
                            <a href="{{ route('login') }}"
                                class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:ring-orange-300 dark:focus:ring-orange-900">
                                Ingresar
                                <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            @endauth
                        </div>
                        <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                            <img src="https://cdn-icons-png.flaticon.com/512/2801/2801619.png" alt="mockup"
                                class="animated-image">
                        </div>

                        <style>
                        @keyframes moveUpDown {
                            0% {
                                transform: translateY(0);
                            }

                            50% {
                                transform: translateY(20px);
                            }

                            100% {
                                transform: translateY(0);
                            }
                        }

                        .animated-image {
                            animation: moveUpDown 3s ease infinite;
                        }
                        </style>

                    </div>

                </main>


                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                    REALIZADO POR VARIOS SENATINOS - FUTURO DEL PAIS
                </footer>
            </div>
        </div>
    </div>
    @stack('modals')

    @livewireScripts
</body>

</html>