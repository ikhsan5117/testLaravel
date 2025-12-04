<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-blue-50 via-white to-purple-50 min-h-screen">
    <div class="min-h-screen">

        {{-- ====== HEADER / NAVBAR ATAS ====== --}}
        @include('layouts.navigation') 
        {{-- navigation.blade.php bawaan Breeze/Jetstream --}}

        {{-- ====== BODY: Sidebar + Konten ====== --}}
        <div class="flex">
            {{-- SIDEBAR di kiri, tepat di bawah header --}}
            <aside class="w-64 bg-white/80 backdrop-blur-sm border-r border-white/20 shadow-lg min-h-screen">
                <nav class="p-4 space-y-1">
                    @if (Auth::user() && Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard') }}"
                       class="block px-4 py-2 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700 font-semibold shadow-sm' : 'text-gray-700' }}">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                            </svg>
                            Dashboard
                        </div>
                    </a>
                    <a href="{{ route('mahasiswa.index') }}"
                       class="block px-4 py-2 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition-colors duration-200 {{ request()->routeIs('mahasiswa.*') ? 'bg-blue-100 text-blue-700 font-semibold shadow-sm' : 'text-gray-700' }}">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            Mahasiswa
                        </div>
                    </a>
                    <a href="{{ route('ruangan.index') }}"
                       class="block px-4 py-2 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition-colors duration-200 {{ request()->routeIs('ruangan.*') ? 'bg-blue-100 text-blue-700 font-semibold shadow-sm' : 'text-gray-700' }}">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Ruangan
                        </div>
                    </a>
                    <a href="{{ route('matkul.index') }}"
                        class="block px-4 py-2 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition-colors duration-200 {{ request()->routeIs('matkul.*') ? 'bg-blue-100 text-blue-700 font-semibold shadow-sm' : 'text-gray-700' }}">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            Mata Kuliah
                        </div>
                    </a>
                    <a href="{{ route('dosen.index') }}"
                        class="block px-4 py-2 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition-colors duration-200 {{ request()->routeIs('dosen.*') ? 'bg-blue-100 text-blue-700 font-semibold shadow-sm' : 'text-gray-700' }}">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Dosen
                        </div>
                    </a>
                    <a href="{{ route('admin.ekyc.index') }}"
                        class="block px-4 py-2 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition-colors duration-200 {{ request()->routeIs('admin') ? 'bg-blue-100 text-blue-700 font-semibold shadow-sm' : 'text-gray-700' }}">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            E-KYC Registrations
                        </div>
                    </a>

                    {{-- Landing Page Group --}}
                    <div x-data="{ open: {{ request()->is('admin/landing*') ? 'true' : 'false' }} }" class="mt-2">
                        <!-- Parent Item -->
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-4 py-2 hover:bg-gray-200
                            {{ request()->is('admin/landing*') ? 'bg-gray-200 font-semibold' : '' }}">
                            <span> Landing Page</span>
                            <svg x-show="!open" xmlns="www.w3.org" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                            <svg x-show="open" xmlns="www.w3.org" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 15l7-7 7 7" />
                            </svg>
                        </button>
                        <!-- Collapsible Menu -->
                        <div x-show="open" x-transition class="pl-6 space-y-1">
                            <a href="{{ route('admin.landing.settings.index') }}"
                                class="block px-4 py-2 hover:bg-gray-200
                                {{ request()->routeIs('admin.landing.settings.*') ? 'bg-gray-200 font-semibold' : '' }}">
                                Settings
                            </a>
                            <a href="{{ route('admin.landing.navigation.index') }}"
                                class="block px-4 py-2 hover:bg-gray-200
                                {{ request()->routeIs('admin.landing.navigation.*') ? 'bg-gray-200 font-semibold' : '' }}">
                                Menu Navigasi
                            </a>
                            <a href="{{ route('admin.landing.programs.index') }}"
                                class="block px-4 py-2 hover:bg-gray-200
                                {{ request()->routeIs('admin.landing.programs.*') ? 'bg-gray-200 font-semibold' : '' }}">
                                Program Studi
                            </a>
                            <a href="{{ route('admin.landing.footer.index') }}"
                                class="block px-4 py-2 hover:bg-gray-200
                                {{ request()->routeIs('admin.landing.footer.*') ? 'bg-gray-200 font-semibold' : '' }}">
                                Footer
                            </a>
                        </div>
                    </div>

                    @endif

                </nav>
            </aside>

            {{-- KONTEN UTAMA di kanan --}}
            <main class="flex-1 p-6">
                {{ $slot ?? '' }}
                @yield('content')
            </main>
        </div>

    </div>
</body>
</html>