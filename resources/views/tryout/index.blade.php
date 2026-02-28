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
        body { font-family: 'Poppins', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="bg-white min-h-screen" x-data="{
    currentPage: 1,
    itemsPerPage: 8,
    /* Logika: is_open hanya true jika tersedia DAN belum pernah dikerjakan */
    allTO: {{ $tryouts->map(function($t, $index) use ($userResults) {
        $sudahDikerjakan = $userResults->contains('tryout_id', $t->id);
        return [
            'id' => $t->id,
            'nomor' => $index + 1,
            'nama' => $t->nama_tryout,
            'is_open' => (bool)$t->is_available && !$sudahDikerjakan, 
            'sudah_dikerjakan' => $sudahDikerjakan,
            'tanggal' => $t->tanggal ? $t->tanggal->format('d-M') : '-',
            'tanggal_akhir' => $t->tanggal_akhir ? $t->tanggal_akhir->format('d-M') : '-',
            'url_mengerjakan' => route('tryout.intruksi', $t->id),
            'url_hasil' => route('tryout.hasil', $t->id)
        ];
    })->toJson() }},
    get totalPages() { return Math.ceil(this.allTO.length / this.itemsPerPage) || 1; },
    get paginatedTO() {
        let start = (this.currentPage - 1) * this.itemsPerPage;
        return this.allTO.slice(start, start + this.itemsPerPage);
    }
}">

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
                    <a href="{{ route('profile.index') }}" class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#3171CD] flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 md:size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#4B8A81] flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" /></svg>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </div>

    <main class="max-w-[1440px] mx-auto px-4 md:px-10 py-8">
        <section x-data="{ openUniv: false, openJurusan: false, univSelected: 'Universitas Indonesia', jurusanSelected: 'Teknik Informatika' }" class="border-2 border-gray-200 rounded-[2.5rem] p-6 mb-8 grid grid-cols-1 lg:grid-cols-3 gap-6 items-center">
            <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="relative">
                    <div @click="openUniv = !openUniv; openJurusan = false" class="border border-gray-200 rounded-[2rem] px-6 py-8 cursor-pointer hover:border-blue-300 transition-all bg-white shadow-sm">
                        <p class="text-gray-500 text-sm font-semibold mb-1">Pilih Universitas</p>
                        <div class="flex justify-between items-center font-bold text-lg text-[#2E3B66]">
                            <span x-text="univSelected"></span>
                            <i class="fa-solid fa-chevron-down text-gray-400 text-sm transition-transform" :class="openUniv ? 'rotate-180' : ''"></i>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div @click="openJurusan = !openJurusan; openUniv = false" class="border border-gray-200 rounded-[2rem] px-6 py-8 cursor-pointer hover:border-blue-300 transition-all bg-white shadow-sm">
                        <p class="text-gray-500 text-sm font-semibold mb-1">Pilih Jurusan</p>
                        <div class="flex justify-between items-center font-bold text-lg text-[#2E3B66]">
                            <span x-text="jurusanSelected"></span>
                            <i class="fa-solid fa-chevron-down text-gray-400 text-sm transition-transform" :class="openJurusan ? 'rotate-180' : ''"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-blue-500 rounded-[2rem] p-5 text-white relative overflow-hidden shadow-lg shadow-blue-200">
                <div class="flex justify-between items-center mb-3"><span class="font-medium text-xl">Peluang Lolos</span><span class="text-3xl font-semibold">60%</span></div>
                <div class="w-full bg-blue-700/40 h-5 rounded-full flex p-1 border border-white/20"><div class="bg-white w-[60%] h-full rounded-full transition-all duration-1000"></div></div>
                <p class="text-md mt-3 opacity-90">Hasil dari 2 sesi Try Out!</p>
            </div>
        </section>

        <section class="border-2 border-gray-200 rounded-[3rem] p-8 md:p-10 mb-20">
            <div class="mb-10">
                <h2 class="text-3xl font-black text-[#2E3B66]">Try Out UTBK</h2>
                <p class="text-gray-500 font-medium">Simulasikan ujian UTBK mu dengan berbagai sesi Try Out disini!</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <template x-for="to in paginatedTO" :key="to.id">
                    <a :href="to.is_open ? to.url_mengerjakan : (to.sudah_dikerjakan ? to.url_hasil : '#')">
                        <div :class="to.is_open ? 'bg-blue-50 border-blue-100 hover:shadow-lg' : (to.sudah_dikerjakan ? 'bg-emerald-50 border-emerald-100 hover:shadow-lg' : 'bg-gray-50 opacity-60 border-gray-200 cursor-not-allowed')"
                            class="rounded-[2rem] p-6 flex flex-col items-center relative transition-all group border">
                            
                            <div class="w-full flex justify-between items-start mb-2">
                                <span :class="to.is_open ? 'text-blue-400' : (to.sudah_dikerjakan ? 'text-emerald-400' : 'text-gray-400')" class="font-bold pt-1 text-lg uppercase tracking-tighter">Try Out</span>
                                <span :class="to.is_open ? 'bg-blue-600' : (to.sudah_dikerjakan ? 'bg-emerald-600' : 'bg-gray-400')" class="text-white text-lg px-4 py-1 rounded-full font-bold">UTBK</span>
                            </div>
                            
                            <div :class="to.is_open ? 'text-blue-500 group-hover:scale-110' : (to.sudah_dikerjakan ? 'text-emerald-500 group-hover:scale-110' : 'text-gray-300')" 
                                 class="text-[100px] font-black leading-none mt-6 mb-1 transition-transform" x-text="to.nomor"></div>
                            
                            <div class="w-full mb-6 text-center">
                                <div :class="to.is_open ? 'text-[#2E3B66]' : (to.sudah_dikerjakan ? 'text-[#2E3B66]' : 'text-gray-400')" 
                                     class="text-sm font-black uppercase tracking-[0.15em] line-clamp-2 px-2" 
                                     x-text="to.nama">
                                </div>
                            </div>

                            <div class="bg-white px-4 py-1.5 rounded-full flex items-center gap-2 text-sm font-medium shadow-sm w-full justify-center" 
                                 :class="to.is_open ? 'text-blue-500' : (to.sudah_dikerjakan ? 'text-emerald-500' : 'text-gray-400')">
                                
                                <template x-if="to.is_open">
                                    <i class="fa-solid fa-clock text-[10px]"></i>
                                </template>
                                <template x-if="to.sudah_dikerjakan">
                                    <i class="fa-solid fa-circle-check text-[10px]"></i>
                                </template>
                                <template x-if="!to.is_open && !to.sudah_dikerjakan">
                                    <i class="fa-solid fa-lock text-[10px]"></i>
                                </template>

                                <span class="text-[11px] font-bold" x-text="to.is_open ? (to.tanggal + ' - ' + to.tanggal_akhir) : (to.sudah_dikerjakan ? 'Lihat Hasil' : 'Belum Tersedia')"></span>
                            </div>
                        </div>
                    </a>
                </template>
            </div>

            <div class="flex justify-center items-center gap-3 mt-16" x-show="totalPages > 1">
                <button @click="if(currentPage > 1) currentPage--" class="w-10 h-10 rounded-full border border-gray-200 text-gray-400 hover:bg-blue-500 hover:text-white transition-colors"><i class="fa-solid fa-chevron-left text-xs"></i></button>
                <template x-for="page in totalPages" :key="page">
                    <button @click="currentPage = page" :class="currentPage === page ? 'bg-blue-500 text-white shadow-lg' : 'text-blue-500 hover:bg-blue-50'" class="w-10 h-10 rounded-full font-bold transition-all" x-text="page"></button>
                </template>
                <button @click="if(currentPage < totalPages) currentPage++" class="w-10 h-10 rounded-full border border-gray-200 text-gray-400 hover:bg-blue-500 hover:text-white transition-colors"><i class="fa-solid fa-chevron-right text-xs"></i></button>
            </div>
        </section>
    </main>

    @include('layouts.footer')
</body>
</html>