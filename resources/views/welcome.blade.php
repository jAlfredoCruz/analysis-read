<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel')}}</title>

        <!-- Fonts -->
        <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])


    </head>
    <body class="font-sans antialiased">
        <header>
            <nav class="bg-slate-200 border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
                <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                    <div class="flex items-center">
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Reading Analysis</span>
                    </div>
                    <div class="flex items-center lg:order-2">
                        @if (Route::has('login'))
                            <x-welcome.navogation />
                        @endif
                    </div>
                    <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                        <div class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                           <!-- <x-application-logo class="block h-12 w-auto" /> -->
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main class="items-center justify-center left-0">
            <h1 class="text-center mt-6 text-xl font-semibold">Guia de lectura analitica</h1>
            <p class="text-center mt-3 text-lg">Exsisten cuantro tipos de lecturas:</p>
            <h2 class='text-center text-lg font-semibold mt-4'>1. Nivel basico</h2>
            <p class="text-center text-lg">El primero es el nivel básico de lectura es en el de todas las persona que leen.</p>
            <h2 class='text-center text-lg font-semibold mt-4'>2. Lectura extensiva o prelectura</h2>
            <p class="text-center text-lg">El objetivo de este nivel consiste en extraer el máximo de un libro en un tiempo dado. Las preguntas principales son ¿de qué trata el libro? y ¿Qué clase de libro es?</p>
            <h2 class='text-center text-lg font-semibold mt-4'>3. Lectura analitica</h2>
            <p class="text-center text-lg">Es un tiempo no limitado,  el lector debe plantear numerosas preguntas y bien organizadas está destinada principalmente fundamentalmente a la comprensión.</p>
            <h2 class='text-center text-lg font-semibold mt-4'>4. Lectura paralela</h2>
            <p class="text-center text-lg">Aquí el lector se ocupa de muchos libros a la vez no relacionados entre si pero con un tema en común.</p>
            <p class="text-center text-lg font-semibold mt-5">Esta aplicacion busca guiarte por el tercer nivel</p>
        </main>

    </body>
</html>
