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

    <div class="max-w-[1440px] mx-10 md:mx-auto py-10 md:py-10 px-10 space-y-6">

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-lg md:text-2xl font-bold text-slate-700">Try Out UTBK – 1</h1>
            <div class="flex gap-3">
                <button
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-full text-sm font-semibold transition">Cetak
                    Hasil</button>
                <button
                    class="border border-blue-500 text-blue-500 px-6 py-2 rounded-full text-sm font-semibold hover:bg-blue-50 transition">Kembali</button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="bg-white p-6 rounded-3xl border border-slate-100 card-shadow">
                <div class="flex items-center gap-2 mb-6 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                    </svg>
                    <h2 class="text-xl font-bold text-slate-800">Nilai Per Subtes</h2>
                </div>

                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-sm font-medium mb-4">
                            <span class="text-slate-600">Penalaran Umum</span>
                            <span class="text-slate-800">450</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3.5 border border-blue-200">
                            <div class="bg-blue-400 h-3.5 rounded-full" style="width: 45%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm font-medium mb-4">
                            <span class="text-slate-600">Pemahaman Bacaan dan Menulis</span>
                            <span class="text-slate-800">700</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3.5 border border-green-200">
                            <div class="bg-green-500 h-3.5 rounded-full" style="width: 70%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm font-medium mb-4">
                            <span class="text-slate-600">Pengetahuan dan Pemahaman Umum</span>
                            <span class="text-slate-800">850</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3.5 border border-red-200">
                            <div class="bg-red-400 h-3.5 rounded-full" style="width: 25%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm font-medium mb-4">
                            <span class="text-slate-600">Pengetahuan Kuantitatif</span>
                            <span class="text-slate-800">850</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3.5 border border-green-200">
                            <div class="bg-green-500 h-3.5 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm font-medium mb-4">
                            <span class="text-slate-600">Pengetahuan Matematika</span>
                            <span class="text-slate-800">850</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3.5 border border-green-200">
                            <div class="bg-green-500 h-3.5 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm font-medium mb-4">
                            <span class="text-slate-600">Literasi Bahasa Indonesia</span>
                            <span class="text-slate-800">850</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3.5 border border-red-200">
                            <div class="bg-red-400 h-3.5 rounded-full" style="width: 10%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm font-medium mb-4">
                            <span class="text-slate-600">Literasi Bahasa Inggris</span>
                            <span class="text-slate-800">850</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3.5 border border-blue-200">
                            <div class="bg-blue-400 h-3.5 rounded-full" style="width: 50%"></div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center gap-6 mt-14">
                    <div class="flex items-center gap-2 text-xs font-medium text-slate-400">
                        <span class="w-14 h-3.5 bg-red-400 rounded-full"></span>
                    </div>
                    <div class="flex items-center gap-2 text-xs font-medium text-slate-400">
                        <span class="w-14 h-3.5 bg-blue-400 rounded-full"></span>
                    </div>
                    <div class="flex items-center gap-2 text-xs font-medium text-slate-400">
                        <span class="w-14 h-3.5 bg-green-500 rounded-full"></span>
                    </div>
                </div>

                <div class="flex justify-center gap-7 mt-2">
                    <div class="flex items-center gap-2 text-xs font-medium text-slate-400">
                        <p>Rendah</p>
                    </div>
                    <div class="flex items-center gap-2 text-xs font-medium text-slate-400">
                        <p>Rata-rata</p>
                    </div>
                    <div class="flex items-center gap-2 text-xs font-medium text-slate-400">
                        <p>Tinggi</p>
                    </div>
                </div>
            </div>

            <div class="bg-blue-50 p-6 rounded-3xl border border-blue-100 card-shadow">
                <div class="flex items-center gap-2 mb-2 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                    <h2 class="text-xl font-bold text-slate-800">Peringkat Try Out</h2>
                </div>
                <p class="text-sm text-slate-500 mb-8">Peringkat ke <span class="text-green-600 font-bold">#3</span>
                    dari 2.756 peserta, selamat!</p>

                <div class="flex items-end justify-center gap-2 md:gap-4 mb-6 pt-10">

                    <div class="flex flex-col items-center flex-1 max-w-[120px]">
                        <div
                            class="w-14 h-14 md:w-20 md:h-20 rounded-full border-4 border-white overflow-hidden shadow-md z-10 mb-[-25px] md:mb-[-35px]">
                            <img src="https://i.pravatar.cc/150?u=2" class="w-full h-full object-cover">
                        </div>
                        <div class="bg-white pt-8 md:pt-10 pb-2 w-full rounded-t-[20px] text-center shadow-sm">
                            <span class="text-[10px] md:text-xs font-bold text-slate-600">Third</span>
                        </div>
                        <div
                            class="bg-yellow-400 w-full h-28 md:h-36 rounded-b-2xl flex flex-col items-center justify-center text-white p-2 shadow-inner">
                            <div class="flex items-baseline gap-1">
                                <span class="text-xl md:text-3xl font-bold">#2</span>
                                <span class="text-[8px] md:text-[10px] text-[#3B455E] font-medium leading-none">dengan
                                    skor</span>
                            </div>
                            <span class="font-black text-[#3B455E] text-lg md:text-2xl mt-1">804.98</span>
                        </div>
                    </div>

                    <div class="flex flex-col items-center flex-1 max-w-[140px]">
                        <div
                            class="w-16 h-16 md:w-24 md:h-24 rounded-full border-4 border-white overflow-hidden shadow-lg z-10 mb-[-30px] md:mb-[-40px]">
                            <img src="https://i.pravatar.cc/150?u=1" class="w-full h-full object-cover">
                        </div>
                        <div class="bg-white pt-10 md:pt-12 pb-2 w-full rounded-t-[20px] text-center shadow-sm">
                            <span class="text-[10px] md:text-xs font-bold text-slate-600">Sean</span>
                        </div>
                        <div
                            class="bg-yellow-400 w-full h-40 md:h-52 rounded-b-2xl flex flex-col items-center justify-center text-white p-2 shadow-xl">
                            <div class="flex items-baseline gap-1">
                                <span class="text-2xl md:text-4xl font-bold">#1</span>
                                <span class="text-[8px] md:text-[10px] text-[#3B455E] font-medium leading-none">dengan
                                    skor</span>
                            </div>
                            <span class="font-black text-[#3B455E] text-xl md:text-3xl mt-1">981.52</span>
                        </div>
                    </div>

                    <div class="flex flex-col items-center flex-1 max-w-[120px]">
                        <div
                            class="w-14 h-14 md:w-20 md:h-20 rounded-full border-4 border-white overflow-hidden shadow-md z-10 mb-[-25px] md:mb-[-35px]">
                            <img src="https://i.pravatar.cc/150?u=3" class="w-full h-full object-cover">
                        </div>
                        <div class="bg-white pt-8 md:pt-10 pb-2 w-full rounded-t-[20px]  text-center shadow-sm">
                            <span class="text-[10px] md:text-xs font-bold text-slate-600">Bang Jeemin</span>
                        </div>
                        <div
                            class="bg-yellow-400 w-full h-24 md:h-32 rounded-b-2xl flex flex-col items-center justify-center text-white p-2 shadow-inner">
                            <div class="flex items-baseline gap-1">
                                <span class="text-xl md:text-3xl font-bold">#3</span>
                                <span class="text-[8px] md:text-[10px] text-[#3B455E] font-medium leading-none">dengan
                                    skor</span>
                            </div>
                            <span class="font-black text-[#3B455E] text-lg md:text-2xl mt-1">542.85</span>
                        </div>
                    </div>

                </div>

                <div class="bg-white rounded-xl overflow-hidden shadow-sm text-[11px] md:text-sm">
                    <div class="flex items-center justify-between p-3 border-b text-blue-500 font-bold">
                        <div class="flex gap-2">
                            <span>#4</span>
                            <span>Jennie Blackping</span>
                        </div>

                        <span>532.99</span>
                    </div>

                    <div class="flex items-center justify-between p-3 border-b text-blue-500 font-bold">
                        <div class="flex gap-2">
                            <span>#5</span>
                            <span>Sora</span>
                        </div>

                        <span>532.99</span>
                    </div>

                    <div class="flex items-center justify-between p-3 border-b text-blue-500 font-bold">
                        <div class="flex gap-2">
                            <span>#6</span>
                            <span>Thipakorn</span>
                        </div>

                        <span>532.99</span>
                    </div>

                    <div class="flex items-center justify-between p-3 border-b text-blue-500 font-bold">
                        <div class="flex gap-2">
                            <span>#7</span>
                            <span>Elsa</span>
                        </div>

                        <span>532.99</span>
                    </div>
                    <button
                        class="w-full py-3 bg-blue-500 text-white font-semibold flex items-center justify-center gap-2 hover:bg-blue-600 transition">
                        Lihat Papan Peringkat
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-10 mx-auto">
            <h2 class="text-2xl font-bold text-slate-700 mb-6">Pembahasan Try Out</h2>

            <div class="bg-[#eef4ff] rounded-3xl p-4 md:p-6 border border-blue-100 shadow-sm">

                <div class="flex justify-between items-center mb-4 px-2">
                    <div class="flex items-center gap-3">
                        <div
                            class="bg-[#3b82f6] text-white w-12 h-10 flex items-center justify-center rounded-xl font-bold shadow-lg">
                            PU</div>
                        <div class="flex gap-2 text-[10px] md:text-xs">
                            <span
                                class="bg-green-100 text-green-600 px-3 py-1.5 rounded-full font-bold flex items-center gap-1">
                                <span class="text-[10px]">✓</span> 15 benar
                            </span>
                            <span
                                class="bg-red-100 text-red-600 px-3 py-1.5 rounded-full font-bold flex items-center gap-1">
                                <span class="text-[10px]">✕</span> 5 Salah
                            </span>
                        </div>
                    </div>
                    <button class="text-blue-500 hover:bg-blue-100 p-1 rounded-full transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 15l7-7 7 7" />
                        </svg>
                    </button>
                </div>

                <div class="space-y-4 max-h-[520px] overflow-y-auto pr-2 custom-scrollbar">

                    <details
                        class="group bg-white rounded-2xl shadow-sm border border-transparent open:border-blue-200 transition-all duration-300"
                        open>
                        <summary class="list-none cursor-pointer p-5 flex items-start gap-4">
                            <div
                                class="bg-blue-500 text-white min-w-[28px] h-7 flex items-center justify-center rounded-full text-sm font-bold mt-0.5">
                                1</div>
                            <div class="flex-1">
                                <div class="flex justify-between items-center">
                                    <p class="font-bold text-slate-700">Soal:</p>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-slate-400 group-open:rotate-180 transition-transform"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <p
                                    class="text-slate-500 leading-relaxed text-sm mt-2 line-clamp-2 group-open:line-clamp-none">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor. amet
                                    adipiscing elit. Sed do eiusmod tempor.
                                </p>
                            </div>
                        </summary>

                        <div class="px-5 pb-6 ml-11 border-t border-slate-50 pt-4">
                            <div class="flex items-center gap-2 text-green-600 font-bold py-2">
                                <span
                                    class="bg-green-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-[10px]">✓</span>
                                Jawaban : B
                            </div>

                            <div class="mt-4 space-y-2">
                                <p class="font-bold text-slate-700 text-sm">Pembahasan:</p>
                                <p class="text-slate-400 italic text-sm leading-relaxed">
                                    Lorem ipsum dolor sit amet, consectetur sit amet adipiscing elit. Sed do eiusmod
                                    tempor. amet adipiscing elit. Sed do eiusmod tempor. Pembahasan ini menjelaskan
                                    secara detail kenapa jawaban B adalah yang paling tepat berdasarkan logika penalaran
                                    umum.
                                </p>
                            </div>
                        </div>
                    </details>

                    <details
                        class="group bg-white rounded-2xl shadow-sm border border-transparent open:border-blue-200 transition-all duration-300">
                        <summary class="list-none cursor-pointer p-5 flex items-start gap-4">
                            <div
                                class="bg-blue-500 text-white min-w-[28px] h-7 flex items-center justify-center rounded-full text-sm font-bold mt-0.5">
                                2</div>
                            <div class="flex-1">
                                <div class="flex justify-between items-center">
                                    <p class="font-bold text-slate-700">Soal:</p>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-slate-400 group-open:rotate-180 transition-transform"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <p
                                    class="text-slate-500 leading-relaxed text-sm mt-2 line-clamp-2 group-open:line-clamp-none">
                                    Manakah pernyataan berikut yang paling benar sesuai dengan isi teks di atas?
                                </p>
                            </div>
                        </summary>
                        <div class="px-5 pb-6 ml-11 border-t border-slate-50 pt-4">
                            <div class="flex items-center gap-2 text-green-600 font-bold py-2">
                                <span
                                    class="bg-green-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-[10px]">✓</span>
                                Jawaban : A
                            </div>
                            <div class="mt-4 space-y-2">
                                <p class="font-bold text-slate-700 text-sm">Pembahasan:</p>
                                <p class="text-slate-400 italic text-sm leading-relaxed">Penjelasan mendalam mengenai
                                    korelasi antara paragraf satu dan dua.</p>
                            </div>
                        </div>
                    </details>

                    <details
                        class="group bg-white rounded-2xl shadow-sm border border-transparent open:border-blue-200 transition-all duration-300">
                        <summary class="list-none cursor-pointer p-5 flex items-start gap-4">
                            <div
                                class="bg-blue-500 text-white min-w-[28px] h-7 flex items-center justify-center rounded-full text-sm font-bold mt-0.5">
                                2</div>
                            <div class="flex-1">
                                <div class="flex justify-between items-center">
                                    <p class="font-bold text-slate-700">Soal:</p>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-slate-400 group-open:rotate-180 transition-transform"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <p
                                    class="text-slate-500 leading-relaxed text-sm mt-2 line-clamp-2 group-open:line-clamp-none">
                                    Manakah pernyataan berikut yang paling benar sesuai dengan isi teks di atas?
                                </p>
                            </div>
                        </summary>
                        <div class="px-5 pb-6 ml-11 border-t border-slate-50 pt-4">
                            <div class="flex items-center gap-2 text-green-600 font-bold py-2">
                                <span
                                    class="bg-green-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-[10px]">✓</span>
                                Jawaban : A
                            </div>
                            <div class="mt-4 space-y-2">
                                <p class="font-bold text-slate-700 text-sm">Pembahasan:</p>
                                <p class="text-slate-400 italic text-sm leading-relaxed">Penjelasan mendalam mengenai
                                    korelasi antara paragraf satu dan dua.</p>
                            </div>
                        </div>
                    </details>

                    <details
                        class="group bg-white rounded-2xl shadow-sm border border-transparent open:border-blue-200 transition-all duration-300">
                        <summary class="list-none cursor-pointer p-5 flex items-start gap-4">
                            <div
                                class="bg-blue-500 text-white min-w-[28px] h-7 flex items-center justify-center rounded-full text-sm font-bold mt-0.5">
                                2</div>
                            <div class="flex-1">
                                <div class="flex justify-between items-center">
                                    <p class="font-bold text-slate-700">Soal:</p>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-slate-400 group-open:rotate-180 transition-transform"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <p
                                    class="text-slate-500 leading-relaxed text-sm mt-2 line-clamp-2 group-open:line-clamp-none">
                                    Manakah pernyataan berikut yang paling benar sesuai dengan isi teks di atas?
                                </p>
                            </div>
                        </summary>
                        <div class="px-5 pb-6 ml-11 border-t border-slate-50 pt-4">
                            <div class="flex items-center gap-2 text-green-600 font-bold py-2">
                                <span
                                    class="bg-green-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-[10px]">✓</span>
                                Jawaban : A
                            </div>
                            <div class="mt-4 space-y-2">
                                <p class="font-bold text-slate-700 text-sm">Pembahasan:</p>
                                <p class="text-slate-400 italic text-sm leading-relaxed">Penjelasan mendalam mengenai
                                    korelasi antara paragraf satu dan dua.</p>
                            </div>
                        </div>
                    </details>

                </div>
            </div>

            {{-- PPU --}}

            <div class="bg-[#eef4ff] rounded-3xl mt-10 p-4 md:p-6 border border-blue-100 shadow-sm">

                <div class="flex justify-between items-center mb-4 px-2">
                    <div class="flex items-center gap-3">
                        <div
                            class="bg-[#3b82f6] text-white w-12 h-10 flex items-center justify-center rounded-xl font-bold shadow-lg">
                            PPU</div>
                        <div class="flex gap-2 text-[10px] md:text-xs">
                            <span
                                class="bg-green-100 text-green-600 px-3 py-1.5 rounded-full font-bold flex items-center gap-1">
                                <span class="text-[10px]">✓</span> 15 benar
                            </span>
                            <span
                                class="bg-red-100 text-red-600 px-3 py-1.5 rounded-full font-bold flex items-center gap-1">
                                <span class="text-[10px]">✕</span> 5 Salah
                            </span>
                        </div>
                    </div>
                    <button class="text-blue-500 hover:bg-blue-100 p-1 rounded-full transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 15l7-7 7 7" />
                        </svg>
                    </button>
                </div>

                <div class="space-y-4 max-h-[520px] overflow-y-auto pr-2 custom-scrollbar">

                    <details
                        class="group bg-white rounded-2xl shadow-sm border border-transparent open:border-blue-200 transition-all duration-300"
                        open>
                        <summary class="list-none cursor-pointer p-5 flex items-start gap-4">
                            <div
                                class="bg-blue-500 text-white min-w-[28px] h-7 flex items-center justify-center rounded-full text-sm font-bold mt-0.5">
                                1</div>
                            <div class="flex-1">
                                <div class="flex justify-between items-center">
                                    <p class="font-bold text-slate-700">Soal:</p>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-slate-400 group-open:rotate-180 transition-transform"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <p
                                    class="text-slate-500 leading-relaxed text-sm mt-2 line-clamp-2 group-open:line-clamp-none">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor. amet
                                    adipiscing elit. Sed do eiusmod tempor.
                                </p>
                            </div>
                        </summary>

                        <div class="px-5 pb-6 ml-11 border-t border-slate-50 pt-4">
                            <div class="flex items-center gap-2 text-green-600 font-bold py-2">
                                <span
                                    class="bg-green-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-[10px]">✓</span>
                                Jawaban : B
                            </div>

                            <div class="mt-4 space-y-2">
                                <p class="font-bold text-slate-700 text-sm">Pembahasan:</p>
                                <p class="text-slate-400 italic text-sm leading-relaxed">
                                    Lorem ipsum dolor sit amet, consectetur sit amet adipiscing elit. Sed do eiusmod
                                    tempor. amet adipiscing elit. Sed do eiusmod tempor. Pembahasan ini menjelaskan
                                    secara detail kenapa jawaban B adalah yang paling tepat berdasarkan logika penalaran
                                    umum.
                                </p>
                            </div>
                        </div>
                    </details>

                    <details
                        class="group bg-white rounded-2xl shadow-sm border border-transparent open:border-blue-200 transition-all duration-300">
                        <summary class="list-none cursor-pointer p-5 flex items-start gap-4">
                            <div
                                class="bg-blue-500 text-white min-w-[28px] h-7 flex items-center justify-center rounded-full text-sm font-bold mt-0.5">
                                2</div>
                            <div class="flex-1">
                                <div class="flex justify-between items-center">
                                    <p class="font-bold text-slate-700">Soal:</p>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-slate-400 group-open:rotate-180 transition-transform"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <p
                                    class="text-slate-500 leading-relaxed text-sm mt-2 line-clamp-2 group-open:line-clamp-none">
                                    Manakah pernyataan berikut yang paling benar sesuai dengan isi teks di atas?
                                </p>
                            </div>
                        </summary>
                        <div class="px-5 pb-6 ml-11 border-t border-slate-50 pt-4">
                            <div class="flex items-center gap-2 text-green-600 font-bold py-2">
                                <span
                                    class="bg-green-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-[10px]">✓</span>
                                Jawaban : A
                            </div>
                            <div class="mt-4 space-y-2">
                                <p class="font-bold text-slate-700 text-sm">Pembahasan:</p>
                                <p class="text-slate-400 italic text-sm leading-relaxed">Penjelasan mendalam mengenai
                                    korelasi antara paragraf satu dan dua.</p>
                            </div>
                        </div>
                    </details>

                    <details
                        class="group bg-white rounded-2xl shadow-sm border border-transparent open:border-blue-200 transition-all duration-300">
                        <summary class="list-none cursor-pointer p-5 flex items-start gap-4">
                            <div
                                class="bg-blue-500 text-white min-w-[28px] h-7 flex items-center justify-center rounded-full text-sm font-bold mt-0.5">
                                2</div>
                            <div class="flex-1">
                                <div class="flex justify-between items-center">
                                    <p class="font-bold text-slate-700">Soal:</p>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-slate-400 group-open:rotate-180 transition-transform"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <p
                                    class="text-slate-500 leading-relaxed text-sm mt-2 line-clamp-2 group-open:line-clamp-none">
                                    Manakah pernyataan berikut yang paling benar sesuai dengan isi teks di atas?
                                </p>
                            </div>
                        </summary>
                        <div class="px-5 pb-6 ml-11 border-t border-slate-50 pt-4">
                            <div class="flex items-center gap-2 text-green-600 font-bold py-2">
                                <span
                                    class="bg-green-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-[10px]">✓</span>
                                Jawaban : A
                            </div>
                            <div class="mt-4 space-y-2">
                                <p class="font-bold text-slate-700 text-sm">Pembahasan:</p>
                                <p class="text-slate-400 italic text-sm leading-relaxed">Penjelasan mendalam mengenai
                                    korelasi antara paragraf satu dan dua.</p>
                            </div>
                        </div>
                    </details>

                    <details
                        class="group bg-white rounded-2xl shadow-sm border border-transparent open:border-blue-200 transition-all duration-300">
                        <summary class="list-none cursor-pointer p-5 flex items-start gap-4">
                            <div
                                class="bg-blue-500 text-white min-w-[28px] h-7 flex items-center justify-center rounded-full text-sm font-bold mt-0.5">
                                2</div>
                            <div class="flex-1">
                                <div class="flex justify-between items-center">
                                    <p class="font-bold text-slate-700">Soal:</p>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-slate-400 group-open:rotate-180 transition-transform"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <p
                                    class="text-slate-500 leading-relaxed text-sm mt-2 line-clamp-2 group-open:line-clamp-none">
                                    Manakah pernyataan berikut yang paling benar sesuai dengan isi teks di atas?
                                </p>
                            </div>
                        </summary>
                        <div class="px-5 pb-6 ml-11 border-t border-slate-50 pt-4">
                            <div class="flex items-center gap-2 text-green-600 font-bold py-2">
                                <span
                                    class="bg-green-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-[10px]">✓</span>
                                Jawaban : A
                            </div>
                            <div class="mt-4 space-y-2">
                                <p class="font-bold text-slate-700 text-sm">Pembahasan:</p>
                                <p class="text-slate-400 italic text-sm leading-relaxed">Penjelasan mendalam mengenai
                                    korelasi antara paragraf satu dan dua.</p>
                            </div>
                        </div>
                    </details>

                </div>
            </div>
        </div>

        <style>
            /* Styling Scrollbar agar cantik seperti di gambar */
            .custom-scrollbar::-webkit-scrollbar {
                width: 6px;
            }

            .custom-scrollbar::-webkit-scrollbar-track {
                background: transparent;
            }

            .custom-scrollbar::-webkit-scrollbar-thumb {
                background: #bfdbfe;
                /* Warna biru muda */
                border-radius: 10px;
            }

            .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                background: #3b82f6;
            }

            /* Menghilangkan marker default chrome/safari pada <details> */
            details summary::-webkit-details-marker {
                display: none;
            }
        </style>

</body>

</html>
