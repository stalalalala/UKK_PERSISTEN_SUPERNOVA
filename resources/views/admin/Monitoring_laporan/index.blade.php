<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Rinci - Persisten</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * { font-family: 'Poppins', sans-serif !important; }
        [x-cloak] { display: none !important; }
        
        /* Custom Scrollbar */
        .log-scroll::-webkit-scrollbar { width: 4px; }
        .log-scroll::-webkit-scrollbar-track { background: transparent; }
        .log-scroll::-webkit-scrollbar-thumb { background: #E2E8F0; border-radius: 10px; }
        
        .nav-scroll::-webkit-scrollbar { width: 4px; }
        .nav-scroll::-webkit-scrollbar-track { background: transparent; }
        .nav-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 10px; }

        /* Desktop Layout Fixes */
        @media (min-width: 1024px) {
            body { overflow: hidden; }
            .admin-layout { display: grid; grid-template-columns: 288px 1fr; height: 100vh; }
        }
    </style>
</head>
<body class="bg-[#F8FAFC]" 
      x-data="{ 
        currentPage: 'monitoring',
        currentAdmin: 'Sean',
        openYear: 2026,
        openMonth: null,
        showDraftDetail: false,
        selectedDraftTitle: '',
        mobileMenuOpen: false,

        allLogs: [
            { admin: 'Sean', hari: 'Rabu', aksi: 'Update Kuota', objek: 'Kedokteran - UI', detail: 'Mengubah kuota dari 50 menjadi 75', waktu: '11 Feb 2026', jam: '14:20:45' },
            { admin: 'Admin 2', hari: 'Rabu', aksi: 'Hapus Prodi', objek: 'Sastra Mesin - ITB', detail: 'Menghapus prodi karena tidak aktif', waktu: '11 Feb 2026', jam: '13:05:12' },
            { admin: 'Sean', hari: 'Selasa', aksi: 'Edit Lokasi', objek: 'UNAIR', detail: 'Mengubah lokasi: Surabaya Kampus A -> Kampus C', waktu: '10 Feb 2026', jam: '09:45:03' },
            { admin: 'Admin 3', hari: 'Selasa', aksi: 'Tambah Univ', objek: 'UGM Yogyakarta', detail: 'Mendaftarkan universitas baru ke sistem', waktu: '10 Feb 2026', jam: '08:30:59' }
        ],

        archiveData: [
            { tahun: 2026, bulan: [{ nama: 'Februari', minggu: ['Minggu 1', 'Minggu 2'] }] },
            { tahun: 2025, bulan: [{ nama: 'Desember', minggu: ['Minggu 3', 'Minggu 4'] }] }
        ],

        openDraft(year, month, week) {
            this.selectedDraftTitle = `Laporan ${week} - ${month} ${year}`;
            this.showDraftDetail = true;
        }
      }">

    <div class="admin-layout">
        <aside :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed inset-y-0 left-0 z-50 w-72 bg-[#4A72D4] text-white flex flex-col p-6 shadow-xl transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 shrink-0 h-screen overflow-y-auto">

    <div class="flex items-center justify-between mb-10 px-2">
        <div class="flex items-center gap-3">
            <div class="bg-white p-2 rounded-xl">
                <svg class="w-6 h-6 text-[#4A72D4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
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

    <nav class="flex-1 space-y-1 overflow-y-auto pr-2 
                [&::-webkit-scrollbar]:w-1 
                [&::-webkit-scrollbar-track]:bg-transparent 
                [&::-webkit-scrollbar-thumb]:bg-white/20 
                [&::-webkit-scrollbar-thumb]:rounded-full">
        
        <a href="#"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <div class="w-5 h-5 border-2 border-white/50 rounded group-hover:border-white transition-colors shrink-0"></div>
            <span class="text-md font-regular">Dashboard</span>
        </a>

        <a href="#"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl  transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen user</span>
        </a>

        <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen streak</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen tryout</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen kuis</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen latihan soal</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen video pembelajaran</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen minat  bakat</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen peluang PTN</span>
        </a>

         <a href="#" 
            x-init="if(currentPage === 'monitoring') { $el.scrollIntoView({ block: 'center' }) }"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left bg-[#D4DEF7]  text-[#2E3B66]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Monitoring dan laporan</span>
        </a>

        </nav>

    <button class="mt-4 w-full flex items-center bg-white/10 hover:bg-white/20 px-6 py-3 rounded-2xl transition-all group border border-white/20 backdrop-blur-sm shrink-0">
        <svg xmlns="http://www.w3.org/2000/xml" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 md:size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
        </svg>
        <span class="text-white text-md font-medium tracking-wide ml-4">Logout</span>
    </button>
</aside>

        <main class="flex flex-col h-full lg:h-screen overflow-hidden p-4 lg:p-8">
            <header class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4 shrink-0">
                <div class="flex items-center w-full gap-4">
                    <button @click="mobileMenuOpen = true" class="lg:hidden p-3 bg-white rounded-xl shadow-sm hover:bg-gray-50 transition-all">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    
                    <div class="relative w-full group flex items-center gap-2">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </div>
                            <input type="text" placeholder="Search...."
                                class="w-full bg-white border-none rounded-full py-3 pl-12 pr-4 shadow-sm focus:ring-2 focus:ring-blue-400 outline-none transition-all">
                        </div>
                        <button class="bg-[#4A72D4] hover:bg-blue-600 text-white px-6 py-3 rounded-full text-sm font-medium shadow-sm transition-all active:scale-95 shrink-0">
                            Cari
                        </button>
                    </div>
                </div>

                <div class="flex items-center gap-3 bg-white p-1 pr-4 pl-1 rounded-full shadow-sm shrink-0 self-end md:self-auto border border-gray-100">
                    <div class="w-10 h-10 bg-gray-200 rounded-full overflow-hidden border-2 border-white">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=random" alt="Admin">
                    </div>
                    <span class="font-bold text-sm hidden sm:block text-gray-700">Admin</span>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto space-y-8 pr-2 log-scroll">
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm flex flex-col h-[400px]">
                        <div class="p-6 border-b flex justify-between items-center">
                            <h3 class="text-[10px] font-black uppercase text-slate-500 tracking-widest">Aktivitas Saya</h3>
                        </div>
                        <div class="flex-1 overflow-y-auto log-scroll p-4 space-y-4">
                            <template x-for="log in allLogs.filter(l => l.admin === currentAdmin)">
                                <div class="p-5 bg-white border border-slate-100 rounded-3xl shadow-sm hover:border-[#4A72D4] transition-all">
                                    <div class="flex justify-between items-start mb-2">
                                        <span class="text-[9px] font-black px-2 py-1 bg-[#4A72D4] text-white rounded-lg uppercase w-fit" x-text="log.aksi"></span>
                                        <span class="text-[10px] font-bold text-slate-400" x-text="log.jam"></span>
                                    </div>
                                    <p class="text-xs font-black text-slate-800" x-text="log.objek"></p>
                                    <p class="text-[11px] text-slate-500 italic mt-1" x-text="'» ' + log.detail"></p>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm flex flex-col h-[400px]">
                        <div class="p-6 border-b flex justify-between items-center">
                            <h3 class="text-[10px] font-black uppercase text-slate-500 tracking-widest">Semua Admin</h3>
                        </div>
                        <div class="flex-1 overflow-y-auto log-scroll p-4 space-y-3">
                            <template x-for="log in allLogs">
                                <div class="p-4 bg-slate-50 rounded-[1.5rem] border border-transparent hover:border-slate-200 transition-all">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-[10px] font-black text-slate-400" x-text="log.admin[0]"></div>
                                            <div>
                                                <p class="text-[11px] font-black text-slate-700" x-text="log.admin"></p>
                                                <p class="text-[9px] text-[#4A72D4] font-bold" x-text="log.aksi"></p>
                                            </div>
                                        </div>
                                        <p class="text-[9px] font-bold text-slate-400" x-text="log.jam"></p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="space-y-6 pb-20">
                    <div class="flex items-center gap-3">
                        <div class="w-1.5 h-6 bg-amber-400 rounded-full"></div>
                        <h3 class="text-xs font-black uppercase tracking-[0.3em] text-slate-400">Arsip Folder Draf</h3>
                    </div>

                    <template x-for="item in archiveData">
                        <div class="bg-white rounded-[2rem] border border-slate-100 overflow-hidden shadow-sm">
                            <button @click="openYear = (openYear === item.tahun ? null : item.tahun)" class="w-full flex items-center justify-between p-6 hover:bg-slate-50 transition-all">
                                <span class="text-lg font-black text-slate-800" x-text="item.tahun"></span>
                                <svg class="w-5 h-5 transition-transform" :class="openYear === item.tahun ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="3" d="M19 9l-7 7-7-7"/></svg>
                            </button>

                            <div x-show="openYear === item.tahun" x-collapse class="p-4 lg:p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 bg-slate-50/30">
                                <template x-for="bln in item.bulan">
                                    <div class="bg-white p-2 rounded-3xl border border-slate-100">
                                        <button @click="openMonth = (openMonth === bln.nama ? null : bln.nama)" class="w-full p-4 flex items-center gap-3 hover:bg-amber-50 rounded-2xl transition-all text-left">
                                            <svg class="w-5 h-5 text-amber-400 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path></svg>
                                            <span class="text-[11px] font-black text-slate-700 uppercase" x-text="bln.nama"></span>
                                        </button>
                                        <div x-show="openMonth === bln.nama" x-collapse class="space-y-1 p-2">
                                            <template x-for="mgg in bln.minggu">
                                                <button @click="openDraft(item.tahun, bln.nama, mgg)" class="w-full text-left p-3 pl-6 text-[10px] font-bold text-slate-400 hover:text-[#4A72D4] hover:bg-blue-50 rounded-xl transition-all">
                                                    <span x-text="mgg"></span>
                                                </button>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </main>
    </div>

    <div x-show="showDraftDetail" x-transition x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 lg:p-6 bg-slate-900/80 backdrop-blur-md">
        <div @click.away="showDraftDetail = false" class="bg-white rounded-[2rem] w-full max-w-2xl overflow-hidden shadow-2xl">
            <div class="bg-slate-900 p-8 text-white flex justify-between items-center">
                <div>
                    <h4 class="text-xl font-black uppercase italic tracking-tighter" x-text="selectedDraftTitle"></h4>
                    <p class="text-[9px] font-black text-slate-500 uppercase tracking-[0.3em] mt-1">Data Aktivitas</p>
                </div>
                <button @click="showDraftDetail = false" class="text-slate-500 hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-8">
                <div class="max-h-[350px] overflow-y-auto log-scroll space-y-6">
                    <template x-for="(day, index) in ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']">
                        <div class="flex gap-6 pb-6 border-b border-slate-100 last:border-0">
                            <div class="text-right min-w-[80px]">
                                <p class="text-[10px] font-black text-[#4A72D4] uppercase" x-text="day"></p>
                                <p class="text-[9px] font-bold text-slate-300 italic">08:15:22</p>
                            </div>
                            <div>
                                <p class="text-xs font-black text-slate-800 uppercase">Update Data Harian</p>
                                <p class="text-[11px] text-slate-500 mt-1 italic leading-relaxed">» Sinkronisasi otomatis log sistem bulanan.</p>
                            </div>
                        </div>
                    </template>
                </div>
                <div class="mt-10">
                    <button @click="showDraftDetail = false" class="w-full bg-slate-900 text-white py-5 rounded-[1.5rem] font-black text-[10px] uppercase tracking-[0.2em] hover:bg-slate-800 transition-colors">Kembali</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>