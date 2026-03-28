<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivitas | PERSISTEN</title>

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

        <section x-data="{ tab: 'all' }" class="bg-white border-2 border-gray-100 rounded-[35px] p-8">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-bold text-[#2e3b66]">Aktivitas</h3>
                <div class="flex gap-2 mb-6">

                    <!-- SEMUA -->
                    <button @click="tab='all'"
                        :class="tab === 'all' ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-500'"
                        class="px-4 py-2 rounded-full text-xs font-semibold transition">
                        Semua
                    </button>

                    <!-- TRYOUT -->
                    <button @click="tab='tryout'"
                        :class="tab === 'tryout' ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-500'"
                        class="px-4 py-2 rounded-full text-xs font-semibold transition">
                        Tryout
                    </button>

                    <!-- KUIS -->
                    <button @click="tab='kuis'"
                        :class="tab === 'kuis' ? 'bg-purple-500 text-white' : 'bg-gray-100 text-gray-500'"
                        class="px-4 py-2 rounded-full text-xs font-semibold transition">
                        Kuis
                    </button>

                    <!-- LATIHAN -->
                    <button @click="tab='latihan'"
                        :class="tab === 'latihan' ? 'bg-orange-400 text-white' : 'bg-gray-100 text-gray-500'"
                        class="px-4 py-2 rounded-full text-xs font-semibold transition">
                        Latihan
                    </button>

                </div>
                <p class="text-gray-400 text-xs font-bold hover:underline uppercase">
                    Menampilkan {{ $activities->total() }} aktivitas
                </p>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-stretch">
                @forelse($activities as $act)
                    <template x-if="tab === 'all' || tab === '{{ $act->type }}'">
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
            @if ($act->type == 'tryout') bg-red-500
            @elseif($act->type == 'kuis') bg-purple-500
            @else bg-orange-400 @endif">

                                    @if ($act->type == 'tryout')
                                        TO
                                    @elseif($act->type == 'kuis')
                                        K
                                    @else
                                        L
                                    @endif
                                </div>

                                <!-- TITLE -->
                                <div class="flex-1">
                                    <h4 class="font-semibold text-[#2e3b66] text-sm leading-snug">
                                        {{ $act->title }}
                                    </h4>

                                    <div class="flex items-center gap-2 mt-1">
                                        <!-- TYPE BADGE -->
                                        <span
                                            class="text-[10px] px-2 py-0.5 rounded-full font-medium
                    @if ($act->type == 'tryout') bg-red-100 text-red-600
                    @elseif($act->type == 'kuis') bg-purple-100 text-purple-600
                    @else bg-orange-100 text-orange-600 @endif">

                                            {{ ucfirst($act->type) }}
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
                                        {{ $act->skor }}
                                    </p>
                                </div>

                                <!-- TANGGAL -->
                                <div class="text-right">
                                    <p class="text-[10px] text-gray-400">Waktu</p>
                                    <p class="text-xs text-gray-600">
                                        @if ($act->tanggal)
                                            {{ \Carbon\Carbon::parse($act->tanggal)->format('d M Y') }}
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>

                            </div>

                        </div>
                    </template>


                @empty
                    <p class="text-gray-500">Belum ada aktivitas</p>
                @endforelse

            </div>

            {{-- PAGINATION --}}
            <div class="flex justify-center items-center gap-3 mt-16 mb-10">

                @if ($activities->onFirstPage())
                    <span
                        class="w-10 h-10 rounded-full border border-gray-200 text-gray-300 flex items-center justify-center cursor-not-allowed">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                    </span>
                @else
                    <a href="{{ $activities->previousPageUrl() }}"
                        class="w-10 h-10 rounded-full border border-gray-200 text-gray-400 hover:bg-blue-500 hover:text-white flex items-center justify-center">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                    </a>
                @endif

                @foreach ($activities->getUrlRange(1, $activities->lastPage()) as $page => $url)
                    <a href="{{ $url }}"
                        class="w-10 h-10 rounded-full font-bold flex items-center justify-center {{ $page == $activities->currentPage() ? 'bg-blue-500 text-white' : 'text-blue-500 hover:bg-blue-50' }}">
                        {{ $page }}
                    </a>
                @endforeach

                @if ($activities->hasMorePages())
                    <a href="{{ $activities->nextPageUrl() }}"
                        class="w-10 h-10 rounded-full border border-gray-200 text-gray-400 hover:bg-blue-500 hover:text-white flex items-center justify-center">
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </a>
                @else
                    <span
                        class="w-10 h-10 rounded-full border border-gray-200 text-gray-300 flex items-center justify-center cursor-not-allowed">
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </span>
                @endif

            </div>
        </section>
    </main>

</body>

</html>
