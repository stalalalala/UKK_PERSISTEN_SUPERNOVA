<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minat Bakat - Admin | PERSISTEN</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        .active-page {
            background-color: #4A72D4 !important;
            color: white !important;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>

<body class="bg-[#E9EFFF] h-screen overflow-hidden text-[#2D3B61]" x-data="minatBakatLogic()">

    <div class="flex h-full w-full">
        <aside :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed inset-y-0 left-0 z-50 w-72 bg-[#4A72D4] text-white flex flex-col p-6 shadow-xl transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 shrink-0 h-screen overflow-y-auto">

            <div class="flex items-center justify-between mb-10 px-2">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/logo.svg') }}" alt="Logo" class="w-14 h-14">
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

                <a href="{{ route('admin.dashboard.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                    </svg>
                    <span class="text-md font-regular">Dashboard</span>
                </a>

                <a href="{{ route('admin.user.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl  transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen user</span>
                </a>

                <a href="{{ route('admin.streak.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 18a3.75 3.75 0 0 0 .495-7.468 5.99 5.99 0 0 0-1.925 3.547 5.975 5.975 0 0 1-2.133-1.001A3.75 3.75 0 0 0 12 18Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen streak</span>
                </a>

                <a href="{{ route('admin.tryout.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen tryout</span>
                </a>

                <a href="{{ route('admin.kuis.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen kuis</span>
                </a>

                <a href="{{ route('admin.latihan.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                    <span class="text-md font-regular">Manajemen latihan soal</span>
                </a>

                <a href="{{ route('admin.videoPembelajaran.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-9">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen video pembelajaran</span>
                </a>

                <a href="{{ route('admin.minatBakat.index') }}" x-init="if (currentPage === 'minat_bakat') { $el.scrollIntoView({ block: 'center' }) }"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl bg-[#D4DEF7]  text-[#2E3B66] transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                    </svg>
                    <span class="text-md font-regular">Manajemen minat bakat</span>
                </a>



                <a href="{{ route('admin.peluang.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen peluang PTN</span>
                </a>

                <a href="{{ route('admin.laporan.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                    </svg>
                    <span class="text-md font-regular">Monitoring dan laporan</span>
                </a>

                <form action="{{ route('logout') }}" method="POST" class="w-full inline">
                    @csrf
                    <button type="submit"
                        class="mt-4 w-full flex items-center bg-white/10 hover:bg-white/20 px-6 py-3 rounded-2xl transition-all group border border-white/20 backdrop-blur-sm shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-5 md:size-6 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                        </svg>
                        <span class="text-white text-md font-medium tracking-wide ml-4">Logout</span>
                    </button>
                </form>
        </aside>

        <main class="flex-1 flex flex-col min-w-0 bg-[#F8FAFF] overflow-hidden p-4 lg:p-8">
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
                    alert('Halaman tidak ditemukan')
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

            <div class="flex-1 pb-8 overflow-y-auto custom-scrollbar">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-blue-50 flex items-center gap-6 group hover:shadow-md transition-all">
                        <div
                            class="w-14 h-14 rounded-2xl flex items-center justify-center text-xl bg-blue-50 text-blue-500">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Peserta
                                Tes</p>
                            <h3 class="text-xl font-bold text-gray-800" x-text="participants.length"></h3>
                        </div>
                    </div>
                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-blue-50 flex items-center gap-6 group hover:shadow-md transition-all">
                        <div
                            class="w-14 h-14 rounded-2xl flex items-center justify-center text-xl bg-emerald-50 text-emerald-500">
                            <i class="fa-solid fa-brain"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Kategori
                                Minat Bakat</p>
                            <h3 class="text-xl font-bold text-gray-800" x-text="categories.length"></h3>
                        </div>
                    </div>
                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-blue-50 flex items-center gap-6 group hover:shadow-md transition-all">
                        <div
                            class="w-14 h-14 rounded-2xl flex items-center justify-center text-xl bg-orange-50 text-orange-500">
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Soal Aktif
                            </p>
                            <h3 class="text-xl font-bold text-gray-800" x-text="totalSoalAktif"></h3>
                        </div>
                    </div>
                </div>

                <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-widest">Kategori Minat Bakat</h3>
                        <p class="text-[10px] text-gray-400 font-medium mt-1">Kelola kategori dan deskripsi Minat bakat
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <button @click="showHistoryModal = true"
                            class="flex-1 md:flex-none px-5 py-3 bg-white border border-gray-200 text-gray-500 rounded-xl text-[10px] font-bold uppercase hover:bg-gray-50 transition-all flex items-center justify-center shadow-sm">
                            <i class="fa-solid fa-clock-rotate-left mr-2 text-[#4A72D4]"></i> History
                        </button>

                        <button @click="openAddModal()"
                            class="flex-1 md:flex-none px-6 py-3 bg-[#4A72D4] text-white rounded-xl text-[10px] font-bold uppercase tracking-widest shadow-lg shadow-blue-100 hover:scale-105 active:scale-95 transition-all flex items-center justify-center">
                            <i class="fa-solid fa-plus mr-2"></i> Tambah Kategori
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                    <template x-for="cat in categories" :key="cat.id">
                        <div
                            class="bg-white p-6 rounded-2xl border-2 border-transparent hover:border-[#4A72D4] transition-all relative group overflow-hidden cursor-pointer shadow-sm">

                            <div @click="goToSoal(cat.name)"
                                class="absolute inset-0 bg-[#2D3B61]/80 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10 flex items-center justify-center">
                                <span
                                    class="text-white text-[10px] font-bold uppercase tracking-widest border border-white/30 px-4 py-2 rounded-full">Atur
                                    Soal</span>
                            </div>

                            <div
                                class="absolute top-3 right-3 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex gap-2">
                                <button @click.stop="openEditModal(cat)"
                                    class="w-8 h-8 bg-white text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all shadow-md flex items-center justify-center">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </button>

                                <button type="button"
                                    @click.stop="
                            Swal.fire({
                            title: 'Hapus Kategori?',
                            text: 'Kategori akan dipindahkan ke History',
                            icon: 'warning',
                            width: '340px',
                            showCancelButton: true,
                            confirmButtonColor: '#ef4444',
                            confirmButtonText: 'Ya, Hapus!',
                            cancelButtonText: 'Batal',
                        customClass: { popup: 'rounded-3xl shadow-xl', title: 'text-lg font-bold', confirmButton: 'px-5 py-2.5 rounded-xl text-sm',   cancelButton: 'px-5 py-2.5 rounded-xl text-sm bg-gray-100 text-gray-600 hover:bg-gray-200' }
                        }).then((result) => {
                            if(result.isConfirmed) $el.nextElementSibling.submit()
                        })
                        "
                                    class="text-red-500 px-3 py-1.5 rounded-lg text-xs hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>

                                <form :action="`/admin/minatBakat/${cat.id}`" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>

                            <div class="flex flex-col gap-3 relative z-0">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white shrink-0 shadow-sm"
                                        :style="`background-color: ${cat.color}`">
                                        <i class="fa-solid fa-brain text-sm"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="text-xs font-bold text-gray-800 truncate" x-text="cat.name"></h4>
                                        <p class="text-[9px] font-bold text-blue-500 uppercase"
                                            x-text="(cat.soals_count || 0) + ' Soal'"></p>
                                    </div>
                                </div>
                                <p class="text-[10px] leading-relaxed text-gray-500 line-clamp-2 italic"
                                    x-text="cat.description || 'Belum ada deskripsi untuk kategori ini.'"></p>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="bg-white rounded-2xl border border-blue-50 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                        <h3 class="text-xs font-bold text-gray-800 uppercase tracking-widest">Peserta Tes Terbaru</h3>
                        <button @click="showAllParticipants = true; pagiCurrentPage = 1"
                            class="text-[10px] font-bold text-blue-500 uppercase hover:underline">Lihat Semua</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                        Nama Peserta</th>
                                    <th
                                        class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">
                                        Hasil Dominan</th>
                                    <th
                                        class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <template x-for="user in participants.slice(0, 5)" :key="user.id">
                                    <tr class="hover:bg-blue-50/30 transition-all">
                                        <td class="px-6 py-4">
                                            <p class="text-sm font-bold text-gray-800" x-text="user.name"></p>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span
                                                class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-bold uppercase"
                                                x-text="user.hasil"></span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a :href="'/admin/minat-bakat/pdf/' + user.id" target="_blank"
                                                class="text-gray-400 hover:text-blue-500 transition-all">
                                                <i class="fa-solid fa-file-pdf text-sm"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div x-show="showModal" x-cloak
        class="fixed inset-0 z-[100] bg-black/50 backdrop-blur-sm flex items-center justify-center p-4" x-transition>

        <div @click.away="showModal = false" class="bg-white w-full max-w-md rounded-[32px] p-8 shadow-2xl">

            <!-- HEADER -->
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-extrabold text-slate-800"
                    x-text="isEdit ? 'Ubah Kategori' : 'Tambah Kategori'"></h3>

                <button @click="showModal = false" class="text-gray-300 hover:text-red-500">
                    <i class="fa-solid fa-circle-xmark text-2xl"></i>
                </button>
            </div>

            <!-- FORM -->
            <form method="POST"
                @submit.prevent="
                if(!formData.name || !formData.description || !formData.color){
                    Swal.fire({
                        icon: 'error',
                        title: 'Lengkapi Data!',
                        text: 'Semua field wajib diisi',
                        width: '340px'
                    });
                    return;
                }
                $el.submit();
            "
                :action="isEdit
                    ?
                    `/admin/minatBakat/${formData.id}` :
                    '{{ route('admin.minatBakat.kategori.store') }}'">

                @csrf
                <template x-if="isEdit">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div class="space-y-3">

                    <!-- Nama -->
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase ml-1 tracking-widest">
                            Nama Kategori
                        </label>
                        <input type="text" name="name" x-model="formData.name"
                            class="w-full bg-[#F3F6FF] rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none"
                            placeholder="Masukkan nama kategori...">
                    </div>

                    <!-- Deskripsi -->
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase ml-1 tracking-widest">
                            Deskripsi
                        </label>
                        <textarea name="description" x-model="formData.description" rows="3"
                            class="w-full bg-[#F3F6FF] rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none resize-none"
                            placeholder="Masukkan deskripsi..."></textarea>
                    </div>

                    <!-- Warna -->
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase ml-1 tracking-widest">
                            Warna Identitas
                        </label>

                        <div class="flex gap-3 items-center">
                            <input type="color" name="color" x-model="formData.color"
                                class="h-12 w-16 rounded-xl border-none cursor-pointer bg-transparent">

                            <div class="flex-1 bg-[#F3F6FF] rounded-2xl p-3 text-[10px] font-bold text-slate-400 uppercase flex items-center"
                                x-text="formData.color"></div>
                        </div>
                    </div>

                    <!-- BUTTON -->
                    <div class="flex gap-3 pt-2">
                        <button type="button" @click="showModal = false"
                            class="flex-1 bg-slate-50 text-slate-400 font-bold py-3.5 rounded-2xl hover:bg-slate-100">
                            Batal
                        </button>

                        <button type="submit"
                            class="flex-1 bg-[#4A72D4] text-white font-bold py-3.5 rounded-2xl hover:bg-blue-600 shadow-lg shadow-blue-100 active:scale-95">
                            <span x-text="isEdit ? 'Simpan' : 'Tambah'"></span>
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div x-show="showAllParticipants" x-cloak class="fixed inset-0 z-[110] flex items-center justify-center lg:p-10">
        <div @click="showAllParticipants = false" class="absolute inset-0 bg-[#2D3B61]/60 backdrop-blur-md"></div>
        <div class="bg-white lg:rounded-[40px] w-full h-full max-w-6xl flex flex-col relative shadow-2xl overflow-hidden"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-20">

            <div class="p-8 border-b border-gray-100 flex items-center justify-between shrink-0">
                <div>
                    <h2 class="text-2xl font-black text-gray-800 uppercase tracking-tight">Database Peserta</h2>
                    <p class="text-[9px] font-bold text-blue-400 uppercase mt-1">Total <span
                            x-text="filteredParticipants.length"></span> Peserta</p>
                </div>
                <div class="flex items-center gap-3">
                    <button @click="exportData()"
                        class="hidden md:flex items-center gap-2 px-4 py-3 bg-emerald-50 text-emerald-600 rounded-2xl text-[10px] font-bold uppercase tracking-widest hover:bg-emerald-500 hover:text-white transition-all shadow-sm border border-emerald-100">
                        <i class="fa-solid fa-file-csv text-sm"></i> Backup CSV
                    </button>

                    <button @click="resetData()"
                        class="hidden md:flex items-center gap-2 px-4 py-3 bg-red-50 text-red-500 rounded-2xl text-[10px] font-bold uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all shadow-sm border border-red-100">
                        <i class="fa-solid fa-trash-can text-sm"></i> Reset Data
                    </button>

                    <div class="relative hidden md:block">
                        <i
                            class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-gray-300 text-xs"></i>
                        <input type="text" x-model="searchParticipants" @input="pagiCurrentPage = 1"
                            placeholder="Cari nama..."
                            class="pl-12 pr-6 py-4 bg-gray-50 border-none rounded-2xl text-xs font-medium w-48 focus:ring-2 focus:ring-blue-400 outline-none transition-all shadow-inner">
                    </div>
                    <button @click="showAllParticipants = false"
                        class="w-12 h-12 flex items-center justify-center rounded-2xl bg-gray-100 text-gray-400 hover:bg-red-500 hover:text-white transition-all">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-4 md:p-10 custom-scrollbar bg-gray-50/50">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/80">
                            <tr>
                                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                    Nama</th>
                                <th
                                    class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">
                                    Hasil</th>
                                <th
                                    class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <template x-for="user in paginatedParticipants" :key="user.id">
                                <tr class="hover:bg-blue-50/50 transition-all">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center font-black text-xs"
                                                x-text="user.name.charAt(0)"></div>
                                            <div>
                                                <p class="text-sm font-bold text-gray-800" x-text="user.name"></p>
                                                <p class="text-[9px] font-bold text-gray-400 uppercase"
                                                    x-text="user.created_at ? new Date(user.created_at).toLocaleDateString() : ''">
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <span
                                            class="px-4 py-2 bg-blue-50 text-[#4A72D4] rounded-xl text-[10px] font-black uppercase"
                                            x-text="user.hasil"></span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <a :href="'/admin/minat-bakat/pdf/' + user.id" target="_blank"
                                            class="w-8 h-8 rounded-lg bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white transition-all inline-flex items-center justify-center">
                                            <i class="fa-solid fa-file-pdf text-xs"></i>
                                        </a>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 flex items-center justify-between px-4" x-show="totalParticipantPages > 1">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Halaman <span
                            x-text="pagiCurrentPage"></span> dari <span x-text="totalParticipantPages"></span></p>
                    <div class="flex items-center gap-2">
                        <button @click="pagiCurrentPage--" :disabled="pagiCurrentPage === 1"
                            class="w-10 h-10 rounded-xl bg-white text-blue-500 shadow-sm disabled:opacity-20 flex items-center justify-center">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                        <button @click="pagiCurrentPage++" :disabled="pagiCurrentPage === totalParticipantPages"
                            class="w-10 h-10 rounded-xl bg-white text-blue-500 shadow-sm disabled:opacity-20 flex items-center justify-center">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('minatBakatLogic', () => ({
                activeMenu: 'minat-bakat',
                currentPage: 'minat_bakat',
                searchQuery: '',
                searchParticipants: '',
                mobileMenuOpen: false,
                showModal: false,
                showAllParticipants: false,
                showHistoryModal: false,
                isEdit: false,
                actionId: null,
                actionName: '',
                pagiCurrentPage: 1,
                pagiItemsPerPage: 5,
                showDeleteConfirmModal: false,

                // Data Initialization
                deletedSubtests: @json($trashedCategories ?? []),
                categories: @json($categories),
                participants: @json($participants),

                formData: {
                    id: null,
                    name: '',
                    color: '#4A72D4',
                    description: ''
                },

                // Computed Properties
                get totalSoalAktif() {
                    return this.categories.reduce((acc, cat) => acc + (parseInt(cat.soals_count) ||
                        0), 0);
                },

                get filteredParticipants() {
                    return this.participants.filter(p =>
                        p.name.toLowerCase().includes(this.searchParticipants.toLowerCase()) ||
                        (p.hasil && p.hasil.toLowerCase().includes(this.searchParticipants
                            .toLowerCase()))
                    );
                },

                get paginatedParticipants() {
                    let start = (this.pagiCurrentPage - 1) * this.pagiItemsPerPage;
                    return this.filteredParticipants.slice(start, start + this.pagiItemsPerPage);
                },

                get totalParticipantPages() {
                    return Math.ceil(this.filteredParticipants.length / this.pagiItemsPerPage) || 1;
                },

                // Actions
                exportData() {
                    window.location.href = '{{ route('admin.minatBakat.export') }}';
                },

                async resetData() {
                    if (confirm(
                            'PERINGATAN: Pastikan Anda sudah membackup data! Hapus semua data peserta sekarang?'
                        )) {
                        try {
                            const response = await fetch('{{ route('admin.minatBakat.reset') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                }
                            });
                            if (response.ok) {
                                alert('Database berhasil dibersihkan');
                                window.location.reload();
                            }
                        } catch (e) {
                            alert('Gagal mereset data');
                        }
                    }
                },

                openAddModal() {
                    this.isEdit = false;
                    this.formData = {
                        id: null,
                        name: '',
                        color: '#4A72D4',
                        description: ''
                    };
                    this.showModal = true;
                },

                openEditModal(cat) {
                    this.isEdit = true;
                    this.formData = {
                        id: cat.id,
                        name: cat.name,
                        color: cat.color,
                        description: cat.description || ''
                    };
                    this.showModal = true;
                },


                goToSoal(name) {
                    const baseUrl = '{{ route('admin.minatBakat.manajemen') }}';
                    window.location.href = `${baseUrl}?category=${encodeURIComponent(name)}`;
                }
            }));
        });
    </script>

    {{-- HISTORY --}}
    <div x-show="showHistoryModal" x-cloak class="fixed inset-0 z-[110] flex items-center justify-center p-4 sm:p-6">
        <div @click="showHistoryModal = false" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:leave="ease-in duration-200"
            class="absolute inset-0 bg-[#2D3B61]/60 backdrop-blur-md"></div>

        <div class="bg-white rounded-[2.5rem] w-full max-w-2xl flex flex-col relative shadow-[0_20px_50px_rgba(0,0,0,0.2)] overflow-hidden max-h-[80vh]"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-10">

            <div class="p-8 border-b border-gray-100 flex items-center justify-between bg-white sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 bg-blue-50 text-[#4A72D4] rounded-2xl flex items-center justify-center shadow-inner">
                        <i class="fa-solid fa-box-archive text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-[#2D3B61] uppercase tracking-tight">History</h2>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Kelola data terhapus
                        </p>
                    </div>
                </div>
                <button @click="showHistoryModal = false"
                    class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-50 text-gray-400 hover:bg-red-50 hover:text-red-500 transition-all">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto p-8 bg-[#F8FAFF] custom-scrollbar">
                <div class="grid gap-4">
                    <template x-if="deletedSubtests.length === 0">
                        <div class="text-center py-16 bg-white rounded-[2rem] border-2 border-dashed border-gray-100">
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Tidak ada kategori
                                terhapus</p>
                        </div>
                    </template>

                    <template x-for="item in deletedSubtests" :key="item.id">
                        <div
                            class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm flex flex-col sm:flex-row items-center justify-between group hover:shadow-md transition-all duration-300">
                            <div class="flex items-center gap-4 w-full sm:w-auto mb-4 sm:mb-0">
                                <div class="w-2 h-10 rounded-full shrink-0"
                                    :style="`background-color: ${item.color}`"></div>
                                <div class="min-w-0">
                                    <h4 class="font-bold text-[#2D3B61] text-sm truncate" x-text="item.name"></h4>
                                    <p class="text-[10px] text-gray-400 font-medium line-clamp-1"
                                        x-text="item.description || 'Tanpa deskripsi'"></p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 w-full sm:w-auto">
                                <button type="button"
                                    @click.stop="
                            Swal.fire({
                            title: 'Pulihkan Kategori?',
                            text: 'Data akan dikembalikan ke daftar Kategori',
                            icon: 'question',
                            width: '340px',
                            showCancelButton: true,
                            confirmButtonColor: '#22c55e',
                            confirmButtonText: 'Ya, Pulihkan!',
                            cancelButtonText: 'Batal',
                            customClass: { popup: 'rounded-3xl shadow-xl', title: 'text-lg font-bold', confirmButton: 'px-5 py-2.5 rounded-xl text-sm',   cancelButton: 'px-5 py-2.5 rounded-xl text-sm bg-gray-100 text-gray-600 hover:bg-gray-200' }
                            }).then((result) => {
                                if(result.isConfirmed) $el.nextElementSibling.submit()
                            })
                            "
                                    class="text-blue-500 px-2 py-1 rounded-lg text-xs hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 4v6h6M20 20v-6h-6M4 10a8 8 0 0116 0 8 8 0 01-16 0z" />
                                    </svg>
                                </button>

                                <form :action="`/admin/minat-bakat/${item.id}/restore`" method="POST"
                                    class="hidden">
                                    @csrf
                                </form>
                                <button type="button"
                                    @click.stop="
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
                            if(result.isConfirmed) $el.nextElementSibling.submit()
                        })
                        "
                                    class="text-red-500 px-3 py-1.5 rounded-lg text-xs hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>

                                <form :action="`/admin/minat-bakat/${item.id}/force-delete`" method="POST"
                                    class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

        </div>
    </div>
    @if (session('success'))
        <div x-data x-init="Swal.fire({
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
        })"></div>
    @endif

    @if (session('error'))
        <div x-data x-init="Swal.fire({
            icon: 'error',
            title: '{{ session('error') }}',
        
            width: '340px',
            padding: '1.8rem',
        
            background: '#ffffff',
            color: '#334155',
        
            confirmButtonText: 'Coba Lagi',
            confirmButtonColor: '#ef4444',
        
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
        })"></div>
    @endif
</body>

</html>