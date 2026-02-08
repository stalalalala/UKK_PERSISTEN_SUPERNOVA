<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERSISTEN - Latihan Soal</title>

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
                <li><a href="/latihan" class="hover:text-blue-500 font-bold cursor-pointer">Kuis Fundamental</a></li>
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
                        <svg xmlns="http://www.w3.org/2000/xml" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-5 md:size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
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
            <h1 class="text-3xl md:text-4xl font-extrabold text-[#2E3B66]">Kuis Fundamental</h1>
            <p class="text-gray-500 mt-2">Tentukan materi fundamental yang ingin kamu latih dan mulai kerjakan kuis
                sekarang!</p>
        </section>

        <div class="px-4 md:px-10">
            <hr class="my-12 border-gray-300">
        </div>

        <section class="px-4 md:px-10">


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">

                <div x-show="currentPage === 1"
                    class="bg-white border-2 border-gray-100 rounded-[2.5rem] p-6 relative group hover:border-blue-300 hover:shadow-xl transition-all duration-300">
                    <div class="flex justify-between items-start mb-6">
                        <div class="space-y-1">
                            <h4 class="font-bold text-blue-900 text-lg" x-text="selectedSub + ' - Set 1'"></h4>
                            <span
                                class="bg-blue-100 text-blue-600 text-[10px] font-semibold px-3 py-1 rounded-full">LATSOL</span>
                        </div>
                        <span
                            class="bg-orange-50 text-orange-500 text-[10px] font-bold px-3 py-1 rounded-full">Belum</span>
                    </div>
                    <div class="space-y-3 text-gray-500 text-sm mb-4">
                        <div class="flex items-center gap-3"><i
                                class="fa-solid fa-file-signature text-blue-500"></i><span>20 Soal</span></div>
                        <div class="flex items-center gap-3"><i class="fa-solid fa-stopwatch text-blue-500"></i><span>30
                                Menit</span></div>
                    </div>
                    <a :href="'/soal-' + selectedSub.toLowerCase() + '.html?set=1'"
                        class="block text-center w-full mt-2 py-3 bg-blue-50 text-blue-600 font-bold rounded-2xl group-hover:bg-blue-500 group-hover:text-white transition-colors">
                        Kerjakan Sekarang
                    </a>
                </div>

                <div x-show="currentPage === 1"
                    class="bg-white border-2 border-gray-100 rounded-[2.5rem] p-6 relative group hover:border-blue-300 hover:shadow-xl transition-all duration-300">
                    <div class="flex justify-between items-start mb-6">
                        <div class="space-y-1">
                            <h4 class="font-bold text-blue-900 text-lg" x-text="selectedSub + ' - Set 2'"></h4><span
                                class="bg-blue-100 text-blue-600 text-[10px] font-semibold px-3 py-1 rounded-full">LATSOL</span>
                        </div>
                        <span
                            class="bg-orange-50 text-orange-500 text-[10px] font-bold px-3 py-1 rounded-full">Belum</span>
                    </div>
                    <div class="space-y-3 text-gray-500 text-sm mb-4">
                        <div class="flex items-center gap-3"><i
                                class="fa-solid fa-file-signature text-blue-500"></i><span>20 Soal</span></div>
                        <div class="flex items-center gap-3"><i class="fa-solid fa-stopwatch text-blue-500"></i><span>30
                                Menit</span></div>
                    </div>
                    <a :href="'/soal-' + selectedSub.toLowerCase() + '.html?set=2'"
                        class="block text-center w-full mt-2 py-3 bg-blue-50 text-blue-600 font-bold rounded-2xl group-hover:bg-blue-500 group-hover:text-white transition-colors">Kerjakan
                        Sekarang</a>
                </div>

                <div x-show="currentPage === 1"
                    class="bg-white border-2 border-gray-100 rounded-[2.5rem] p-6 relative group hover:border-blue-300 hover:shadow-xl transition-all duration-300">
                    <div class="flex justify-between items-start mb-6">
                        <div class="space-y-1">
                            <h4 class="font-bold text-blue-900 text-lg" x-text="selectedSub + ' - Set 3'"></h4><span
                                class="bg-blue-100 text-blue-600 text-[10px] font-semibold px-3 py-1 rounded-full">LATSOL</span>
                        </div>
                        <span
                            class="bg-green-100 text-green-600 text-[10px] font-bold px-3 py-1 rounded-full">Selesai</span>
                    </div>
                    <div class="space-y-3 text-gray-500 text-sm mb-4">
                        <div class="flex items-center gap-3"><i
                                class="fa-solid fa-file-signature text-blue-500"></i><span>20 Soal</span></div>
                        <div class="flex items-center gap-3"><i class="fa-solid fa-stopwatch text-blue-500"></i><span>30
                                Menit</span></div>
                    </div>
                    <a :href="'/soal-' + selectedSub.toLowerCase() + '.html?set=3'"
                        class="block text-center w-full mt-2 py-3 bg-blue-50 text-blue-600 font-bold rounded-2xl group-hover:bg-blue-500 group-hover:text-white transition-colors">Kerjakan
                        Sekarang</a>
                </div>

                <div x-show="currentPage === 1"
                    class="bg-white border-2 border-gray-100 rounded-[2.5rem] p-6 relative group hover:border-blue-300 hover:shadow-xl transition-all duration-300">
                    <div class="flex justify-between items-start mb-6">
                        <div class="space-y-1">
                            <h4 class="font-bold text-blue-900 text-lg" x-text="selectedSub + ' - Set 4'"></h4><span
                                class="bg-blue-100 text-blue-600 text-[10px] font-semibold px-3 py-1 rounded-full">LATSOL</span>
                        </div>
                        <span
                            class="bg-orange-50 text-orange-500 text-[10px] font-bold px-3 py-1 rounded-full">Belum</span>
                    </div>
                    <div class="space-y-3 text-gray-500 text-sm mb-4">
                        <div class="flex items-center gap-3"><i
                                class="fa-solid fa-file-signature text-blue-500"></i><span>20 Soal</span></div>
                        <div class="flex items-center gap-3"><i class="fa-solid fa-stopwatch text-blue-500"></i><span>30
                                Menit</span></div>
                    </div>
                    <a :href="'/soal-' + selectedSub.toLowerCase() + '.html?set=4'"
                        class="block text-center w-full mt-2 py-3 bg-blue-50 text-blue-600 font-bold rounded-2xl group-hover:bg-blue-500 group-hover:text-white transition-colors">Kerjakan
                        Sekarang</a>
                </div>

                <div x-show="currentPage === 1"
                    class="bg-white border-2 border-gray-100 rounded-[2.5rem] p-6 relative group hover:border-blue-300 hover:shadow-xl transition-all duration-300">
                    <div class="flex justify-between items-start mb-6">
                        <div class="space-y-1">
                            <h4 class="font-bold text-blue-900 text-lg" x-text="selectedSub + ' - Set 5'"></h4>
                            <span
                                class="bg-blue-100 text-blue-600 text-[10px] font-semibold px-3 py-1 rounded-full">LATSOL</span>
                        </div>
                        <span
                            class="bg-orange-50 text-orange-500 text-[10px] font-bold px-3 py-1 rounded-full">Belum</span>
                    </div>
                    <div class="space-y-3 text-gray-500 text-sm mb-4">
                        <div class="flex items-center gap-3"><i
                                class="fa-solid fa-file-signature text-blue-500"></i><span>20 Soal</span></div>
                        <div class="flex items-center gap-3"><i
                                class="fa-solid fa-stopwatch text-blue-500"></i><span>30 Menit</span></div>
                    </div>
                    <a :href="'/soal-' + selectedSub.toLowerCase() + '.html?set=1'"
                        class="block text-center w-full mt-2 py-3 bg-blue-50 text-blue-600 font-bold rounded-2xl group-hover:bg-blue-500 group-hover:text-white transition-colors">
                        Kerjakan Sekarang
                    </a>
                </div>

                <div x-show="currentPage === 1"
                    class="bg-white border-2 border-gray-100 rounded-[2.5rem] p-6 relative group hover:border-blue-300 hover:shadow-xl transition-all duration-300">
                    <div class="flex justify-between items-start mb-6">
                        <div class="space-y-1">
                            <h4 class="font-bold text-blue-900 text-lg" x-text="selectedSub + ' - Set 6'"></h4><span
                                class="bg-blue-100 text-blue-600 text-[10px] font-semibold px-3 py-1 rounded-full">LATSOL</span>
                        </div>
                        <span
                            class="bg-orange-50 text-orange-500 text-[10px] font-bold px-3 py-1 rounded-full">Belum</span>
                    </div>
                    <div class="space-y-3 text-gray-500 text-sm mb-4">
                        <div class="flex items-center gap-3"><i
                                class="fa-solid fa-file-signature text-blue-500"></i><span>20 Soal</span></div>
                        <div class="flex items-center gap-3"><i
                                class="fa-solid fa-stopwatch text-blue-500"></i><span>30 Menit</span></div>
                    </div>
                    <a :href="'/soal-' + selectedSub.toLowerCase() + '.html?set=2'"
                        class="block text-center w-full mt-2 py-3 bg-blue-50 text-blue-600 font-bold rounded-2xl group-hover:bg-blue-500 group-hover:text-white transition-colors">Kerjakan
                        Sekarang</a>
                </div>

                <div x-show="currentPage === 2"
                    class="bg-white border-2 border-gray-100 rounded-[2.5rem] p-6 relative group hover:border-blue-300 hover:shadow-xl transition-all duration-300">
                    <div class="flex justify-between items-start mb-6">
                        <div class="space-y-1">
                            <h4 class="font-bold text-blue-900 text-lg" x-text="selectedSub + ' - Set 7'"></h4><span
                                class="bg-blue-100 text-blue-600 text-[10px] font-semibold px-3 py-1 rounded-full">LATSOL</span>
                        </div>
                        <span
                            class="bg-green-100 text-green-600 text-[10px] font-bold px-3 py-1 rounded-full">Selesai</span>
                    </div>
                    <div class="space-y-3 text-gray-500 text-sm mb-4">
                        <div class="flex items-center gap-3"><i
                                class="fa-solid fa-file-signature text-blue-500"></i><span>20 Soal</span></div>
                        <div class="flex items-center gap-3"><i
                                class="fa-solid fa-stopwatch text-blue-500"></i><span>30 Menit</span></div>
                    </div>
                    <a :href="'/soal-' + selectedSub.toLowerCase() + '.html?set=3'"
                        class="block text-center w-full mt-2 py-3 bg-blue-50 text-blue-600 font-bold rounded-2xl group-hover:bg-blue-500 group-hover:text-white transition-colors">Kerjakan
                        Sekarang</a>
                </div>

                <div x-show="currentPage === 2"
                    class="bg-white border-2 border-gray-100 rounded-[2.5rem] p-6 relative group hover:border-blue-300 hover:shadow-xl transition-all duration-300">
                    <div class="flex justify-between items-start mb-6">
                        <div class="space-y-1">
                            <h4 class="font-bold text-blue-900 text-lg" x-text="selectedSub + ' - Set 8'"></h4><span
                                class="bg-blue-100 text-blue-600 text-[10px] font-semibold px-3 py-1 rounded-full">LATSOL</span>
                        </div>
                        <span
                            class="bg-orange-50 text-orange-500 text-[10px] font-bold px-3 py-1 rounded-full">Belum</span>
                    </div>
                    <div class="space-y-3 text-gray-500 text-sm mb-4">
                        <div class="flex items-center gap-3"><i
                                class="fa-solid fa-file-signature text-blue-500"></i><span>20 Soal</span></div>
                        <div class="flex items-center gap-3"><i
                                class="fa-solid fa-stopwatch text-blue-500"></i><span>30 Menit</span></div>
                    </div>
                    <a :href="'/soal-' + selectedSub.toLowerCase() + '.html?set=4'"
                        class="block text-center w-full mt-2 py-3 bg-blue-50 text-blue-600 font-bold rounded-2xl group-hover:bg-blue-500 group-hover:text-white transition-colors">Kerjakan
                        Sekarang</a>
                </div>


                <div x-show="currentPage === 2"
                    class="bg-white border-2 border-gray-100 rounded-[2.5rem] p-6 relative group hover:border-blue-300 hover:shadow-xl transition-all duration-300">
                    <div class="flex justify-between items-start mb-6">
                        <div class="space-y-1">
                            <h4 class="font-bold text-blue-900 text-lg" x-text="selectedSub + ' - Set 9'"></h4><span
                                class="bg-blue-100 text-blue-600 text-[10px] font-semibold px-3 py-1 rounded-full">LATSOL</span>
                        </div>
                        <span
                            class="bg-orange-50 text-orange-500 text-[10px] font-bold px-3 py-1 rounded-full">Belum</span>
                    </div>
                    <div class="space-y-3 text-gray-500 text-sm mb-4">
                        <div class="flex items-center gap-3"><i
                                class="fa-solid fa-file-signature text-blue-500"></i><span>20 Soal</span></div>
                        <div class="flex items-center gap-3"><i
                                class="fa-solid fa-stopwatch text-blue-500"></i><span>30 Menit</span></div>
                    </div>
                    <a :href="'/soal-' + selectedSub.toLowerCase() + '.html?set=5'"
                        class="block text-center w-full mt-2 py-3 bg-blue-50 text-blue-600 font-bold rounded-2xl group-hover:bg-blue-500 group-hover:text-white transition-colors">Kerjakan
                        Sekarang</a>
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
