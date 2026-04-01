<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Rinci - Persisten</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; }
        h1, h2, h3, h4, h5, h6, p, span, button, div { font-family: 'Poppins', sans-serif; }
        [x-cloak] { display: none !important; }
        .log-scroll::-webkit-scrollbar { width: 4px; }
        .log-scroll::-webkit-scrollbar-track { background: transparent; }
        .log-scroll::-webkit-scrollbar-thumb { background: #E2E8F0; border-radius: 10px; }
        
        /* Custom Scrollbar untuk Navigasi */
        .nav-scroll::-webkit-scrollbar { width: 4px; }
        .nav-scroll::-webkit-scrollbar-track { background: transparent; }
        .nav-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 10px; }

        @media (min-width: 1024px) {
            body { overflow: hidden; }
            .admin-layout { 
                display: grid; 
                grid-template-columns: 288px 1fr; 
                height: 100vh; 
                overflow: hidden; /* Pastikan layout utama tidak ikut scroll */
            }
        }
    </style>
</head>
<body class="bg-[#F8FAFC]" x-data="monitoringApp()">

    <div class="admin-layout">
        <aside x-data="{ currentPage: 'laporan' }" :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed inset-y-0 left-0 z-50 w-72 bg-[#4A72D4] text-white flex flex-col shadow-xl transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 shrink-0 h-full overflow-hidden">

    <div class="p-6 pb-1">
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
    </div>

    <nav class="flex-1 px-6 space-y-1 overflow-y-auto pr-4 
                [&::-webkit-scrollbar]:w-1 
                [&::-webkit-scrollbar-track]:bg-transparent 
                [&::-webkit-scrollbar-thumb]:bg-white/20 
                [&::-webkit-scrollbar-thumb]:rounded-full">
        
        <a href="{{ route('admin.dashboard.index') }}"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left hover:bg-white/10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
            </svg>
            <span class="text-md font-regular">Dashboard</span>
        </a>

        <a href="{{ route('admin.user.index') }}"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left hover:bg-white/10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen user</span>
        </a>

        <a href="{{ route('admin.streak.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left hover:bg-white/10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 0 0 .495-7.468 5.99 5.99 0 0 0-1.925 3.547 5.975 5.975 0 0 1-2.133-1.001A3.75 3.75 0 0 0 12 18Z" />
            </svg>
            <span class="text-md font-regular">Manajemen streak</span>
        </a>

        <a href="{{ route('admin.tryout.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left hover:bg-white/10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
            <span class="text-md font-regular">Manajemen tryout</span>
        </a>

        <a href="{{ route('admin.kuis.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left hover:bg-white/10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
            </svg>
            <span class="text-md font-regular">Manajemen kuis</span>
        </a>

        <a href="{{ route('admin.latihan.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left hover:bg-white/10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
            </svg>
            <span class="text-md font-regular">Manajemen latihan soal</span>
        </a>

        <a href="{{ route('admin.videoPembelajaran.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left hover:bg-white/10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
            <span class="text-md font-regular">Manajemen video</span>
        </a>

        <a href="{{ route('admin.minatBakat.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left hover:bg-white/10">
           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
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

        <a href="{{ route('admin.laporan.index') }}" x-init="if(currentPage === 'laporan') { $el.scrollIntoView({ block: 'center' }) }"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left bg-[#D4DEF7] text-[#2E3B66]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
            </svg>
            <span class="text-md font-regular">Monitoring dan laporan</span>
        </a>
    </nav>

    <div class="p-6 pt-2">
        <form action="{{ route('logout') }}" method="POST" class="w-full inline">
            @csrf
            <button type="submit" class="w-full flex items-center bg-white/10 hover:bg-white/20 px-6 py-3 rounded-2xl transition-all group border border-white/20 backdrop-blur-sm shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                </svg>
                <span class="text-white text-md font-medium tracking-wide ml-4">Logout</span>
            </button>
        </form>
    </div>
</aside>

        <main class="h-full overflow-y-auto log-scroll p-6 lg:p-10">
            <header class="flex flex-col lg:flex-row lg:items-center justify-between pb-4 gap-4 flex-shrink-0 w-full">
    <div class="flex items-center justify-between w-full lg:w-auto gap-4 lg:order-2">
        <button @click="mobileMenuOpen = true" class="lg:hidden p-3 bg-white rounded-xl shadow-sm shrink-0">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        @php
            use Illuminate\Support\Facades\Auth;
            $user = Auth::user();
            // Mengambil nama depan saja untuk tampilan ringkas di bar
            $firstName = explode(' ', trim($user->name))[0];
        @endphp

        <div x-data="{ open: false }" class="relative flex-1 lg:flex-initial">
            <div @click="open = !open" 
                class="flex items-center justify-between lg:justify-start gap-3 bg-white p-1 pr-4 pl-1 rounded-full shadow-sm cursor-pointer border border-transparent hover:border-blue-100 transition-all w-full lg:w-auto ml-auto">
                
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-gray-100 rounded-full overflow-hidden border-2 border-white shrink-0">
                        <img src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=4A72D4&color=fff' }}" 
                             alt="{{ $user->name }}" class="w-full h-full object-cover">
                    </div>
                    <span class="font-bold text-sm text-gray-700 truncate">{{ $firstName }}</span>
                </div>
                
                <i class="fa-solid fa-chevron-down text-gray-400 text-[10px]"></i>
            </div>

            <div x-show="open" 
                x-cloak
                @click.away="open = false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform scale-95 -translate-y-2"
                x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                class="absolute right-0 mt-3 w-64 bg-white rounded-[20px] shadow-2xl border border-gray-100 z-[100] overflow-hidden">
                
                <div class="p-5 bg-gradient-to-br from-gray-50 to-white border-b border-gray-100">
                    <p class="font-extrabold text-gray-800 leading-tight">{{ $user->name }}</p>
                    <p class="text-[11px] text-gray-400 mt-1 truncate">{{ $user->email }}</p>
                </div>
                
                <div class="p-4 flex flex-col gap-2 bg-white">
                    <div class="flex items-center gap-3 text-xs text-gray-500 p-2 bg-gray-50 rounded-xl border border-gray-100">
                        <i class="fa-solid fa-phone text-blue-400"></i>
                        <span>{{ $user->no_hp ?? 'No HP belum diatur' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-data="{
            keyword: '',
            routes: {
                'dashboard': '{{ route('admin.dashboard.index') }}',
                'user': '{{ route('admin.user.index') }}',
                'streak': '{{ route('admin.streak.index') }}',
                'monitoring': '{{ route('admin.laporan.index') }}',
                'video': '{{ route('admin.videoPembelajaran.index') }}',
                'peluang': '{{ route('admin.peluang.index') }}',
                'tryout': '{{ route('admin.tryout.index') }}',
                'minat bakat': '{{ route('admin.minatBakat.index') }}',
                'kuis': '{{ route('admin.kuis.index') }}',
                'latihan': '{{ route('admin.latihan.index') }}'
            },
            goToPage(){
                let search = this.keyword.toLowerCase().trim();
                if(!search) return;
                for (let key in this.routes) {
                    if (key.includes(search)) {
                        window.location.href = this.routes[key];
                        return;
                    }
                }
                alert('Halaman tidak ditemukan');
            }
        }"
        class="relative w-full lg:flex-grow flex items-center gap-2 lg:order-1"
    >
        <div class="relative w-full group">
            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 group-focus-within:text-[#4A72D4] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
            <input 
                type="text" 
                x-model="keyword" 
                placeholder="Cari halaman..." 
                @keydown.enter="goToPage()"
                class="w-full bg-white border-none rounded-full py-3.5 pl-14 pr-4 shadow-sm focus:ring-2 focus:ring-blue-400 outline-none transition-all text-sm placeholder:text-gray-400 font-medium"
            >
        </div>

        <button 
            @click="goToPage()" 
            class="bg-[#4A72D4] hover:bg-blue-600 text-white px-7 py-3.5 rounded-full text-sm font-extrabold shadow-lg shadow-blue-100 transition-all active:scale-95 shrink-0"
        >
            Cari
        </button>
    </div>
</header>

            <div class="flex-1 overflow-y-auto space-y-8 pr-2 log-scroll">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm flex flex-col h-[400px]">
                        <div class="p-6 border-b"><h3 class="text-[10px] font-black uppercase text-slate-500 tracking-widest">Aktivitas Saya</h3></div>
                        <div class="flex-1 overflow-y-auto log-scroll p-4 space-y-4">
                            <template x-for="log in myLogs" :key="'my-'+log.id">
                                <div class="p-5 bg-white border border-slate-100 rounded-3xl shadow-sm hover:border-[#4A72D4] transition-all">
                                    <div class="flex justify-between items-start mb-2">
                                        <div class="flex flex-col gap-1">
                                            <span class="text-[9px] font-black px-2 py-1 bg-[#4A72D4] text-white rounded-lg uppercase w-fit" x-text="log.aksi"></span>
                                            <span class="text-[9px] font-bold text-[#4A72D4] italic pl-1" x-text="log.hari"></span>
                                        </div>
                                        <span class="text-[10px] font-bold text-slate-400" x-text="log.jam"></span>
                                    </div>
                                    <p class="text-xs font-black text-slate-800" x-text="log.objek"></p>
                                    <p class="text-[11px] text-slate-500 italic mt-1" x-text="'» ' + log.detail"></p>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm flex flex-col h-[400px]">
                        <div class="p-6 border-b"><h3 class="text-[10px] font-black uppercase text-slate-500 tracking-widest">Riwayat Semua Admin</h3></div>
                        <div class="flex-1 overflow-y-auto log-scroll p-4 space-y-3">
                            <template x-for="log in filteredLogs" :key="'all-'+log.id">
                                <div class="p-4 bg-slate-50 rounded-[1.5rem] border border-transparent hover:border-slate-200 transition-all">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-[10px] font-black text-slate-400">A</div>
                                            <div>
                                                <p class="text-[11px] font-black text-slate-700" x-text="'Admin: ' + (log.nama_admin || 'Unknown')"></p>
                                                <p class="text-[9px] text-[#4A72D4] font-bold uppercase" x-text="log.aksi"></p>
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
                    <div class="flex items-center gap-6 border-b border-slate-100 pb-4">
                        <button @click="activeTab = 'archive'" :class="activeTab === 'archive' ? 'text-slate-800 border-[#4A72D4]' : 'text-slate-400 border-transparent'" class="flex items-center gap-2 pb-2 border-b-2 transition-all">
                            <div class="w-1.5 h-4 bg-amber-400 rounded-full"></div>
                            <h3 class="text-[10px] font-black uppercase tracking-widest">Arsip Folder Draf</h3>
                        </button>
                        <button @click="activeTab = 'history'" :class="activeTab === 'history' ? 'text-slate-800 border-[#4A72D4]' : 'text-slate-400 border-transparent'" class="flex items-center gap-2 pb-2 border-b-2 transition-all">
                            <div class="w-1.5 h-4 bg-red-400 rounded-full"></div>
                            <h3 class="text-[10px] font-black uppercase tracking-widest">History Terhapus</h3>
                        </button>
                    </div>

                    <div x-show="activeTab === 'archive'" x-transition>
                        <template x-for="item in archiveData" :key="item.tahun">
                            <div class="bg-white rounded-[2rem] border border-slate-100 overflow-hidden shadow-sm mb-4">
                                <button @click="openYear = (openYear === item.tahun ? null : item.tahun)" class="w-full flex items-center justify-between p-6 hover:bg-slate-50">
                                    <span class="text-lg font-black text-slate-800" x-text="item.tahun"></span>
                                    <svg class="w-5 h-5 transition-transform" :class="openYear === item.tahun ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="3" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                                <div x-show="openYear === item.tahun" x-collapse class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 bg-slate-50/30">
                                    <template x-for="bln in item.bulan" :key="bln.nama">
                                        <div class="bg-white p-2 rounded-3xl border border-slate-100">
                                            <button @click="openMonth = (openMonth === bln.nama ? null : bln.nama)" class="w-full p-4 flex items-center gap-3 hover:bg-amber-50 rounded-2xl text-left">
                                                <svg class="w-5 h-5 text-amber-400 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path></svg>
                                                <span class="text-[11px] font-black text-slate-700 uppercase" x-text="bln.nama"></span>
                                            </button>
                                            <div x-show="openMonth === bln.nama" x-collapse class="space-y-1 p-2">
                                                <template x-for="mgg in bln.minggu">
                                                    <div class="group flex items-center justify-between p-1 hover:bg-blue-50 rounded-xl">
                                                        <button @click="openDraft(item.tahun, bln.nama, mgg)" class="flex-1 text-left p-2 pl-4 text-[10px] font-bold text-slate-400 group-hover:text-[#4A72D4]">
                                                            <span x-text="'Minggu ' + mgg"></span>
                                                        </button>
                                                       <form 
                                                        action="{{ route('admin.laporan.update-status-multiple') }}"
                                                        method="POST"
                                                        class="hidden">
                                                        @csrf

                                                    <template 
                                                    x-for="log in mappedLogs.filter(l => 
                                                        l.tahun === item.tahun && 
                                                        l.bulan === bln.nama && 
                                                        l.minggu === mgg && 
                                                        l.status === 'active'
                                                    )" :key="log.id">

                                                        <input type="hidden" name="ids[]" :value="log.id">

                                                    </template>

                                                    <input type="hidden" name="status" value="deleted">
                                                    </form>

                                                    <button 
                                                    @click="
                                                    Swal.fire({
                                                    title: 'Hapus Aktivitas?',
                                                    text: 'Aktivitas akan dipindahkan ke History',
                                                    icon: 'warning',
                                                    width: '340px',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#ef4444',
                                                    confirmButtonText: 'Ya, Hapus!',
                                                    customClass: { popup: 'rounded-3xl shadow-xl', title: 'text-lg font-bold', confirmButton: 'px-5 py-2.5 rounded-xl text-sm',   cancelButton: 'px-5 py-2.5 rounded-xl text-sm bg-gray-100 text-gray-600 hover:bg-gray-200' }
                                                    }).then((result) => {
                                                    if(result.isConfirmed){
                                                        $el.previousElementSibling.submit()
                                                    }
                                                })
                                                    "
                                                    class="text-red-500 px-3 py-1.5 rounded-lg text-xs hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                        </svg>

                                                    </button>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div x-show="activeTab === 'history'" x-transition>
                        <template x-for="item in historyData" :key="'hist-'+item.tahun">
                            <div class="bg-white rounded-[2rem] border border-slate-100 overflow-hidden shadow-sm mb-4">
                                <div class="p-6 bg-red-50/50 border-b border-red-100">
                                    <span class="text-lg font-black text-red-800" x-text="item.tahun"></span>
                                </div>
                                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                    <template x-for="bln in item.bulan" :key="bln.nama">
                                        <div class="bg-slate-50 p-4 rounded-3xl border border-dashed border-slate-200">
                                            <p class="text-[10px] font-black text-slate-400 uppercase mb-4" x-text="bln.nama"></p>
                                            <div class="space-y-3">
                                                <template x-for="mgg in bln.minggu">
                                                    <div class="bg-white p-3 rounded-2xl shadow-sm">
                                                        <p class="text-[10px] font-black text-slate-800 mb-3" x-text="'Minggu ' + mgg"></p>
                                                        <div class="flex gap-2">
                                                            <form 
                                                            action="{{ route('admin.laporan.update-status-multiple') }}"
                                                            method="POST"
                                                            class="hidden">
                                                            @csrf

                                                            <!-- ambil semua ID dalam minggu -->
                                                            <template 
                                                            x-for="log in mappedLogs.filter(l => 
                                                                l.tahun === item.tahun && 
                                                                l.bulan === bln.nama && 
                                                                l.minggu === mgg && 
                                                                l.status === 'deleted'
                                                            )" :key="log.id">

                                                                <input type="hidden" name="ids[]" :value="log.id">

                                                            </template>

                                                            <input type="hidden" name="status" value="active">
                                                        </form>

                                                        <button 
                                                        @click="
                                                        Swal.fire({
                                                        title: 'Pulihkan Aktivitas?',
                                                        text: 'Data akan dikembalikan ke daftar Aktivitas',
                                                        icon: 'question',
                                                        width: '340px',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#22c55e',
                                                        confirmButtonText: 'Ya, Pulihkan!',
                                                        cancelButtonText: 'Batal',
                                                        customClass: { popup: 'rounded-3xl shadow-xl', title: 'text-lg font-bold', confirmButton: 'px-5 py-2.5 rounded-xl text-sm',   cancelButton: 'px-5 py-2.5 rounded-xl text-sm bg-gray-100 text-gray-600 hover:bg-gray-200' }
                                                        }).then((result) => {
                                                        if(result.isConfirmed){
                                                            $el.previousElementSibling.submit()
                                                        }
                                                    })
                                                    "
                                class="text-blue-500 px-2 py-1 rounded-lg text-xs hover:bg-blue-600 hover:text-white transition-all shadow-sm"> 
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v6h6M20 20v-6h-6M4 10a8 8 0 0116 0 8 8 0 01-16 0z" />
                                                </svg>
                                </button>
                                                                                            <form 
                                    action="{{ route('admin.laporan.destroy-multiple') }}"
                                    method="POST"
                                    class="hidden">
                                    @csrf

                                    <!-- ambil semua ID dalam minggu -->
                                    <template 
                                    x-for="log in mappedLogs.filter(l => 
                                        l.tahun === item.tahun && 
                                        l.bulan === bln.nama && 
                                        l.minggu === mgg && 
                                        l.status === 'deleted'
                                    )" :key="log.id">

                                        <input type="hidden" name="ids[]" :value="log.id">

                                    </template>
                                </form>

                                <button 
                                @click="
                                Swal.fire({
                                title: 'Hapus Permanen?',
                                text: 'Data tidak bisa dikembalikan!',
                                width: '340px',
                                icon: 'error',
                                showCancelButton: true,
                                confirmButtonColor: '#ef4444',
                                confirmButtonText: 'Ya, Hapus!',
                                cancelButtonText: 'Batal',
                                customClass: { popup: 'rounded-3xl shadow-xl', title: 'text-lg font-bold', confirmButton: 'px-5 py-2.5 rounded-xl text-sm',   cancelButton: 'px-5 py-2.5 rounded-xl text-sm bg-gray-100 text-gray-600 hover:bg-gray-200' }
                                }).then((result) => {
                                if(result.isConfirmed){
                                    $el.previousElementSibling.submit()
                                }
                            })
                            "
                            class="text-red-500 px-3 py-1.5 rounded-lg text-xs hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                            </button>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div x-show="showDraftDetail" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 scale-95"
     x-transition:enter-end="opacity-100 scale-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 scale-100"
     x-transition:leave-end="opacity-0 scale-95"
     x-cloak 
     class="fixed inset-0 z-[100] flex items-center justify-center p-2 sm:p-4 bg-slate-900/90 backdrop-blur-md">
    
    <div @click.away="showDraftDetail = false" 
         class="bg-white rounded-[1.5rem] sm:rounded-[2rem] w-full max-w-sm md:max-w-2xl lg:max-w-3xl xl:max-w-4xl max-h-[90vh] flex flex-col overflow-hidden shadow-2xl border border-white/20">
        
        <div class="bg-slate-900 p-5 sm:p-8 text-white flex justify-between items-start gap-4">
            <div class="min-w-0"> <h4 class="text-lg sm:text-xl lg:text-2xl font-black uppercase tracking-tight truncate" x-text="selectedDraftTitle"></h4>
                <p class="text-slate-400 text-[9px] sm:text-[10px] uppercase tracking-[0.2em] font-bold mt-1">Laporan Aktivitas Mingguan</p>
                
                <button 
                    @click="window.location.href = `{{ route('admin.laporan.download-pdf') }}?year=${selectedCriteria.year}&month=${selectedCriteria.month}&week=${selectedCriteria.week}`"
                    class="mt-4 sm:mt-5 flex items-center gap-2 sm:gap-3 bg-[#4A72D4] hover:bg-blue-600 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl sm:rounded-2xl text-[9px] sm:text-[10px] font-black transition-all uppercase tracking-widest shadow-xl shadow-blue-500/20 active:scale-95 group"
                >
                    <i class="fa-solid fa-file-pdf text-xs sm:text-sm group-hover:rotate-12 transition-transform"></i>
                    <span class="hidden xs:inline">Cetak Draf Ke PDF</span>
                    <span class="xs:hidden">Cetak PDF</span>
                </button>
            </div>

            <button @click="showDraftDetail = false" 
                    class="shrink-0 bg-white/5 hover:bg-white/10 p-2 sm:p-3 rounded-xl text-slate-500 hover:text-white transition-all">
                <svg class="w-5 h-5 sm:w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="p-4 sm:p-8 overflow-y-auto log-scroll bg-slate-50/50 flex-1">
            <div class="space-y-4 sm:space-y-1">
                <template x-for="log in filteredLogsByDraft">
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-6 pb-6 border-b border-slate-100 mb-6 last:border-0 last:mb-0 last:pb-0 group">
                        
                        <div class="flex sm:flex-col justify-between sm:justify-start items-center sm:items-end sm:min-w-[100px] bg-white sm:bg-transparent p-2 sm:p-0 rounded-lg border sm:border-0 border-slate-100 shadow-sm sm:shadow-none">
                            <p class="text-[10px] font-black text-[#4A72D4] uppercase" x-text="log.hari"></p>
                            <p class="text-[9px] font-bold text-slate-400 sm:text-slate-300 italic group-hover:text-slate-400 transition-colors" x-text="log.jam"></p>
                        </div>
                        
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="hidden sm:block w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                                <p class="text-[10px] sm:text-[11px] font-black text-slate-500 uppercase tracking-wider truncate" x-text="'Admin: ' + log.nama_admin"></p>
                            </div>
                            <p class="text-xs sm:text-sm font-black text-slate-800 mt-1 sm:mt-1.5 leading-relaxed" x-text="log.objek"></p>
                            
                            <div class="mt-2 bg-white p-3 sm:p-4 rounded-xl border border-slate-100 shadow-sm group-hover:border-blue-100 transition-colors">
                                <p class="text-[10px] sm:text-[11px] text-slate-500 italic leading-relaxed" x-text="'» ' + log.detail"></p>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <template x-if="filteredLogsByDraft.length === 0">
                <div class="py-12 sm:py-20 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-slate-100 rounded-full mb-4">
                        <i class="fa-solid fa-folder-open text-3xl sm:text-4xl text-slate-300"></i>
                    </div>
                    <p class="text-slate-400 text-[10px] sm:text-xs font-bold uppercase tracking-widest px-4">Tidak ada aktivitas pada draf ini</p>
                </div>
            </template>
        </div>

        <div class="px-5 sm:px-8 py-3 sm:py-4 bg-white border-t border-slate-50 flex justify-between items-center">
             <div class="flex gap-1">
                 <span class="w-1 h-1 rounded-full bg-slate-200"></span>
                 <span class="w-1 h-1 rounded-full bg-slate-200"></span>
                 <span class="w-1 h-1 rounded-full bg-slate-200"></span>
             </div>
             <p class="text-[8px] sm:text-[9px] font-bold text-slate-300 uppercase tracking-[0.2em]">Persisten Monitoring System</p>
        </div>
    </div>
</div>

    @if(session('success'))
<div 
    x-data
    x-init="
        Swal.fire({
            icon: 'success',
            title: '{{ session('success') }}',

            width: '340px',
            padding: '1.8rem',

            background: '#ffffff',
            color: '#334155',

            confirmButtonText: 'Oke',
            confirmButtonColor: '#4A72D4',

            customClass: {
                popup: 'rounded-3xl shadow-xl',
                title: 'text-lg font-bold',
                confirmButton: 'rounded-xl px-6 py-2'
            },

            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })
    "
></div>
@endif

   <script>
function monitoringApp() {
    return {
        currentAdminId: "{{ (string) Auth::id() }}",
        currentAdminName: "{{ Auth::user()->name }}",
        activeTab: 'archive',
        openYear: new Date().getFullYear(),
        openMonth: null,
        showDraftDetail: false,
        selectedDraftTitle: '',
        selectedCriteria: { year: null, month: null, week: null },
        mobileMenuOpen: false,
        adminDropdownOpen: false,
        searchQuery: '',
        logs: @json($logs),

        getNow() {
            const today = new Date();
            return {
                week: Math.ceil(today.getDate() / 7),
                month: today.toLocaleDateString('id-ID', { month: 'long' }),
                year: today.getFullYear()
            };
        },

        get mappedLogs() {
            return this.logs.map(log => {
                const date = new Date(log.created_at);
                return {
                    id: log.id,
                    id_pengguna: log.id_pengguna ? String(log.id_pengguna) : null,
                    nama_admin: log.user ? log.user.name : this.currentAdminName,
                    hari: date.toLocaleDateString('id-ID', { weekday: 'long' }),
                    aksi: log.category,
                    objek: log.title,
                    detail: log.description,
                    jam: date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }),
                    tahun: date.getFullYear(),
                    bulan: date.toLocaleDateString('id-ID', { month: 'long' }),
                    minggu: Math.ceil(date.getDate() / 7),
                    status: log.status || 'active'
                };
            });
        },

        get myLogs() {
            const now = this.getNow();
            return this.mappedLogs.filter(log =>
                log.status === 'active' &&
                log.id_pengguna === this.currentAdminId &&
                log.minggu === now.week &&
                log.bulan === now.month &&
                log.tahun === now.year
            );
        },

        get filteredLogs() {
            const now = this.getNow();
            let base = this.mappedLogs.filter(log =>
                log.status === 'active' &&
                log.minggu === now.week &&
                log.bulan === now.month &&
                log.tahun === now.year
            );

            if (this.searchQuery) {
                const q = this.searchQuery.toLowerCase();
                base = base.filter(log =>
                    log.objek.toLowerCase().includes(q) ||
                    log.aksi.toLowerCase().includes(q)
                );
            }

            return base;
        },

        buildTree(sourceLogs) {
            const tree = [];

            sourceLogs.forEach(log => {
                let yearEntry = tree.find(a => a.tahun === log.tahun);
                if (!yearEntry) {
                    yearEntry = { tahun: log.tahun, bulan: [] };
                    tree.push(yearEntry);
                }

                let monthEntry = yearEntry.bulan.find(b => b.nama === log.bulan);
                if (!monthEntry) {
                    monthEntry = { nama: log.bulan, minggu: [] };
                    yearEntry.bulan.push(monthEntry);
                }

                if (!monthEntry.minggu.includes(log.minggu)) {
                    monthEntry.minggu.push(log.minggu);
                    monthEntry.minggu.sort((a, b) => a - b);
                }
            });

            return tree.sort((a, b) => b.tahun - a.tahun);
        },

        get archiveData() {
            return this.buildTree(this.mappedLogs.filter(l => l.status === 'active'));
        },

        get historyData() {
            return this.buildTree(this.mappedLogs.filter(l => l.status === 'deleted'));
        },

        get filteredLogsByDraft() {
            return this.mappedLogs.filter(log =>
                log.tahun === this.selectedCriteria.year &&
                log.bulan === this.selectedCriteria.month &&
                log.minggu === this.selectedCriteria.week
            );
        },

        openDraft(year, month, week) {
            this.selectedCriteria = { year, month, week };
            this.selectedDraftTitle = `Minggu ${week} - ${month} ${year}`;
            this.showDraftDetail = true;
        }
    }
}
</script>
</body>
</html>