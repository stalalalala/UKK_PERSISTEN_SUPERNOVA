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
            height: 4px;
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

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    </style>
</head>

<body class="bg-[#E9EFFF] h-screen flex overflow-hidden text-[#2D3B61]" x-data="{
    activeMenu: 'Manajemen Tryout',
    mobileMenuOpen: false,
    activeTab: 'list',
    currentPage: 1,
    itemsPerPage: 10,

    allTryout: [
        { id: 1, judul: 'Try Out 1', subtes: 7, total_soal: 140, durasi: 195, status: 'Aktif', tgl: '12 Feb 2024' },
        { id: 2, judul: 'Try Out 1', subtes: 7, total_soal: 140, durasi: 195, status: 'Aktif', tgl: '10 Feb 2024' },
        { id: 3, judul: 'Try Out 1', subtes: 7, total_soal: 140, durasi: 195, status: 'Draft', tgl: '08 Feb 2024' },
        { id: 4, judul: 'Try Out 1', subtes: 7, total_soal: 140, durasi: 195, status: 'Aktif', tgl: '05 Feb 2024' },
        { id: 5, judul: 'Try Out 1', subtes: 5, total_soal: 100, durasi: 120, status: 'Aktif', tgl: '01 Feb 2024' },
        { id: 6, judul: 'Try Out 1', subtes: 5, total_soal: 100, durasi: 120, status: 'Aktif', tgl: '01 Feb 2024' },
        { id: 7, judul: 'Try Out 1', subtes: 5, total_soal: 100, durasi: 120, status: 'Aktif', tgl: '01 Feb 2024' },
        { id: 8, judul: 'Try Out 1', subtes: 5, total_soal: 100, durasi: 120, status: 'Aktif', tgl: '01 Feb 2024' },
        { id: 9, judul: 'Try Out 1', subtes: 5, total_soal: 100, durasi: 120, status: 'Aktif', tgl: '01 Feb 2024' },
        { id: 10, judul: 'Try Out 1', subtes: 5, total_soal: 100, durasi: 120, status: 'Aktif', tgl: '01 Feb 2024' },
        { id: 11, judul: 'Try Out 1', subtes: 5, total_soal: 100, durasi: 120, status: 'Aktif', tgl: '01 Feb 2024' },
        { id: 12, judul: 'Try Out 1', subtes: 5, total_soal: 100, durasi: 120, status: 'Aktif', tgl: '01 Feb 2024' },
    ],

    historyTryout: [],

    deleteToHistory(id) {
        const index = this.allTryout.findIndex(item => item.id === id);
        if (index !== -1) {
            this.historyTryout.push(this.allTryout[index]);
            this.allTryout.splice(index, 1);
        }
    },

    restoreFromHistory(id) {
        const index = this.historyTryout.findIndex(item => item.id === id);
        if (index !== -1) {
            this.allTryout.push(this.historyTryout[index]);
            this.historyTryout.splice(index, 1);
        }
    },

    permanentDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus permanen data ini?')) {
            this.historyTryout = this.historyTryout.filter(item => item.id !== id);
        }
    },

    get totalPages() {
        let data = this.activeTab === 'list' ? this.allTryout : this.historyTryout;
        return Math.ceil(data.length / this.itemsPerPage) || 1;
    },

    get pagedTryout() {
        let start = (this.currentPage - 1) * this.itemsPerPage;
        let end = start + this.itemsPerPage;
        return this.allTryout.slice(start, end);
    },

    get pagedHistory() {
        let start = (this.currentPage - 1) * this.itemsPerPage;
        let end = start + this.itemsPerPage;
        return this.historyTryout.slice(start, end);
    }
}">

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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <nav class="flex-1 space-y-1 overflow-y-auto pr-2 custom-scrollbar">
             <a href="{{ route('admin.dashboard.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl  transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
            <span class="text-md font-regular">Dashboard</span>
        </a>

        <a href="{{ route('admin.user.index') }}"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl  transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen user</span>
        </a>

        <a href="{{ route('admin.streak.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 0 0 .495-7.468 5.99 5.99 0 0 0-1.925 3.547 5.975 5.975 0 0 1-2.133-1.001A3.75 3.75 0 0 0 12 18Z" />
            </svg>
            <span class="text-md font-regular">Manajemen streak</span>
        </a>

         <a href="{{ route('admin.tryout.index') }}" x-init="if(currentPage === 'tryout') { $el.scrollIntoView({ block: 'center' }) }"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl bg-[#D4DEF7]  text-[#2E3B66] transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
            <span class="text-md font-regular">Manajemen tryout</span>
        </a>

         <a href="{{ route('admin.kuis.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
            </svg>
            <span class="text-md font-regular">Manajemen kuis</span>
        </a>

         <a href="{{ route('admin.latihan.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
            </svg>
            <span class="text-md font-regular">Manajemen latihan
soal</span>
        </a>

         <a href="{{ route('admin.videoPembelajaran.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-9">
            <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
            <span class="text-md font-regular">Manajemen video
pembelajaran</span>
        </a>

         <a href="{{ route('admin.minatBakat.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
            </svg>
            <span class="text-md font-regular">Manajemen minat 
bakat</span>
        </a>

        

         <a href="{{ route('admin.peluang.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
            </svg>
            <span class="text-md font-regular">Manajemen peluang
PTN</span>
        </a>

         <a href="{{ route('admin.laporan.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
            </svg>
            <span class="text-md font-regular">Monitoring dan
laporan</span>
        </a>
        </nav>

         <form action="{{ route('logout') }}" method="POST" class="w-full inline">
    @csrf
    <button type="submit" class="mt-4 w-full flex items-center bg-white/10 hover:bg-white/20 px-6 py-3 rounded-2xl transition-all group border border-white/20 backdrop-blur-sm shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 md:size-6 text-white">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
        </svg>
        <span class="text-white text-md font-medium tracking-wide ml-4">Logout</span>
    </button>
    </form>
    </aside>

    <div x-show="mobileMenuOpen" x-transition:enter="transition opacity-ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition opacity-ease-in duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" @click="mobileMenuOpen = false"
        class="fixed inset-0 bg-black/50 z-40 lg:hidden">
    </div>

    <main class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden">

        <header
            class="flex flex-col md:flex-row items-center justify-between p-4 lg:px-8 lg:pt-8 lg:pb-4 gap-4 flex-shrink-0">
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
                            <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                        </div>
                        <input type="text" placeholder="Search Tryout...."
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
                <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto custom-scrollbar p-4 lg:px-8 lg:pb-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-blue-50 flex items-center gap-5">
                    <div
                        class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 shadow-inner">
                        <i class="fa-solid fa-pen-nib text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Total Tryout</p>
                        <h4 class="text-2xl font-bold text-gray-800" x-text="allTryout.length"></h4>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-blue-50 flex items-center gap-5">
                    <div
                        class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500 shadow-inner">
                        <i class="fa-solid fa-bolt text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Aktif</p>
                        <h4 class="text-2xl font-bold text-gray-800"
                            x-text="allTryout.filter(t => t.status === 'Aktif').length"></h4>
                    </div>
                </div>
                <div
                    class="bg-white p-6 rounded-xl shadow-sm border border-blue-50 flex items-center gap-5 sm:col-span-2 md:col-span-1">
                    <div
                        class="w-14 h-14 bg-rose-50 rounded-2xl flex items-center justify-center text-rose-500 shadow-inner">
                        <i class="fa-solid fa-trash-can text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">History</p>
                        <h4 class="text-2xl font-bold text-gray-800" x-text="historyTryout.length"></h4>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-blue-50 overflow-hidden flex flex-col">

                <div
                    class="p-6 md:p-8 border-b border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800"
                            x-text="activeTab === 'list' ? 'Daftar Tryout' : 'History / Tempat Sampah'"></h3>
                        <p class="text-sm text-gray-400"
                            x-text="activeTab === 'list' ? 'Kelola subtes, soal, dan durasi tryout' : 'Data yang dihapus sementara dapat dipulihkan di sini'">
                        </p>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <button @click="activeTab = activeTab === 'list' ? 'history' : 'list'; currentPage = 1"
                            class="flex-1 md:flex-none bg-orange-500 hover:bg-orange-600 text-white px-5 py-3 rounded-xl font-semibold text-xs transition-all flex items-center justify-center gap-2 shadow-lg shadow-orange-100 active:scale-95">
                            <i
                                :class="activeTab === 'list' ? 'fa-solid fa-clock-rotate-left' : 'fa-solid fa-list'"></i>
                            <span x-text="activeTab === 'list' ? 'History' : 'Kembali ke Daftar'"></span>
                        </button>
                        <a href="/tryout/create"
                            class="flex-1 md:flex-none bg-[#4A72D4] hover:bg-blue-600 text-white px-5 py-3 rounded-xl font-semibold text-xs transition-all flex items-center justify-center gap-2 shadow-lg shadow-blue-100 active:scale-95">
                            <i class="fa-solid fa-plus-circle"></i> Buat Baru
                        </a>
                    </div>
                </div>

                <div class="table-responsive custom-scrollbar">
                    <table x-show="activeTab === 'list'"
                        class="w-full text-left border-separate border-spacing-0 min-w-[800px]">
                        <thead class="bg-gray-50/50 sticky top-0 z-10 backdrop-blur-sm">
                            <tr>
                                <th class="px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                                    Informasi Tryout</th>
                                <th
                                    class="px-16 md:px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center">
                                    Subtes</th>
                                <th
                                    class="px-12 md:px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center">
                                    Total Soal</th>
                                <th
                                    class="px-16 md:px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center">
                                    Durasi</th>
                                <th
                                    class="px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center">
                                    Status</th>
                                <th
                                    class="px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <template x-for="(to, index) in pagedTryout" :key="to.id">
                                <tr class="hover:bg-blue-50/30 transition-colors group">
                                    <td class="px-8 py-5">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-gray-800 group-hover:text-[#4A72D4]"
                                                x-text="to.judul"></span>
                                            <span class="text-[10px] text-gray-400 font-medium uppercase"
                                                x-text="'ID: #TO-' + to.id + ' • ' + to.tgl"></span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-center">
                                        <span
                                            class="bg-indigo-50 text-indigo-600 text-[11px] font-bold px-3 py-1.5 rounded-xl border border-indigo-100"
                                            x-text="to.subtes + ' Subtes'"></span>
                                    </td>
                                    <td class="px-8 py-5 text-center text-sm font-bold text-gray-600"
                                        x-text="to.total_soal + ' Soal'"></td>
                                    <td class="px-8 py-5 text-center text-sm font-semibold text-gray-700">
                                        <div class="flex items-center justify-center gap-2">
                                            <i class="fa-regular fa-clock text-gray-400"></i>
                                            <span x-text="to.durasi + ' Menit'"></span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-center">
                                        <span
                                            :class="to.status === 'Aktif' ? 'bg-emerald-100 text-emerald-600' :
                                                'bg-gray-100 text-gray-500'"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-bold uppercase">
                                            <span
                                                :class="to.status === 'Aktif' ? 'bg-emerald-500 animate-pulse' :
                                                    'bg-gray-400'"
                                                class="w-1.5 h-1.5 rounded-full"></span>
                                            <span x-text="to.status"></span>
                                        </span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center justify-center gap-2">
                                            <button
                                                class="p-2 text-blue-400 hover:bg-blue-50 rounded-lg transition-all"
                                                title="Edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <button
                                                class="p-2 text-orange-400 hover:bg-orange-50 rounded-lg transition-all"
                                                title="Laporan"><i class="fa-solid fa-chart-line"></i></button>
                                            <button @click="deleteToHistory(to.id)"
                                                class="p-2 text-rose-400 hover:bg-rose-50 rounded-lg transition-all"
                                                title="Hapus"><i class="fa-solid fa-trash-can"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                            <tr x-show="allTryout.length === 0">
                                <td colspan="6" class="px-8 py-10 text-center text-gray-400 italic">Tidak ada
                                    tryout aktif.</td>
                            </tr>
                        </tbody>
                    </table>

                    <table x-show="activeTab === 'history'"
                        class="w-full text-left border-separate border-spacing-0 min-w-[800px]">
                        <thead class="bg-orange-50/50 sticky top-0 z-10 backdrop-blur-sm">
                            <tr>
                                <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                    Judul Terhapus</th>
                                <th
                                    class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">
                                    Subtes</th>
                                <th
                                    class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">
                                    Status Terakhir</th>
                                <th
                                    class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">
                                    Aksi Pemulihan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <template x-for="hist in pagedHistory" :key="hist.id">
                                <tr class="hover:bg-orange-50/30 transition-colors group">
                                    <td class="px-8 py-5">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-gray-800" x-text="hist.judul"></span>
                                            <span class="text-[10px] text-rose-400 font-bold uppercase">SAMPAH /
                                                HISTORY</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-center">
                                        <span
                                            class="bg-gray-50 text-gray-600 text-[11px] font-bold px-3 py-1.5 rounded-xl border border-gray-100"
                                            x-text="hist.subtes + ' Subtes'"></span>
                                    </td>
                                    <td class="px-8 py-5 text-center">
                                        <span
                                            class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-[10px] font-black uppercase"
                                            x-text="hist.status"></span>
                                    </td>
                                    <td class="px-8 py-5 text-center">
                                        <div class="flex items-center justify-center gap-3">
                                            <button @click="restoreFromHistory(hist.id)"
                                                class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl text-xs font-bold transition-all shadow-md active:scale-95">
                                                <i class="fa-solid fa-rotate-left"></i> Pulihkan
                                            </button>
                                            <button @click="permanentDelete(hist.id)"
                                                class="px-4 py-2 bg-rose-500 hover:bg-rose-600 text-white rounded-xl text-xs font-bold transition-all shadow-md active:scale-95">
                                                <i class="fa-solid fa-circle-xmark"></i> Hapus Permanen
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                            <tr x-show="historyTryout.length === 0">
                                <td colspan="4" class="px-8 py-10 text-center text-gray-400 italic">History kosong.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div
                    class="p-6 md:p-8 border-t border-gray-50 flex flex-col sm:flex-row items-center justify-between gap-4 bg-white">
                    <p class="text-[10px] md:text-[11px] text-gray-400 font-bold uppercase tracking-wider">
                        Menampilkan
                        <span class="text-gray-700" x-text="((currentPage - 1) * itemsPerPage) + 1"></span> -
                        <span class="text-gray-700"
                            x-text="activeTab === 'list' ? Math.min(currentPage * itemsPerPage, allTryout.length) : Math.min(currentPage * itemsPerPage, historyTryout.length)"></span>
                        dari <span class="text-gray-700"
                            x-text="activeTab === 'list' ? allTryout.length : historyTryout.length"></span> Data
                    </p>

                    <div class="flex items-center gap-2">
                        <button @click="if(currentPage > 1) currentPage--" :disabled="currentPage === 1"
                            class="w-10 h-10 flex items-center justify-center rounded-xl border border-gray-100 hover:bg-gray-50 text-gray-400 disabled:opacity-50">
                            <i class="fa-solid fa-chevron-left text-xs"></i>
                        </button>

                        <div class="flex gap-2">
                            <template x-for="page in totalPages" :key="page">
                                <button @click="currentPage = page"
                                    :class="currentPage === page ? 'bg-[#4A72D4] text-white shadow-blue-100' :
                                        'border border-gray-100 text-gray-600 hover:bg-gray-50'"
                                    class="w-10 h-10 flex items-center justify-center rounded-xl font-bold text-xs transition-all shadow-md"
                                    x-text="page">
                                </button>
                            </template>
                        </div>

                        <button @click="if(currentPage < totalPages) currentPage++"
                            :disabled="currentPage === totalPages"
                            class="w-10 h-10 flex items-center justify-center rounded-xl border border-gray-100 hover:bg-gray-50 text-gray-400 disabled:opacity-50">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>
