<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERSISTEN - Profile</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite('resources/css/app.css')
</head>

<body class="font-po bg-white overflow-x-hidden">

    <div class="max-w-[1440px] mx-auto" x-data="{ open: false }">
        <nav class="flex justify-between items-center bg-gray-100 rounded-full mx-4 md:mx-10 mt-4 relative z-10">
            <div class="w-20 md:w-28 h-12 bg-blue-400 rounded-full flex-shrink-0"></div>

            <ul class="hidden lg:flex gap-12 text-gray-800 font-medium text-sm">
                <li><a href="/" class=" hover:text-blue-500">Beranda</a></li>
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

    <main class="flex-1 p-4 md:p-10 max-w-[1440px] mx-auto py-10 w-full space-y-6">

        <section
            class="bg-[#f0f5ff] rounded-[35px] p-6 md:p-10 flex flex-col md:flex-row items-center gap-8 relative overflow-hidden">
            <div class="absolute top-4 left-1/4 w-3 h-3 bg-yellow-400 rounded-sm rotate-12 opacity-60"></div>
            <div class="absolute bottom-10 right-1/4 w-3 h-3 bg-orange-400 transform rotate-45 opacity-60"></div>

            <div class="flex flex-col items-center gap-2 shrink-0">
                <div class="w-32 h-32 md:w-40 md:h-40 rounded-full border-8 border-white overflow-hidden shadow-sm">
                    <img @if ($user->photo) src="{{ asset('storage/' . $user->photo) }}"  
            @else  
                src="https://via.placeholder.com/150?text=Belum+ada+foto" @endif
                        alt="Profile" class="w-full h-full object-cover">
                </div>
                <h2 class="text-xl pt-2 font-bold text-[#2e3b66]">{{ $user->name }}</h2>
                <p class="text-xs text-gray-500 font-medium">{{ $user->email }}</p>
            </div>

            <div class="flex-1 w-full overflow-hidden rounded-[30px] shadow-xs border border-gray-100">

                <div class="bg-[#4375D1] p-8 pb-16 relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="absolute top-20 -left-10 w-32 h-32 bg-blue-400/20 rounded-full blur-xl"></div>

                    <i
                        class="fa-solid fa-graduation-cap absolute -bottom-5 right-10 text-9xl text-white/5 -rotate-12"></i>

                    <div class="flex justify-between items-start text-white relative z-10">
                        <div class="flex items-center gap-6">


                            <div>
                                <div class="flex items-center gap-2">
                                    <h3 class="text-3xl font-bold tracking-tight">{{ $user->name }}</h3>

                                </div>
                                <p class="text-sm opacity-80 flex items-center gap-2 mt-1">
                                    <i class="fa-regular fa-envelope opacity-70"></i> {{ $user->email }}
                                </p>

                                <div class="flex gap-4 mt-3">

                                    <div
                                        class="text-[11px] bg-white/10 px-3 py-1 rounded-full border border-white/10 backdrop-blur-sm">
                                        <span class="opacity-70 font-light">Bergabung:</span>
                                        {{ $user->created_at->format('d M Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="/profile/edit">
                            <button
                                class="bg-white hover:bg-white text-[#4375D1] px-5 py-2.5 rounded-full text-sm font-bold flex items-center gap-2 transition-all duration-300 backdrop-blur-md border border-white/20 shadow-lg">
                                <i class="fa-regular fa-pen-to-square"></i> Edit Profil
                            </button>
                        </a>
                    </div>
                </div>

                <div class="bg-white p-8 pt-0 relative">
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 pt-5">

                        <div class="bg-white px-4 py-8 rounded-[24px] border border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-[#fea33a]/10 rounded-2xl flex items-center justify-center">
                                    <i class="fa-solid fa-chart-simple text-2xl text-[#fea33a]"></i>
                                </div>
                                <div>
                                    <p class="text-3xl font-bold text-slate-800">
                                        {{ $tryoutTerbaru->skor ?? 0 }}
                                    </p>
                                    <p
                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-wider leading-tight">
                                        Tryout Terbaru
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white px-4 py-8 rounded-[24px] border border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-[#ff908e]/10 rounded-2xl flex items-center justify-center">
                                    <i class="fa-solid fa-award text-2xl text-[#ff908e]"></i>
                                </div>
                                <div>
                                    <p class="text-3xl font-bold text-slate-800">
                                        {{ $tryoutTerbesar->skor ?? 0 }}
                                    </p>
                                    <p
                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-wider leading-tight">
                                        Tryout Terbesar
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white px-4 py-8 rounded-[24px] border border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-[#9885FB]/10 rounded-2xl flex items-center justify-center">
                                    <i class="fa-solid fa-fire text-2xl text-[#9885FB]"></i>
                                </div>
                                <div>
                                    <p class="text-3xl font-bold text-slate-800">
                                        {{ $user->streak_days ?? 0 }}
                                    </p>
                                    <p
                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-wider leading-tight">
                                        Hari Streak
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white px-4 py-8 rounded-[24px] border border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-[#4caa60]/10 rounded-2xl flex items-center justify-center">
                                    <i class="fa-solid fa-calendar-check text-2xl text-[#4caa60]"></i>
                                </div>
                                <div>
                                    <p class="text-3xl font-bold text-slate-800">
                                        {{ $user->total_xp ?? 0 }}
                                    </p>
                                    <p
                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-wider leading-tight">
                                        Jumlah XP
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </section>

        <section class="bg-white border-2 border-gray-100 rounded-[35px] p-8">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-bold text-[#2e3b66]">Aktivitas</h3>
                <a href="{{ route('log.index') }}"
                    class="text-blue-500 text-xs font-bold uppercase hover:underline">Lihat
                    semua
                    aktivitas</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($activities as $act)
                    <div
                        class="bg-gradient-to-br from-[#F2F7FE] to-white border border-gray-100 rounded-3xl p-6 
    shadow-sm hover:shadow-lg hover:-translate-y-1 transition duration-300 
    h-full flex flex-col justify-between group">

                        <!-- HEADER -->
                        <div class="flex items-start gap-4 mb-4">

                            <!-- ICON -->
                            <div
                                class="w-11 h-11 rounded-xl flex items-center justify-center text-white font-bold text-xs shrink-0
            group-hover:scale-110 transition
            @if ($act['type'] == 'tryout') bg-red-500
            @elseif($act['type'] == 'kuis') bg-purple-500
            @else bg-orange-400 @endif">

                                @if ($act['type'] == 'tryout')
                                    TO
                                @elseif($act['type'] == 'kuis')
                                    K
                                @else
                                    L
                                @endif
                            </div>

                            <!-- TITLE -->
                            <div class="flex-1">
                                <h4 class="font-semibold text-[#2e3b66] text-sm leading-snug">
                                    {{ $act['title'] }}
                                </h4>

                                <div class="flex items-center gap-2 mt-1">
                                    <!-- TYPE BADGE -->
                                    <span
                                        class="text-[10px] px-2 py-0.5 rounded-full font-medium
                    @if ($act['type'] == 'tryout') bg-red-100 text-red-600
                    @elseif($act['type'] == 'kuis') bg-purple-100 text-purple-600
                    @else bg-orange-100 text-orange-600 @endif">

                                        {{ ucfirst($act['type']) }}
                                    </span>

                                    <p class="text-[10px] text-gray-400">
                                        Aktivitas pengguna
                                    </p>
                                </div>
                            </div>

                        </div>

                        <!-- FOOTER -->
                        <div class="border-t border-gray-100 pt-4 flex items-center justify-between">

                            <!-- SKOR -->
                            <div>
                                <p class="text-[10px] text-gray-400">Skor</p>
                                <p class="text-lg font-bold text-blue-600 leading-none">
                                    {{ $act['skor'] }}
                                </p>
                            </div>

                            <!-- TANGGAL -->
                            <div class="text-right">
                                <p class="text-[10px] text-gray-400">Waktu</p>
                                <p class="text-xs text-gray-600">
                                    @if ($act['tanggal'])
                                        {{ \Carbon\Carbon::parse($act['tanggal'])->format('d M Y') }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>

                        </div>

                    </div>

                @empty
                    <p class="text-gray-500">Belum ada aktivitas</p>
                @endforelse
            </div>
        </section>
    </main>

</body>

</html>
