<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERSISTEN - Video Pembelajaran</title>

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
                <li><a href="/" class="hover:text-blue-500">Beranda</a></li>
                <li><a href="{{ route('streak.index') }}" class="hover:text-blue-500">Pet Streak</a></li>
                <li><a href="{{ route('tryout.index') }}" class="font-bold hover:text-blue-500">Try Out</a></li>
                <li><a href="{{ route('latihan.index') }}" class="hover:text-blue-500">Latihan Soal</a></li>
                <li><a href="{{ route('video.index') }}" class="hover:text-blue-500">Video Pembelajaran</a></li>
            </ul>

            <div class="flex items-center gap-2">
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
        selectedSub: 'Penalaran Umum',
        currentPage: 1
    }">

        <section class="px-4 md:px-10 mb-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-[#2E3B66]">Subtes Video Pembelajaran</h1>
            <p class="text-gray-500 mt-2">Tentukan materi yang ingin kamu pelajari dan mulai tonton videonya sekarang!
            </p>
        </section>

        <section class="px-4 md:px-10 mb-12">
            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-5">

                <div @click="selectedSub = 'Penalaran Umum'; currentPage = 1"
                    class="rounded-[35px] w-full h-full text-white shadow-lg transition-all duration-300 cursor-pointer text-center p-4 border-4 bg-[#FEA33A]"
                    :class="selectedSub === 'Penalaran Umum' ? 'border-blue-400 scale-105 ring-4 ring-blue-100 opacity-100' :
                        'border-transparent opacity-80 hover:opacity-100 hover:-translate-y-2'">
                    <div
                        class="w-14 h-14 md:w-16 md:h-16 bg-white/30 rounded-full mx-auto flex items-center justify-center font-bold text-xl mb-3">
                        PU</div>
                    <p class="font-medium text-xs md:text-sm">Mulai <br>
                        Latihan!</p>
                </div>

                <div @click="selectedSub = 'Pemahaman Bacaan dan Menulis'; currentPage = 1"
                    class="rounded-[35px] w-full h-full text-white shadow-lg transition-all duration-300 cursor-pointer text-center p-4 border-4 bg-[#9885FB]"
                    :class="selectedSub === 'Pemahaman Bacaan dan Menulis' ? 'border-blue-400 scale-105 ring-4 ring-blue-100 opacity-100' :
                        'border-transparent opacity-80 hover:opacity-100 hover:-translate-y-2'">
                    <div
                        class="w-14 h-14 md:w-16 md:h-16 bg-white/30 rounded-full mx-auto flex items-center justify-center font-bold text-xl mb-3">
                        PBM</div>
                    <p class="font-medium text-xs md:text-sm">Mulai <br>
                        Latihan!</p>
                </div>

                <div @click="selectedSub = 'Pengetahuan dan Pemahaman Umum'; currentPage = 1"
                    class="rounded-[35px] w-full h-full text-white shadow-lg transition-all duration-300 cursor-pointer text-center p-4 border-4 bg-[#FF908E]"
                    :class="selectedSub === 'Pengetahuan dan Pemahaman Umum' ? 'border-blue-400 scale-105 ring-4 ring-blue-100 opacity-100' :
                        'border-transparent opacity-80 hover:opacity-100 hover:-translate-y-2'">
                    <div
                        class="w-14 h-14 md:w-16 md:h-16 bg-white/30 rounded-full mx-auto flex items-center justify-center font-bold text-xl mb-3">
                        PPU</div>
                    <p class="font-medium text-xs md:text-sm">Mulai <br>
                        Latihan!</p>
                </div>

                <div @click="selectedSub = 'Pengetahuan Kuantitatif'; currentPage = 1"
                    class="rounded-[35px] w-full h-full text-white shadow-lg transition-all duration-300 cursor-pointer text-center p-4 border-4 bg-[#4CAA60]"
                    :class="selectedSub === 'Pengetahuan Kuantitatif' ? 'border-blue-400 scale-105 ring-4 ring-blue-100 opacity-100' :
                        'border-transparent opacity-80 hover:opacity-100 hover:-translate-y-2'">
                    <div
                        class="w-14 h-14 md:w-16 md:h-16 bg-white/30 rounded-full mx-auto flex items-center justify-center font-bold text-xl mb-3">
                        PK</div>
                    <p class="font-medium text-xs md:text-sm">Mulai <br>
                        Latihan!</p>
                </div>

                <div @click="selectedSub = 'Penalaran Matematika'; currentPage = 1"
                    class="rounded-[35px] w-full h-full text-white shadow-lg transition-all duration-300 cursor-pointer text-center p-4 border-4 bg-[#CEA4EC]"
                    :class="selectedSub === 'Penalaran Matematika' ? 'border-blue-400 scale-105 ring-4 ring-blue-100 opacity-100' :
                        'border-transparent opacity-80 hover:opacity-100 hover:-translate-y-2'">
                    <div
                        class="w-14 h-14 md:w-16 md:h-16 bg-white/30 rounded-full mx-auto flex items-center justify-center font-bold text-xl mb-3">
                        PM</div>
                    <p class="font-medium text-xs md:text-sm">Mulai <br>
                        Latihan!</p>
                </div>

                <div @click="selectedSub = 'Literasi dalam Bahasa Indonesia'; currentPage = 1"
                    class="rounded-[35px] w-full h-full text-white shadow-lg transition-all duration-300 cursor-pointer text-center p-4 border-4 bg-[#A5BBEC]"
                    :class="selectedSub === 'Literasi dalam Bahasa Indonesia' ? 'border-blue-400 scale-105 ring-4 ring-blue-100 opacity-100' :
                        'border-transparent opacity-80 hover:opacity-100 hover:-translate-y-2'">
                    <div
                        class="w-14 h-14 md:w-16 md:h-16 bg-white/30 rounded-full mx-auto flex items-center justify-center font-bold text-xl mb-3">
                        LBI</div>
                    <p class="font-medium text-xs md:text-sm">Mulai <br>
                        Latihan!</p>
                </div>

                <div @click="selectedSub = 'Literasi dalam Bahasa Inggris'; currentPage = 1"
                    class="rounded-[35px] w-full h-full text-white shadow-lg transition-all duration-300 cursor-pointer text-center p-4 border-4 bg-[#4B8A81]"
                    :class="selectedSub === 'Literasi dalam Bahasa Inggris' ? 'border-blue-400 scale-105 ring-4 ring-blue-100 opacity-100' :
                        'border-transparent opacity-80 hover:opacity-100 hover:-translate-y-2'">
                    <div
                        class="w-14 h-14 md:w-16 md:h-16 bg-white/30 rounded-full mx-auto flex items-center justify-center font-bold text-xl mb-3">
                        LBE</div>
                    <p class="font-medium text-xs md:text-sm">Mulai <br>
                        Latihan!</p>
                </div>

            </div>
        </section>

        <div class="px-4 md:px-10">
            <hr class="mb-12 border-gray-300">
        </div>

        <section class="px-4 md:px-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                @foreach($videos as $video)
        <div 
            x-show="selectedSub === '{{ $video->subtes }}'"
            x-transition
            class="border-2 border-blue-400 rounded-[2.5rem] p-6 flex flex-col sm:flex-row gap-6 hover:shadow-xl transition-all group">

            <div class="flex-1 flex flex-col justify-between">
                <div>
                    <h3 class="text-blue-600 font-bold text-xl mb-3">
                        {{ $video->subtes }}
                    </h3>

                    <div class="space-y-3">
                        <div class="flex items-center gap-3 text-blue-500 font-semibold">
                            <i class="fa-solid fa-book-open"></i>
                            <span>{{ $video->judul_video }}</span>
                        </div>

                        <div class="flex items-center gap-3 text-blue-500 font-semibold">
                            
                            <span>Video Pembelajaran</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <span class="bg-[#FF6B6B] text-white text-xs px-5 py-2 rounded-full font-bold shadow-sm">
                        Belum Ditonton
                    </span>
                </div>
            </div>

            <div class="w-full sm:w-56 h-36 rounded-3xl overflow-hidden bg-gray-100 relative">
        <div class="absolute inset-0">
            {!! preg_replace(
                ['/width=".*?"/', '/height=".*?"/'],
                ['width="100%"', 'height="100%"'],
                $video->iframe
            ) !!}
        </div>
    </div>


        </div>
    @endforeach

                </div>

            </div>

            <div class="flex justify-center items-center gap-3 mt-16">
                <button @click="if(currentPage > 1) currentPage--"
                    class="w-10 h-10 rounded-full border border-gray-200 text-gray-400 hover:bg-blue-500 hover:text-white">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </button>

                <button @click="currentPage = 1"
                    :class="currentPage === 1 ? 'bg-blue-500 text-white shadow-lg' : 'text-blue-500 hover:bg-blue-50'"
                    class="w-10 h-10 rounded-full font-bold">1</button>

                <button @click="currentPage = 2"
                    :class="currentPage === 2 ? 'bg-blue-500 text-white shadow-lg' : 'text-blue-500 hover:bg-blue-50'"
                    class="w-10 h-10 rounded-full font-bold">2</button>

                <button @click="if(currentPage < 2) currentPage++"
                    class="w-10 h-10 rounded-full border border-gray-200 text-gray-400 hover:bg-blue-500 hover:text-white">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </button>
            </div>
        </section>
    </main>
    @include('layouts.footer')


</body>

</html>
