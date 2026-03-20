<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERSISTEN</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/alpinejs" defer></script>

    @vite('resources/css/app.css')
</head>

<body class="font-po bg-white overflow-x-hidden">

    <div class="max-w-[1440px] mx-auto" x-data="{ open: false }">
        <nav class="flex justify-between items-center bg-gray-100 rounded-full mx-4 md:mx-10 mt-4 relative z-10">
            <div class="w-20 md:w-28 h-12 bg-blue-400 rounded-full flex-shrink-0"></div>

            <ul class="hidden lg:flex gap-12 text-gray-800 font-medium text-sm">
                <li><a href="/" class="font-bold hover:text-blue-500">Beranda</a></li>
                <li><a href="{{ route('streak.index') }}" class="hover:text-blue-500">Pet Streak</a></li>
                <li><a href="{{ route('tryout.index') }}" class="hover:text-blue-500">Try Out</a></li>
                <li><a href="{{ route('latihan.index') }}" class="hover:text-blue-500">Latihan Soal</a></li>
                <li><a href="{{ route('video.index') }}" class="hover:text-blue-500">Video Pembelajaran</a></li>
            </ul>

            <div class="flex items-center gap-2">
                <div class="flex items-center gap-2 bg-[#FBBA16] rounded-full">
                    <a href="{{ route('profile.index') }}"
                        class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#3171CD] flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-5 md:size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline" id="logout-form">
                        @csrf
                        <button type="submit"
                            class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#4B8A81] flex items-center justify-center text-white hover:bg-red-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                            </svg>
                        </button>
                    </form>
                </div>

                <button @click="open = true"
                    class="lg:hidden p-2 text-gray-600 hover:bg-gray-200 rounded-full transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </nav>

        <div x-show="open" class="fixed inset-0 z-[100] flex items-center justify-center p-4" style="display: none;">
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="open = false"
                class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                class="relative bg-white rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Menu Utama</h2>
                    <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <ul class="space-y-3">
                    <li><a href="/"
                            class="block text-center py-3 px-4 bg-gray-50 rounded-xl font-semibold text-gray-700 hover:bg-blue-500 hover:text-white transition">Beranda</a>
                    </li>
                    <li><a href="{{ route('streak.index') }}"
                            class="block text-center py-3 px-4 bg-gray-50 rounded-xl font-semibold text-gray-700 hover:bg-blue-500 hover:text-white transition">Pet
                            Streak</a></li>
                    <li><a href="{{ route('tryout.index') }}"
                            class="block text-center py-3 px-4 bg-gray-50 rounded-xl font-semibold text-gray-700 hover:bg-blue-500 hover:text-white transition">Try
                            Out</a></li>
                    <li><a href="{{ route('latihan.index') }}"
                            class="block text-center py-3 px-4 bg-gray-50 rounded-xl font-semibold text-gray-700 hover:bg-blue-500 hover:text-white transition">Latihan
                            Soal</a></li>
                    <li><a href="{{ route('video.index') }}"
                            class="block text-center py-3 px-4 bg-gray-50 rounded-xl font-semibold text-gray-700 hover:bg-blue-500 hover:text-white transition">Video
                            Pembelajaran</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="py-16 pb-10">
        <div class="max-w-[1440px] mx-auto">
            <section class="px-4 md:px-10 mt-8">
                <div
                    class="bg-gradient-to-r from-blue-100 to-blue-50 rounded-[35px] px-6 md:px-8 py-8 flex flex-col lg:flex-row justify-between items-center lg:items-end relative overflow-hidden gap-10">

                    <object data="{{ asset('img/pet-1.svg') }}" type="image/svg+xml"
                        class="absolute z-0 pointer-events-none
           top-[40%] left-1/2 -translate-x-1/2 -translate-y-1/2
           w-40 md:w-[340px]
           lg:top-[50%] lg:left-1/6
           lg:-translate-x-1/2 lg:-translate-y-1/2">
                    </object>

                    <div class="max-w-xl relative z-10 text-center lg:text-left">
                        <h1 class="text-3xl md:text-5xl text-[#2E3B66] font-extrabold leading-tight">
                            MENJELANG UTBK?
                        </h1>
                        <p class="mt-3 text-base md:text-lg text-[#2E3B66] leading-relaxed">
                            Belajar sedikit setiap hari lebih baik daripada <br class="hidden md:block">
                            sekali tapi berhenti. <br class="hidden md:block">
                            Yuk mulai dari sekarang bersama
                            <span class="text-blue-500 font-bold">Persisten</span>.
                        </p>
                    </div>

                    <div x-data="{
                        target: new Date('{{ $snbtDate }}').getTime(),
                        days: 0,
                        hours: 0,
                        minutes: 0,
                    
                        update() {
                            let now = new Date().getTime()
                            let distance = this.target - now
                    
                            if (distance < 0) {
                                this.days = 0
                                this.hours = 0
                                this.minutes = 0
                                return
                            }
                    
                            this.days = Math.floor(distance / (1000 * 60 * 60 * 24))
                            this.hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
                            this.minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))
                        },
                    
                        start() {
                            this.update()
                            setInterval(() => this.update(), 1000)
                        }
                    }" x-init="start()"
                        class="relative z-10 w-full max-w-xs md:max-w-none md:w-auto">

                        <div class="bg-white rounded-[35px] pb-6 relative shadow-xl">

                            <div
                                class="relative bg-[#4375D1] text-white rounded-[35px] px-10 md:px-20 py-8 md:py-10 z-10">

                                <h2 class="text-5xl md:text-[75px] font-extrabold text-center leading-none">
                                    H-<span x-text="days"></span>
                                </h2>

                                <div
                                    class="bg-white text-[#4375D1] font-semibold rounded-full px-4 py-2 mt-4 text-center text-xs md:text-sm">
                                    Menjelang Pelaksanaan SNBT
                                </div>

                            </div>

                            <div
                                class="absolute bottom-[58px] left-[10%] w-[80%] h-14 bg-gradient-to-r from-yellow-400 via-white to-yellow-400 rounded-[40px] z-0">
                            </div>

                            <div class="flex justify-around mt-8 text-xs md:text-sm text-[#4375D1] font-medium">

                                <div class="flex items-center gap-1 md:gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>

                                    <span x-text="days + ' hari'"></span>

                                </div>

                                <div class="flex items-center gap-1 md:gap-2">

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>

                                    <span x-text="hours + ' jam'"></span>

                                </div>

                                <div class="flex items-center gap-1 md:gap-2">

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>

                                    <span x-text="minutes + ' menit'"></span>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </section>

            <section class="mt-6 flex justify-center px-4">
                <div x-data="{
                    keyword: '',
                    routes: {
                        'tryout': '{{ route('tryout.index') }}',
                        'latihan': '{{ route('latihan.index') }}',
                        'kuis': '{{ route('kuis.index') }}',
                        'video': '{{ route('video.index') }}',
                        'streak': '{{ route('streak.index') }}',
                        'profil': '{{ route('profile.index') }}',
                        'minat bakat': '{{ route('minatbakat.soal') }}'
                    },
                    goToPage() {
                        let search = this.keyword.toLowerCase().trim();
                        if (search === '') return;
                
                        // Cari kunci yang mengandung kata kunci pencarian
                        for (let key in this.routes) {
                            if (key.includes(search)) {
                                window.location.href = this.routes[key];
                                return;
                            }
                        }
                
                        // Jika tidak ketemu di navigasi, arahkan ke pencarian global di controller (opsional)
                        window.location.href = '{{ route('beranda') }}?search=' + this.keyword;
                    }
                }" class="flex flex-col md:flex-row items-center gap-4 w-full max-w-3xl">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                            <i class="fa-solid fa-magnifying-glass text-gray-400 text-sm"></i>
                        </div>

                        <input type="text" x-model="keyword" @keydown.enter="goToPage()"
                            placeholder="Cari Halaman Try Out, Latihan Soal dll... "
                            class="w-full bg-white border border-gray-200 rounded-full py-4 pl-12 pr-4 shadow-md focus:ring-2 focus:ring-blue-400 outline-none transition-all text-sm">
                    </div>

                    <button @click="goToPage()"
                        class="w-full md:w-auto bg-blue-400 hover:bg-blue-500 text-white px-10 py-4 rounded-full font-semibold text-sm shadow-md transition-all active:scale-95 shrink-0">
                        Cari
                    </button>
                </div>
            </section>

            <section class="mt-8 px-4 md:px-10">
                @php
                    $subs = [
                        ['PU', 'bg-[#FEA33A]'],
                        ['PBM', 'bg-[#9885FB]'],
                        ['PPU', 'bg-[#FF908E]'],
                        ['PK', 'bg-[#4CAA60]'],
                        ['PM', 'bg-[#CEA4EC]'],
                        ['LBI', 'bg-[#A5BBEC]'],
                        ['LBE', 'bg-[#4B8A81]'],
                    ];
                @endphp

                <a href="{{ route('latihan.index') }}">
                    <div
                        class="grid justify-items-center grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-5">
                        @foreach ($subs as $s)
                            <div
                                class="{{ $s[1] }} rounded-[30px] w-full h-full text-white shadow-lg hover:shadow-2xl hover:-translate-y-3 transition duration-300 cursor-pointer text-center">
                                <div class="px-2 py-3">
                                    <div
                                        class="w-16 h-16 bg-white/30 rounded-full mt-1 mx-auto flex items-center justify-center font-bold text-xl">
                                        {{ $s[0] }}
                                    </div>
                                    <p class="mt-3 font-medium text-md">Mulai</p>
                                    <p class="font-medium text-md">Latihan!</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </a>
            </section>
        </div>
    </div>

    <div class="bg-[#EAF2FE] py-16">
        <div class="max-w-[1440px] mx-auto flex flex-col px-4 md:px-10 gap-6">

            <section style="background-image: url('{{ asset('img/bg-home-1.png') }}');"
                class="relative bg-cover bg-center bg-no-repeat rounded-[35px] px-4 md:px-14 py-30 overflow-hidden h-[250px] md:h-[500px] flex items-center">

                <div
                    class="absolute inset-0 bg-gradient-to-br from-blue-600/30 via-transparent to-black/20 backdrop-blur-[1px] md:hidden">
                </div>

                <div class="relative z-10 max-w-xl">
                    <h1 class="text-3xl md:text-5xl font-extrabold text-[#2E3B66]">Belajar dari Nol?</h1>
                    <p class="mt-3 text-base md:text-lg text-[#2E3B66]">
                        Kuasai fundamental dulu sebelum masuk <br> latihan tingkat lanjut.
                        <br><span class="font-bold">Yuk latihan pemahaman dasarmu!</span>
                    </p>
                    @php
                        // Cek apakah user sudah pernah mengerjakan tes
                        $hasilTes = \App\Models\HasilMinatBakat::where('user_id', Auth::id())->exists();
                    @endphp

                    <a href="{{ route('kuis.index') }}">
                        <button
                            class="mt-7 bg-[#FCAE4B] hover:bg-[#f39c12] text-white font-bold px-10 py-3 rounded-full text-xl shadow-lg flex items-center gap-4 transition-transform hover:scale-100">
                            {{ $hasilTes ? 'Lihat Hasil Tes' : 'Mulai Tes' }}
                            <span class="bg-white/30 w-8 h-8 flex items-center justify-center rounded-full text-white">
                                ➜
                            </span>
                        </button>
                    </a>
                </div>
            </section>

            <section class="border-2 bg-white border-gray-200 rounded-[3rem] p-8 md:p-10">
                <div class="mb-10">
                    <h2 class="text-3xl font-black text-[#2E3B66]">Try Out UTBK</h2>
                    <p class="text-gray-500 font-medium">Simulasikan ujian UTBK mu dengan berbagai sesi Try Out disini!
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($latestTryouts as $to)
                        <a href="{{ $to->sudah_dikerjakan ? route('tryout.hasil', $to->id) : ($to->is_open ? route('tryout.intruksi', $to->id) : '#') }}"
                            @if (!$to->is_open && $to->is_locked) onclick="alert('Silakan pilih Universitas & Jurusan terlebih dahulu!')" @endif>
                            <div
                                class="rounded-[2rem] p-6 flex flex-col items-center relative transition-all group
                            {{ $to->sudah_dikerjakan ? 'bg-emerald-50 border-emerald-100 hover:shadow-lg' : ($to->is_open ? 'bg-blue-50 border-blue-100 hover:shadow-lg' : 'bg-gray-100 opacity-60 border-gray-200 cursor-not-allowed grayscale') }}">

                                {{-- Label TO --}}
                                <div class="w-full flex justify-between items-start mb-2">
                                    <span
                                        class="{{ $to->is_open ? 'text-blue-400' : ($to->sudah_dikerjakan ? 'text-emerald-400' : 'text-gray-400') }} font-bold pt-1 text-lg uppercase tracking-tighter">Try
                                        Out</span>
                                    <span
                                        class="{{ $to->is_open ? 'bg-blue-600' : ($to->sudah_dikerjakan ? 'bg-emerald-600' : 'bg-gray-400') }} text-white text-lg px-4 py-1 rounded-full font-bold">UTBK</span>
                                </div>

                                {{-- Nomor TO --}}
                                <div
                                    class="{{ $to->is_open ? 'text-blue-500 group-hover:scale-110' : ($to->sudah_dikerjakan ? 'text-emerald-500' : 'text-gray-300') }} text-[100px] font-black leading-none mt-6 mb-1 transition-transform">
                                    {{ $loop->iteration }}
                                </div>

                                {{-- Nama TO --}}
                                <div class="w-full mb-6 text-center">
                                    <div
                                        class="{{ $to->is_open || $to->sudah_dikerjakan ? 'text-[#2E3B66]' : 'text-gray-400' }} text-sm font-black uppercase tracking-[0.15em] line-clamp-2 px-2">
                                        {{ $to->nama_tryout }}
                                    </div>
                                </div>

                                {{-- Status / tanggal --}}
                                <div
                                    class="bg-white px-4 py-1.5 rounded-full flex items-center gap-2 text-sm font-medium shadow-sm w-full justify-center mt-auto
                                {{ $to->is_open ? 'text-blue-500' : ($to->sudah_dikerjakan ? 'text-emerald-500' : 'text-gray-400') }}">
                                    <i
                                        class="fa-solid {{ $to->is_open ? 'fa-clock' : ($to->sudah_dikerjakan ? 'fa-circle-check' : 'fa-lock') }} text-[10px]"></i>
                                    <span class="text-[11px] font-bold">
                                        {{ $to->sudah_dikerjakan ? 'Lihat Hasil' : ($to->is_open ? $to->tanggal->format('d M') . ' - ' . $to->tanggal_akhir->format('d M') : ($to->is_locked ? 'Pilih Jurusan' : 'Belum Tersedia')) }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach

                    {{-- Tombol Lainnya --}}
                    <div class="flex-1 flex flex-col items-center justify-center min-h-[200px]">
                        <img src="{{ asset('img/slime.png') }}" class="w-44 md:w-52 mb-4" alt="Slime">
                        <a href="{{ route('tryout.index') }}">
                            <button
                                class="bg-blue-500 hover:bg-blue-600 text-white px-10 py-2.5 rounded-full font-bold shadow-md transition-all hover:scale-105">
                                Lainnya
                            </button>
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="max-w-[1440px] mx-auto">
        <section style="background-image: url('{{ asset('img/bg-home-2.png') }}');"
            class="relative bg-cover bg-center bg-no-repeat rounded-[40px] mx-4 md:mx-10 mt-10 mb-10 px-6 py-12 h-90 md:h-160 overflow-hidden shadow-sm border border-white/50">

            <div
                class="absolute inset-0 bg-gradient-to-br from-blue-600/30 via-transparent to-black/20 backdrop-blur-[1px] md:hidden">
            </div>

            <div class="flex flex-col items-center text-center relative z-10">
                <h2 class="text-2xl md:text-4xl font-extrabold text-[#2E3B66] tracking-tight">
                    Tes Minat dan Bakat
                </h2>
                <p class="mt-4 text-[#2E3B66] text-sm md:text-lg max-w-2xl leading-relaxed font-medium">
                    Kenali potensi diri serta arahkan jurusan <br class="hidden md:block">
                    dan karir yang sesuai dengan minat dan bakatmu!
                </p>
                <div class="mt-28 md:mt-8">

                    <a href="{{ route('minatbakat.intruksi') }}">
                        <button
                            class="bg-[#FCAE4B] hover:bg-[#f39c12] text-white font-bold px-10 py-3 rounded-full text-xl shadow-lg flex items-center gap-4 transition-transform hover:scale-105">
                            Mulai Tes
                            <div class="bg-white w-6 h-6 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#FCAE4B"
                                    class="w-4 h-4">
                                    <path fill-rule="evenodd"
                                        d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </a>
                </div>
            </div>
        </section>
    </div>

    @include('layouts.footer')


</body>

</html>
