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

    currentPage: 1,
    itemsPerPage: 10,
    // Contoh data kuis (buat sampai 24 atau lebih)
    allKuis: [
        { id: 1, judul: 'Fundamental 1', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Aktif' },
        { id: 2, judul: 'Fundamental 1', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Aktif' },
        { id: 3, judul: 'Fundamental 1', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Draft' },
        { id: 4, judul: 'Fundamental 1', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Aktif' },
        { id: 5, judul: 'Fundamental 1', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Aktif' },
        { id: 6, judul: 'Fundamental 1', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Aktif' },
        { id: 7, judul: 'Fundamental 1', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Aktif' },
        { id: 8, judul: 'Fundamental 1', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Aktif' },
        { id: 9, judul: 'Fundamental 1', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Aktif' },
        { id: 10, judul: 'Fundamental 1', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Draft' },
        { id: 11, judul: 'Fundamental 1', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Aktif' },
        { id: 12, judul: 'Fundamental 1', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Aktif' },


        // ... tambahkan data kuis sampai 24 item
    ],

    // Fungsi untuk menghitung total halaman
    get totalPages() {
        return Math.ceil(this.allKuis.length / this.itemsPerPage);
    },

    // Fungsi untuk mengambil data yang hanya tampil di halaman aktif
    get pagedKuis() {
        let start = (this.currentPage - 1) * this.itemsPerPage;
        let end = start + this.itemsPerPage;
        return this.allKuis.slice(start, end);
    }
}">

    <div class="flex h-full w-full">
        <aside x-init="if(currentPage === 'kuis') { $el.scrollIntoView({ block: 'center' }) }" :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
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

                <a href="#" x-init="if(currentPage === 'kuis') { $el.scrollIntoView({ block: 'center' }) }"
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

            <main class="flex-1 flex flex-col min-w-0 h-full overflow-y-auto custom-scrollbar p-4 lg:p-8">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-blue-50 flex items-center gap-5">
                        <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-[#4A72D4]">
                            <i class="fa-solid fa-layer-group text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400 font-medium">Total Set Kuis</p>
                            <h4 class="text-2xl font-bold text-gray-800">12</h4>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-blue-50 flex items-center gap-5">
                        <div
                            class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500">
                            <i class="fa-solid fa-circle-check text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400 font-medium">Kuis Aktif</p>
                            <h4 class="text-2xl font-bold text-gray-800">10</h4>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-blue-50 flex items-center gap-5">
                        <div
                            class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-500">
                            <i class="fa-solid fa-clock-rotate-left text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400 font-medium">Draft</p>
                            <h4 class="text-2xl font-bold text-gray-800">2</h4>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-blue-50 overflow-hidden flex flex-col h-full">

                    <div
                        class="p-8 border-b border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4 flex-shrink-0">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Daftar Set Kuis</h3>
                            <p class="text-sm text-gray-400">Kelola soal, waktu, dan kategori kuis</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <button
                                class="bg-[#4A72D4] hover:bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold text-sm transition-all flex items-center gap-2 shadow-lg shadow-blue-100 active:scale-95">
                                <i class="fa-solid fa-plus"></i> Buat Set Baru
                            </button>
                        </div>
                    </div>

                    <div class="flex-1 overflow-y-auto overflow-x-auto custom-scrollbar">
                        <table class="w-full text-left border-separate border-spacing-0">
                            <thead class="bg-gray-50/50 sticky top-0 z-10 backdrop-blur-sm">
                                <tr>
                                    <th
                                        class="px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider bg-gray-50/80">
                                        Set & Judul</th>
                                    <th
                                        class="px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider bg-gray-50/80">
                                        Kategori</th>
                                    <th
                                        class="px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center bg-gray-50/80">
                                        Soal</th>
                                    <th
                                        class="px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center bg-gray-50/80">
                                        Durasi</th>
                                    <th
                                        class="px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center bg-gray-50/80">
                                        Status</th>
                                    <th
                                        class="px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center bg-gray-50/80">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <template x-for="(kuis, index) in pagedKuis" :key="kuis.id">
                                    <tr class="hover:bg-blue-50/30 transition-colors group">
                                        <td class="px-8 py-5">
                                            <div class="flex flex-col">
                                                <span class="font-bold text-gray-800 group-hover:text-[#4A72D4]"
                                                    x-text="'Set ' + kuis.id + ': ' + kuis.judul"></span>
                                                <span class="text-xs text-gray-400"
                                                    x-text="'Dibuat: ' + kuis.tanggal"></span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-5 text-sm font-medium text-gray-600"
                                            x-text="kuis.kategori"></td>
                                        <td class="px-8 py-5 text-center">
                                            <span
                                                class="bg-blue-50 text-[#4A72D4] text-xs font-bold px-3 py-1 rounded-full border border-blue-100"
                                                x-text="kuis.soal + ' Soal'"></span>
                                        </td>
                                        <td class="px-8 py-5 text-center text-sm font-semibold text-gray-700"
                                            x-text="kuis.durasi + ' Menit'"></td>
                                        <td class="px-8 py-5 text-center">
                                            <span
                                                :class="kuis.status === 'Aktif' ? 'bg-emerald-100 text-emerald-600' :
                                                    'bg-gray-100 text-gray-500'"
                                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase">
                                                <span
                                                    :class="kuis.status === 'Aktif' ? 'bg-emerald-500 animate-pulse' :
                                                        'bg-gray-400'"
                                                    class="w-1.5 h-1.5 rounded-full"></span>
                                                <span x-text="kuis.status"></span>
                                            </span>
                                        </td>

                                        <td class="px-8 py-5">
                                            <div class="flex items-center justify-center gap-2">
                                                <button
                                                    class="p-2 text-blue-400 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-all"
                                                    title="Edit Soal">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button
                                                    class="p-2 text-orange-400 hover:bg-orange-50 hover:text-orange-600 rounded-lg transition-all"
                                                    title="Preview Kuis">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                                <button
                                                    class="p-2 text-rose-400 hover:bg-rose-50 hover:text-rose-600 rounded-lg transition-all"
                                                    title="Hapus">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>

                    <div
                        class="p-8 border-t border-gray-50 flex flex-col sm:flex-row items-center justify-between gap-4 flex-shrink-0 bg-white">
                        <p class="text-sm text-gray-400 font-medium">
                            Menampilkan
                            <span x-text="((currentPage - 1) * itemsPerPage) + 1"></span> -
                            <span x-text="Math.min(currentPage * itemsPerPage, allKuis.length)"></span>
                            dari <span x-text="allKuis.length"></span> Set Kuis
                        </p>

                        <div class="flex items-center gap-2">
                            <button @click="if(currentPage > 1) currentPage--" :disabled="currentPage === 1"
                                class="w-10 h-10 flex items-center justify-center rounded-xl border border-gray-100 hover:bg-gray-50 text-gray-400 disabled:opacity-50">
                                <i class="fa-solid fa-chevron-left text-xs"></i>
                            </button>

                            <template x-for="page in totalPages" :key="page">
                                <button @click="currentPage = page"
                                    :class="currentPage === page ? 'bg-[#4A72D4] text-white shadow-blue-100' :
                                        'border border-gray-100 text-gray-600 hover:bg-gray-50'"
                                    class="w-10 h-10 flex items-center justify-center rounded-xl font-bold transition-all shadow-md"
                                    x-text="page">
                                </button>
                            </template>

                            <button @click="if(currentPage < totalPages) currentPage++"
                                :disabled="currentPage === totalPages"
                                class="w-10 h-10 flex items-center justify-center rounded-xl border border-gray-100 hover:bg-gray-50 text-gray-400 disabled:opacity-50">
                                <i class="fa-solid fa-chevron-right text-xs"></i>
                            </button>
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
