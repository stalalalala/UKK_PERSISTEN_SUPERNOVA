<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - PERSISTEN</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; letter-spacing: -0.01em; }
        [x-cloak] { display: none !important; }
        
        /* Custom Scrollbar untuk area prodi */
        .prodi-scroll::-webkit-scrollbar { width: 6px; height: 6px; }
        .prodi-scroll::-webkit-scrollbar-track { background: #f8fafc; }
        .prodi-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .prodi-scroll::-webkit-scrollbar-thumb:hover { background: #4A72D4; }

        .admin-layout { display: grid; grid-template-columns: 280px 1fr; height: 100vh; overflow: hidden; }
        @media (max-width: 1024px) { .admin-layout { grid-template-columns: 1fr; } }
    </style>
</head>
<body class="bg-[#F8FAFC] text-[#1E293B]" 
      x-data="{ 
        currentPage: 'peluang_ptn',
        mobileMenuOpen: false, 
        expandedUniv: null, 
        showModalUniv: false, 
        showModalProdi: false,
        showConfirm: false,
        isEditModeProdi: false,
        isEditModeUniv: false,
        editProdiIndex: null,
        
        confirmData: { type: '', univId: null, prodiIndex: null, title: '', message: '' },
        
        newUnivName: '', newUnivLocation: '',
        selectedUnivId: null, selectedUnivName: '',
        newProdiName: '', newProdiKuota: '', newProdiPeminat: '',

        univList: [
            { id: 1, name: 'Universitas Indonesia (UI)', location: 'Depok', prodis: [
                {nama: 'Kedokteran', kuota: 60, peminat: 1250}, {nama: 'Ilmu Hukum', kuota: 80, peminat: 1100},
                {nama: 'Psikologi', kuota: 75, peminat: 950}, {nama: 'Teknik Informatika', kuota: 50, peminat: 800},
                {nama: 'Manajemen', kuota: 90, peminat: 1300}, {nama: 'Akuntansi', kuota: 85, peminat: 1150},
                {nama: 'Ilmu Komunikasi', kuota: 70, peminat: 1050}, {nama: 'Arsitektur', kuota: 40, peminat: 600},
                {nama: 'Farmasi', kuota: 55, peminat: 750}, {nama: 'Sastra Inggris', kuota: 45, peminat: 400}
            ]},
            { id: 2, name: 'Institut Teknologi Bandung (ITB)', location: 'Bandung', prodis: [
                {nama: 'STEI - Komputasi', kuota: 120, peminat: 2500}, {nama: 'FTMD', kuota: 90, peminat: 1600},
                {nama: 'SAPPK', kuota: 60, peminat: 900}, {nama: 'FITB', kuota: 75, peminat: 850},
                {nama: 'FTTM', kuota: 100, peminat: 1800}, {nama: 'FTSL', kuota: 110, peminat: 1400},
                {nama: 'SF', kuota: 50, peminat: 1100}, {nama: 'SBM', kuota: 80, peminat: 2000},
                {nama: 'FSRD', kuota: 70, peminat: 1200}, {nama: 'FMIPA', kuota: 130, peminat: 1000}
            ]},
            { id: 3, name: 'Universitas Gadjah Mada (UGM)', location: 'Yogyakarta', prodis: [
                {nama: 'Kedokteran Umum', kuota: 65, peminat: 1400}, {nama: 'Hukum', kuota: 100, peminat: 1300},
                {nama: 'Farmasi', kuota: 70, peminat: 950}, {nama: 'Teknik Sipil', kuota: 85, peminat: 1100},
                {nama: 'Psikologi', kuota: 80, peminat: 1200}, {nama: 'Akuntansi', kuota: 90, peminat: 1500},
                {nama: 'Hubungan Internasional', kuota: 50, peminat: 1450}, {nama: 'Kedokteran Gigi', kuota: 45, peminat: 800},
                {nama: 'Ilmu Komputer', kuota: 60, peminat: 1200}, {nama: 'Teknik Industri', kuota: 75, peminat: 900}
            ]},
            { id: 4, name: 'Universitas Airlangga (UNAIR)', location: 'Surabaya', prodis: [
                {nama: 'Kedokteran', kuota: 70, peminat: 1600}, {nama: 'Kesehatan Masyarakat', kuota: 100, peminat: 1200},
                {nama: 'Farmasi', kuota: 80, peminat: 1100}, {nama: 'Kedokteran Hewan', kuota: 60, peminat: 850},
                {nama: 'Ilmu Hukum', kuota: 90, peminat: 1150}, {nama: 'Akuntansi', kuota: 100, peminat: 1050},
                {nama: 'Psikologi', kuota: 75, peminat: 980}, {nama: 'Manajemen', kuota: 85, peminat: 1200}
            ]}
        ],
        historyList: [],

        triggerDelete(type, univ, prodiIndex = null) {
            this.confirmData = {
                type: type,
                univId: univ.id,
                prodiIndex: prodiIndex,
                title: type === 'univ' ? 'Hapus Universitas?' : 'Hapus Prodi?',
                message: type === 'univ' ? `Hapus ${univ.name}? Data akan dipindah ke history.` : `Hapus prodi ${univ.prodis[prodiIndex].nama}?`
            };
            this.showConfirm = true;
        },

        executeDelete() {
            const idx = this.univList.findIndex(u => u.id === this.confirmData.univId);
            if(this.confirmData.type === 'univ') {
                const deleted = this.univList.splice(idx, 1)[0];
                this.historyList.unshift({ type: 'Universitas', name: deleted.name, info: deleted.location, time: new Date().toLocaleString() });
            } else {
                const univ = this.univList[idx];
                const deleted = univ.prodis.splice(this.confirmData.prodiIndex, 1)[0];
                this.historyList.unshift({ type: 'Prodi', name: deleted.nama, info: 'Dari ' + univ.name, time: new Date().toLocaleString() });
            }
            this.showConfirm = false;
        },

        openAddUniv() { this.isEditModeUniv = false; this.newUnivName = ''; this.newUnivLocation = ''; this.showModalUniv = true; },
        openEditUniv(univ) { this.isEditModeUniv = true; this.selectedUnivId = univ.id; this.newUnivName = univ.name; this.newUnivLocation = univ.location; this.showModalUniv = true; },
        saveUniv() {
            if(this.newUnivName == '' || this.newUnivLocation == '') return;
            if(this.isEditModeUniv) {
                const univ = this.univList.find(u => u.id === this.selectedUnivId);
                if(univ) { univ.name = this.newUnivName; univ.location = this.newUnivLocation; }
            } else {
                this.univList.push({ id: Date.now(), name: this.newUnivName, location: this.newUnivLocation, prodis: [] });
            }
            this.showModalUniv = false;
        },
        openAddProdi(univ) { this.isEditModeProdi = false; this.selectedUnivId = univ.id; this.selectedUnivName = univ.name; this.newProdiName = ''; this.newProdiKuota = ''; this.newProdiPeminat = ''; this.showModalProdi = true; },
        saveProdi() {
            const univ = this.univList.find(u => u.id === this.selectedUnivId);
            if(!univ || this.newProdiName == '') return;
            univ.prodis.unshift({ 
                nama: this.newProdiName, 
                kuota: parseInt(this.newProdiKuota) || 0, 
                peminat: parseInt(this.newProdiPeminat) || 0 
            });
            this.showModalProdi = false;
        }
      }">

    <div class="admin-layout">
        <aside x-data="{ currentPage: 'peluang' }" :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
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

        

         <a href="{{ route('admin.peluang.index') }}" x-init="if(currentPage === 'peluang') { $el.scrollIntoView({ block: 'center' }) }"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl  bg-[#D4DEF7]  text-[#2E3B66] transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
            </svg>
            <span class="text-md font-regular">Manajemen peluang PTN</span>
        </a>

         <a href="{{ route('admin.laporan.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
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

        <main class="flex flex-col h-screen overflow-hidden">
            <header class="flex flex-col md:flex-row items-center justify-between px-4 md:px-10 py-6 gap-4 shrink-0 bg-[#F8FAFC]">
    <div class="flex items-center w-full gap-4">
        <button @click="mobileMenuOpen = true" class="lg:hidden p-3 bg-white rounded-xl shadow-sm text-[#4A72D4]">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        
        <div class="relative w-full group flex items-center gap-2">
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" placeholder="Search...." 
                    class="w-full bg-white border-none rounded-full py-3 pl-12 pr-4 shadow-sm focus:ring-2 focus:ring-[#4A72D4] outline-none transition-all text-sm">
            </div>
        </div>
    </div>

    <div class="flex items-center gap-3 w-full md:w-auto justify-end">
        <button @click="currentPage = (currentPage === 'peluang_ptn' ? 'history' : 'peluang_ptn')" 
                class="bg-white border border-gray-100 hover:border-[#4A72D4] text-[#4A72D4] px-4 py-3 rounded-full font-black text-[10px] flex items-center gap-2 transition-all uppercase tracking-widest shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span x-text="currentPage === 'peluang_ptn' ? 'History' : 'Kembali'"></span>
        </button>

        <button x-show="currentPage === 'peluang_ptn'" @click="openAddUniv()" 
                class="bg-[#4A72D4] hover:bg-blue-600 text-white px-5 py-3 rounded-full font-black text-[10px] flex items-center gap-2 shadow-lg shadow-blue-100 transition-all uppercase tracking-widest whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M12 4.5v15m7.5-7.5h-15" /></svg>
            <span>Tambah</span>
        </button>

        <div class="flex items-center gap-2 bg-white p-1 pr-4 rounded-full shadow-sm shrink-0 border border-gray-50">
            <div class="w-8 h-8 bg-blue-100 rounded-full overflow-hidden">
                <img src="https://ui-avatars.com/api/?name=Admin&background=4A72D4&color=fff" alt="Admin">
            </div>
            <span class="font-bold text-xs hidden sm:block text-gray-700">Admin</span>
        </div>
    </div>
</header>

            <div x-show="currentPage === 'peluang_ptn'" class="flex-1 overflow-y-auto p-4 md:p-10 bg-[#F8FAFC]">
                <div class="max-w-6xl mx-auto space-y-4 pb-20">
                    <template x-for="univ in univList" :key="univ.id">
                        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden transition-all duration-300">
                            <div @click="expandedUniv = (expandedUniv === univ.id ? null : univ.id)" 
                                 class="p-4 md:p-6 flex items-center justify-between cursor-pointer hover:bg-gray-50 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex flex-col items-center justify-center text-[#4A72D4]">
                                        <svg :class="expandedUniv === univ.id ? 'rotate-180' : ''" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="3" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                                    </div>
                                    <div>
                                        <h3 class="font-black text-[#1E293B] text-sm md:text-base leading-tight uppercase" x-text="univ.name"></h3>
                                        <p class="text-[9px] md:text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1" x-text="univ.location + ' • ' + univ.prodis.length + ' Prodi'"></p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button @click.stop="openEditUniv(univ)" class="p-2 text-gray-400 hover:bg-blue-500 hover:text-white rounded-xl transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                    </button>
                                    <button @click.stop="triggerDelete('univ', univ)" class="p-2 text-red-400 hover:bg-red-500 hover:text-white rounded-xl transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                    <button @click.stop="openAddProdi(univ)" class="ml-2 p-2 bg-[#4A72D4] text-white rounded-xl shadow-md">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="3" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                                    </button>
                                </div>
                            </div>

                            <div x-show="expandedUniv === univ.id" x-collapse x-cloak class="border-t border-gray-50 bg-gray-50/30">
                                <div class="prodi-scroll overflow-x-auto overflow-y-auto max-h-[350px]">
                                    <table class="w-full text-left min-w-[600px] relative">
                                        <thead class="sticky top-0 z-10 bg-gray-100/90 backdrop-blur-md">
                                            <tr class="text-[9px] text-gray-400 font-black uppercase tracking-widest">
                                                <th class="px-6 py-4">Program Studi</th>
                                                <th class="px-6 py-4 text-center">Kuota</th>
                                                <th class="px-6 py-4 text-center">Peminat (tahun lalu)</th>
                                                <th class="px-6 py-4 text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100 bg-white">
                                            <template x-for="(prodi, index) in univ.prodis" :key="index">
                                                <tr class="hover:bg-blue-50/40 transition-colors">
                                                    <td class="px-6 py-4 font-bold text-xs" x-text="prodi.nama"></td>
                                                    <td class="px-6 py-4 text-center text-xs font-black" x-text="prodi.kuota"></td>
                                                    <td class="px-6 py-4 text-center text-xs font-black text-[#4A72D4]" x-text="prodi.peminat"></td>
                                                    <td class="px-6 py-4 text-center">
                                                        <button @click="triggerDelete('prodi', univ, index)" class="p-2 text-red-400 hover:bg-red-50 rounded-lg">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                    <template x-if="univ.prodis.length === 0">
                                        <div class="p-10 text-center text-gray-400 text-xs italic font-bold">Belum ada program studi. Klik tombol + untuk menambah.</div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div x-show="currentPage === 'history'" x-cloak class="flex-1 overflow-y-auto p-4 md:p-10 bg-[#F8FAFC]">
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-8 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                            <h3 class="font-black text-gray-800 uppercase tracking-tighter text-lg">Log Penghapusan Terbaru</h3>
                            <button @click="historyList = []" class="text-[10px] font-black text-red-400 uppercase tracking-widest hover:text-red-600 transition-colors">Bersihkan Log</button>
                        </div>
                        <div class="divide-y divide-gray-50">
                            <template x-for="log in historyList">
                                <div class="p-6 flex items-center justify-between hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center gap-4">
                                        <div :class="log.type === 'Universitas' ? 'bg-amber-100 text-amber-600' : 'bg-blue-100 text-blue-600'" 
                                             class="w-10 h-10 rounded-xl flex items-center justify-center font-black text-[10px]" x-text="log.type === 'Universitas' ? 'U' : 'P'"></div>
                                        <div>
                                            <p class="font-bold text-gray-800 text-sm" x-text="log.name"></p>
                                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest" x-text="log.info"></p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest" x-text="log.time"></p>
                                        <span class="text-[9px] bg-red-50 text-red-400 px-2 py-1 rounded-lg font-black uppercase mt-1 inline-block">Terhapus</span>
                                    </div>
                                </div>
                            </template>
                            <div x-show="historyList.length === 0" class="p-20 text-center text-gray-400 italic font-bold">Tidak ada riwayat penghapusan.</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div x-show="showConfirm" x-transition x-cloak class="fixed inset-0 z-[150] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
        <div class="bg-white rounded-[2.5rem] w-full max-w-sm p-8 text-center shadow-2xl">
            <div class="w-16 h-16 bg-red-50 text-red-500 rounded-3xl flex items-center justify-center mx-auto mb-6 font-black text-2xl">!</div>
            <h4 class="text-xl font-black text-gray-800" x-text="confirmData.title"></h4>
            <p class="text-sm text-gray-500 mt-2 leading-relaxed" x-text="confirmData.message"></p>
            <div class="flex gap-3 mt-8">
                <button @click="showConfirm = false" class="flex-1 py-4 font-black text-gray-400 uppercase text-[10px] tracking-widest">Batal</button>
                <button @click="executeDelete()" class="flex-[2] bg-red-500 text-white py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest shadow-lg shadow-red-200">Ya, Hapus Data</button>
            </div>
        </div>
    </div>

    <div x-show="showModalUniv" x-transition x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
        <div @click.away="showModalUniv = false" class="bg-white rounded-[2.5rem] w-full max-w-md overflow-hidden shadow-2xl">
            <div class="bg-[#4A72D4] p-8 text-white">
                <h4 class="text-xl font-black italic uppercase" x-text="isEditModeUniv ? 'Edit Universitas' : 'Tambah PTN Baru'"></h4>
            </div>
            <div class="p-8 space-y-4">
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Nama Universitas</label>
                    <input x-model="newUnivName" type="text" class="w-full bg-gray-50 border-2 border-transparent focus:border-blue-400 rounded-2xl py-4 px-6 outline-none font-bold text-sm mt-1">
                </div>
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Lokasi (Kota)</label>
                    <input x-model="newUnivLocation" type="text" class="w-full bg-gray-50 border-2 border-transparent focus:border-blue-400 rounded-2xl py-4 px-6 outline-none font-bold text-sm mt-1">
                </div>
                <div class="flex gap-4 pt-4">
                    <button @click="showModalUniv = false" class="flex-1 font-black text-gray-400 uppercase text-[10px] tracking-widest">Batal</button>
                    <button @click="saveUniv()" class="flex-[2] bg-[#4A72D4] py-4 rounded-2xl font-black text-white shadow-lg uppercase text-[10px] tracking-widest">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div x-show="showModalProdi" x-transition x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
        <div @click.away="showModalProdi = false" class="bg-white rounded-[2.5rem] w-full max-w-md overflow-hidden shadow-2xl">
            <div class="bg-[#4A72D4] p-8 text-white">
                <h4 class="text-xl font-black italic uppercase">Tambah Prodi Baru</h4>
                <p class="text-[10px] font-bold text-blue-100 uppercase tracking-widest mt-1" x-text="selectedUnivName"></p>
            </div>
            <div class="p-8 space-y-4">
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Nama Program Studi</label>
                    <input x-model="newProdiName" type="text" class="w-full bg-gray-50 border-2 border-transparent focus:border-blue-400 rounded-2xl py-4 px-6 outline-none font-bold text-sm mt-1">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Kuota</label>
                        <input x-model="newProdiKuota" type="number" class="w-full bg-gray-50 border-2 border-transparent focus:border-blue-400 rounded-2xl py-4 px-6 outline-none font-black text-center text-blue-600 mt-1">
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Peminat (tahun lalu)</label>
                        <input x-model="newProdiPeminat" type="number" class="w-full bg-gray-50 border-2 border-transparent focus:border-indigo-400 rounded-2xl py-4 px-6 outline-none font-black text-center text-indigo-500 mt-1">
                    </div>
                </div>
                <div class="flex gap-4 pt-4">
                    <button @click="showModalProdi = false" class="flex-1 font-black text-gray-400 uppercase text-[10px] tracking-widest">Batal</button>
                    <button @click="saveProdi()" class="flex-[2] bg-[#4A72D4] py-4 rounded-2xl font-black text-white shadow-lg uppercase text-[10px] tracking-widest">Simpan Prodi</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>