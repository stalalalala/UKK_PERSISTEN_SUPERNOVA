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

    <div class="max-w-[1440px] mx-auto">
        <nav class="flex justify-between items-center bg-gray-100 rounded-full mx-4 md:mx-10 mt-4">
            <div class="w-20 md:w-28 h-12 bg-blue-400 rounded-full flex-shrink-0"></div>

            <ul class="hidden lg:flex gap-12 text-gray-800 font-medium text-sm">
                <li><a href="/" class="font-medium hover:text-blue-500">Beranda</a></li>
                <li><a href="/streak" class="hover:text-blue-500 cursor-pointer">Pet Streak</a></li>
                <li><a href="/tryout" class="hover:text-blue-500 cursor-pointer">Try Out</a></li>
                <li><a href="/latihan" class="hover:text-blue-500 cursor-pointer">Latihan Soal</a></li>
                <li><a href="/video" class="hover:text-blue-500 font-bold cursor-pointer">Video Pembelajaran</a></li>
            </ul>

            <div class="flex gap-2">
                <div class="flex items-center gap-3 bg-[#FBBA16] rounded-full">
                    <button
                        class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#3171CD] flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-5 md:size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </button>
                    <button
                        class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#4B8A81] flex items-center justify-center text-white">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
        </svg>
                    </button>
                </div>
            </div>
        </nav>
    </div>

    <main class="max-w-[1440px] mx-auto py-10" x-data="{
        selectedSub: 'PU',
        currentPage: 1
    }">

        <section class="px-4 md:px-10 mb-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-[#2E3B66]">Subtes Video Pembelajaran</h1>
            <p class="text-gray-500 mt-2">Tentukan materi yang ingin kamu pelajari dan mulai tonton videonya sekarang!
            </p>
        </section>

        <section class="px-4 md:px-10 mb-12">
            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-5">

                <div @click="selectedSub = 'PU'; currentPage = 1"
                    class="rounded-[35px] w-full h-full text-white shadow-lg transition-all duration-300 cursor-pointer text-center p-4 border-4 bg-[#FEA33A]"
                    :class="selectedSub === 'PU' ? 'border-blue-400 scale-105 ring-4 ring-blue-100 opacity-100' :
                        'border-transparent opacity-80 hover:opacity-100 hover:-translate-y-2'">
                    <div
                        class="w-14 h-14 md:w-16 md:h-16 bg-white/30 rounded-full mx-auto flex items-center justify-center font-bold text-xl mb-3">
                        PU</div>
                    <p class="font-medium text-xs md:text-sm">Mulai <br>
                        Latihan!</p>
                </div>

                <div @click="selectedSub = 'PBM'; currentPage = 1"
                    class="rounded-[35px] w-full h-full text-white shadow-lg transition-all duration-300 cursor-pointer text-center p-4 border-4 bg-[#9885FB]"
                    :class="selectedSub === 'PBM' ? 'border-blue-400 scale-105 ring-4 ring-blue-100 opacity-100' :
                        'border-transparent opacity-80 hover:opacity-100 hover:-translate-y-2'">
                    <div
                        class="w-14 h-14 md:w-16 md:h-16 bg-white/30 rounded-full mx-auto flex items-center justify-center font-bold text-xl mb-3">
                        PBM</div>
                    <p class="font-medium text-xs md:text-sm">Mulai <br>
                        Latihan!</p>
                </div>

                <div @click="selectedSub = 'PPU'; currentPage = 1"
                    class="rounded-[35px] w-full h-full text-white shadow-lg transition-all duration-300 cursor-pointer text-center p-4 border-4 bg-[#FF908E]"
                    :class="selectedSub === 'PPU' ? 'border-blue-400 scale-105 ring-4 ring-blue-100 opacity-100' :
                        'border-transparent opacity-80 hover:opacity-100 hover:-translate-y-2'">
                    <div
                        class="w-14 h-14 md:w-16 md:h-16 bg-white/30 rounded-full mx-auto flex items-center justify-center font-bold text-xl mb-3">
                        PPU</div>
                    <p class="font-medium text-xs md:text-sm">Mulai <br>
                        Latihan!</p>
                </div>

                <div @click="selectedSub = 'PK'; currentPage = 1"
                    class="rounded-[35px] w-full h-full text-white shadow-lg transition-all duration-300 cursor-pointer text-center p-4 border-4 bg-[#4CAA60]"
                    :class="selectedSub === 'PK' ? 'border-blue-400 scale-105 ring-4 ring-blue-100 opacity-100' :
                        'border-transparent opacity-80 hover:opacity-100 hover:-translate-y-2'">
                    <div
                        class="w-14 h-14 md:w-16 md:h-16 bg-white/30 rounded-full mx-auto flex items-center justify-center font-bold text-xl mb-3">
                        PK</div>
                    <p class="font-medium text-xs md:text-sm">Mulai <br>
                        Latihan!</p>
                </div>

                <div @click="selectedSub = 'PM'; currentPage = 1"
                    class="rounded-[35px] w-full h-full text-white shadow-lg transition-all duration-300 cursor-pointer text-center p-4 border-4 bg-[#CEA4EC]"
                    :class="selectedSub === 'PM' ? 'border-blue-400 scale-105 ring-4 ring-blue-100 opacity-100' :
                        'border-transparent opacity-80 hover:opacity-100 hover:-translate-y-2'">
                    <div
                        class="w-14 h-14 md:w-16 md:h-16 bg-white/30 rounded-full mx-auto flex items-center justify-center font-bold text-xl mb-3">
                        PM</div>
                    <p class="font-medium text-xs md:text-sm">Mulai <br>
                        Latihan!</p>
                </div>

                <div @click="selectedSub = 'LBI'; currentPage = 1"
                    class="rounded-[35px] w-full h-full text-white shadow-lg transition-all duration-300 cursor-pointer text-center p-4 border-4 bg-[#A5BBEC]"
                    :class="selectedSub === 'LBI' ? 'border-blue-400 scale-105 ring-4 ring-blue-100 opacity-100' :
                        'border-transparent opacity-80 hover:opacity-100 hover:-translate-y-2'">
                    <div
                        class="w-14 h-14 md:w-16 md:h-16 bg-white/30 rounded-full mx-auto flex items-center justify-center font-bold text-xl mb-3">
                        LBI</div>
                    <p class="font-medium text-xs md:text-sm">Mulai <br>
                        Latihan!</p>
                </div>

                <div @click="selectedSub = 'LBE'; currentPage = 1"
                    class="rounded-[35px] w-full h-full text-white shadow-lg transition-all duration-300 cursor-pointer text-center p-4 border-4 bg-[#4B8A81]"
                    :class="selectedSub === 'LBE' ? 'border-blue-400 scale-105 ring-4 ring-blue-100 opacity-100' :
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

        <div x-show="currentPage === 1"
            class="border-2 border-blue-400 rounded-[2.5rem] p-6 flex flex-col sm:flex-row gap-6 hover:shadow-xl transition-all group">
            <div class="flex-1 flex flex-col justify-between">
                <div>
                    <h3 class="text-blue-600 font-bold text-xl mb-3" x-text="selectedSub + ' - Set 1'"></h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 text-blue-500 font-semibold"><i
                                class="fa-solid fa-book-open"></i><span>Kalimat Efektif</span></div>
                        <div class="flex items-center gap-3 text-blue-500 font-semibold"><i
                                class="fa-regular fa-clock"></i><span>10.55</span></div>
                    </div>
                </div>
                <div class="mt-6">
                    <span class="bg-[#FF6B6B] text-white text-xs px-5 py-2 rounded-full font-bold shadow-sm">Belum Ditonton</span>
                </div>
            </div>
            <div class="w-full sm:w-56 h-36 bg-gray-100 rounded-3xl overflow-hidden relative">
                <iframe src="https://www.youtube.com/embed/cX8sNF9ExDw?si=L0I_1bc2bKOKJceV" 
                    title="YouTube video player" frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen class="w-full h-full object-cover"></iframe>
            </div>
        </div>

        <div x-show="currentPage === 1"
            class="border-2 border-blue-400 rounded-[2.5rem] p-6 flex flex-col sm:flex-row gap-6 hover:shadow-xl transition-all group">
            <div class="flex-1 flex flex-col justify-between">
                <div>
                    <h3 class="text-blue-600 font-bold text-xl mb-3" x-text="selectedSub + ' - Set 2'"></h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 text-blue-500 font-semibold"><i
                                class="fa-solid fa-book-open"></i><span>Paragraf Padu</span></div>
                        <div class="flex items-center gap-3 text-blue-500 font-semibold"><i
                                class="fa-regular fa-clock"></i><span>08:45</span></div>
                    </div>
                </div>
                <div class="mt-6">
                    <span class="bg-green-500 text-white text-xs px-5 py-2 rounded-full font-bold shadow-sm">Sudah Ditonton</span>
                </div>
            </div>
            <div class="w-full sm:w-56 h-36 bg-gray-100 rounded-3xl overflow-hidden relative">
                <iframe src="https://www.youtube.com/embed/cX8sNF9ExDw?si=L0I_1bc2bKOKJceV" 
                    title="YouTube video player" frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen class="w-full h-full object-cover"></iframe>
            </div>
        </div>

        <div x-show="currentPage === 1"
            class="border-2 border-blue-400 rounded-[2.5rem] p-6 flex flex-col sm:flex-row gap-6 hover:shadow-xl transition-all group">
            <div class="flex-1 flex flex-col justify-between">
                <div>
                    <h3 class="text-blue-600 font-bold text-xl mb-3" x-text="selectedSub + ' - Set 3'"></h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 text-blue-500 font-semibold"><i
                                class="fa-solid fa-book-open"></i><span>Kalimat Efektif</span></div>
                        <div class="flex items-center gap-3 text-blue-500 font-semibold"><i
                                class="fa-regular fa-clock"></i><span>10.55</span></div>
                    </div>
                </div>
                <div class="mt-6">
                    <span class="bg-[#FF6B6B] text-white text-xs px-5 py-2 rounded-full font-bold shadow-sm">Belum Ditonton</span>
                </div>
            </div>
            <div class="w-full sm:w-56 h-36 bg-gray-100 rounded-3xl overflow-hidden relative">
                <iframe src="https://www.youtube.com/embed/cX8sNF9ExDw?si=L0I_1bc2bKOKJceV" 
                    title="YouTube video player" frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen class="w-full h-full object-cover"></iframe>
            </div>
        </div>

        <div x-show="currentPage === 1"
            class="border-2 border-blue-400 rounded-[2.5rem] p-6 flex flex-col sm:flex-row gap-6 hover:shadow-xl transition-all group">
            <div class="flex-1 flex flex-col justify-between">
                <div>
                    <h3 class="text-blue-600 font-bold text-xl mb-3" x-text="selectedSub + ' - Set 4'"></h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 text-blue-500 font-semibold"><i
                                class="fa-solid fa-book-open"></i><span>Paragraf Padu</span></div>
                        <div class="flex items-center gap-3 text-blue-500 font-semibold"><i
                                class="fa-regular fa-clock"></i><span>08:45</span></div>
                    </div>
                </div>
                <div class="mt-6">
                    <span class="bg-green-500 text-white text-xs px-5 py-2 rounded-full font-bold shadow-sm">Sudah Ditonton</span>
                </div>
            </div>
            <div class="w-full sm:w-56 h-36 bg-gray-100 rounded-3xl overflow-hidden relative">
                <iframe src="https://www.youtube.com/embed/cX8sNF9ExDw?si=L0I_1bc2bKOKJceV" 
                    title="YouTube video player" frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen class="w-full h-full object-cover"></iframe>
            </div>
        </div>

        <div x-show="currentPage === 2"
            class="border-2 border-blue-400 rounded-[2.5rem] p-6 flex flex-col sm:flex-row gap-6 hover:shadow-xl transition-all group">
            <div class="flex-1 flex flex-col justify-between">
                <div>
                    <h3 class="text-blue-600 font-bold text-xl mb-3" x-text="selectedSub + ' - Set 5'"></h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 text-blue-500 font-semibold"><i
                                class="fa-solid fa-book-open"></i><span>Simpulan Teks</span></div>
                        <div class="flex items-center gap-3 text-blue-500 font-semibold"><i
                                class="fa-regular fa-clock"></i><span>15:10</span></div>
                    </div>
                </div>
                <div class="mt-6">
                    <span class="bg-[#FF6B6B] text-white text-xs px-5 py-2 rounded-full font-bold shadow-sm">Belum Ditonton</span>
                </div>
            </div>
            <div class="w-full sm:w-56 h-36 bg-gray-100 rounded-3xl overflow-hidden relative">
                <iframe src="https://www.youtube.com/embed/cX8sNF9ExDw?si=L0I_1bc2bKOKJceV" 
                    title="YouTube video player" frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen class="w-full h-full object-cover"></iframe>
            </div>
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
