<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        {{-- Kontainer utama dengan layout flex --}}
        <div class="min-h-screen flex flex-col sm:flex-row items-center bg-gray-100">
            
            <div class="w-full sm:w-1/2 h-64 sm:h-screen bg-white flex items-center justify-center p-8 shadow-lg">
                <div class="text-center max-w-md">
                    {{-- Anda bisa mengganti SVG ini dengan ilustrasi lain dari undraw.co, dll --}}
                    <svg class="w-auto h-56 md:h-64 mx-auto" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M473.6 156.9C458.5 136.3 427.9 128 392.5 128H152C138.7 128 128 138.7 128 152V360C128 373.3 138.7 384 152 384H392.5C427.9 384 458.5 375.7 473.6 355.1C490.3 332.2 490.3 300.7 473.6 277.8C490.3 254.9 490.3 223.4 473.6 200.5V156.9H473.6Z" fill="#3B82F6"/>
                        <path d="M392.5 128H152C138.7 128 128 138.7 128 152V360C128 373.3 138.7 384 152 384H392.5C370.4 384 352.3 365.1 352.3 341.9V169.1C352.3 145.9 370.4 128 392.5 128Z" fill="#2563EB"/>
                        <path d="M49.9004 121.7C24.3004 135.2 5.30039 161.4 0.300391 192.3C18.3004 186.2 33.5004 172.9 49.9004 156.5L49.9004 121.7Z" fill="#3B82F6"/>
                        <path d="M49.9004 390.3C24.3004 376.8 5.30039 350.6 0.300391 319.7C18.3004 325.8 33.5004 339.1 49.9004 355.5L49.9004 390.3Z" fill="#3B82F6"/>
                        <path d="M92.7 78.9C79.2 53.3 53 34.3 22.1 29.3C28.2 47.3 21.3 62.5 37.7 78.9H92.7Z" fill="#3B82F6"/>
                        <path d="M92.7 433.1C79.2 458.7 53 477.7 22.1 482.7C28.2 464.7 21.3 449.5 37.7 433.1H92.7Z" fill="#3B82F6"/>
                    </svg>
                    <h1 class="text-3xl font-bold mt-6 text-gray-800">IndoJournal</h1>
                    <p class="text-gray-500 mt-2 text-base">Starter Kit Berita Modern dan Cepat untuk Proyek Anda Berikutnya.</p>
                </div>
            </div>

            <div class="w-full sm:w-1/2 flex items-center justify-center p-4">
                <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    {{-- Di sinilah konten dari login.blade.php atau register.blade.php akan ditampilkan --}}
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>