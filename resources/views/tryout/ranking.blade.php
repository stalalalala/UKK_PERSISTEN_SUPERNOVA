<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERSISTEN - Peringkat Try Out</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.2); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #3171CD; border-radius: 10px; }
        body { overscroll-behavior: none; }
    </style>
</head>
<body class="font-po bg-white overflow-x-hidden h-screen" 
    x-data="{ 
        showModal: false,
        init() {
            // INGET KATA SAYA: Gunakan Hash untuk mengunci riwayat browser
            if (window.location.hash !== '#peringkat') {
                window.history.pushState(null, null, '#peringkat');
            }

            window.addEventListener('popstate', (event) => {
                this.showModal = true;
                // Dorong kembali agar tidak keluar dari halaman
                window.history.pushState(null, null, '#peringkat');
            });
        }
    }">

    <div class="max-w-[1440px] mx-auto h-full flex flex-col px-4 md:px-10 py-6">

        <div class="flex justify-between items-center mb-6 shrink-0">
            <div class="flex items-center gap-3">
                <div class="text-[#3171CD] text-2xl md:text-3xl">
                    <i class="fa-solid fa-award"></i>
                </div>
                <div>
                    <h1 class="text-xl md:text-2xl font-bold text-[#2E3B66]">Peringkat Peserta</h1>
                    <p class="text-[10px] md:text-xs text-slate-400 font-medium uppercase tracking-widest">{{ $tryout->nama_tryout }}</p>
                </div>
            </div>

            <button @click="showModal = true" 
                class="px-6 py-2 border-2 border-[#6EB4FF] text-[#6EB4FF] font-bold rounded-full text-xs hover:bg-[#6EB4FF] hover:text-white transition-all uppercase tracking-wider block">
                Kembali Ke Hasil Skor
            </button>
        </div>

        <div class="bg-[#E2EDFE] rounded-[2.5rem] p-4 md:p-8 shadow-inner border border-blue-100 flex flex-col flex-1 min-h-0 overflow-hidden mb-4">

            <div class="grid grid-cols-12 mb-4 px-4 text-[10px] md:text-xs font-black text-blue-400 uppercase tracking-[0.2em] shrink-0">
                <div class="col-span-3 md:col-span-2">Rank</div>
                <div class="col-span-6 md:col-span-7">Nama Peserta</div>
                <div class="col-span-3 md:col-span-3 text-right">Skor Akhir</div>
            </div>

            <div class="flex-1 overflow-y-auto pr-2 custom-scrollbar space-y-3">
                @foreach($rankings as $index => $rank)
                <div class="grid grid-cols-12 items-center bg-white rounded-2xl p-4 md:p-5 border border-blue-50 shadow-sm hover:shadow-md transition-shadow group">
                    <div class="col-span-3 md:col-span-2">
                        @if($index == 0)
                            <span class="bg-yellow-100 text-yellow-600 font-black px-3 py-1.5 rounded-xl text-sm flex items-center w-fit gap-2">
                                <i class="fa-solid fa-crown text-xs"></i> #1
                            </span>
                        @elseif($index == 1)
                            <span class="bg-slate-100 text-slate-500 font-black px-3 py-1.5 rounded-xl text-sm w-fit block">#2</span>
                        @elseif($index == 2)
                            <span class="bg-orange-50 text-orange-700 font-black px-3 py-1.5 rounded-xl text-sm w-fit block">#3</span>
                        @else
                            <span class="text-slate-400 font-bold px-3 py-1 text-sm block">#{{ $index + 1 }}</span>
                        @endif
                    </div>

                    <div class="col-span-6 md:col-span-7 flex items-center gap-3">
                        <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center font-bold text-xs uppercase">
                            {{ substr($rank->user->name ?? 'U', 0, 2) }}
                        </div>
                        <div class="overflow-hidden">
                            <p class="font-bold text-[#3171CD] text-sm md:text-base truncate group-hover:text-blue-700 transition-colors">
                                {{ $rank->user->name ?? 'User' }}
                            </p>
                            <p class="text-[9px] text-slate-400 uppercase font-medium">Selesai pada {{ $rank->created_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    <div class="col-span-3 md:col-span-3 text-right">
                        <p class="font-black text-[#3171CD] text-base md:text-xl tracking-tighter">{{ number_format($rank->skor_total, 0) }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            @if(isset($userRank) && $userRank)
            <div class="mt-4 shrink-0">
                <div class="bg-white rounded-[2rem] p-4 border-4 border-blue-200 shadow-xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-2 opacity-10 text-4xl group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-user-check text-blue-600"></i>
                    </div>
                    
                    <p class="text-[10px] font-black text-slate-400 mb-3 ml-2 uppercase tracking-[0.3em]">Peringkat Anda</p>
                    
                    <div class="grid grid-cols-12 items-center bg-[#3171CD] rounded-2xl p-4 md:p-5 shadow-lg">
                        <div class="col-span-2 border-r border-white/20 text-center">
                            <span class="text-white font-black text-lg md:text-xl italic">#{{ $userRankNumber }}</span>
                        </div>
                        <div class="col-span-7 px-4">
                            <p class="font-bold text-white text-sm md:text-lg truncate">{{ Auth::user()->name }}</p>
                            <p class="text-[9px] text-blue-100 uppercase font-bold tracking-widest leading-none text-left">Terus tingkatkan belajarmu!</p>
                        </div>
                        <div class="col-span-3 text-right">
                            <p class="font-black text-white text-lg md:text-2xl tracking-tighter">{{ number_format($userRank->skor_total, 0) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div x-show="showModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-90"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-90"
         class="fixed inset-0 z-[999] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" 
         x-cloak>
        
        <div @click.away="showModal = false" class="bg-white rounded-[3rem] p-8 max-w-sm w-full text-center shadow-2xl relative overflow-hidden">
            <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                <i class="fa-solid fa-square-poll-vertical"></i>
            </div>
            <h3 class="text-2xl font-black text-slate-800 mb-2">Kembali ke Skor?</h3>
            <p class="text-slate-500 text-sm mb-8 font-medium">Anda akan diarahkan kembali ke halaman hasil pengerjaan.</p>
            
            <div class="flex flex-col gap-3">
                <a href="{{ route('tryout.hasil', $tryout->id) }}" 
                   class="w-full py-4 bg-[#3171CD] text-white rounded-2xl font-bold uppercase tracking-widest text-xs shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95 text-center block">
                    Ya, Lihat Hasil Lagi
                </a>
                <button @click="showModal = false" class="w-full py-4 text-slate-400 font-bold uppercase tracking-widest text-[10px] hover:text-slate-600 transition-colors">
                    Tetap di Sini
                </button>
            </div>
        </div>
    </div>

</body>
</html>