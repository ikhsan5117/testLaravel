<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- konten : title -->
    <title>LP3I - Kampus Vokasi Terbaik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800">

    <!-- NAVBAR -->
    <header class="w-full py-4 bg-white shadow-sm fixed top-0 left-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-4">
            <!-- konten : logo -->
            <h1 class="text-2xl font-bold text-blue-600">LP3I</h1>
            <!-- konten : navbar -->
            <nav class="hidden md:flex gap-8 text-gray-700 font-medium" x-data="navHighlight()">
                @foreach ($navigation as $nav)
                <a href="{{ $nav->url }}"
                   :class="activeSection === '{{ str_replace('#', '', $nav->url) }}' ? 'text-blue-600 font-semibold' : 'hover:text-blue-600'"
                   @click="scrollToSection('{{ str_replace('#', '', $nav->url) }}')">
                    {{ $nav->label }}
                </a>
                @endforeach
            </nav>

            <div class="flex gap-3">
                <nav class="flex items-center gap-4">
                    @auth
                    <a
                        href="{{ url('/dashboard') }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700">
                        Dashboard
                    </a>
                    @else
                    <a
                        href="{{ route('login') }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700">
                        Log in
                    </a>
                    @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700">
                        Register
                    </a>
                    @endif
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section id="beranda" class="pt-32 pb-20 bg-gray-50">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10 px-4 items-center">

            <!-- Text Content -->
             <!-- konten : banner wording -->
            <div>
                <h2 class="text-4xl md:text-5xl font-extrabold leading-tight text-gray-900 mb-6">
                    {!! $landing['hero_title'] ?? 'Kampus Vokasi Terbaik<br>Untuk Masa Depan Karir Anda' !!}
                </h2>
                <p class="text-lg text-gray-600 mb-8">
                    {!! $landing['hero_subtitle'] ?? 'Solusi Pendidikan Masa Depan' !!}
                </p>

                <div class="flex gap-4">
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" 
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold text-lg hover:bg-blue-700">Daftar Sekarang</a>
                    @endif
                    <a href="#program" 
                    class="px-6 py-3 border border-blue-600 text-blue-600 rounded-lg font-semibold text-lg hover:bg-blue-50">Lihat Program</a>
                </div>
            </div>
            <!-- Image -->
            <div class="flex justify-center">
                <!-- konten : banner image -->
            <img src="{{ asset('storage/' . ($landing['hero_image'] ?? 'landing/default-hero.png')) }}" alt="Mahasiswa LP3I" class="w-full max-w-2xl object-cover rounded-xl shadow-lg" />
        </div>
        </div>
    </section>

    <!-- PROGRAM PENDIDIKAN -->
     <!-- konten : programPendidikan -->
    <section id="program" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h3 class="text-3xl font-bold text-gray-900 mb-10">Program Pendidikan</h3>

           <div class="grid md:grid-cols-3 gap-8">
            @foreach($programs as $program)
                <div class="bg-gray-50 p-8 rounded-xl shadow-sm hover:shadow-lg transition">
                    @if($program->icon)
                        <div class="text-4xl text-blue-600 mb-4">
                            <i class="{{ $program->icon }}"></i>
                        </div>
                    @endif
                    <h4 class="text-xl font-semibold mb-3">{{ $program->title }}</h4>
                    <p class="text-gray-600 mb-4">{{ $program->description }}</p>
                    @if($program->url)
                        <a href="{{ $program->url }}" class="text-blue-600 hover:text-blue-800 font-medium">Pelajari Lebih Lanjut →</a>
                    @endif
                </div>
            @endforeach
            </div>
        </div>
    </section>

    <!-- TENTANG LP3I -->
    <!-- konten : tentang -->
    <section id="tentang" class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-2 gap-10 items-center">
            <div>
                <h3 class="text-3xl font-bold text-gray-900 mb-6">Tentang LP3I</h3>
                <p class="text-gray-600 leading-relaxed mb-4">
                    LP3I adalah lembaga pendidikan vokasi yang telah berdiri lebih dari 30 tahun,
                    berfokus pada pendidikan yang langsung terhubung dengan dunia kerja.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    Dengan kurikulum berbasis industri, dosen praktisi, dan jaringan perusahaan luas,
                    LP3I telah membantu ribuan lulusan untuk siap bekerja sejak semester awal.
                </p>
            </div>

            <img src="{{ asset('storage/image/landing/mahasiswa-lp3i.png') }}" class="rounded-xl shadow-lg" />
        </div>
    </section>

    <!-- FOOTER -->
    <!-- konten : footer -->
    <footer id="kontak" class="bg-blue-600 text-white py-10">
        <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-3 gap-10">

            <div>
                <h4 class="text-xl font-semibold mb-3">LP3I</h4>
                <p class="text-gray-100">Kampus vokasi yang mempersiapkan mahasiswa siap kerja lebih cepat.</p>
            </div>

            <div>
                <h4 class="text-xl font-semibold mb-3">Navigasi</h4>
                <ul class="space-y-2 text-gray-100">
                    @foreach ($footerNav as $itemNav)
                    <li><a href="{{ $itemNav->url }}" class="hover:underline">
                        {{ $itemNav->label }}
                    </a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="text-xl font-semibold mb-3">Hubungi Kami</h4>
                <p class="text-gray-100">Email: info@lp3i.ac.id</p>
                <p class="text-gray-100">Telp: (021) 12345678</p>
            </div>

        </div>

        <p class="text-center text-gray-200 mt-10 text-sm">
            {!! $landing['footer_text'] ?? '@ 2025 LP3I College - All Rights Reserved' !!}
        </p>
    </footer>

</body>
</html>

<script>
function navHighlight() {
    return {
        activeSection: 'beranda',
        init() {
            this.updateActiveSection();
            window.addEventListener('scroll', () => {
                this.updateActiveSection();
            });
        },
        updateActiveSection() {
            const sections = ['beranda', 'program', 'tentang', 'kontak'];
            let current = 'beranda';

            for (const section of sections) {
                const element = document.getElementById(section);
                if (element) {
                    const rect = element.getBoundingClientRect();
                    if (rect.top <= 100 && rect.bottom >= 100) {
                        current = section;
                        break;
                    }
                }
            }

            this.activeSection = current;
        },
        scrollToSection(sectionId) {
            const element = document.getElementById(sectionId);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        }
    }
}
</script>
