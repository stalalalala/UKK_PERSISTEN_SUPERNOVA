<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERSISTEN - Try Out</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-white min-h-screen" x-data="{
    currentPage: 1,
    itemsPerPage: 8,
    allTO: Array.from({ length: 24 }, (_, i) => ({ id: i + 1 })),
    get totalPages() { return Math.ceil(this.allTO.length / this.itemsPerPage); },
    get paginatedTO() {
        let start = (this.currentPage - 1) * this.itemsPerPage;
        return this.allTO.slice(start, start + this.itemsPerPage);
    }
}">

    <div class="max-w-[1440px] mx-auto">
        <nav class="flex justify-between items-center bg-gray-100 rounded-full mx-4 md:mx-10 mt-4">
            <div class="w-20 md:w-28 h-12 bg-blue-400 rounded-full flex-shrink-0"></div>

            <ul class="hidden lg:flex gap-12 text-gray-800 font-medium text-sm">
                <li><a href="/" class="font-medium hover:text-blue-500">Beranda</a></li>
                <li><a href="/streak" class="hover:text-blue-500 cursor-pointer">Pet Streak</a></li>
                <li><a href="/tryout" class="hover:text-blue-500 font-bold cursor-pointer">Try Out</a></li>
                <li><a href="/latihan" class="hover:text-blue-500 cursor-pointer">Latihan Soal</a></li>
                <li><a href="/video" class="hover:text-blue-500 cursor-pointer">Video Pembelajaran</a></li>
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

    <main class="max-w-[1440px] mx-auto px-4 md:px-10 py-8">

       <section x-data="{ 
    openUniv: false, 
    openJurusan: false, 
    univSelected: 'Universitas Indonesia',
    jurusanSelected: 'Teknik Informatika'
}" class="border-2 border-gray-200 rounded-[2.5rem] p-6 mb-8 grid grid-cols-1 lg:grid-cols-3 gap-6 items-center">
    
    <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
        
        <div class="relative">
            <div @click="openUniv = !openUniv; openJurusan = false" 
                class="border border-gray-200 rounded-[2rem] px-6 py-8 cursor-pointer hover:border-blue-300 transition-all bg-white shadow-sm">
                <p class="text-gray-500 text-sm font-semibold mb-1">Pilih Universitas</p>
                <div class="flex justify-between items-center font-bold text-lg text-[#2E3B66]">
                    <span x-text="univSelected"></span>
                    <i class="fa-solid fa-chevron-down text-gray-400 text-sm transition-transform" :class="openUniv ? 'rotate-180' : ''"></i>
                </div>
            </div>

            <div x-show="openUniv" @click.away="openUniv = false" x-cloak
                class="absolute z-50 w-full mt-2 bg-white border border-gray-100 rounded-[1.5rem] shadow-xl max-h-60 overflow-y-auto p-2">
                <div class="p-2 border-b mb-2">
                    <input type="text" placeholder="Cari Univ..." class="w-full p-2 text-sm bg-slate-50 rounded-lg outline-none border-none focus:ring-1 focus:ring-blue-400">
                </div>
                <div @click="univSelected = 'Universitas Indonesia'; openUniv = false" class="p-3 hover:bg-blue-50 rounded-xl cursor-pointer text-sm font-medium text-slate-700">Universitas Indonesia</div>
                <div @click="univSelected = 'Institut Teknologi Bandung'; openUniv = false" class="p-3 hover:bg-blue-50 rounded-xl cursor-pointer text-sm font-medium text-slate-700">Institut Teknologi Bandung</div>
                <div @click="univSelected = 'Universitas Gadjah Mada'; openUniv = false" class="p-3 hover:bg-blue-50 rounded-xl cursor-pointer text-sm font-medium text-slate-700">Universitas Gadjah Mada</div>
                <div @click="univSelected = 'Universitas Airlangga'; openUniv = false" class="p-3 hover:bg-blue-50 rounded-xl cursor-pointer text-sm font-medium text-slate-700">Universitas Airlangga</div>
                <div @click="univSelected = 'Universitas Padjadjaran'; openUniv = false" class="p-3 hover:bg-blue-50 rounded-xl cursor-pointer text-sm font-medium text-slate-700">Universitas Padjadjaran</div>
            </div>
        </div>

        <div class="relative">
            <div @click="openJurusan = !openJurusan; openUniv = false" 
                class="border border-gray-200 rounded-[2rem] px-6 py-8 cursor-pointer hover:border-blue-300 transition-all bg-white shadow-sm">
                <p class="text-gray-500 text-sm font-semibold mb-1">Pilih Jurusan</p>
                <div class="flex justify-between items-center font-bold text-lg text-[#2E3B66]">
                    <span x-text="jurusanSelected"></span>
                    <i class="fa-solid fa-chevron-down text-gray-400 text-sm transition-transform" :class="openJurusan ? 'rotate-180' : ''"></i>
                </div>
            </div>

            <div x-show="openJurusan" @click.away="openJurusan = false" x-cloak
                class="absolute z-50 w-full mt-2 bg-white border border-gray-100 rounded-[1.5rem] shadow-xl max-h-60 overflow-y-auto p-2">
                <div class="p-2 border-b mb-2">
                    <input type="text" placeholder="Cari Jurusan..." class="w-full p-2 text-sm bg-slate-50 rounded-lg outline-none border-none focus:ring-1 focus:ring-blue-400">
                </div>
                <div @click="jurusanSelected = 'Teknik Informatika'; openJurusan = false" class="p-3 hover:bg-blue-50 rounded-xl cursor-pointer text-sm font-medium text-slate-700">Teknik Informatika</div>
                <div @click="jurusanSelected = 'Sistem Informasi'; openJurusan = false" class="p-3 hover:bg-blue-50 rounded-xl cursor-pointer text-sm font-medium text-slate-700">Sistem Informasi</div>
                <div @click="jurusanSelected = 'Ilmu Komunikasi'; openJurusan = false" class="p-3 hover:bg-blue-50 rounded-xl cursor-pointer text-sm font-medium text-slate-700">Ilmu Komunikasi</div>
                <div @click="jurusanSelected = 'Kedokteran'; openJurusan = false" class="p-3 hover:bg-blue-50 rounded-xl cursor-pointer text-sm font-medium text-slate-700">Kedokteran</div>
                <div @click="jurusanSelected = 'Psikologi'; openJurusan = false" class="p-3 hover:bg-blue-50 rounded-xl cursor-pointer text-sm font-medium text-slate-700">Psikologi</div>
            </div>
        </div>

    </div>

    <div class="bg-blue-500 rounded-[2rem] p-5 text-white relative overflow-hidden shadow-lg shadow-blue-200">
        <div class="flex justify-between items-center mb-3">
            <span class="font-medium text-xl">Peluang Lolos</span>
            <span class="text-3xl font-semibold">60%</span>
        </div>
        <div class="w-full bg-blue-700/40 h-5 rounded-full flex p-1 border border-white/20">
            <div class="bg-white w-[60%] h-full rounded-full shadow-sm transition-all duration-1000"></div>
        </div>
        <p class="text-md mt-3 opacity-90">Hasil dari 2 sesi Try Out!</p>
    </div>
</section>

        <section class="border-2 border-gray-200 rounded-[3rem] p-8 md:p-10 mb-20">
            <div class="mb-10">
                <h2 class="text-3xl font-black text-[#2E3B66]">Try Out UTBK</h2>
                <p class="text-gray-500 font-medium">Simulasikan ujian UTBK mu dengan berbagai sesi Try Out disini!</p>
            </div>

            <div x-show="currentPage === 1" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" x-transition>
                <div
                    class="bg-blue-50 rounded-[2rem] p-6 flex flex-col items-center relative hover:shadow-lg transition-all border border-blue-100 group">
                    <div class="w-full flex justify-between items-start mb-2">
                        <span class="text-blue-400 font-bold pt-1 text-lg uppercase tracking-tighter">Try Out</span>
                        <span class="bg-blue-600 text-white text-lg px-4 py-1 rounded-full font-bold">UTBK</span>
                    </div>
                    <div
                        class="text-[100px] font-black text-blue-500 leading-none my-6 group-hover:scale-110 transition-transform">
                        1</div>
                    <div
                        class="bg-white px-4 py-1.5 rounded-full flex items-center gap-2 text-sm font-medium text-blue-500 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                        <span>Selesai</span>
                    </div>
                </div>

                <div
                    class="bg-blue-50 rounded-[2rem] p-6 flex flex-col items-center relative hover:shadow-lg transition-all border border-blue-100 group">
                    <div class="w-full flex justify-between items-start mb-2">
                        <span class="text-blue-400 font-bold pt-1 text-lg uppercase tracking-tighter">Try Out</span>
                        <span class="bg-blue-600 text-white text-lg px-4 py-1 rounded-full font-bold">UTBK</span>
                    </div>
                    <div
                        class="text-[100px] font-black text-blue-500 leading-none my-6 group-hover:scale-110 transition-transform">
                        2</div>
                    <div
                        class="bg-white px-4 py-1.5 rounded-full flex items-center gap-2 text-sm font-medium text-blue-500 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                        <span>20-27 Maret</span>
                    </div>
                </div>

                <div
                    class="bg-gray-50 opacity-60 rounded-[2rem] p-6 flex flex-col items-center relative border border-gray-200">
                    <div class="w-full flex justify-between items-start mb-2">
                        <span class="text-gray-400 font-bold pt-1 text-lg uppercase tracking-tighter">Try Out</span>
                        <span class="bg-gray-400 text-white text-lg px-4 py-1 rounded-full font-bold">UTBK</span>
                    </div>
                    <div class="text-[100px] font-black text-gray-300 leading-none my-6">3</div>
                    <div
                        class="bg-white px-4 py-1.5 rounded-full flex items-center gap-2 text-sm font-medium text-gray-400 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>

                        <span>Belum Tersedia</span>
                    </div>
                </div>

                <div
                    class="bg-gray-50 opacity-60 rounded-[2rem] p-6 flex flex-col items-center relative border border-gray-200">
                    <div class="w-full flex justify-between items-start mb-2">
                        <span class="text-gray-400 font-bold pt-1 text-lg uppercase tracking-tighter">Try Out</span>
                        <span class="bg-gray-400 text-white text-lg px-4 py-1 rounded-full font-bold">UTBK</span>
                    </div>
                    <div class="text-[100px] font-black text-gray-300 leading-none my-6">4</div>
                    <div
                        class="bg-white px-4 py-1.5 rounded-full flex items-center gap-2 text-sm font-medium text-gray-400 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>

                        <span>Belum Tersedia</span>
                    </div>
                </div>

                <div
                    class="bg-gray-50 opacity-60 rounded-[2rem] p-6 flex flex-col items-center relative border border-gray-200">
                    <div class="w-full flex justify-between items-start mb-2">
                        <span class="text-gray-400 font-bold pt-1 text-lg uppercase tracking-tighter">Try Out</span>
                        <span class="bg-gray-400 text-white text-lg px-4 py-1 rounded-full font-bold">UTBK</span>
                    </div>
                    <div class="text-[100px] font-black text-gray-300 leading-none my-6">5</div>
                    <div
                        class="bg-white px-4 py-1.5 rounded-full flex items-center gap-2 text-sm font-medium text-gray-400 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>

                        <span>Belum Tersedia</span>
                    </div>
                </div>

                <div
                    class="bg-gray-50 opacity-60 rounded-[2rem] p-6 flex flex-col items-center relative border border-gray-200">
                    <div class="w-full flex justify-between items-start mb-2">
                        <span class="text-gray-400 font-bold pt-1 text-lg uppercase tracking-tighter">Try Out</span>
                        <span class="bg-gray-400 text-white text-lg px-4 py-1 rounded-full font-bold">UTBK</span>
                    </div>
                    <div class="text-[100px] font-black text-gray-300 leading-none my-6">6</div>
                    <div
                        class="bg-white px-4 py-1.5 rounded-full flex items-center gap-2 text-sm font-medium text-gray-400 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>

                        <span>Belum Tersedia</span>
                    </div>
                </div>

                <div
                    class="bg-gray-50 opacity-60 rounded-[2rem] p-6 flex flex-col items-center relative border border-gray-200">
                    <div class="w-full flex justify-between items-start mb-2">
                        <span class="text-gray-400 font-bold pt-1 text-lg uppercase tracking-tighter">Try Out</span>
                        <span class="bg-gray-400 text-white text-lg px-4 py-1 rounded-full font-bold">UTBK</span>
                    </div>
                    <div class="text-[100px] font-black text-gray-300 leading-none my-6">7</div>
                    <div
                        class="bg-white px-4 py-1.5 rounded-full flex items-center gap-2 text-sm font-medium text-gray-400 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>

                        <span>Belum Tersedia</span>
                    </div>
                </div>

                <div
                    class="bg-gray-50 opacity-60 rounded-[2rem] p-6 flex flex-col items-center relative border border-gray-200">
                    <div class="w-full flex justify-between items-start mb-2">
                        <span class="text-gray-400 font-bold pt-1 text-lg uppercase tracking-tighter">Try Out</span>
                        <span class="bg-gray-400 text-white text-lg px-4 py-1 rounded-full font-bold">UTBK</span>
                    </div>
                    <div class="text-[100px] font-black text-gray-300 leading-none my-6">8</div>
                    <div
                        class="bg-white px-4 py-1.5 rounded-full flex items-center gap-2 text-sm font-medium text-gray-400 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>

                        <span>Belum Tersedia</span>
                    </div>
                </div>

            </div>

            <div x-show="currentPage === 2" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" x-cloak
                x-transition>
                <div
                    class="bg-gray-50 opacity-60 rounded-[2rem] p-6 flex flex-col items-center relative border border-gray-200">
                    <div class="w-full flex justify-between items-start mb-2">
                        <span class="text-gray-400 font-bold pt-1 text-lg uppercase tracking-tighter">Try Out</span>
                        <span class="bg-gray-400 text-white text-lg px-4 py-1 rounded-full font-bold">UTBK</span>
                    </div>
                    <div class="text-[100px] font-black text-gray-300 leading-none my-6">9</div>
                    <div
                        class="bg-white px-4 py-1.5 rounded-full flex items-center gap-2 text-sm font-medium text-gray-400 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>

                        <span>Belum Tersedia</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-center items-center gap-3 mt-16">
                <button @click="if(currentPage > 1) currentPage--"
                    class="w-10 h-10 rounded-full border border-gray-200 text-gray-400 hover:bg-blue-500 hover:text-white transition-colors">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </button>

                <button @click="currentPage = 1"
                    :class="currentPage === 1 ? 'bg-blue-500 text-white shadow-lg' : 'text-blue-500 hover:bg-blue-50'"
                    class="w-10 h-10 rounded-full font-bold transition-all">1</button>

                <button @click="currentPage = 2"
                    :class="currentPage === 2 ? 'bg-blue-500 text-white shadow-lg' : 'text-blue-500 hover:bg-blue-50'"
                    class="w-10 h-10 rounded-full font-bold transition-all">2</button>

                <button @click="currentPage = 3"
                    :class="currentPage === 3 ? 'bg-blue-500 text-white shadow-lg' : 'text-blue-500 hover:bg-blue-50'"
                    class="w-10 h-10 rounded-full font-bold transition-all">3</button>

                <button @click="if(currentPage < 3) currentPage++"
                    class="w-10 h-10 rounded-full border border-gray-200 text-gray-400 hover:bg-blue-500 hover:text-white transition-colors">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </button>
            </div>
        </section>
    </main>

    @include('layouts.footer')

</body>

</html>
