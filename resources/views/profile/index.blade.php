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

    <div class="max-w-[1440px] mx-auto" x-data="{ open: false }">
        <nav class="flex justify-between items-center bg-gray-100 rounded-full mx-4 md:mx-10 mt-4 relative z-10">
            <div class="w-20 md:w-28 h-12 bg-blue-400 rounded-full flex-shrink-0"></div>

            <ul class="hidden lg:flex gap-12 text-gray-800 font-medium text-sm">
                <li><a href="/" class="font-bold hover:text-blue-500">Profile Peserta</a></li>
            </ul>

            <div class="flex items-center gap-2">
                <div class="flex items-center gap-2 bg-[#FBBA16] rounded-full">
                    <a href="/"
                        class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#3171CD] flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
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

                <button @click="open = true"
                    class="lg:hidden p-2 text-gray-600 hover:bg-gray-200 rounded-full transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </nav>

        <div x-show="open" class="fixed inset-0 z-[100] flex items-center justify-center p-4" style="display: none;">
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="open = false"
                class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                class="relative bg-white rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Menu Utama</h2>
                    <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <ul class="space-y-3">
                    <li><a href="/"
                            class="block text-center py-3 px-4 bg-gray-50 rounded-xl font-semibold text-gray-700 hover:bg-blue-500 hover:text-white transition">Beranda</a>
                    </li>
                    <li><a href="{{ route('streak.index') }}"
                            class="block text-center py-3 px-4 bg-gray-50 rounded-xl font-semibold text-gray-700 hover:bg-blue-500 hover:text-white transition">Pet
                            Streak</a></li>
                    <li><a href="{{ route('tryout.index') }}"
                            class="block text-center py-3 px-4 bg-gray-50 rounded-xl font-semibold text-gray-700 hover:bg-blue-500 hover:text-white transition">Try
                            Out</a></li>
                    <li><a href="{{ route('latihan.index') }}"
                            class="block text-center py-3 px-4 bg-gray-50 rounded-xl font-semibold text-gray-700 hover:bg-blue-500 hover:text-white transition">Latihan
                            Soal</a></li>
                    <li><a href="{{ route('video.index') }}"
                            class="block text-center py-3 px-4 bg-gray-50 rounded-xl font-semibold text-gray-700 hover:bg-blue-500 hover:text-white transition">Video
                            Pembelajaran</a></li>
                </ul>
            </div>
        </div>
    </div>

    <main class="flex-1 p-4 md:p-10 max-w-[1440px] mx-auto py-10 w-full space-y-6">

        <section
            class="bg-[#f0f5ff] rounded-[40px] p-6 md:p-10 flex flex-col md:flex-row items-center gap-8 relative overflow-hidden">
            <div class="absolute top-4 left-1/4 w-3 h-3 bg-yellow-400 rounded-sm rotate-12 opacity-60"></div>
            <div class="absolute bottom-10 right-1/4 w-3 h-3 bg-orange-400 transform rotate-45 opacity-60"></div>

            <div class="flex flex-col items-center gap-2 shrink-0">
                <div class="w-32 h-32 md:w-40 md:h-40 rounded-full border-8 border-white overflow-hidden shadow-sm">
                    <img src="https://i.pinimg.com/564x/07/33/ba/0733ba760b29378474dea0fdbcb97107.jpg" alt="Profile"
                        class="w-full h-full object-cover">
                </div>
                <h2 class="text-xl pt-2 font-bold text-[#2e3b66]">Bang Jeemin</h2>
                <p class="text-xs text-gray-500 font-medium">contoh@gmail.com</p>
            </div>

            <div class="flex-1 w-full overflow-hidden rounded-[30px] shadow-xs border border-gray-100">

                <div class="bg-[#4375D1] p-8 pb-14 relative">
                    <div class="flex justify-between items-start text-white">
                        <div>
                            <h3 class="text-3xl font-bold tracking-tight">Bang Jeemin</h3>
                            <p class="text-sm opacity-90 font-medium">contoh@gmail.com</p>
                        </div><a href="/profile/edit">
                            <button
                                class="bg-white/20 hover:bg-white/30 text-white px-5 py-2 rounded-2xl text-sm font-medium flex items-center gap-2 transition backdrop-blur-sm">
                                <i class="fa-regular fa-pen-to-square"></i> Edit Profil
                            </button></a>
                    </div>
                </div>

                <div class="bg-white p-8 pt-0 relative">
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 pt-5">

                        <div class="bg-[#fea33a] px-4 py-8 rounded-[24px] text-white shadow-lg shadow-orange-200/50">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-chart-simple text-2xl opacity-80"></i>
                                <div>
                                    <p class="text-3xl font-bold">562</p>
                                    <p class="text-sm font-medium pt-1 uppercase tracking-wider leading-tight">
                                        Tryout Terbaru</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-[#ff908e] px-4 py-8 rounded-[24px] text-white shadow-lg shadow-red-200/50">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-award text-2xl opacity-80"></i>
                                <div>
                                    <p class="text-3xl font-bold">900</p>
                                    <p class="text-sm font-medium pt-1 uppercase tracking-wider leading-tight">
                                        Tryout Terbesar</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-[#9885FB] px-4 py-8 rounded-[24px] text-white shadow-lg shadow-purple-200/50">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-sun text-2xl opacity-80"></i>
                                <div>
                                    <p class="text-3xl font-bold">50</p>
                                    <p class="text-sm font-medium pt-1 uppercase tracking-wider leading-tight">
                                        Hari Streak</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-[#4caa60] px-4 py-8 rounded-[24px] text-white shadow-lg shadow-green-200/50">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-sun text-2xl opacity-80"></i>
                                <div>
                                    <p class="text-3xl font-bold">50</p>
                                    <p class="text-sm font-medium pt-1 uppercase tracking-wider leading-tight">
                                        Jumlah Hari</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </section>

        <section class="bg-white border-2 border-gray-100 rounded-[40px] p-8">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-bold text-[#2e3b66]">Aktivitas</h3>
                <a href="#" class="text-blue-500 text-sm font-semibold hover:underline">Lihat semua
                    aktivitas</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div
                    class="bg-[#F2F7FE] border-2 border-gray-100 rounded-[30px] p-6 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="w-10 h-10 bg-[#fea33a] rounded-xl flex items-center justify-center text-white font-bold text-xs shrink-0">
                            PU</div>
                        <div>
                            <h4 class="font-bold text-[#2e3b66] text-sm">Latihan soal-PU</h4>
                            <p class="text-[10px] text-gray-500">Waktu mengerjakan: 20 menit</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-150 pt-4">
                        <p class="text-sm font-bold text-[#2e3b66]">Skor: <span class="text-blue-600">80/100</span>
                        </p>
                        <p class="text-[10px] text-gray-500">Selesai pada 10 Januari 2026</p>
                    </div>
                </div>

                <div
                    class="bg-[#F2F7FE] border-2 border-gray-100 rounded-[30px] p-6 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="w-10 h-10 bg-[#9885FB] rounded-xl flex items-center justify-center text-white font-bold text-xs shrink-0">
                            PBM</div>
                        <div>
                            <h4 class="font-bold text-[#2e3b66] text-sm">Latihan soal-PBM</h4>
                            <p class="text-[10px] text-gray-500">Waktu mengerjakan: 10 menit</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-150 pt-4">
                        <p class="text-sm font-bold text-[#2e3b66]">Skor: <span class="text-blue-600">75/100</span>
                        </p>
                        <p class="text-[10px] text-gray-500">Selesai pada 10 Januari 2026</p>
                    </div>
                </div>

                <div
                    class="bg-[#F2F7FE] border-2 border-gray-100 rounded-[30px] p-6 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="w-10 h-10 bg-[#FF908E] rounded-xl flex items-center justify-center text-white font-bold text-xs shrink-0">
                            PPU</div>
                        <div>
                            <h4 class="font-bold text-[#2e3b66] text-sm">Latihan soal-PPU</h4>
                            <p class="text-[10px] text-gray-500">Waktu mengerjakan: 15 menit</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-150 pt-4">
                        <p class="text-sm font-bold text-[#2e3b66]">Skor: <span class="text-blue-600">90/100</span>
                        </p>
                        <p class="text-[10px] text-gray-500">Selesai pada 10 Januari 2026</p>
                    </div>
                </div>

                <div
                    class="bg-[#F2F7FE] border-2 border-gray-100 rounded-[30px] p-6 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="w-10 h-10 bg-red-500 rounded-xl flex items-center justify-center text-white font-bold text-xs shrink-0">
                            TO</div>
                        <div>
                            <h4 class="font-bold text-[#2e3b66] text-sm">Try Out 1</h4>
                            <p class="text-[10px] text-gray-500">Waktu mengerjakan: 260 menit</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-150 pt-4">
                        <p class="text-sm font-bold text-[#2e3b66]">Skor: <span class="text-blue-600">750</span>
                        </p>
                        <p class="text-[10px] text-gray-500">Selesai pada 10 Januari 2026</p>
                    </div>
                </div>

                <div
                    class="bg-[#F2F7FE] border-2 border-gray-100 rounded-[30px] p-6 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="w-10 h-10 bg-[#4caa60] rounded-xl flex items-center justify-center text-white font-bold text-xs shrink-0">
                            PK</div>
                        <div>
                            <h4 class="font-bold text-[#2e3b66] text-sm">Latihan soal-PPU</h4>
                            <p class="text-[10px] text-gray-500">Waktu mengerjakan: menit</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-150 pt-4">
                        <p class="text-sm font-bold text-[#2e3b66]">Skor: <span class="text-blue-600">90/100</span>
                        </p>
                        <p class="text-[10px] text-gray-500">Selesai pada 10 Januari 2026</p>
                    </div>
                </div>

                <div
                    class="bg-[#F2F7FE] border-2 border-gray-100 rounded-[30px] p-6 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="w-10 h-10 bg-[#A5BBEC] rounded-xl flex items-center justify-center text-white font-bold text-xs shrink-0">
                            LBI</div>
                        <div>
                            <h4 class="font-bold text-[#2e3b66] text-sm">Latihan soal-PPU</h4>
                            <p class="text-[10px] text-gray-500">Waktu mengerjakan: menit</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-150 pt-4">
                        <p class="text-sm font-bold text-[#2e3b66]">Skor: <span class="text-blue-600">70/100</span>
                        </p>
                        <p class="text-[10px] text-gray-500">Selesai pada 10 Januari 2026</p>
                    </div>
                </div>

            </div>
        </section>
    </main>

</body>

</html>
