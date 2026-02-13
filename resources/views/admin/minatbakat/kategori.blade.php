<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori Bakat - Persisten</title>
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
            background: rgba(74, 114, 212, 0.2);
            border-radius: 10px;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-[#E9EFFF] h-screen overflow-hidden text-[#2D3B61]" x-data="{
    showAddModal: false,
    showEditModal: false,

    categories: [
        { id: 1, name: 'Logika Matematika', icon: 'fa-calculator', color: 'blue', desc: 'Kemampuan mengolah angka dan penalaran logis.', totalSoal: 15 },
        { id: 2, name: 'Visual Spasial', icon: 'fa-palette', color: 'emerald', desc: 'Kemampuan membayangkan bentuk dan ruang.', totalSoal: 12 },
        { id: 3, name: 'Linguistik', icon: 'fa-book', color: 'orange', desc: 'Kemampuan mengolah kata dan bahasa.', totalSoal: 20 },
        { id: 4, name: 'Interpersonal', icon: 'fa-users', color: 'purple', desc: 'Kemampuan memahami orang lain dan berempati.', totalSoal: 10 }
    ]
}">

    <div class="flex h-full w-full">
       <aside x-data="{ currentPage: 'minatbakat' }" :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
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

                <a href="#" x-init="if(currentPage === 'minatbakat') { $el.scrollIntoView({ block: 'center' }) }" 
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl bg-[#D4DEF7]  text-[#2E3B66] transition-all duration-200 group text-left">
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

                <a href="#" x-init="if(currentPage === 'minat-bakat') { $el.scrollIntoView({ block: 'center' }) }"
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

        <main class="flex-1 flex flex-col min-w-0 bg-[#F8FAFF] overflow-hidden p-4 lg:p-8">
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

            <div class="flex-1 pb-10 overflow-y-auto custom-scrollbar">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <template x-for="cat in categories" :key="cat.id">
                        <div
                            class="bg-white rounded-xl p-8 border border-blue-50/50 shadow-sm group hover:border-[#4A72D4] transition-all">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-16 h-16 rounded-3xl flex items-center justify-center text-2xl transition-all"
                                    :class="cat.color === 'blue' ?
                                        'bg-blue-50 text-blue-500 group-hover:bg-blue-500 group-hover:text-white' :
                                        cat.color === 'emerald' ?
                                        'bg-emerald-50 text-emerald-500 group-hover:bg-emerald-500 group-hover:text-white' :
                                        cat.color === 'orange' ?
                                        'bg-orange-50 text-orange-500 group-hover:bg-orange-500 group-hover:text-white' :
                                        'bg-purple-50 text-purple-500 group-hover:bg-purple-500 group-hover:text-white'">
                                    <i class="fa-solid" :class="cat.icon"></i>
                                </div>
                                <div class="flex gap-2">
                                    <button
                                        class="w-10 h-10 rounded-xl bg-gray-50 text-gray-400 hover:text-blue-500 transition-all"><i
                                            class="fa-solid fa-pen-to-square text-xs"></i></button>
                                    <button
                                        class="w-10 h-10 rounded-xl bg-gray-50 text-gray-400 hover:text-red-500 transition-all"><i
                                            class="fa-solid fa-trash text-xs"></i></button>
                                </div>
                            </div>

                            <h3 class="text-lg font-bold text-gray-800 mb-2" x-text="cat.name"></h3>
                            <p class="text-xs text-gray-400 leading-relaxed mb-6" x-text="cat.desc"></p>

                            <div class="flex items-center justify-between pt-6 border-t border-gray-50">
                                <div>
                                    <p class="text-[9px] font-bold text-gray-300 uppercase tracking-widest mb-1">
                                        Mapping Soal</p>
                                    <p class="text-xs font-bold text-gray-700" x-text="cat.totalSoal + ' Pertanyaan'">
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[9px] font-bold text-gray-300 uppercase tracking-widest mb-1">
                                        Status
                                    </p>
                                    <span class="text-[10px] font-bold text-emerald-500">AKTIF</span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </main>
    </div>

    <div x-show="showAddModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-6">
        <div class="absolute inset-0 bg-[#2D3B61]/40 backdrop-blur-sm" @click="showAddModal = false"></div>
        <div class="bg-white w-full max-w-xl rounded-[45px] p-12 relative shadow-2xl transition-all" x-transition>
            <h3 class="text-xl font-bold text-gray-800 mb-2 text-center tracking-tight">Tambah Kategori Bakat</h3>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center mb-10">Definisikan
                bakat
                baru ke dalam sistem</p>

            <div class="space-y-6 text-left">
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-3 block ml-2">Nama
                        Kategori</label>
                    <input type="text" placeholder="Contoh: Logika Matematika"
                        class="w-full px-8 py-5 bg-gray-50 rounded-2xl border-none text-xs font-bold focus:ring-2 focus:ring-blue-100 outline-none transition-all">
                </div>
                <div>
                    <label
                        class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-3 block ml-2">Deskripsi
                        Hasil (Untuk Raport)</label>
                    <textarea placeholder="Tulis deskripsi yang akan muncul di raport peserta..."
                        class="w-full px-8 py-5 bg-gray-50 rounded-2xl border-none text-xs font-bold focus:ring-2 focus:ring-blue-100 outline-none transition-all h-32"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <button @click="showAddModal = false"
                        class="py-5 rounded-2xl text-xs font-bold uppercase tracking-widest text-gray-400 hover:bg-gray-50 transition-all">Batalkan</button>
                    <button
                        class="py-5 bg-[#4A72D4] text-white rounded-2xl text-xs font-bold uppercase tracking-widest shadow-xl shadow-blue-100 hover:bg-blue-700 transition-all">Simpan
                        Kategori</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
