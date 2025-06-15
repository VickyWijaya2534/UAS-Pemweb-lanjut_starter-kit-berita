<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'IndoJournal') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
        <div class="bg-gradient-to-br from-gray-50 to-blue-100 text-black/50">
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-blue-500 selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="absolute top-0 left-0 right-0 grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex lg:justify-center lg:col-start-2">
                           {{-- Logo atau Nama Aplikasi --}}
                        </div>
                        <nav class="-mx-3 flex flex-1 justify-end">
                            @if (Route::has('login'))
                                @auth
                                    <a
                                        href="{{ url('/dashboard') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                    >
                                        Dashboard
                                    </a>
                                @else
                                    <a
                                        href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                    >
                                        
                                    </a>

                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                        >
                                            
                                        </a>
                                    @endif
                                @endauth
                            @endif
                        </nav>
                    </header>

                    <main class="mt-6">
                        <div class="text-center">
                            <div class="mb-8">
                                <h1 class="text-5xl font-extrabold text-gray-800">IndoJournal</h1>
                                <p class="mt-4 text-lg text-gray-600">
                                    Platform starter kit berita modern yang siap membantu Anda memulai proyek dengan cepat.
                                </p>
                             </div>
                             
                             <div class="flex justify-center">
                                 <svg class="w-auto h-80 text-blue-600" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M473.6 156.9C458.5 136.3 427.9 128 392.5 128H152C138.7 128 128 138.7 128 152V360C128 373.3 138.7 384 152 384H392.5C427.9 384 458.5 375.7 473.6 355.1C490.3 332.2 490.3 300.7 473.6 277.8C490.3 254.9 490.3 223.4 473.6 200.5V156.9H473.6Z" fill="currentColor"/>
                                    <path d="M392.5 128H152C138.7 128 128 138.7 128 152V360C128 373.3 138.7 384 152 384H392.5C370.4 384 352.3 365.1 352.3 341.9V169.1C352.3 145.9 370.4 128 392.5 128Z" fill="#2563EB"/>
                                    <path d="M49.9004 121.7C24.3004 135.2 5.30039 161.4 0.300391 192.3C18.3004 186.2 33.5004 172.9 49.9004 156.5L49.9004 121.7Z" fill="currentColor"/>
                                    <path d="M49.9004 390.3C24.3004 376.8 5.30039 350.6 0.300391 319.7C18.3004 325.8 33.5004 339.1 49.9004 355.5L49.9004 390.3Z" fill="currentColor"/>
                                    <path d="M92.7 78.9C79.2 53.3 53 34.3 22.1 29.3C28.2 47.3 21.3 62.5 37.7 78.9H92.7Z" fill="currentColor"/>
                                    <path d="M92.7 433.1C79.2 458.7 53 477.7 22.1 482.7C28.2 464.7 21.3 449.5 37.7 433.1H92.7Z" fill="currentColor"/>
                                </svg>
                             </div>

                             <div class="mt-8 flex justify-center gap-4">
                                 <a href="{{ route('login') }}" class="inline-block rounded-lg bg-blue-600 px-8 py-3 text-sm font-semibold text-white shadow-lg hover:bg-blue-700 transition">Mulai Login</a>
                                 <a href="{{ route('register') }}" class="inline-block rounded-lg bg-white px-8 py-3 text-sm font-semibold text-gray-800 shadow-lg hover:bg-gray-100 transition">Daftar Akun</a>
                             </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>