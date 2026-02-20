<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERSISTEN - Kuis</title>

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
                <li><a href="/" class="font-bold hover:text-blue-500">Kuis Fundamental</a></li>

            </ul>

            <div class="flex items-center  gap-2">
                <div class="flex items-center gap-2 bg-[#FBBA16] rounded-full">
                    <a href="/profile/index"
                        class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#3171CD] flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-5 md:size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </a>
                    <button
                        class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#4B8A81] flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg>
                    </button>
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

    <main class="max-w-[1440px] mx-auto py-10" x-data="{
        selectedSub: 'Kuis Fundamental',
        currentPage: 1
    }">

        <section class="px-4 md:px-10 mb-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-[#2E3B66]">Kuis Fundamental</h1>
            <p class="text-gray-500 mt-2">Tentukan materi fundamental yang ingin kamu latih dan mulai kerjakan kuis
                sekarang!</p>
        </section>

        <div class="px-4 md:px-10">
            <hr class="my-12 border-gray-300">
        </div>

        <section class="px-4 md:px-10">


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">

                @foreach ($allKuis as $k)
                    <div
                        class="bg-white border-2 border-gray-100 rounded-[2.5rem] p-6 relative group hover:border-blue-300 hover:shadow-xl transition-all duration-300">
                        <div class="flex justify-between items-start mb-6">
                            <div class="space-y-1">
                                <h4 class="font-bold text-blue-900 text-lg">Kuis Fundamental - Set
                                    {{ $k->set_ke }}</h4>
                                <span
                                    class="bg-blue-100 text-blue-600 text-[10px] font-semibold px-3 py-1 rounded-full uppercase">
                                    {{ $k->kategori ?? 'KUIS' }}
                                </span>
                            </div>
                            <span
                                class="bg-orange-50 text-orange-500 text-[10px] font-bold px-3 py-1 rounded-full">Belum</span>
                        </div>

                        <div class="space-y-3 text-gray-500 text-sm mb-4">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-file-signature text-blue-500"></i>
                                <span>{{ $k->questions_count ?? '20' }} Soal</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-stopwatch text-blue-500"></i>
                                <span>{{ $k->durasi }} Menit</span>
                            </div>
                        </div>

                        <a href="{{ route('kuis.intruksi', $k->id) }}"
                            class="block text-center w-full mt-2 py-3 bg-blue-50 text-blue-600 font-bold rounded-2xl group-hover:bg-blue-500 group-hover:text-white transition-colors">
                            Kerjakan Sekarang
                        </a>
                    </div>
                @endforeach


            </div>
            <div class="flex justify-center items-center gap-3 mt-16 mb-10">
                {{-- Tombol Previous --}}
                @if ($allKuis->onFirstPage())
                    <span
                        class="w-10 h-10 rounded-full border border-gray-200 text-gray-300 flex items-center justify-center cursor-not-allowed">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                    </span>
                @else
                    <a href="{{ $allKuis->previousPageUrl() }}"
                        class="w-10 h-10 rounded-full border border-gray-200 text-gray-400 hover:bg-blue-500 hover:text-white flex items-center justify-center transition-all">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                    </a>
                @endif

                {{-- Nomor Halaman --}}
                @foreach ($allKuis->getUrlRange(1, $allKuis->lastPage()) as $page => $url)
                    <a href="{{ $url }}"
                        class="w-10 h-10 rounded-full font-bold flex items-center justify-center transition-all {{ $page == $allKuis->currentPage() ? 'bg-blue-500 text-white shadow-lg shadow-blue-200' : 'text-blue-500 hover:bg-blue-50' }}">
                        {{ $page }}
                    </a>
                @endforeach

                {{-- Tombol Next --}}
                @if ($allKuis->hasMorePages())
                    <a href="{{ $allKuis->nextPageUrl() }}"
                        class="w-10 h-10 rounded-full border border-gray-200 text-gray-400 hover:bg-blue-500 hover:text-white flex items-center justify-center transition-all">
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

    @include('layouts.footer')

</body>

</html>
