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
        
        <a href="{{ route('admin.dashboard.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
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

         <a href="{{ route('admin.tryout.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
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
            <span class="text-md font-regular">Manajemen latihan soal</span>
        </a>

         <a href="{{ route('admin.videoPembelajaran.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-9">
            <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
            <span class="text-md font-regular">Manajemen video pembelajaran</span>
        </a>

         <a href="{{ route('admin.minatBakat.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
            </svg>
            <span class="text-md font-regular">Manajemen minat bakat</span>
        </a>

        

         <a href="{{ route('admin.peluang.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
            </svg>
            <span class="text-md font-regular">Manajemen peluang PTN</span>
        </a>

         <a href="{{ route('admin.laporan.index') }}" x-init="if(currentPage === 'monitoring') { $el.scrollIntoView({ block: 'center' }) }"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl bg-[#D4DEF7]  text-[#2E3B66] transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
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