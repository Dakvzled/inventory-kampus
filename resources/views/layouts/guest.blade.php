<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Hapus tag <h2> yang sebelumnya ada di sini, itu menyebabkan masalah. -->

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            
            <!-- Tempat Logo dan Teks Judul Website -->
            <div class="text-center mb-6">
                <!-- 1. Placeholder untuk Logo (Ganti string kosong dengan URL logo Anda) -->
                
                <!-- 2. Teks Judul Website -->
                <h1 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">
                    Inventory System Sebelas Maret
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400">Silakan login untuk mengakses sistem.</p>
            </div>
            <!-- Akhir Tempat Logo dan Teks Judul -->

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                <!-- $slot akan berisi formulir Login atau Register -->
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
