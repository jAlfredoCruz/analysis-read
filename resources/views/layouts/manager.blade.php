<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="icon" type="image/png" sizes="192x192" href="/android-chrome-192x192.png">
        <link rel="icon" type="image/png" sizes="512x512" href="/android-chrome-512x512.png">
        <link rel="manifest" href="/site.webmanifest">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
        <style type="text/tailwindcss">
          @theme {
            --color-clifford: #da373d;
          }
        </style>
        
        <!-- Styles -->
        @livewireStyles
        @bukStyles
    </head>
    <body class="font-sans antialiased">

        <div x-data="{ userDropdownOpen: false, mobileNavOpen: false }">
            <!-- Page Container -->
            <div id="page-container" class="mx-auto flex min-h-screen w-full min-w-[320px] flex-col bg-slate-100">
              <!-- Page Header -->
               <x-manager.header :book="$book" />
              <!-- END Page Header -->

              <!-- Page Content -->
              <main id="page-content" class="flex max-w-full flex-auto flex-col">
                <div class="container mx-auto p-4 lg:p-8 xl:max-w-7xl">
                  <div class="grid grid-cols-1 md:gap-20 lg:grid-cols-12">
                    <!-- Navigation -->
                   <x-manager.navigation :book="$book" />
                    <!-- END Navigation -->

                    <!-- Main Content -->
                    <div class="lg:col-span-8">
                     <!-- <div class="grid grid-cols-1 gap-4 sm:grid-cols-12 md:gap-6"> -->
                        <x-banner />
                        @yield('content')
                      <!-- </div> -->
                    </div>
                    <!-- END Main Content -->
                  </div>
                </div>
              </main>
              <!-- END Page Content -->

              <!-- Page Footer -->
              <x-manager.footer />
              <!-- END Page Footer -->
            </div>
            <!-- END Page Container -->
          </div>

        @stack('modals')
        @livewireScripts
        @bukScripts
    </body>
</html>
