<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persisten Dashboard - Manajemen Tryout</title>
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

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-[#E9EFFF] h-screen overflow-hidden text-[#2D3B61]" x-data="{
    mobileMenuOpen: false,
    activeSubtesIndex: null,
    activeQuestion: 1,
    targetSoal: 20,
    imageUrl: null,

    subtesList: [
        { name: 'Penalaran Umum', completed: false, soalTerisi: 0, waktu: 20 },
        { name: 'Penalaran & Pemahaman Umum', completed: false, soalTerisi: 0, waktu: 20 },
        { name: 'Pemahaman Bacaan & Menulis', completed: false, soalTerisi: 0, waktu: 20 },
        { name: 'Pengetahuan Kuantitatif', completed: false, soalTerisi: 0, waktu: 20 },
        { name: 'Penalaran Matematika', completed: false, soalTerisi: 0, waktu: 20 },
        { name: 'Literasi Bahasa Indonesia', completed: false, soalTerisi: 0, waktu: 20 },
        { name: 'Literasi Bahasa Inggris', completed: false, soalTerisi: 0, waktu: 20 }
    ],

    get canPublish() {
        return this.subtesList.every(s => s.completed);
    },

    selectSubtes(index) {
        this.activeSubtesIndex = index;
        this.activeQuestion = 1;
        this.imageUrl = null;
    },

    handleImage(event) {
        const file = event.target.files[0];
        if (file) {
            this.imageUrl = URL.createObjectURL(file);
        }
    },

    step: 'pilih_subtes', // Default awal
    activeSubtesIndex: null,
    activeQuestion: 1,

    // Fungsi untuk pindah ke mode edit
    selectSubtes(index) {
        this.activeSubtesIndex = index;
        this.step = 'editing';
    },

    simpanSoal() {
        let current = this.subtesList[this.activeSubtesIndex];
        if (current.soalTerisi < this.targetSoal) {
            current.soalTerisi++;
            if (this.activeQuestion < 20) {
                this.activeQuestion++;
            }
            document.getElementById('formTryout').reset();
            this.imageUrl = null;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    },

    selesaikanSubtes() {
        if (confirm('Selesaikan subtes ini? Pastikan 20 soal sudah terinput.')) {
            this.subtesList[this.activeSubtesIndex].completed = true;
            this.activeSubtesIndex = null;
        }
    }
}">

    <div class="flex h-full w-full">
        <aside x-data="{ currentPage: 'tryout' }" :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
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

                <a href="#" x-init="if (currentPage === 'tryout') { $el.scrollIntoView({ block: 'center' }) }"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl bg-[#D4DEF7]  text-[#2E3B66] transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen tryout</span>
                </a>

                <a href="#"
                    class="w-full flex items-center gap-4 px-4 py-3  rounded-2xl transition-all duration-200 group text-left">
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

            <div x-show="activeSubtesIndex === null" x-transition>
                <div class="mb-8">
                    <h2 class="text-2xl font-extrabold text-[#4A72D4]">Edit Tryout</h2>
                    <p class="text-gray-400 text-sm">Pilih subtes untuk melengkapi data 20 soal dan penjelasan.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <template x-for="(sub, index) in subtesList" :key="index">
                        <div @click="selectSubtes(index)"
                            class="bg-white p-6 rounded-[30px] shadow-sm border-2 border-transparent hover:border-[#4A72D4] transition-all cursor-pointer group">
                            <div class="flex justify-between items-start mb-4">
                                <div class="p-3 rounded-2xl"
                                    :class="sub.completed ? 'bg-emerald-100 text-emerald-600' : 'bg-blue-50 text-[#4A72D4]'">
                                    <i class="fa-solid"
                                        :class="sub.completed ? 'fa-check-double' : 'fa-book-open'"></i>
                                </div>
                                <div class="text-right">
                                    <span class="block text-[10px] font-bold text-gray-400 uppercase">Waktu</span>
                                    <span class="text-xs font-bold text-orange-500"
                                        x-text="sub.waktu + ' Menit'"></span>
                                </div>
                            </div>
                            <h3 class="font-bold text-gray-800 mb-1" x-text="sub.name"></h3>
                            <p class="text-xs text-gray-400">Progress: <span class="text-[#4A72D4] font-bold"
                                    x-text="sub.soalTerisi"></span>/20</p>
                            <div class="w-full bg-gray-100 h-1.5 rounded-full mt-4">
                                <div class="bg-[#4A72D4] h-full rounded-full transition-all"
                                    :style="`width: ${(sub.soalTerisi/20)*100}%`"></div>
                            </div>
                        </div>
                    </template>
                </div>

                <div
                    class="mt-12 p-8 bg-white rounded-[35px] border-2 border-dashed border-gray-200 flex flex-col items-center">
                    <button :disabled="!canPublish"
                        class="px-12 py-4 bg-orange-500 disabled:bg-gray-200 text-white rounded-2xl font-bold shadow-xl transition-all active:scale-95">
                        <i class="fa-solid fa-paper-plane mr-2"></i> PUBLIKASIKAN TRYOUT
                    </button>
                    <p class="mt-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest"
                        x-show="!canPublish">
                        Lengkapi semua subtes (7/7) untuk rilis</p>
                </div>
            </div>

            <div x-show="activeSubtesIndex !== null" x-cloak x-transition>
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                    <div class="flex items-center gap-4">
                        <button @click="activeSubtesIndex = null"
                            class="p-3 bg-white rounded-xl text-gray-400 hover:text-red-500 shadow-sm transition-all">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                        <div>
                            <h2 class="text-xl font-extrabold text-[#4A72D4]"
                                x-text="subtesList[activeSubtesIndex]?.name"></h2>
                            <p class="text-gray-400 text-xs font-medium uppercase tracking-widest">Edit Soal
                                Tryout
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-2xl shadow-sm border border-blue-50"
                        x-data="{ openWaktu: false }">
                        <i class="fa-solid fa-stopwatch text-orange-400"></i>
                        <div class="relative">
                            <button @click="openWaktu = !openWaktu" type="button"
                                class="text-sm font-bold text-gray-700 flex items-center gap-2 outline-none">
                                <span x-text="subtesList[activeSubtesIndex]?.waktu + ' Menit'"></span>
                                <i class="fa-solid fa-chevron-down text-[10px]"></i>
                            </button>
                            <div x-show="openWaktu" @click.away="openWaktu = false"
                                class="absolute right-0 mt-2 w-32 bg-white rounded-xl shadow-xl border z-50 overflow-hidden">
                                <template x-for="t in [15, 20, 25, 30, 45, 60]">
                                    <div @click="subtesList[activeSubtesIndex].waktu = t; openWaktu = false"
                                        class="px-4 py-2 text-[11px] font-bold text-gray-600 hover:bg-blue-50 hover:text-[#4A72D4] cursor-pointer">
                                        <span x-text="t + ' Menit'"></span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white rounded-[30px] p-6 lg:p-10 shadow-sm border border-blue-50">
                            <form id="formTryout" @submit.prevent="simpanSoal()">

                                <div class="space-y-6">

                                    <div class="space-y-2">
                                        <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Materi atau
                                            Teks (Opsional)</label>
                                        <div class="relative group">
                                            <textarea x-data="{
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
                                                    <span class="text-[10px] font-bold text-blue-600 uppercase">Tambah
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
                                                <button @click="imageUrl = null" type="button"
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
                                        <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Pertanyaan
                                            Nomor <span x-text="activeQuestion"></span></label>
                                        <textarea required x-data="{
                                            resize() {
                                                $el.style.height = 'auto';
                                                $el.style.height = ($el.scrollHeight < 120 ? 120 : $el.scrollHeight) + 'px';
                                            }
                                        }" x-init="resize()" @input="resize()"
                                            class="w-full bg-gray-50 border-none rounded-[25px] p-6 text-sm focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none shadow-inner transition-all overflow-hidden resize-none"
                                            placeholder="Masukkan teks pertanyaan di sini..." style="min-height: 120px;"></textarea>
                                    </div>

                                    <div class="grid grid-cols-1 gap-4" x-data="{ jawabanTerpilih: null }">
                                        <template x-for="(opt, i) in ['A','B','C','D','E']" :key="i">
                                            <div :class="jawabanTerpilih === i ? 'bg-emerald-50 border-emerald-200' :
                                                'bg-gray-50 border-transparent'"
                                                class="flex items-start gap-4 p-4 rounded-2xl border-2 transition-all">

                                                <span
                                                    class="w-10 h-10 shrink-0 flex items-center justify-center bg-white rounded-xl shadow-sm font-black text-[#4A72D4]"
                                                    x-text="opt"></span>

                                                <textarea placeholder="Tulis jawaban di sini..." required
                                                    @input="$el.style.height = '40px'; $el.style.height = $el.scrollHeight + 'px'"
                                                    class="flex-1 bg-transparent border-none outline-none text-sm font-medium pt-2 resize-none overflow-hidden"
                                                    style="height: 40px;"></textarea>

                                                <div class="pt-2">
                                                    <input type="radio" name="benar" @click="jawabanTerpilih = i"
                                                        required
                                                        class="w-5 h-5 accent-emerald-500 cursor-pointer shrink-0">
                                                </div>
                                            </div>
                                        </template>
                                    </div>

                                    <div class="pt-6 border-t border-gray-100">
                                        <div class="space-y-2">
                                            <label
                                                class="text-[10px] font-bold text-orange-500 uppercase flex items-center gap-2 ml-1">
                                                <i class="fa-solid fa-lightbulb text-sm"></i> Penjelasan Jawaban
                                            </label>
                                            <textarea required x-data="{
                                                resize() {
                                                    $el.style.height = 'auto';
                                                    $el.style.height = ($el.scrollHeight < 100 ? 100 : $el.scrollHeight) + 'px';
                                                }
                                            }" x-init="resize()" @input="resize()"
                                                class="w-full bg-orange-50/30 border-2 border-orange-100 rounded-[25px] p-6 text-sm focus:bg-white focus:ring-2 focus:ring-orange-200 outline-none transition-all overflow-hidden resize-none"
                                                placeholder="Tuliskan alasan dan pembahasan jawaban benar di sini..." style="min-height: 100px;"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between mt-10">
                                    <button type="reset" @click="imageUrl = null; selected = null"
                                        class="text-xs font-bold text-gray-400 hover:text-red-400 transition-colors uppercase tracking-widest">Reset
                                        Form</button>
                                    <button type="submit" :disabled="subtesList[activeSubtesIndex]?.soalTerisi >= 20"
                                        class="bg-[#4A72D4] text-white px-10 py-4 rounded-2xl font-bold text-sm shadow-lg shadow-blue-100 hover:-translate-y-1 transition-all disabled:bg-gray-200">
                                        SIMPAN & LANJUT <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-blue-50">
                            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-6">Navigasi
                                Soal</h4>
                            <div class="grid grid-cols-5 gap-3">
                                <template x-for="n in 20">
                                    <button @click="activeQuestion = n"
                                        :class="{
                                            'bg-[#4A72D4] text-white shadow-lg shadow-blue-200': activeQuestion === n,
                                            'bg-emerald-500 text-white border-emerald-500': n <= subtesList[
                                                activeSubtesIndex]?.soalTerisi && activeQuestion !== n,
                                            'bg-gray-50 text-gray-400 border-gray-100': n > subtesList[
                                                activeSubtesIndex]?.soalTerisi && activeQuestion !== n
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
                            <button @click="selesaikanSubtes()"
                                :disabled="subtesList[activeSubtesIndex]?.soalTerisi < 20"
                                class="w-full mt-8 py-4 bg-emerald-500 disabled:bg-gray-100 disabled:text-gray-400 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-lg shadow-emerald-100 transition-all">
                                Selesaikan Subtes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>
