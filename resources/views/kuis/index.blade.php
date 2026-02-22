<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERSISTEN - Kuis</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite('resources/css/app.css')
</head>

<body class="font-po bg-white overflow-x-hidden">

    <div class="max-w-[1440px] mx-auto" x-data="{ open: false }">
        {{-- Navbar --}}
        <nav class="flex justify-between items-center bg-gray-100 rounded-full mx-4 md:mx-10 mt-4 relative z-10">
            <div class="w-20 md:w-28 h-12 bg-blue-400 rounded-full flex-shrink-0"></div>
            <ul class="hidden lg:flex gap-12 text-gray-800 font-medium text-sm">
                <li><a href="/" class="font-bold hover:text-blue-500">Kuis Fundamental</a></li>
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
                <button @click="open = true" class="lg:hidden p-2 text-gray-600 hover:bg-gray-200 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </nav>
    </div>

    <main class="max-w-[1440px] mx-auto py-10">

        <section class="px-4 md:px-10 mb-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-[#2E3B66]">Kuis Fundamental</h1>
            <p class="text-gray-500 mt-2">Tentukan materi fundamental yang ingin kamu latih dan mulai kerjakan kuis
                sekarang!</p>
        </section>

        <div class="px-4 md:px-10">
            <hr class="my-12 border-gray-300">
        </div>

        <section class="px-4 md:px-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8">

                @php
                    $warnaTag = [
                        'Penalaran Umum' => ['light' => 'bg-[#FFF2E1]', 'text' => 'text-[#E67E00]'],
                        'Pemahaman Bacaan dan Menulis' => ['light' => 'bg-[#F0EEFF]', 'text' => 'text-[#7C69EF]'],
                        'Pengetahuan dan Pemahaman Umum' => ['light' => 'bg-[#FFF0F1]', 'text' => 'text-[#F86D7D]'],
                        'Pengetahuan Kuantitatif' => ['light' => 'bg-[#EEF7EE]', 'text' => 'text-[#4E934C]'],
                        'Penalaran Matematika' => ['light' => 'bg-[#F6EFFF]', 'text' => 'text-[#A66EEF]'],
                        'Literasi Bahasa Inggris' => ['light' => 'bg-[#EFF3FD]', 'text' => 'text-[#6D8CD8]'],
                        'Literasi Bahasa Indonesia' => ['light' => 'bg-[#EEF5F5]', 'text' => 'text-[#4D8487]'],
                    ];
                    $tagDefault = ['light' => 'bg-blue-50', 'text' => 'text-blue-600'];
                @endphp

                @foreach ($allKuis as $k)
                    @php
                        $subtes = $k->category->name ?? ($k->kategori ?? 'Kuis');
                        $temaTag = $warnaTag[$subtes] ?? $tagDefault;
                        $userHasil = $k->hasil->first();
                    @endphp

                    <div
                        class="flex flex-col bg-white border-2 {{ $userHasil ? 'border-blue-100 shadow-md' : 'border-gray-100' }} rounded-[2.5rem] p-6 group hover:border-blue-300 hover:shadow-xl transition-all duration-300 h-full">

                        {{-- HEADER SECTION --}}
                        <div class="flex justify-between items-start mb-4 gap-2">
                            <div class="space-y-1">
                                <h4
                                    class="font-bold text-blue-900 text-lg leading-tight group-hover:text-blue-600 transition-colors">
                                    Kuis Fundamental - Set {{ $k->set_ke }}
                                </h4>
                                <span
                                    class="{{ $temaTag['light'] }} {{ $temaTag['text'] }} text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider block w-fit">
                                    {{ $subtes }}
                                </span>
                            </div>

                            @if ($userHasil)
                                {{-- SKOR PINDAH KE SINI: Di dalam badge Selesai --}}
                                <div class="flex flex-col items-end gap-1 shrink-0">
                                    <span
                                        class="bg-green-500 text-white text-[10px] font-semibold px-3 py-1 rounded-full uppercase flex items-center gap-1 shadow-sm">
                                        Selesai - SKOR {{ $userHasil->skor }}
                                    </span>
                                </div>
                            @else
                                <span
                                    class="bg-orange-50 text-orange-500 text-[10px] font-bold px-3 py-1 rounded-full uppercase border border-orange-100 shrink-0">
                                    Belum
                                </span>
                            @endif
                        </div>

                        {{-- INFO SECTION (Soal & Durasi) --}}
                        {{-- Perubahan: 'flex-col' untuk urutan ke bawah, 'gap-2' untuk jarak antar baris --}}
                        <div class="flex flex-col gap-2 mb-6">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.5" stroke="currentColor" class="size-5 text-blue-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                <span class="text-sm font-semibold text-slate-500">
                                    {{ $k->questions_count ?? '20' }} Soal
                                </span>
                            </div>

                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.5" stroke="currentColor" class="size-5 text-blue-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span class="text-sm font-semibold text-slate-500">
                                    {{ $k->durasi }} Menit
                                </span>
                            </div>
                        </div>

                        {{-- ACTION BUTTONS --}}
                        <div class="mt-auto">
                            @if ($userHasil)
                                <div class="flex gap-3">
                                    <a href="{{ route('kuis.hasil', $k->id) }}"
                                        class="flex-1 text-center py-3 bg-white border-2 border-blue-400 text-blue-400 font-bold rounded-2xl hover:bg-blue-50 transition-all duration-300 text-sm">
                                        Hasil
                                    </a>
                                    <a href="{{ route('kuis.intruksi', $k->id) }}"
                                        class="flex-1 text-center py-3 bg-blue-400 text-white font-bold rounded-2xl hover:bg-blue-500 transition-all duration-300 text-sm shadow-md shadow-blue-100">
                                        Ulang
                                    </a>
                                </div>
                            @else
                                <a href="{{ route('kuis.intruksi', $k->id) }}"
                                    class="block text-center w-full py-4 bg-blue-400 text-white font-bold rounded-2xl hover:bg-blue-500 hover:-translate-y-1 transition-all duration-300 shadow-lg shadow-blue-100 text-sm">
                                    Kerjakan Sekarang
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- PAGINATION --}}
            <div class="flex justify-center items-center gap-3 mt-16 mb-10">
                @if ($allKuis->onFirstPage())
                    <span
                        class="w-10 h-10 rounded-full border border-gray-200 text-gray-300 flex items-center justify-center cursor-not-allowed">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                    </span>
                @else
                    <a href="{{ $allKuis->previousPageUrl() }}"
                        class="w-10 h-10 rounded-full border border-gray-200 text-gray-400 hover:bg-blue-500 hover:text-white flex items-center justify-center">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                    </a>
                @endif

                @foreach ($allKuis->getUrlRange(1, $allKuis->lastPage()) as $page => $url)
                    <a href="{{ $url }}"
                        class="w-10 h-10 rounded-full font-bold flex items-center justify-center {{ $page == $allKuis->currentPage() ? 'bg-blue-500 text-white' : 'text-blue-500 hover:bg-blue-50' }}">
                        {{ $page }}
                    </a>
                @endforeach

                @if ($allKuis->hasMorePages())
                    <a href="{{ $allKuis->nextPageUrl() }}"
                        class="w-10 h-10 rounded-full border border-gray-200 text-gray-400 hover:bg-blue-500 hover:text-white flex items-center justify-center">
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </a>
                @else
                    <span
                        class="w-10 h-10 rounded-full border border-gray-200 text-gray-300 flex items-center justify-center cursor-not-allowed">
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </span>
                @endif
            </div>
        </section>
    </main>

    @include('layouts.footer')
</body>

</html>
