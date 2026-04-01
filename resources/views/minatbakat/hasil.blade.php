<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Analisis Potensi Diri | PERSISTEN</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fcfdfe;
            color: #1a1d23;
            overflow-x: hidden;
        }

        /* Elemen Abstrak Latar Belakang */
        .abstract-blob {
            position: fixed;
            z-index: -1;
            filter: blur(80px);
            opacity: 0.4;
            border-radius: 50%;
        }

        .main-container {
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 1.5rem;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 50px -12px rgba(0, 0, 0, 0.05);
        }

        @media (min-width: 768px) {
            .main-container {
                border-radius: 2.5rem;
            }
        }

        /* Podium Glassmorphism */
        .podium-card {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 1.5rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @media (min-width: 768px) {
            .podium-card {
                border-radius: 2rem;
            }
        }

        .podium-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 30px -10px rgba(14, 165, 233, 0.2);
        }

        .category-name {
            background: linear-gradient(to bottom right, #0369a1, #075985);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }

        /* Golden Accent yang Lebih Mewah */
        .golden-gradient {
            background: linear-gradient(90deg, transparent 0%, #fbbf24 20%, #f59e0b 50%, #fbbf24 80%, transparent 100%);
            height: 4px;
            filter: drop-shadow(0 4px 10px rgba(245, 158, 11, 0.6));
        }

        .description-box {
            background: linear-gradient(180deg, #f8fafc 0%, #eff6ff 100%);
            border-radius: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        @media (min-width: 768px) {
            .description-box {
                border-radius: 2.5rem;
            }
        }

        .description-box::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: rgba(59, 130, 246, 0.05);
            border-radius: 50%;
        }

        .btn-premium {
            background: #1e293b;
            color: white;
            padding: 0.6rem 1rem;
            border-radius: 0.75rem;
            font-weight: 700;
            transition: all 0.3s;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            font-size: 0.75rem;
            white-space: nowrap;
        }

        @media (min-width: 768px) {
            .btn-premium {
                padding: 0.75rem 2rem;
                border-radius: 1rem;
                font-size: 1rem;
            }
        }

        .btn-premium:hover {
            background: #3b82f6;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -3px rgba(59, 130, 246, 0.3);
        }
    </style>
</head>

<body class="min-h-screen p-4 pt-10 md:p-12 lg:p-20">

    <div class="abstract-blob bg-blue-200 w-96 h-96 -top-20 -left-20"></div>
    <div class="abstract-blob bg-purple-100 w-80 h-80 bottom-0 -right-20"></div>

    <div class="max-w-6xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-6 px-2">
            <div class="flex items-center gap-3 md:gap-4 group w-full md:w-auto justify-center md:justify-start">
                <div
                    class="w-10 h-10 md:w-14 md:h-14 bg-white shadow-sm border border-slate-100 rounded-xl md:rounded-2xl flex items-center justify-center text-blue-600 text-lg md:text-2xl transition-transform group-hover:rotate-12">
                    <i class="fa-solid fa-shapes"></i>
                </div>
                <div>
                    <h1 class="text-xl md:text-3xl font-extrabold text-slate-900 tracking-tight leading-none">Tes Minat
                        Bakat</h1>
                    <p class="text-slate-400 text-[9px] md:text-xs font-bold uppercase tracking-[0.2em] mt-1">Laporan
                        Hasil Analisis</p>
                </div>
            </div>

            <div class="flex flex-row items-center gap-2 w-full md:w-auto justify-center md:justify-end shrink-0">
                <a href="{{ route('minatbakat.download') }}" target="_blank"
                    class="flex-1 md:flex-none flex items-center justify-center gap-1.5 px-4 md:px-6 py-3 bg-blue-600 text-white rounded-lg md:rounded-xl text-[11px] md:text-base font-bold shadow-lg shadow-blue-100 hover:bg-blue-700 transition-all">
                    <i class="fa-solid fa-file-pdf"></i> Cetak Hasil
                </a>

                <a href="/"
                    class="flex-1 md:flex-none btn-premium flex items-center justify-center gap-1.5 px-4 md:px-6 py-3">
                    <i class="fa-solid fa-arrow-left text-[9px] md:text-xs"></i> Kembali
                </a>
            </div>
        </div>

        <div class="main-container p-5 md:p-12">

            <div class="text-center mb-12 md:mb-16">
                <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-[9px] md:text-[10px] font-black uppercase tracking-widest mb-3 md:mb-4 inline-block">Kenali Dirimu</span>
                <h2 class="text-lg md:text-3xl font-extrabold text-slate-800 px-2 leading-tight">Tiga Potensi Utama</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-10 mb-12 md:mb-16 items-end">

                {{-- Rank 2 (Left) --}}
                <div class="order-2 md:order-1 flex flex-col items-center">
                    <div
                        class="w-full podium-card h-32 md:h-52 p-4 md:p-8 flex flex-col items-center justify-center relative overflow-hidden">
                        <div
                            class="absolute -bottom-2 -right-2 md:-bottom-4 md:-right-4 text-6xl md:text-8xl font-black text-white/40 italic">
                            2</div>
                        <h3 class="category-name text-lg md:text-2xl text-center z-10 uppercase leading-tight">
                            {{ $hasil->top_2 ?? 'Artistik' }}</h3>
                        <p
                            class="text-[9px] md:text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 md:mt-2 z-10">
                            Pendukung</p>
                    </div>
                </div>

                {{-- Rank 1 (Center - Higher) --}}
                <div class="order-1 md:order-2 flex flex-col items-center mb-4 md:mb-0">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 bg-amber-400 rounded-xl md:rounded-2xl mb-3 md:mb-4 flex items-center justify-center shadow-lg shadow-amber-200 animate-bounce">
                        <i class="fa-solid fa-crown text-white text-xl md:text-2xl"></i>
                    </div>
                    <div
                        class="w-full podium-card h-48 md:h-72 p-6 md:p-8 border-2 border-blue-100 flex flex-col items-center justify-center relative overflow-hidden bg-white shadow-xl shadow-blue-50">
                        <div
                            class="absolute -bottom-2 -right-2 md:-bottom-4 md:-right-4 text-7xl md:text-9xl font-black text-blue-50/50 italic">
                            1</div>
                        <h3
                            class="category-name text-xl md:text-4xl text-center z-10 uppercase scale-105 md:scale-110 leading-tight">
                            {{ $hasil->top_1 ?? 'Investigatif' }}</h3>
                        <div
                            class="mt-3 md:mt-4 px-3 py-1 bg-blue-600 rounded-lg text-white text-[8px] md:text-[9px] font-bold uppercase tracking-tighter z-10">
                            Paling Dominan</div>
                    </div>
                </div>

                {{-- Rank 3 (Right) --}}
                <div class="order-3 md:order-3 flex flex-col items-center">
                    <div
                        class="w-full podium-card h-28 md:h-40 p-4 md:p-8 flex flex-col items-center justify-center relative overflow-hidden">
                        <div
                            class="absolute -bottom-2 -right-2 md:-bottom-4 md:-right-4 text-5xl md:text-7xl font-black text-white/40 italic">
                            3</div>
                        <h3 class="category-name text-base md:text-xl text-center z-10 uppercase leading-tight">
                            {{ $hasil->top_3 ?? 'Enterprising' }}</h3>
                        <p
                            class="text-[9px] md:text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 md:mt-2 z-10">
                            Potensial</p>
                    </div>
                </div>
            </div>

            <div class="max-w-xs md:max-w-md mx-auto golden-gradient mb-12 md:mb-20"></div>

            <div class="description-box p-6 md:p-14">
                <div class="flex items-center gap-4 mb-8 md:mb-10">
                    <h4
                        class="text-[9px] md:text-xs font-black uppercase tracking-[0.2em] md:tracking-[0.3em] text-blue-900/40 shrink-0">
                        Analisis Karakteristik</h4>
                    <div class="h-px flex-1 bg-blue-100"></div>
                </div>

                <div class="grid grid-cols-1 gap-8 md:gap-12">
                    @php
                        $deskripsiDb = $categories->pluck('description', 'name')->toArray();
                        $items = [
                            ['name' => $hasil->top_1 ?? '-', 'color' => 'bg-blue-600'],
                            ['name' => $hasil->top_2 ?? '-', 'color' => 'bg-slate-800'],
                            ['name' => $hasil->top_3 ?? '-', 'color' => 'bg-slate-400'],
                        ];
                    @endphp

                    @foreach ($items as $item)
                        <div class="group">
                            <div class="flex items-start gap-4 md:gap-6">
                                <div
                                    class="w-1 md:w-1.5 h-8 md:h-10 {{ $item['color'] }} rounded-full transition-all group-hover:h-14 md:group-hover:h-16 shrink-0">
                                </div>
                                <div>
                                    <h5
                                        class="text-lg md:text-xl font-extrabold text-slate-800 mb-2 md:mb-3 tracking-tight group-hover:text-blue-600 transition-colors">
                                        {{ $item['name'] }}
                                    </h5>
                                    <p class="text-slate-500 leading-relaxed text-xs md:text-base font-medium">
                                        {{ $deskripsiDb[$item['name']] ?? 'Informasi deskripsi tidak tersedia untuk kategori ini.' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <p
                class="text-center mt-10 md:mt-12 text-slate-300 text-[8px] md:text-[9px] font-bold uppercase tracking-[0.3em] md:tracking-[0.4em]">
                &copy; {{ date('Y') }} • Platform Persisten
            </p>
        </div>
    </div>

</body>

</html>
