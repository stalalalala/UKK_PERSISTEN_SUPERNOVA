<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERSISTEN - Hasil Try Out</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        details summary::-webkit-details-marker { display: none; }
    </style>
</head>
<body class="font-po bg-slate-50 text-slate-900 antialiased">
    <div x-data="{ 
        activeCategory: null,
        allAnswers: {{ $userAnswers->toJson() }},
        showModal: false,
        init() {
            Object.keys(localStorage).forEach(key => {
                if (key.includes('jawaban_to_') || key.includes('last_soal_') || key.includes('jeda_timer_')) {
                    localStorage.removeItem(key);
                }
            });
            window.history.pushState(null, null, window.location.href);
            window.onpopstate = () => {
                this.showModal = true;
                window.history.pushState(null, null, window.location.href);
            };
        }
    }" x-init="init()" class="min-h-screen">

        <div class="container mx-auto max-w-7xl px-4 md:px-6 lg:px-8 py-6 md:py-10 space-y-6">
            
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
                <h1 class="text-xl md:text-3xl font-extrabold text-slate-800 tracking-tight">
                    Hasil <span class="text-blue-600">{{ $tryout->nama_tryout }}</span>
                </h1>
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <a href="{{ route('tryout.sertifikat', $tryout->id) }}" 
                       target="_blank" 
                       class="w-full sm:w-auto bg-emerald-600 text-white px-8 py-3.5 rounded-2xl font-bold shadow-md hover:bg-emerald-700 transition-colors duration-200 active:scale-[0.98] text-center flex items-center justify-center gap-2.5">
                        <i class="fa-solid fa-print text-lg"></i>
                        <span>Cetak Sertifikat</span>
                    </a>
                    
                    <button @click="showModal = true" 
                            class="w-full sm:w-auto bg-blue-600 text-white px-8 py-3.5 rounded-2xl font-bold shadow-md hover:bg-blue-700 transition-colors duration-200 active:scale-[0.98]">
                        Kembali Ke Menu
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <div class="lg:col-span-4 bg-[#3171CD] rounded-[2.5rem] p-8 text-white flex flex-col justify-between shadow-xl min-h-[420px]">
                    <div>
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="font-black uppercase tracking-widest text-[10px] text-blue-100">Top Rankings</h3>
                            <i class="fa-solid fa-trophy text-yellow-400"></i>
                        </div>
                        
                        <div class="space-y-3">
                            @for($i = 0; $i < 3; $i++)
                                @php $rank = $rankings->get($i); @endphp
                                <div class="flex items-center justify-between bg-white/10 p-4 rounded-2xl border border-white/10 backdrop-blur-sm transition-all hover:bg-white/20">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center font-black text-[#3171CD] text-[10px]">
                                            @if($i == 0) <i class="fa-solid fa-crown text-yellow-500 text-sm"></i> @else #{{ $i + 1 }} @endif
                                        </div>
                                        <span class="text-xs font-bold truncate max-w-[150px]">
                                            {{ $rank ? ($rank->user->name ?? 'User') : 'Belum ada data' }}
                                        </span>
                                    </div>
                                    <span class="text-xs font-black">{{ $rank ? number_format($rank->skor_total, 0) : '-' }}</span>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <div class="mt-6 pt-5 border-t border-white/20">
                        <div class="flex justify-between items-end mb-4 px-2">
                            <div>
                                <span class="text-[9px] font-black uppercase text-blue-100 block mb-1">Peringkat Anda</span>
                                <span class="text-3xl font-black italic tracking-tighter">Rank #{{ $userRankNumber }}</span>
                            </div>
                            <div class="text-right">
                                <span class="text-[9px] font-black uppercase text-blue-100 block mb-1">Skor Anda</span>
                                <p class="text-3xl font-black tracking-tighter">{{ $skorTotal }}</p>
                            </div>
                        </div>
                        <a href="{{ route('tryout.ranking', $tryout->id) }}" class="w-full bg-white text-[#3171CD] py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest text-center block shadow-lg hover:bg-blue-50 transition">
                            Lihat Selengkapnya <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-8 bg-white rounded-[2.5rem] p-6 md:p-8 border border-slate-100 shadow-sm flex flex-col justify-center">
                    <h3 class="text-lg font-bold text-slate-700 mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-chart-pie text-blue-500"></i> Ringkasan Performa
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-slate-50 p-4 rounded-3xl border border-slate-100 text-center">
                            <p class="text-[10px] text-slate-400 font-bold uppercase mb-1">Benar</p>
                            <p class="text-2xl font-black text-green-500">{{ $benar }}</p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-3xl border border-slate-100 text-center">
                            <p class="text-[10px] text-slate-400 font-bold uppercase mb-1">Salah</p>
                            <p class="text-2xl font-black text-red-500">{{ $salah }}</p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-3xl border border-slate-100 text-center">
                            <p class="text-[10px] text-slate-400 font-bold uppercase mb-1">Kosong</p>
                            <p class="text-2xl font-black text-slate-400">{{ $kosong }}</p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-3xl border border-slate-100 text-center">
                            <p class="text-[10px] text-slate-400 font-bold uppercase mb-1">Akurasi</p>
                            <p class="text-2xl font-black text-blue-500">{{ $akurasi }}%</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-1 space-y-4">
                    <h3 class="text-lg font-bold text-slate-700 px-2 flex items-center justify-between">
                        Skor Per Subtes
                    </h3>
                    @foreach($categories as $category)
                    <div @click="activeCategory = {{ $category->id }}" 
                         :class="activeCategory === {{ $category->id }} ? 'ring-2 ring-blue-500 bg-blue-50 border-transparent shadow-md' : 'bg-white border-slate-100 shadow-sm'"
                         class="flex items-center justify-between p-5 rounded-3xl cursor-pointer border hover:border-blue-300 transition-all group">
                        <div class="overflow-hidden">
                            <p class="text-sm font-bold text-slate-700 group-hover:text-blue-600 transition-colors truncate">{{ $category->nama_kategori }}</p>
                            <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Potensi Skolastik</p>
                        </div>
                        <p class="text-xl font-black text-blue-600 ml-2">{{ $category->skor }}</p>
                    </div>
                    @endforeach
                </div>

                <div class="lg:col-span-2 space-y-4">
                    <h3 class="text-lg font-bold text-slate-700 px-2">Pembahasan Soal</h3>
                    <div x-show="activeCategory === null" class="flex flex-col items-center justify-center py-24 bg-white rounded-[3rem] border-2 border-dashed border-slate-200">
                        <i class="fa-solid fa-mouse-pointer text-2xl text-slate-400 animate-bounce mb-4"></i>
                        <p class="text-slate-500 font-bold text-center px-6">Silahkan pilih salah satu subtes di kiri</p>
                    </div>

                    <template x-for="(jawaban, index) in allAnswers.filter(j => j.category_id == activeCategory)" :key="index">
                        <details class="group bg-white border border-slate-100 rounded-[2rem] overflow-hidden shadow-sm hover:shadow-md mb-4">
                            <summary class="flex items-center justify-between p-5 md:p-6 cursor-pointer list-none">
                                <div class="flex items-center gap-4 min-w-0">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-2xl flex items-center justify-center font-bold text-sm"
                                         :class="jawaban.is_correct ? 'bg-green-100 text-green-600' : (jawaban.pilihan_user ? 'bg-red-100 text-red-600' : 'bg-slate-100 text-slate-400')">
                                        <span x-text="index + 1"></span>
                                    </div>
                                    <div class="text-sm font-bold text-slate-600 truncate pr-4" x-html="jawaban.pertanyaan.replace(/<[^>]*>?/gm, '')"></div>
                                </div>
                                <span class="flex-shrink-0 px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest"
                                      :class="jawaban.is_correct ? 'bg-green-100 text-green-600' : (jawaban.pilihan_user ? 'bg-red-100 text-red-600' : 'bg-slate-100 text-slate-400')"
                                      x-text="jawaban.is_correct ? 'Benar' : (jawaban.pilihan_user ? 'Salah' : 'Kosong')">
                                </span>
                            </summary>
                            <div class="px-5 md:px-8 pb-6 pt-2 border-t border-slate-50 space-y-5">
                                <div class="bg-slate-50 p-5 rounded-3xl text-slate-700 text-sm leading-relaxed" x-html="jawaban.pertanyaan"></div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="p-4 rounded-2xl border text-sm font-bold flex flex-col gap-1"
                                         :class="jawaban.is_correct ? 'border-green-100 bg-green-50/50 text-green-700' : (jawaban.pilihan_user ? 'border-red-100 bg-red-50/50 text-red-700' : 'border-slate-100 bg-slate-50 text-slate-500')">
                                        <span class="text-[10px] opacity-60 uppercase">Jawaban Anda</span>
                                        <span x-text="jawaban.pilihan_user || 'Tidak Dijawab'"></span>
                                    </div>
                                    <div class="p-4 rounded-2xl border border-blue-100 bg-blue-50/50 text-blue-700 text-sm font-bold flex flex-col gap-1">
                                        <span class="text-[10px] opacity-60 uppercase">Kunci Jawaban</span>
                                        <span x-text="jawaban.kunci_jawaban"></span>
                                    </div>
                                </div>
                                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-5 rounded-r-3xl text-sm italic text-slate-600" x-html="jawaban.pembahasan || 'Penjelasan belum tersedia.'"></div>
                            </div>
                        </details>
                    </template>
                </div>
            </div>
        </div>

        <div x-show="showModal" class="fixed inset-0 z-[999] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-cloak>
            <div @click.away="showModal = false" class="bg-white rounded-[3rem] p-8 max-w-sm w-full text-center shadow-2xl relative overflow-hidden">
                <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                    <i class="fa-solid fa-house-chimney"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-800 mb-2">Selesai Review?</h3>
                <div class="flex flex-col gap-3">
                    <a href="{{ route('tryout.index') }}" class="w-full py-4 bg-blue-600 text-white rounded-2xl font-bold uppercase tracking-widest text-xs">Ya, Keluar Sekarang</a>
                    <button @click="showModal = false" class="w-full py-4 text-slate-400 font-bold uppercase text-xs">Batal</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>