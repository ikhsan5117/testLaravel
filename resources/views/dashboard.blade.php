<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="text-sm text-gray-600 dark:text-gray-400">
                Welcome back, {{ Auth::user()->name }}!
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Welcome Message -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6 text-white">
                    <h3 class="text-2xl font-bold mb-2">{{ __("You're logged in!") }}</h3>
                    <p class="text-blue-100">Manage your academic system efficiently</p>
                </div>
            </div>

            @if(Auth::user()->role === 'admin')
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card Mahasiswa -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wide">Total Mahasiswa</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{ \App\Models\Mahasiswa::count() }}</p>
                            </div>
                            <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-full">
                                <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('mahasiswa.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium">
                                View Details →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card Ruangan -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wide">Total Ruangan</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{ \App\Models\Ruangan::count() }}</p>
                            </div>
                            <div class="p-3 bg-green-100 dark:bg-green-900 rounded-full">
                                <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('ruangan.index') }}" class="text-sm text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 font-medium">
                                View Details →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card Dosen -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wide">Total Dosen</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{ \App\Models\Dosen::count() }}</p>
                            </div>
                            <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-full">
                                <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('dosen.index') }}" class="text-sm text-purple-600 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-300 font-medium">
                                View Details →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card E-KYC Pending -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wide">E-KYC Pending</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{ \App\Models\EkycRegistration::where('status', 'pending')->count() }}</p>
                            </div>
                            <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-full">
                                <svg class="w-8 h-8 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-sm text-yellow-600 dark:text-yellow-400 font-medium">
                                Pending Reviews
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('mahasiswa.index') }}" class="flex items-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors duration-200">
                            <div class="p-2 bg-blue-500 rounded-md mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-blue-900 dark:text-blue-100">Manage Mahasiswa</p>
                                <p class="text-sm text-blue-700 dark:text-blue-300">Add, edit, or view students</p>
                            </div>
                        </a>
                        <a href="{{ route('ruangan.index') }}" class="flex items-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/30 transition-colors duration-200">
                            <div class="p-2 bg-green-500 rounded-md mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-green-900 dark:text-green-100">Manage Ruangan</p>
                                <p class="text-sm text-green-700 dark:text-green-300">Add or edit classrooms</p>
                            </div>
                        </a>
                        <a href="{{ route('dosen.index') }}" class="flex items-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-colors duration-200">
                            <div class="p-2 bg-purple-500 rounded-md mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-purple-900 dark:text-purple-100">Manage Dosen</p>
                                <p class="text-sm text-purple-700 dark:text-purple-300">Add or edit lecturers</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Recent Activities</h3>
                    <div class="space-y-4">
                        @php
                            $recentMahasiswa = \App\Models\Mahasiswa::latest()->take(3)->get();
                            $recentRuangan = \App\Models\Ruangan::latest()->take(3)->get();
                        @endphp

                        @if($recentMahasiswa->count() > 0)
                            @foreach($recentMahasiswa as $mhs)
                                <div class="flex items-center space-x-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div class="w-3 h-3 bg-blue-500 rounded-full flex-shrink-0"></div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">New student registered: {{ $mhs->nama }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $mhs->created_at->diffForHumans() }}</p>
                                    </div>
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"></path>
                                    </svg>
                                </div>
                            @endforeach
                        @endif

                        @if($recentRuangan->count() > 0)
                            @foreach($recentRuangan as $ruangan)
                                <div class="flex items-center space-x-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div class="w-3 h-3 bg-green-500 rounded-full flex-shrink-0"></div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">New room added: {{ $ruangan->nama }} ({{ $ruangan->kode }})</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $ruangan->created_at->diffForHumans() }}</p>
                                    </div>
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                            @endforeach
                        @endif

                        @if($recentMahasiswa->count() === 0 && $recentRuangan->count() === 0)
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">No recent activities</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @else
            <!-- Student Dashboard -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-8 text-center">
                    <div class="mb-6">
                        <svg class="w-16 h-16 text-blue-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">Welcome, {{ Auth::user()->name }}!</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-lg">Complete your E-KYC process to get started</p>
                    </div>
                    <div class="space-y-4">
                        <p class="text-gray-500 dark:text-gray-400 max-w-md mx-auto">
                            To access all features, please complete your electronic Know Your Customer verification process.
                        </p>
                        <a href="{{ route('ekyc.step1') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium rounded-lg hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            Start E-KYC Process
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
