<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analisis Potensi Diri</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: radial-gradient(circle at top right, #fdfcfd, #f2f5ff);
            color: #1a1c20;
        }
        .premium-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.7);
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .premium-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 45px rgba(31, 38, 135, 0.1);
        }
        .gradient-text {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .badge-glow {
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.3);
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade { animation: fadeIn 0.8s ease-out forwards; }
    </style>
</head>

<body class="min-h-screen py-10 px-4 md:px-6">

    <div class="max-w-4xl mx-auto">
        
        {{-- Header --}}
        <header class="text-center mb-16 animate-fade">
            <div class="inline-block px-4 py-1.5 bg-indigo-50 rounded-full text-indigo-600 text-[10px] font-extrabold uppercase tracking-[0.2em] mb-4">
                Laporan Analisis
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-3">
                Hasil Tes <span class="gradient-text">Minat Bakat</span>
            </h1>
            <p class="text-slate-500 font-medium text-sm md:text-base">Eksplorasi potensi dirimu untuk masa depan yang lebih cerah.</p>
        </header>

        {{-- Podium Section --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
            
            {{-- Peringkat 2 --}}
            <div class="order-2 md:order-1 flex flex-col justify-end">
                <div class="premium-card rounded-[2.5rem] p-8 text-center relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-indigo-50 rounded-full -mr-12 -mt-12 transition-transform group-hover:scale-150 duration-500"></div>
                    <div class="relative z-10">
                        <div class="text-slate-300 font-black text-4xl mb-2">02</div>
                        <h3 class="text-xl font-bold text-slate-800 uppercase mb-1 tracking-tight">{{ $hasil->top_2 }}</h3>
                        <p class="text-[10px] font-bold text-indigo-400 uppercase tracking-widest">Kekuatan Pendukung</p>
                    </div>
                </div>
            </div>

            {{-- Peringkat 1 --}}
            <div class="order-1 md:order-2">
                <div class="bg-indigo-600 rounded-[3rem] p-10 text-center shadow-2xl shadow-indigo-200 relative transform transition-transform hover:scale-[1.02]">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mx-auto mb-6 badge-glow">
                            <i class="fa-solid fa-crown text-white text-2xl"></i>
                        </div>
                        <p class="text-indigo-200 text-[11px] font-bold uppercase tracking-[0.4em] mb-2">Paling Dominan</p>
                        <h3 class="text-3xl md:text-4xl font-black text-white uppercase tracking-tighter mb-4">{{ $hasil->top_1 }}</h3>
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/10 rounded-full text-white text-[10px] font-bold uppercase border border-white/20">
                            Analisis Sistem: Akurat
                        </div>
                    </div>
                </div>
            </div>

            {{-- Peringkat 3 --}}
            <div class="order-3 md:order-3 flex flex-col justify-end">
                <div class="premium-card rounded-[2.5rem] p-8 text-center relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-purple-50 rounded-full -mr-12 -mt-12 transition-transform group-hover:scale-150 duration-500"></div>
                    <div class="relative z-10">
                        <div class="text-slate-300 font-black text-4xl mb-2">03</div>
                        <h3 class="text-xl font-bold text-slate-800 uppercase mb-1 tracking-tight">{{ $hasil->top_3 }}</h3>
                        <p class="text-[10px] font-bold text-purple-400 uppercase tracking-widest">Bakat Potensial</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Detail Deskripsi --}}
        <div class="space-y-8">
            <div class="flex items-center justify-between px-2">
                <h2 class="text-xl font-bold tracking-tight uppercase text-slate-700 text-sm tracking-[0.2em]">Penjelasan Karakteristik</h2>
                <div class="h-px flex-1 bg-slate-100 mx-6"></div>
            </div>

            @php
                $deskripsiDb = $categories->pluck('description', 'name')->toArray();
                
                $content = [
                    ['tipe' => $hasil->top_1, 'label' => 'Hasil Utama'],
                    ['tipe' => $hasil->top_2, 'label' => 'Hasil Kedua'],
                    ['tipe' => $hasil->top_3, 'label' => 'Hasil Ketiga']
                ];
            @endphp

            @foreach($content as $index => $item)
            <div class="premium-card rounded-[2.5rem] p-8 md:p-10 flex flex-col md:flex-row gap-8 items-start animate-fade" style="animation-delay: {{ ($index + 1) * 0.2 }}s">
                
                {{-- Ikon Yang Disamakan (Modern Check) --}}
                <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center shrink-0 shadow-lg shadow-indigo-100">
                    <i class="fa-solid fa-circle-check text-white text-xl"></i>
                </div>

                <div class="flex-1">
                    <div class="flex flex-wrap items-center gap-3 mb-4">
                        <h4 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">{{ $item['tipe'] }}</h4>
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[9px] font-black uppercase rounded-full tracking-widest">
                            {{ $item['label'] }}
                        </span>
                    </div>
                    <p class="text-slate-500 text-sm md:text-base leading-relaxed font-medium opacity-90 italic">
                        "{{ $deskripsiDb[$item['tipe']] ?? 'Deskripsi detail untuk kategori ini belum tersedia di sistem admin.' }}"
                    </p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Footer --}}
        <div class="mt-20 text-center">
            <a href="/" class="inline-flex items-center gap-3 px-8 py-4 bg-slate-900 text-white rounded-2xl font-bold text-sm hover:bg-indigo-600 transition-all duration-300 shadow-xl hover:shadow-indigo-200">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <p class="mt-8 text-slate-400 text-[10px] font-bold uppercase tracking-[0.2em]">© {{ date('Y') }} Platform Analisis Persisten</p>
        </div>
    </div>

</body>
</html>