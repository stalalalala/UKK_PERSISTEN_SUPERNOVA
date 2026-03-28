<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Streak | PERSISTEN</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/pet.css') }}">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-po min-h-screen overflow-x-hidden">

    <img src="{{ asset('img/bg-awan.jpg') }}" alt="Background"
        class="fixed top-0 left-0 w-full h-full object-cover -z-50 pointer-events-none contrast-90">

    <div class="max-w-[1440px] mx-auto" x-data="{ open: false }">
        <nav class="flex justify-between items-center bg-gray-100 rounded-full mx-4 md:mx-10 mt-4 relative z-10">
            <div class="w-20 md:w-28 h-12 bg-blue-400 rounded-full flex-shrink-0"></div>

            <ul class="hidden lg:flex gap-12 text-gray-800 font-medium text-sm">
                <li><a href="/" class="hover:text-blue-500">Beranda</a></li>
                <li><a href="{{ route('streak.index') }}" class="font-bold hover:text-blue-500">Pet Streak</a></li>
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

    {{-- TARUH DI ATAS SEBELUM DIPAKAI --}}
    @php
        $user = auth()->user();

        $xp = $user->total_xp ?? 0;
        $jumlahHari = $user->streak_days ?? 0;
        $isLocked = $user->character_locked ?? false; // 🔥

        // Hitung level dari total XP
        $level = 1;
        $xpNeed = 200;

        while ($xp >= $xpNeed) {
            $level++;
            $xpNeed += 200;
        }

        $currentXpInLevel = $xp;
        $maxXp = $xpNeed;

        // Ambil karakter saat ini
        $currentStreak = $isLocked ? null : $currentStreak ?? null;

        // Cek next evolution
        $userHasNextEvolution = $nextEvolution && !$isLocked;

    @endphp

    <main class="max-w-[1300px] mx-auto mt-10 px-4 md:px-6 pb-20" x-data="{
        xp: {{ $currentXpInLevel }},
        maxXp: {{ $maxXp }},
        level: {{ $level }},
        isClicked: false,
        trigger() {
            this.isClicked = true;
            setTimeout(() => this.isClicked = false, 600);
        }
    }">

        <div class="flex flex-col items-center mb-12">
            <div
                class="bg-blue-600 text-white px-8 py-1.5 rounded-full font-bold shadow-lg -mb-10 z-20 tracking-widest text-sm">
                • Level {{ $level }} •
            </div>

            <div class="slime relative z-10 w-full max-w-[320px] md:max-w-[500px] lg:max-w-[600px] cursor-pointer"
                :class="{ 'animate-bounce-slime': isClicked, 'filter blur-sm opacity-50': {{ $isLocked ? 'true' : 'false' }} }"
                @click="trigger">

                <!-- ICON LOCK DI TENGAH -->
                @if ($isLocked)
                    <div class="absolute inset-0 flex items-center justify-center z-20 pointer-events-none">
                        <i class="fa-solid fa-lock text-white text-4xl md:text-6xl drop-shadow-lg"></i>
                    </div>
                @endif

                <!-- SVG -->
                <object
                    data="{{ $isLocked ? asset('img/pet(tanpa_animasi).svg') : asset('storage/' . $currentStreak->svg_path) }}"
                    type="image/svg+xml" class="pointer-events-none select-none w-full h-auto"></object>
            </div>



            <div class="mt-10 w-full max-w-md mx-auto relative z-20">

                @if ($isLocked)
                    <!-- Tombol Pulihkan -->
                    <form action="{{ route('streak.restore') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full bg-yellow-400 text-blue-900 font-bold py-2.5 rounded-full shadow-md hover:bg-yellow-500 transition-all">
                            Pulihkan Karakter
                        </button>
                    </form>
                @else
                    <!-- Progress XP normal -->
                    <div
                        class="bg-blue-400/30 rounded-full h-8 md:h-9 p-1 border-2 border-blue-400/50 shadow-inner relative overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-full rounded-full transition-all duration-700"
                            :style="`width: ${(xp/maxXp)*100}%`">
                        </div>
                        <div
                            class="absolute inset-0 flex items-center justify-center text-white font-black text-sm md:text-lg drop-shadow-md">
                            <div class="flex items-center gap-1">
                                <span x-text="xp"></span>
                                <span>/</span>
                                <span x-text="maxXp"></span>
                                <span>XP</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-16 lg:gap-8 items-stretch mt-24">

            <div class="glass-card rounded-[3rem] p-2 border-4 border-white/50 shadow-2xl relative">
                <div
                    class="bg-white/80 rounded-[2.5rem] p-6 md:p-8 border-2 border-orange-300 shadow-inner h-full flex flex-col justify-between">
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-5">
                        <div class="relative md:absolute md:-left-12 md:-top-20 drop-shadow-2xl w-48 md:w-80">
                            <img src="{{ asset('img/api.png') }}" class="w-full h-auto object-contain">
                            {{-- <span
                                class="absolute top-[60%] left-1/2 -translate-x-1/2 -translate-y-1/2 text-white font-black text-4xl md:text-5xl italic tracking-tighter drop-shadow-md">X{{ $jumlahHari }}</span> --}}
                        </div>
                        <div class="md:ml-48 text-center md:text-left">
                            <span
                                class="inline-block bg-yellow-400 text-blue-900 text-[10px] font-black px-4 py-1 rounded-full uppercase tracking-wider mb-2">Streak
                                berjalan</span>
                            <h2 class="text-6xl md:text-7xl font-black text-[#2E3B66] leading-none">
                                {{ $jumlahHari }} Hari</h2>
                            <p class="text-blue-800/60 text-sm md:text-base font-bold mt-2">Konsisten belajar bikin
                                peluang naik!</p>
                        </div>
                    </div>

                    <div x-data="{ openInfo: false }" class="mt-8 flex items-center justify-center md:justify-start">

                        {{-- BUTTON --}}
                        <button @click="openInfo = true"
                            class="group w-full inline-flex items-center gap-2 px-4 py-2 rounded-full
               bg-gradient-to-r from-blue-500 to-blue-600
               text-white text-xs md:text-sm font-bold
               shadow-md hover:shadow-lg
               hover:from-blue-600 hover:to-blue-700
               transition-all duration-300">

                            <span class="text-white/90 group-hover:scale-110 transition">
                                ⓘ
                            </span>

                            <span>
                                Informasi Streak
                            </span>
                        </button>

                        {{-- POPUP --}}
                        <div x-show="openInfo" x-transition
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4">

                            <div @click.away="openInfo = false"
                                class="bg-white rounded-3xl p-6 max-w-2xl w-full shadow-2xl text-left border border-blue-100">

                                {{-- HEADER --}}
                                <h3 class="font-black text-lg text-[#2E3B66] mb-3 flex items-center gap-2">
                                    <span class="text-blue-500">🔥</span>
                                    Sistem Persisten Streak
                                </h3>

                                {{-- CONTENT --}}
                                <div class="text-sm text-gray-600 space-y-4">

                                    {{-- HOOK --}}
                                    <p class="font-semibold text-[#2E3B66]">
                                        Kunci naik level bukan belajar lama — tapi <span
                                            class="text-blue-600 font-bold">konsisten setiap hari</span>.
                                    </p>

                                    {{-- PENJELASAN --}}
                                    <p>
                                        Sistem streak dirancang supaya kamu tetap belajar sedikit demi sedikit, tapi
                                        terus maju.
                                        Bahkan progress kecil setiap hari akan berdampak besar dalam jangka panjang.
                                    </p>

                                    {{-- CARA MAIN --}}
                                    <div>
                                        <p class="text-xs font-bold text-gray-500 uppercase mb-2">Cara menjaga streak
                                        </p>
                                        <ul class="space-y-2 text-xs">
                                            <li>🔥 Lakukan minimal <b>1 aktivitas</b> setiap hari</li>
                                            <li>🎯 Ambil XP dari: Login, Latihan, Kuis, atau Tryout</li>
                                            <li>⚡ Maksimal <span class="text-blue-600 font-bold">140 XP / hari</span>
                                            </li>
                                            <li>⏱️ Setiap aktivitas hanya dihitung <b>1x per hari</b></li>
                                        </ul>
                                    </div>

                                    {{-- KONSEKUENSI --}}
                                    <div>
                                        <p class="text-xs font-bold text-gray-500 uppercase mb-2">Perlu diperhatikan
                                        </p>
                                        <ul class="space-y-2 text-xs">
                                            <li>⚠️ Tidak aktif <b>5 hari</b> → streak akan hangus</li>
                                            <li>🔁 Bisa dipulihkan <b>1x per bulan</b></li>
                                        </ul>
                                    </div>

                                    {{-- REWARD --}}
                                    <div>
                                        <p class="text-xs font-bold text-gray-500 uppercase mb-2">Reward progres kamu
                                        </p>
                                        <ul class="space-y-2 text-xs">
                                            <li>🧬 Setiap <b>200 XP</b> → naik level</li>
                                            <li>🚀 Level tinggi membuka <b>evolusi karakter baru</b></li>
                                        </ul>
                                    </div>

                                    {{-- HIGHLIGHT MOTIVASI --}}
                                    <div class="bg-blue-50 rounded-xl p-3 text-xs text-blue-800 font-semibold">
                                        💡 10–15 menit belajar setiap hari lebih efektif daripada belajar lama tapi
                                        jarang.
                                        Jaga streak kamu — itu bukti konsistensi kamu.
                                    </div>

                                </div>

                                {{-- BUTTON --}}
                                <button @click="openInfo = false"
                                    class="mt-5 w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold py-2.5 rounded-xl hover:from-blue-600 hover:to-blue-700 transition">
                                    Mengerti
                                </button>

                            </div>
                        </div>

                    </div>

                    <div class="mt-8 bg-orange-100/60 rounded-[2rem] p-4 border-2 border-orange-200">
                        <div class="flex justify-between items-center text-center">
                            <div class="flex-1">
                                <p class="text-[9px] font-bold text-gray-500 uppercase mb-1">Login</p><span
                                    class="{{ $loginDone ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-600' }} text-[10px] font-bold px-3 py-1.5 rounded-full">
                                    50XP
                                </span>
                            </div>
                            <div class="w-px h-8 bg-orange-200/50"></div>
                            <div class="flex-1">
                                <p class="text-[9px] font-bold text-gray-500 uppercase mb-1">Latihan</p><span
                                    class="{{ $latihanDone ? 'bg-green-500 text-white' : 'bg-[#FF908E] text-white' }} text-[10px] font-bold px-3 py-1.5 rounded-full">
                                    20XP
                                </span>
                            </div>
                            <div class="w-px h-8 bg-orange-200/50"></div>
                            <div class="flex-1">
                                <p class="text-[9px] font-bold text-gray-500 uppercase mb-1">Kuis</p><span
                                    class="{{ $kuisDone ? 'bg-green-500 text-white' : 'bg-[#FF908E] text-white' }} text-[10px] font-bold px-3 py-1.5 rounded-full">
                                    20XP
                                </span>
                            </div>
                            <div class="w-px h-8 bg-orange-200/50"></div>
                            <div class="flex-1">
                                <p class="text-[9px] font-bold text-gray-500 uppercase mb-1">Tryout</p><span
                                    class="{{ $tryoutDone ? 'bg-green-500 text-white' : 'bg-[#FF908E] text-white' }} text-[10px] font-bold px-3 py-1.5 rounded-full">
                                    50XP
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-[3rem] p-2 border-4 border-white/50 shadow-2xl relative">
                <div
                    class="bg-white/20 backdrop-blur-sm rounded-[2.5rem] p-6 md:p-8 border-2 border-blue-200 shadow-inner h-full flex flex-col overflow-hidden">


                    <div
                        class="absolute -right-8 top-0 md:right-4 md:top-4 opacity-30 md:opacity-80 pointer-events-none">
                        @if ($nextEvolution)
                            @if ($userHasNextEvolution)
                                {{-- Sudah punya next evolution → tampil normal --}}
                                <img src="{{ asset('storage/' . $nextEvolution->svg_path) }}"
                                    class="w-32 md:w-64 h-auto object-contain"
                                    style="filter: grayscale(100%) brightness(0%); opacity: 0.5;">>
                            @else
                                {{-- Belum punya → tampil siluet next evolution --}}
                                <img src="{{ asset('storage/' . $nextEvolution->svg_path) }}"
                                    class="w-32 md:w-64 h-auto object-contain"
                                    style="filter: grayscale(100%) brightness(0%); opacity: 0.5;">
                            @endif
                        @elseif ($currentStreak)
                            {{-- Tidak ada next → fallback ke current --}}
                            <img src="{{ asset('storage/' . $currentStreak->svg_path) }}"
                                class="w-32 md:w-64 h-auto object-contain">
                        @endif
                    </div>

                    <div class="mb-4 relative z-10">
                        <div
                            class="bg-blue-600 text-white px-5 py-1.5 rounded-2xl font-black text-xs inline-block shadow-md uppercase tracking-wider">
                            Misi Harian
                        </div>
                    </div>

                    <ul class="mt-4 space-y-4 flex-grow relative z-10">

                        <!-- LOGIN -->
                        <li class="flex items-center gap-4">

                            <div
                                class="w-7 h-7 flex items-center justify-center rounded-full 
{{ $loginDone ? 'bg-green-500 text-white' : 'bg-white border border-gray-300 text-gray-300' }}">
                                <i class="fa-solid fa-check text-xs"></i>
                            </div>

                            <span
                                class="text-[#2E3B66] font-bold text-sm md:text-base {{ $loginDone ? 'opacity-40 line-through' : '' }}">
                                Login Harian
                            </span>

                        </li>


                        <!-- LATIHAN -->
                        <li class="flex items-center gap-4">
                            <div
                                class="w-7 h-7 flex items-center justify-center rounded-full 
{{ $latihanDone ? 'bg-green-500 text-white' : 'bg-white border border-gray-300 text-gray-300' }}">
                                <i class="fa-solid fa-check text-xs"></i>
                            </div>

                            <span
                                class="text-[#2E3B66] font-bold text-sm md:text-base
                            {{ $latihanDone ? 'opacity-40 line-through' : '' }}">
                                Latihan Soal
                            </span>
                        </li>

                        <!-- KUIS -->
                        <li class="flex items-center gap-4">
                            <div
                                class="w-7 h-7 flex items-center justify-center rounded-full 
{{ $kuisDone ? 'bg-green-500 text-white' : 'bg-white border border-gray-300 text-gray-300' }}">
                                <i class="fa-solid fa-check text-xs"></i>
                            </div>

                            <span
                                class="text-[#2E3B66] font-bold text-sm md:text-base
            {{ $kuisDone ? 'opacity-40 line-through' : '' }}">
                                Kuis Fundamental
                            </span>
                        </li>

                        <!-- TRYOUT -->
                        <li class="flex items-center gap-4">
                            <div
                                class="w-7 h-7 flex items-center justify-center rounded-full 
{{ $tryoutDone ? 'bg-green-500 text-white' : 'bg-white border border-gray-300 text-gray-300' }}">
                                <i class="fa-solid fa-check text-xs"></i>
                            </div>

                            <span
                                class="text-[#2E3B66] font-bold text-sm md:text-base
                {{ $tryoutDone ? 'opacity-40 line-through' : '' }}">
                                Tryout
                            </span>
                        </li>

                    </ul>

                    <!-- XP PROGRESS -->
                    <div class="mt-10 bg-blue-50/50 rounded-[2rem] p-5 border-2 border-blue-100 relative z-10">

                        <div
                            class="flex justify-between text-[10px] font-black text-blue-600 mb-2 uppercase tracking-widest">
                            <span>Capai XP harian</span>
                            <span class="bg-blue-600 text-white px-3 rounded-full">
                                {{ $todayXp }}/140
                            </span>
                        </div>

                        <div class="bg-white/50 rounded-full h-4 border border-blue-200 overflow-hidden relative">

                            <!-- PROGRESS -->
                            <div class="h-full rounded-full shadow-sm transition-all duration-1000 ease-out
               bg-gradient-to-r from-blue-400 to-blue-600 relative overflow-hidden"
                                style="width: {{ $xpPercent }}%">

                                <!-- EFEK LONGOR -->
                                <div class="absolute inset-0 overflow-hidden">
                                    <div class="h-full w-1/2 bg-white/30 blur-sm animate-shimmer"></div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>



        @if ($nextEvolution)
            <div
                class="mt-10 glass-card rounded-[2rem] p-4 md:p-6 border-2 border-white/40 flex flex-col md:flex-row items-center justify-between group transition-all shadow-lg relative overflow-hidden">
                <div class="flex items-center gap-5 relative z-10 w-full md:w-auto">
                    <div class="bg-blue-100 p-3 md:p-4 rounded-2xl">
                        <i class="fa-solid fa-lock text-blue-400 text-xl md:text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-[#2E3B66] font-black text-base md:text-lg leading-none">
                            Evolusi Berikutnya
                            <span class="text-xs font-bold text-gray-500 ml-2">(Lv
                                {{ $nextEvolution->min_level }})</span>
                        </h3>
                        <p class="text-blue-800/60 text-xs md:text-sm font-semibold mt-1">
                            Capai <span class="text-blue-600 font-black">Level {{ $nextEvolution->min_level }}</span>
                            untuk membuka bentuk baru!
                        </p>
                    </div>
                </div>

                <div class="absolute right-[-10px] md:right-[5%] pointer-events-none opacity-40">
                    <img src="{{ asset('storage/' . $nextEvolution->svg_path) }}"
                        class="w-32 md:w-48 h-auto object-contain" style="filter: brightness(0%) contrast(100%);">
                </div>
            </div>
        @endif
    </main>

    @include('layouts.footer')
</body>

</html>
