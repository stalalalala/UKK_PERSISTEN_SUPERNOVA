<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Try Out {{ $tryout->nama_tryout }} | PERSISTEN</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    <style>
        [x-cloak] {
            display: none !important;
        }

        .font-po {
            font-family: 'Poppins', sans-serif;
        }
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

        <div class="container mx-auto max-w-7xl px-4 md:px-6 lg:px-8 py-6 md:py-10 space-y-8">

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <h1 class="text-3xl font-black text-slate-800">Hasil <span class="text-blue-600">TO-3</span></h1>

                <div class="flex gap-3">
                    <a href="{{ route('tryout.sertifikat', $tryout->id) }}" target="_blank"
                        class="bg-emerald-600 text-white px-6 py-2.5 rounded-xl font-bold shadow-md hover:bg-emerald-700 transition flex items-center gap-2 text-sm">
                        <i class="fa-solid fa-print"></i> Cetak Sertifikat
                    </a>
                    <button @click="showModal = true"
                        class="bg-blue-600 text-white px-6 py-2.5 rounded-xl font-bold shadow-md hover:bg-blue-700 transition text-sm">
                        Kembali Ke Menu
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">

                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-200 shadow-sm flex flex-col">
                    <div class="flex items-center gap-3 mb-8 text-blue-600">
                        <i class="fa-solid fa-chart-bar text-2xl"></i>
                        <h2 class="text-2xl font-black text-slate-800">Nilai Per Subtes</h2>
                    </div>

                    <div class="space-y-6 flex-grow">
                        @foreach ($categories->unique('id') as $category)
                            <div class="space-y-2">
                                <div class="flex justify-between items-center text-sm font-bold text-slate-700">
                                    <span>{{ $category->nama_kategori }}</span>
                                    <span class="text-slate-900">{{ $category->skor }}</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                                    @php
                                        $percentage = min(($category->skor / 1000) * 100, 100);
                                        $colorClass =
                                            $category->skor < 400
                                                ? 'bg-red-500'
                                                : ($category->skor < 700
                                                    ? 'bg-blue-500'
                                                    : 'bg-emerald-500');
                                    @endphp
                                    <div class="{{ $colorClass }} h-full transition-all duration-700 rounded-full"
                                        style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-center gap-6 mt-10 border-t pt-6">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase">Rendah</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase">Rata-rata</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase">Tinggi</span>
                        </div>
                    </div>
                </div>

                <div class="bg-[#F8FBFF] rounded-[2.5rem] p-8 border border-blue-100 shadow-sm flex flex-col">
                    <div class="flex items-center gap-3 mb-2 text-blue-600">
                        <i class="fa-solid fa-medal text-2xl"></i>
                        <h2 class="text-2xl font-black text-slate-800">Peringkat Try Out</h2>
                    </div>
                    <p class="text-sm font-medium text-slate-500 mb-12">
                        Peringkat ke <span class="font-bold text-blue-600">#{{ $userRankNumber }}</span> dari
                        {{ $rankings->count() }} peserta.
                    </p>

                    <div class="flex justify-center items-end gap-2 md:gap-4 mb-10 h-80 px-2">

                        <div class="flex flex-col items-center w-1/3 max-w-[110px]">
                            @if ($rankings->get(1))
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($rankings->get(1)->user->name) }}&background=64748b&color=fff"
                                    class="w-12 h-12 rounded-full border-2 border-white shadow-md mb-2">
                                <div
                                    class="bg-slate-500 w-full h-40 rounded-t-2xl pt-4 pb-4 text-center shadow-lg px-1 flex flex-col items-center justify-start">
                                    <span class="block text-white font-black text-xl leading-none mb-1">#2</span>
                                    <span
                                        class="block text-white font-bold text-[9px] truncate w-full mb-2 uppercase">{{ $rankings->get(1)->user->name }}</span>
                                    <div class="bg-slate-600/50 py-1 px-2 rounded-lg mt-auto w-11/12">
                                        <span
                                            class="block text-slate-200 text-[7px] font-bold uppercase tracking-widest">SKOR</span>
                                        <span
                                            class="block text-white font-bold text-xs">{{ number_format($rankings->get(1)->skor_total, 2) }}</span>
                                    </div>
                                </div>
                            @else
                                <div class="w-full h-24 bg-slate-200/50 rounded-t-2xl"></div>
                            @endif
                        </div>

                        <div class="flex flex-col items-center w-1/3 max-w-[130px] z-10 relative">
                            @if ($rankings->get(0))
                                <div class="relative mb-2">
                                    <i
                                        class="fa-solid fa-crown absolute -top-5 left-1/2 -translate-x-1/2 text-amber-500 text-xl drop-shadow-sm"></i>
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($rankings->get(0)->user->name) }}&background=f59e0b&color=fff"
                                        class="w-16 h-16 rounded-full border-4 border-white shadow-lg">
                                </div>
                                <div
                                    class="bg-amber-500 w-full h-52 rounded-t-3xl pt-6 pb-6 text-center shadow-xl flex flex-col items-center px-1">
                                    <span class="block text-white font-black text-4xl leading-none mb-2">#1</span>
                                    <span
                                        class="block text-white font-black text-[11px] truncate w-full mb-3 uppercase tracking-wide">{{ $rankings->get(0)->user->name }}</span>
                                    <div
                                        class="bg-amber-600/40 w-11/12 py-2 rounded-xl border border-amber-400/30 mt-auto">
                                        <span
                                            class="block text-amber-100 text-[8px] font-bold uppercase tracking-widest">SKOR</span>
                                        <span
                                            class="block text-white font-black text-lg">{{ number_format($rankings->get(0)->skor_total, 2) }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="flex flex-col items-center w-1/3 max-w-[110px]">
                            @if ($rankings->get(2))
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($rankings->get(2)->user->name) }}&background=c2410c&color=fff"
                                    class="w-12 h-12 rounded-full border-2 border-white shadow-md mb-2">
                                <div
                                    class="bg-orange-700 w-full h-32 rounded-t-2xl pt-4 pb-4 text-center shadow-lg px-1 flex flex-col items-center justify-start">
                                    <span class="block text-white font-black text-xl leading-none mb-1">#3</span>
                                    <span
                                        class="block text-white font-bold text-[9px] truncate w-full mb-2 uppercase">{{ $rankings->get(2)->user->name }}</span>
                                    <div class="bg-orange-800/50 py-1 px-2 rounded-lg mt-auto w-11/12">
                                        <span
                                            class="block text-orange-200 text-[7px] font-bold uppercase tracking-widest">SKOR</span>
                                        <span
                                            class="block text-white font-bold text-xs">{{ number_format($rankings->get(2)->skor_total, 2) }}</span>
                                    </div>
                                </div>
                            @else
                                <div class="w-full h-16 bg-slate-200/50 rounded-t-2xl"></div>
                            @endif
                        </div>
                    </div>

                    <div class="space-y-2 mb-4">
                        @php
                            $lowerRankings = $rankings->slice(3, 2)->values();
                            $isUserInTop5 = $userRankNumber <= 5;
                        @endphp

                        @forelse ($lowerRankings as $index => $rank)
                            <div
                                class="flex justify-between items-center bg-white px-5 py-3 rounded-2xl border border-blue-50 shadow-sm">
                                <div class="flex items-center gap-3">
                                    <span class="text-blue-600 font-black text-xs">#{{ $index + 4 }}</span>
                                    <span
                                        class="text-slate-600 font-bold text-xs truncate max-w-[150px]">{{ $rank->user->name }}</span>
                                </div>
                                <span
                                    class="text-slate-900 font-black text-xs">{{ number_format($rank->skor_total, 2) }}</span>
                            </div>
                        @empty
                            <div class="py-3 text-center bg-white/50 rounded-2xl border border-dashed border-slate-200">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Belum ada
                                    peringkat lainnya</p>
                            </div>
                        @endforelse
                    </div>

                    @if (!$isUserInTop5)
                        <div class="mb-6 space-y-2">
                            <div class="flex justify-center items-center gap-3">
                                <div class="h-[1px] bg-slate-200 flex-grow"></div>
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.2em]">Peringkat
                                    Kamu</span>
                                <div class="h-[1px] bg-slate-200 flex-grow"></div>
                            </div>
                            <div
                                class="flex justify-between items-center bg-indigo-50 px-5 py-4 rounded-2xl border-2 border-indigo-100 shadow-sm">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="bg-indigo-600 w-10 h-10 rounded-xl flex items-center justify-center shadow-sm">
                                        <span class="text-white font-black text-sm">#{{ $userRankNumber }}</span>
                                    </div>
                                    <div>
                                        <span
                                            class="block text-indigo-900 font-black text-sm truncate max-w-[140px]">{{ auth()->user()->name }}</span>
                                        <span
                                            class="block text-indigo-400 text-[9px] font-bold uppercase tracking-wider italic">Semangat,
                                            Terus Berjuang!</span>
                                    </div>
                                </div>
                                <div class="text-right pl-2 border-l border-indigo-200">
                                    <span
                                        class="block text-indigo-400 text-[8px] font-bold uppercase leading-none mb-1">SKOR</span>
                                    <span class="text-indigo-600 font-black text-sm">
                                        {{ number_format($rankings->where('user_id', auth()->id())->first()->skor_total ?? 0, 2) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <a href="{{ route('tryout.ranking', $tryout->id) }}"
                        class="mt-auto w-full bg-blue-600 text-white py-4 rounded-2xl font-black text-xs flex items-center justify-center gap-3 hover:bg-blue-700 transition shadow-lg active:scale-95">
                        LIHAT SEMUA PERINGKAT <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="text-[10px] text-slate-400 font-bold uppercase mb-1 tracking-widest">Benar</p>
                        <p class="text-2xl font-black text-emerald-500">{{ $benar }}</p>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="text-[10px] text-slate-400 font-bold uppercase mb-1 tracking-widest">Salah</p>
                        <p class="text-2xl font-black text-red-500">{{ $salah }}</p>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="text-[10px] text-slate-400 font-bold uppercase mb-1 tracking-widest">Kosong</p>
                        <p class="text-2xl font-black text-slate-400">{{ $kosong }}</p>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="text-[10px] text-slate-400 font-bold uppercase mb-1 tracking-widest">Akurasi</p>
                        <p class="text-2xl font-black text-blue-500">{{ $akurasi }}%</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-1 space-y-4">
                    <h3 class="text-lg font-bold text-slate-700 px-2">Subtes</h3>
                    @foreach ($categories->unique('id') as $category)
                        <div @click="activeCategory = {{ $category->id }}"
                            :class="activeCategory === {{ $category->id }} ?
                                'ring-2 ring-blue-500 bg-blue-50 border-transparent' : 'bg-white border-slate-200'"
                            class="flex items-center justify-between p-5 rounded-2xl cursor-pointer border hover:border-blue-300 transition-all group shadow-sm">
                            <div class="overflow-hidden">
                                <p class="text-sm font-bold text-slate-700 group-hover:text-blue-600 truncate">
                                    {{ $category->nama_kategori }}</p>
                            </div>
                            <p class="text-xl font-black text-blue-600 ml-2">{{ $category->skor }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="lg:col-span-2 space-y-4">
                    <h3 class="text-lg font-bold text-slate-700 px-2">Pembahasan Soal</h3>
                    <div x-show="activeCategory === null"
                        class="flex flex-col items-center justify-center py-20 bg-white rounded-[2rem] border-2 border-dashed border-slate-200">
                        <i class="fa-solid fa-list-check text-2xl text-blue-300 mb-4"></i>
                        <p class="text-slate-400 font-bold text-sm">Pilih subtes untuk melihat pembahasan</p>
                    </div>

                    <template x-for="(jawaban, index) in allAnswers.filter(j => j.category_id == activeCategory)"
                        :key="index">
                        <details
                            class="group bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm mb-4">
                            <summary
                                class="flex items-center justify-between p-5 cursor-pointer list-none hover:bg-slate-50 transition">
                                <div class="flex items-center gap-4">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center font-bold text-xs"
                                        :class="jawaban.is_correct ? 'bg-emerald-100 text-emerald-600' : (jawaban.pilihan_user ?
                                            'bg-red-100 text-red-600' : 'bg-slate-100 text-slate-400')">
                                        <span x-text="index + 1"></span>
                                    </div>
                                    <span class="text-sm font-bold text-slate-600 truncate max-w-[400px]"
                                        x-html="jawaban.pertanyaan.replace(/<[^>]*>?/gm, '')"></span>
                                </div>
                                <i
                                    class="fa-solid fa-chevron-down text-[10px] text-slate-300 group-open:rotate-180 transition"></i>
                            </summary>
                            <div class="p-6 border-t border-slate-50 space-y-4">
                                <div class="text-sm text-slate-700 leading-relaxed" x-html="jawaban.pertanyaan"></div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="p-3 rounded-xl border"
                                        :class="jawaban.is_correct ? 'bg-emerald-50 border-emerald-100 text-emerald-700' :
                                            'bg-red-50 border-red-100 text-red-700'">
                                        <p class="text-[9px] font-bold uppercase opacity-70">Jawaban Kamu</p>
                                        <p class="text-xs font-bold" x-text="jawaban.pilihan_user || 'Kosong'"></p>
                                    </div>
                                    <div class="p-3 rounded-xl border bg-blue-50 border-blue-100 text-blue-700">
                                        <p class="text-[9px] font-bold uppercase opacity-70">Kunci Jawaban</p>
                                        <p class="text-xs font-bold"
                                            x-text="jawaban.jawaban_benar || jawaban.kunci_jawaban"></p>
                                    </div>
                                </div>
                                <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-sm italic text-slate-500"
                                    x-html="jawaban.pembahasan || 'Pembahasan belum tersedia.'"></div>
                            </div>
                        </details>
                    </template>
                </div>
            </div>
        </div>

        <div x-show="showModal" x-cloak
            class="fixed inset-0 z-[999] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
            <div @click.away="showModal = false"
                class="bg-white rounded-[2.5rem] p-8 max-w-sm w-full text-center shadow-2xl">
                <h3 class="text-2xl font-black text-slate-800 mb-6">Selesai Review?</h3>
                <div class="flex flex-col gap-3">
                    <a href="{{ route('tryout.index') }}"
                        class="py-4 bg-blue-600 text-white rounded-2xl font-bold uppercase tracking-widest text-xs shadow-lg">Ya,
                        Keluar</a>
                    <button @click="showModal = false"
                        class="py-4 text-slate-400 font-bold uppercase text-xs">Batal</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
