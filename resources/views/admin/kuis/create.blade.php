<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persisten Dashboard - Manajemen Kuis</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-[#E9EFFF] h-screen overflow-hidden text-[#2D3B61]" x-data="{
    activeMenu: 'Manajemen Kuis',
    mobileMenuOpen: false,
    showImportModal: false,
    soalTersimpan: 0,
    targetSoal: 20,
    currentSet: 1,
    activeQuestion: 1,
    selectedJawaban: null, // Tambahkan ini untuk kontrol radio button

    simpanSoal() {
        if (this.soalTersimpan < this.targetSoal) {
            this.soalTersimpan++;

            // Pindah ke soal berikutnya secara otomatis jika belum sampai 20
            if (this.activeQuestion < 20) {
                this.activeQuestion++;
            }

            // Reset Form (mengosongkan semua input di dalam form)
            document.getElementById('formKuis').reset();
            this.selectedJawaban = null; // Reset pilihan radio button

            // Scroll ke atas form biar admin nggak bingung
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }
}">

    <div class="flex h-full w-full">
        <aside x-init="if (currentPage === 'kuis') { $el.scrollIntoView({ block: 'center' }) }" :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed inset-y-0 left-0 z-50 w-72 bg-[#4A72D4] text-white flex flex-col p-6 shadow-xl transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 shrink-0 h-full">

            <div class="flex items-center justify-between mb-10 px-2">
                <div class="flex items-center gap-3">
                    <div class="bg-white p-2 rounded-xl">
                        <svg class="w-6 h-6 text-[#4A72D4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold tracking-tight">P E R S I S T E N</h1>
                </div>
                <button @click="mobileMenuOpen = false" class="lg:hidden p-2 hover:bg-white/10 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <nav
                class="flex-1 space-y-1 overflow-y-auto pr-2 
                [&::-webkit-scrollbar]:w-1 
                [&::-webkit-scrollbar-track]:bg-transparent 
                [&::-webkit-scrollbar-thumb]:bg-white/20 
                [&::-webkit-scrollbar-thumb]:rounded-full">

                <a href="#"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <div
                        class="w-5 h-5 border-2 border-white/50 rounded group-hover:border-white transition-colors shrink-0">
                    </div>
                    <span class="text-md font-regular">Dashboard</span>
                </a>

                <a href="#"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl  transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen user</span>
                </a>

                <a href="#"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen streak</span>
                </a>

                <a href="#"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen tryout</span>
                </a>

                <a href="#" x-init="if (currentPage === 'kuis') { $el.scrollIntoView({ block: 'center' }) }"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl bg-[#D4DEF7]  text-[#2E3B66] transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen kuis</span>
                </a>

                <a href="#"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen latihan
                        soal</span>
                </a>

                <a href="#"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen video
                        pembelajaran</span>
                </a>

                <a href="#"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen minat
                        bakat</span>
                </a>



                <a href="#"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen peluang
                        PTN</span>
                </a>

                <a href="#"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Monitoring dan
                        laporan</span>
                </a>



            </nav>

            <button
                class="mt-4 w-full flex items-center bg-white/10 hover:bg-white/20 px-6 py-3 rounded-2xl transition-all group border border-white/20 backdrop-blur-sm shrink-0">
                <svg xmlns="http://www.w3.org/2000/xml" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-5 md:size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                </svg>
                <span class="text-white text-md font-medium tracking-wide ml-4">Logout</span>
            </button>
        </aside>

        <div x-show="mobileMenuOpen" x-transition:enter="transition opacity-ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition opacity-ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="mobileMenuOpen = false"
            class="fixed inset-0 bg-black/50 z-40 lg:hidden">
        </div>

        <main class="flex-1 flex flex-col min-w-0 h-full overflow-y-auto custom-scrollbar p-4 lg:p-8">

            <header class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4">
                <div class="flex items-center w-full gap-4">
                    <button @click="mobileMenuOpen = true" class="lg:hidden p-3 bg-white rounded-xl shadow-sm">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <div class="relative w-full group flex items-center gap-2">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </div>
                            <input type="text" placeholder="Search...."
                                class="w-full bg-white border-none rounded-full py-3 pl-12 pr-4 shadow-sm focus:ring-2 focus:ring-blue-400 outline-none transition-all">
                        </div>
                        <button
                            class="bg-[#4A72D4] hover:bg-blue-600 text-white px-6 py-3 rounded-full text-sm font-medium shadow-sm transition-all active:scale-95 shrink-0">
                            Cari
                        </button>
                    </div>
                </div>

                <div
                    class="flex items-center gap-3 bg-white p-1 pr-4 pl-1 rounded-full shadow-sm shrink-0 self-end md:self-auto">
                    <div class="w-10 h-10 bg-gray-200 rounded-full overflow-hidden border-2 border-white">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=random" alt="Admin">
                    </div>
                    <span class="font-bold text-sm hidden sm:block text-gray-700">Admin</span>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </header>

            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-extrabold text-[#4A72D4]">
                        Kuis Fundamental - Set <span x-text="currentSet">1</span>
                    </h2>
                    <p class="text-gray-400 text-sm">Persisten Admin Panel / Kuis</p>
                </div>

                <div class="flex flex-wrap gap-3 w-full lg:w-auto">


                    <button @click="showImportModal = true"
                        class="flex-1 lg:flex-none flex items-center justify-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-xl font-semibold text-sm transition-all shadow-md active:scale-95">
                        <i class="fa-solid fa-file-excel text-lg"></i> Import via Excel
                    </button>
                </div>
            </div>

            <main class="flex-1 flex flex-col min-w-0 h-full overflow-y-auto custom-scrollbar pb-4 lg:pb-8">
                <div x-show="activeMenu === 'Manajemen Kuis'" x-transition>


                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                        <div class="lg:col-span-2 space-y-6">
                            <div class="bg-white rounded-xl p-6 lg:p-10 shadow-sm border border-blue-50">
                                <div class="flex items-center justify-between mb-10">
                                    <div class="flex items-center gap-4">
                                        <div class="p-3 bg-blue-50 rounded-2xl text-[#4A72D4]">
                                            <i class="fa-solid fa-pen-nib text-xl"></i>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-800">Input Soal Nomor <span
                                                x-text="activeQuestion"></span></h3>
                                    </div>
                                </div>

                                <form id="kuisForm" @submit.prevent="simpanSoal(); $el.reset(); selected = null"
                                    class="space-y-8">
                                    <div class="grid grid-cols-1 md:flex md:items-stretch gap-4 mb-8">

                                        {{-- Subtes --}}
                                        <div class="flex-1 min-w-0 flex flex-col gap-2" x-data="{
                                            open: false,
                                            selectedSubtes: '',
                                            options: ['Penalaran Umum', 'Penalaran & Pemahaman Umum', 'Pemahaman Bacaan & Menulis', 'Pengetahuan Kuantitatif', 'Penalaran Matematika', 'Literasi Bahasa Indonesia', 'Literasi Bahasa Inggris']
                                        }"
                                            @click.away="open = false">
                                            <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Kategori
                                                Subtes</label>
                                            <div
                                                class="bg-white px-4 py-3 rounded-2xl shadow-sm border border-blue-50 flex items-center relative h-full">
                                                <button type="button" @click="open = !open"
                                                    class="w-full flex items-center justify-between text-sm font-bold text-[#4A72D4] focus:outline-none">
                                                    <span x-text="selectedSubtes || 'Pilih Subtes'"
                                                        class="truncate"></span>
                                                    <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200"
                                                        :class="open ? 'rotate-180' : ''"></i>
                                                </button>
                                                <div x-show="open" x-transition
                                                    class="absolute z-50 w-full mt-2 top-full left-0 bg-white border border-blue-50 shadow-xl rounded-2xl overflow-hidden py-2">
                                                    <template x-for="item in options">
                                                        <div @click="selectedSubtes = item; open = false"
                                                            class="px-4 py-3 text-sm text-gray-600 hover:bg-blue-50 hover:text-[#4A72D4] cursor-pointer transition-colors font-medium"
                                                            x-text="item"></div>
                                                    </template>
                                                </div>
                                                <input type="hidden" name="subtes" :value="selectedSubtes" required>
                                            </div>
                                        </div>

                                        {{-- Set --}}
                                        <div class="w-full md:w-32 flex flex-col gap-2" x-data="{ open: false }"
                                            @click.away="open = false">
                                            <label
                                                class="text-[10px] font-bold text-gray-400 uppercase ml-1">Set</label>
                                            <div
                                                class="bg-white px-4 py-3 rounded-2xl shadow-sm border border-blue-50 flex items-center relative h-full">
                                                <button type="button" @click="open = !open"
                                                    class="w-full flex items-center justify-between text-sm font-bold text-[#4A72D4] focus:outline-none">
                                                    <span x-text="currentSet"></span>
                                                    <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200"
                                                        :class="open ? 'rotate-180' : ''"></i>
                                                </button>
                                                <div x-show="open" x-transition
                                                    class="absolute z-50 w-full mt-2 top-full left-0 bg-white border border-blue-50 shadow-xl rounded-2xl overflow-hidden py-2">
                                                    <template x-for="n in 10">
                                                        <div @click="currentSet = n; open = false"
                                                            class="px-4 py-2 text-sm text-center text-gray-600 hover:bg-blue-50 hover:text-[#4A72D4] cursor-pointer transition-colors font-medium"
                                                            x-text="n"></div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Waktu --}}
                                        <div class="w-full md:w-48 flex flex-col gap-2" x-data="{ open: false, selectedWaktu: 20 }"
                                            @click.away="open = false">
                                            <label
                                                class="text-[10px] font-bold text-gray-400 uppercase ml-1">Waktu</label>
                                            <div
                                                class="bg-white px-4 py-3 rounded-2xl shadow-sm border border-blue-50 flex items-center gap-2 relative h-full">
                                                <i class="fa-solid fa-stopwatch text-orange-400 text-sm"></i>
                                                <button type="button" @click="open = !open"
                                                    class="w-full flex items-center justify-between text-sm font-bold text-gray-700 focus:outline-none">
                                                    <span x-text="selectedWaktu + ' Menit'"></span>
                                                    <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 transition-transform duration-200"
                                                        :class="open ? 'rotate-180' : ''"></i>
                                                </button>
                                                <div x-show="open" x-transition
                                                    class="absolute z-50 w-full mt-2 top-full left-0 bg-white border border-blue-50 shadow-xl rounded-2xl overflow-hidden py-2">
                                                    <template x-for="t in [20,25,30,35,40,45,50,55,60]">
                                                        <div @click="selectedWaktu = t; open = false"
                                                            class="px-4 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-[#4A72D4] cursor-pointer transition-colors font-medium"
                                                            x-text="t + ' Menit'"></div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-y-6" x-data="{ imageUrl: null }">

                                        <div class="space-y-2">
                                            <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Materi
                                                atau Teks (Opsional)</label>

                                            <div class="relative group">
                                                <textarea required x-data="{
                                                    resize() {
                                                        $el.style.height = 'auto';
                                                        $el.style.height = ($el.scrollHeight < 120 ? 120 : $el.scrollHeight) + 'px';
                                                    }
                                                }" x-init="resize()" @input="resize()"
                                                    class="w-full bg-gray-50 border-none rounded-[25px] p-6 text-sm focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none shadow-inner transition-all overflow-hidden resize-none"
                                                    placeholder="Masukkan teks soal di sini..." style="min-height: 120px;"></textarea>

                                                <div class="absolute right-4 bottom-4">
                                                    <label
                                                        class="flex items-center gap-2 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full shadow-sm border border-gray-100 cursor-pointer hover:bg-blue-50 hover:border-blue-200 transition-all">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-4 w-4 text-blue-500" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        <span
                                                            class="text-[10px] font-bold text-blue-600 uppercase">Tambah
                                                            Foto</span>
                                                        <input type="file" class="hidden" accept="image/*"
                                                            @change="const file = $event.target.files[0]; if (file) { imageUrl = URL.createObjectURL(file) }">
                                                    </label>
                                                </div>
                                            </div>

                                            <template x-if="imageUrl">
                                                <div class="relative mt-3 inline-block">
                                                    <img :src="imageUrl"
                                                        class="max-h-48 rounded-2xl border-2 border-white shadow-sm ring-1 ring-gray-100">
                                                    <button @click="imageUrl = null"
                                                        class="absolute -top-2 -right-2 bg-red-500 text-white p-1 rounded-full hover:scale-110 transition-all shadow-md">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </template>
                                        </div>

                                        <div class="space-y-2">
                                            <label
                                                class="text-[10px] font-bold text-gray-400 uppercase ml-1">Pertanyaan</label>
                                            <textarea required x-data="{
                                                resize() {
                                                    $el.style.height = 'auto';
                                                    $el.style.height = ($el.scrollHeight < 120 ? 120 : $el.scrollHeight) + 'px';
                                                }
                                            }" x-init="resize()" @input="resize()"
                                                class="w-full bg-gray-50 border-none rounded-[25px] p-6 text-sm focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none shadow-inner transition-all overflow-hidden resize-none"
                                                placeholder="Masukkan teks pertanyaan di sini..." style="min-height: 120px;"></textarea>
                                        </div>

                                        <div class="grid grid-cols-1 gap-4" x-data="{ selected: null }">
                                            <template x-for="(opt, i) in ['A','B','C','D','E']">
                                                <div :class="selected === i ? 'bg-emerald-50 border-emerald-200' :
                                                    'bg-gray-50 border-transparent'"
                                                    class="flex items-start gap-4 p-4 rounded-2xl border-2 transition-all">

                                                    <span
                                                        class="w-10 h-10 shrink-0 flex items-center justify-center bg-white rounded-xl shadow-sm font-black text-[#4A72D4]"
                                                        x-text="opt"></span>

                                                    <textarea placeholder="Tulis jawaban di sini..." required x-data="{
                                                        resize() {
                                                            $el.style.height = '40px';
                                                            $el.style.height = $el.scrollHeight + 'px'
                                                        }
                                                    }" x-init="resize()"
                                                        @input="resize()"
                                                        class="flex-1 bg-transparent border-none outline-none text-sm font-medium pt-2 resize-none overflow-hidden"></textarea>

                                                    <div class="pt-2">
                                                        <input type="radio" name="benar" @click="selected = i"
                                                            required
                                                            class="w-5 h-5 accent-emerald-500 cursor-pointer shrink-0">
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>

                                    <div
                                        class="flex flex-col md:flex-row items-center justify-between gap-4 pt-6 border-t border-gray-100 mt-6">
                                        <p
                                            class="text-[10px] text-gray-400 text-center md:text-left order-2 md:order-1">
                                            Klik "Simpan" untuk mengunci jawaban nomor ini.
                                        </p>

                                        <div class="flex items-center gap-2 w-full md:w-auto order-1 md:order-2">
                                            <button type="reset" @click="selected = null"
                                                class="px-4 py-2 text-sm font-bold text-gray-400 hover:text-red-400 transition-colors">
                                                Reset
                                            </button>

                                            <button type="submit" :disabled="soalTersimpan >= 20"
                                                class="flex-1 md:flex-none bg-[#4A72D4] text-white px-8 py-3 rounded-xl font-bold text-sm shadow-lg hover:shadow-blue-200 hover:-translate-y-0.5 active:translate-y-0 transition-all disabled:bg-gray-300 disabled:shadow-none disabled:transform-none">
                                                <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Soal
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="bg-white p-6 rounded-xl shadow-sm border border-blue-50">
                                <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-6">
                                    Navigasi Soal</h4>

                                <div class="grid grid-cols-5 gap-3">
                                    <template x-for="n in 20">
                                        <button @click="activeQuestion = n"
                                            :class="{
                                                'bg-[#4A72D4] text-white shadow-lg shadow-blue-200': activeQuestion ===
                                                    n,
                                                'bg-emerald-500 text-white border-emerald-500': n <= soalTersimpan &&
                                                    activeQuestion !== n,
                                                'bg-gray-50 text-gray-400 border-gray-100': n > soalTersimpan &&
                                                    activeQuestion !== n
                                            }"
                                            class="aspect-square rounded-xl border-2 flex items-center justify-center font-bold text-xs transition-all hover:scale-110 relative">
                                            <span x-text="n"></span>
                                        </button>
                                    </template>
                                </div>

                                <div class="mt-8 space-y-3 pt-6 border-t border-gray-50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                                        <span class="text-[10px] font-bold text-gray-500 uppercase">Terisi</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-3 h-3 bg-[#4A72D4] rounded-full"></div>
                                        <span class="text-[10px] font-bold text-gray-500 uppercase">Aktif</span>
                                    </div>
                                </div>

                                <button :disabled="soalTersimpan < 20"
                                    class="w-full mt-8 py-4 bg-orange-500 disabled:bg-gray-200 disabled:text-gray-400 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-lg shadow-orange-100 transition-all">
                                    Publikasikan Kuis
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
    </div>

    <div x-show="showImportModal" class="fixed inset-0 z-[100] overflow-y-auto" x-cloak>

        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" @click="showImportModal = false">
        </div>

        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="relative bg-white w-full max-w-lg rounded-[35px] shadow-2xl p-8 transform transition-all"
                x-show="showImportModal" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-8"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                        <i class="fa-solid fa-file-import text-emerald-500"></i> Import Data Kuis
                    </h3>
                    <button @click="showImportModal = false"
                        class="text-gray-400 hover:text-red-500 transition-colors">
                        <i class="fa-solid fa-circle-xmark text-2xl"></i>
                    </button>
                </div>

                <div
                    class="border-4 border-dashed border-gray-100 rounded-[25px] p-10 flex flex-col items-center justify-center group hover:border-emerald-200 transition-all bg-gray-50/50">
                    <div
                        class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-cloud-arrow-up text-3xl text-emerald-500"></i>
                    </div>
                    <p class="text-sm font-bold text-gray-600">Klik atau seret file Excel ke sini</p>
                    <p class="text-[10px] text-gray-400 mt-2">Maksimal ukuran file: 5MB (.xlsx, .xls)</p>
                    <input type="file" class="hidden" id="excel_upload">
                    <button onclick="document.getElementById('excel_upload').click()"
                        class="mt-6 px-6 py-2 bg-emerald-500 text-white rounded-xl text-xs font-bold hover:bg-emerald-600 transition-all">Pilih
                        File</button>
                </div>

                <div class="mt-8 p-4 bg-blue-50 rounded-2xl flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-info text-blue-500"></i>
                        <span class="text-[11px] font-bold text-blue-700 uppercase tracking-tight">Belum punya
                            formatnya?</span>
                    </div>
                    <a href="#" class="text-[11px] font-black text-[#4A72D4] hover:underline">DOWNLOAD
                        TEMPLATE</a>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-8">
                    <button @click="showImportModal = false"
                        class="py-4 rounded-2xl text-sm font-bold text-gray-400 hover:bg-gray-50 transition-all">Batalkan</button>
                    <button
                        class="py-4 bg-[#4A72D4] text-white rounded-2xl text-sm font-bold shadow-lg shadow-blue-100 hover:bg-blue-700 transition-all">Proses
                        Import</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
