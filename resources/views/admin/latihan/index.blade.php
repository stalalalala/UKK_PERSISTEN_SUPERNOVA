<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Latihan Soal - Persisten</title>
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
    </style>
</head>

<body class="bg-[#E9EFFF] h-screen flex overflow-hidden text-[#2D3B61]" x-data="{
    mobileMenuOpen: false,
    totalLatihan: {{ $allLatihan->count() }},
    totalHistory: {{ $historyData->count() }},
    activeTab: 'list'
}">

    <aside x-data="{ currentPage: 'kuis' }" :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
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

            <a href="{{ route('admin.kuis.index') }}" x-init="if (currentPage === 'kuis') { $el.scrollIntoView({ block: 'center' }) }"
                class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl  transition-all duration-200 group text-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                </svg>
                <span class="text-md font-regular">Manajemen kuis</span>
            </a>

            <a href="{{ route('admin.latihan.index') }}"
                class="w-full flex items-center gap-4 px-4 py-3 bg-[#D4DEF7]  text-[#2E3B66] rounded-2xl transition-all duration-200 group text-left">
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

            <a href="{{ route('admin.minatBakat.index') }}"
                class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
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
        </nav>

        <button
            class="mt-4 w-full flex items-center bg-white/10 hover:bg-white/20 px-6 py-3 rounded-2xl transition-all group border border-white/20 backdrop-blur-sm shrink-0">
            <i class="fa-solid fa-right-from-bracket text-lg"></i>
            <span class="text-white text-md font-medium tracking-wide ml-4">Logout</span>
        </button>
    </aside>

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
                <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto custom-scrollbar p-4 lg:px-8 lg:pb-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-blue-50 flex items-center gap-5">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-[#4A72D4]">
                        <i class="fa-solid fa-layer-group text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400 font-medium">Total Set Latihan Soal</p>
                        <h4 class="text-2xl font-bold text-gray-800">{{ $allLatihan->count() }}</h4>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-blue-50 flex items-center gap-5">
                    <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500">
                        <i class="fa-solid fa-circle-check text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400 font-medium">Latihan Soal Aktif</p>
                        <h4 class="text-2xl font-bold text-gray-800">{{ $allLatihan->where('is_active', 1)->count() }}
                        </h4>
                    </div>
                </div>
                <div
                    class="bg-white p-6 rounded-xl shadow-sm border border-blue-50 flex items-center gap-5 sm:col-span-2 md:col-span-1">
                    <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-500">
                        <i class="fa-solid fa-trash-can text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400 font-medium">Sampah (History)</p>
                        <h4 class="text-2xl font-bold text-gray-800">{{ $historyData->count() }}</h4>
                    </div>
                </div>
            </div>

            @php
                $subtesList = [
                    'Penalaran Umum' => 'PU',
                    'Pengetahuan & Pemahaman Umum' => 'PPU',
                    'Pemahaman Bacaan & Menulis' => 'PBM',
                    'Pengetahuan Kuantitatif' => 'PK',
                    'Penalaran Matematika' => 'PM',
                    'Literasi Bahasa Indonesia' => 'LBI',
                    'Literasi Bahasa Inggris' => 'LBE',
                ];
            @endphp

            <div class="flex flex-wrap gap-2 mb-6">

                {{-- Semua --}}
                <a href="{{ route('admin.latihan.index') }}"
                    class="px-5 py-2 rounded-full text-xs font-bold transition-all 
        {{ !request('subtes') ? 'bg-[#4A72D4] text-white' : 'bg-white text-gray-500 hover:bg-blue-50' }}">
                    Semua
                </a>

                {{-- Filter Subtes --}}
                @foreach ($subtesList as $full => $short)
                    <a href="{{ route('admin.latihan.index', ['subtes' => $full]) }}"
                        class="px-5 py-2 rounded-full text-xs font-bold transition-all 
            {{ request('subtes') == $full ? 'bg-[#4A72D4] text-white' : 'bg-white text-gray-500 hover:bg-blue-50' }}">
                        {{ $short }}
                    </a>
                @endforeach

            </div>

            <div class="bg-white rounded-xl shadow-sm border border-blue-50 overflow-hidden flex flex-col">
                <div
                    class="p-6 md:p-8 border-b border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800"
                            x-text="activeTab === 'list' ? 'Daftar Latihan Soal' : 'History'"></h3>
                        <p class="text-sm text-gray-400"
                            x-text="activeTab === 'list' ? 'Kelola Latihan Soal' : 'Data yang dihapus sementara dapat dipulihkan di sini'">
                            ></p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button @click="activeTab = activeTab === 'list' ? 'history' : 'list'"
                            class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-3 rounded-xl font-semibold text-xs transition-all flex items-center gap-2">
                            <i class="fa-solid fa-clock-rotate-left"></i> <span
                                x-text="activeTab === 'list' ? 'History' : 'Daftar'"></span>
                        </button>
                        <a href="{{ route('admin.latihan.create') }}"
                            class="bg-[#4A72D4] hover:bg-blue-600 text-white px-5 py-3 rounded-xl font-semibold text-xs transition-all flex items-center gap-2">
                            <i class="fa-solid fa-plus"></i> Buat Set Baru
                        </a>
                    </div>
                </div>

                <div class="w-full overflow-x-auto">
                    <table x-show="activeTab === 'list'" class="w-full text-left border-separate border-spacing-0">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase">Set Latihan</th>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase">Subtes</th>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase text-center">Soal
                                </th>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase text-center">Durasi
                                </th>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase text-center">Status
                                </th>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase text-center">Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($latihans as $item)
                                <tr class="hover:bg-blue-50/30 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-800">Set {{ $item->set_ke }}</div>
                                        <div class="text-xs text-gray-400 "> Dibuat:
                                            {{ $item->created_at->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td
                                        class="px-4 md:px-6 py-4 font-semibold text-gray-600 align-top whitespace-nowrap">
                                        {{ $item->subtes }}
                                    </td>
                                    <td class="px-3 md:px-6 py-4 text-center align-top whitespace-nowrap">
                                        <span
                                            class="inline-block bg-blue-50 text-blue-600 font-semibold px-3 py-1 rounded-full text-xs">
                                            {{ $item->questions_count }} Soal
                                        </span>
                                    </td>
                                    <td
                                        class="px-3 md:px-6 py-4 text-center align-top whitespace-nowrap text-gray-700">
                                        <span
                                            class="inline-block bg-red-50 text-red-600 font-semibold px-3 py-1 rounded-full text-xs">{{ $item->durasi }}
                                            Menit</span>
                                    </td>
                                    <td class="px-3 md:px-6 py-4 text-center align-top whitespace-nowrap">
                                        @if ($item->is_active)
                                            <span
                                                class="px-3 py-1 text-xs rounded-full bg-emerald-100 text-emerald-600 font-semibold">
                                                Aktif
                                            </span>
                                        @else
                                            <span
                                                class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-500 font-semibold">
                                                Hidden
                                            </span>
                                        @endif
                                    </td>
                                    <!-- Aksi -->
                                    <td class="px-3 md:px-6 pt-1 pb-4 text-center align-top whitespace-nowrap">
                                        <div class="flex justify-center gap-2">

                                            <!-- Edit -->
                                            <a href="{{ route('admin.latihan.edit', $item->id) }}"
                                                class="px-4 py-2 rounded-lg hover:bg-blue-100 text-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                </svg>

                                            </a>

                                            <!-- Toggle -->
                                            <form action="{{ route('admin.latihan.toggle', $item->id) }}"
                                                method="POST">
                                                @csrf

                                                <button type="submit"
                                                    class="px-4 py-2 rounded-lg transition
        {{ $item->is_active ? 'hover:bg-emerald-100 text-emerald-600' : 'hover:bg-gray-100 text-gray-500' }}">

                                                    @if ($item->is_active)
                                                        <!-- ICON: Mata Normal (Aktif) -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        </svg>
                                                    @else
                                                        <!-- ICON: Mata Dicoret (Hidden) -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                                        </svg>
                                                    @endif

                                                </button>
                                            </form>


                                            <!-- Delete -->
                                            <form action="{{ route('admin.latihan.destroy', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus set latihan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="px-4 py-2 rounded-lg hover:bg-red-100 text-red-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>

                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($latihans->isEmpty())
                                <tr>
                                    <td colspan="6" class="px-8 py-10 text-center text-gray-400 text-sm">
                                        Tidak ada latihan.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <table x-show="activeTab === 'history'"
                        class="w-full text-left border-separate border-spacing-0 min-w-full">
                        <thead class="bg-orange-50/50 sticky top-0 z-10 backdrop-blur-sm">
                            <tr>
                                <th class="px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                                    Judul Kuis (Terhapus)</th>
                                <th class="px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                                    Kategori</th>
                                <th class="px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                                    Soal</th>
                                <th
                                    class="px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">
                                    Durasi</th>
                                <th
                                    class="px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">
                                    Aksi Pemulihan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">

                            @forelse ($trash as $trashItem)
                                <tr class="hover:bg-orange-50/40 transition group">

                                    <!-- Judul -->
                                    <td class="px-4 md:px-8 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-gray-800">
                                                {{ $trashItem->full_title }}
                                            </span>
                                            <span class="text-[10px] text-rose-400 font-bold uppercase">
                                                Data di History
                                            </span>
                                        </div>
                                    </td>

                                    <!-- Kategori -->
                                    <td
                                        class="px-4 md:px-8 py-4 text-gray-600 font-semibold align-top whitespace-nowrap">
                                        {{ $trashItem->subtes }}
                                    </td>

                                    <!-- Jumlah Soal -->
                                    <td class="px-4 md:px-8 py-4 text-sm text-gray-600 align-top whitespace-nowrap">
                                        <span
                                            class="inline-block bg-blue-50 text-blue-600 font-semibold px-3 py-1 rounded-full text-xs">
                                            {{ $trashItem->questions_count }} Soal
                                        </span>
                                    </td>

                                    <!-- Durasi -->
                                    <td class="px-4 md:px-8 py-4 text-center align-top whitespace-nowrap">
                                        <span
                                            class="inline-block bg-red-50 text-red-600 font-semibold px-3 py-1 rounded-full text-xs">
                                            {{ $trashItem->durasi }} Menit
                                        </span>
                                    </td>

                                    <!-- Aksi -->
                                    <td class="px-4 md:px-8 py-4">
                                        <div class="flex flex-col md:flex-row gap-2 justify-center">

                                            <!-- RESTORE -->
                                            <form action="{{ route('admin.latihan.restore', $trashItem->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="w-full md:w-auto px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg text-xs font-bold shadow-sm transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                    </svg>

                                                </button>
                                            </form>

                                            <!-- FORCE DELETE -->
                                            <form action="{{ route('admin.latihan.forceDelete', $trashItem->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus permanen kuis ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="w-full md:w-auto px-4 py-2 bg-rose-500 hover:bg-rose-600 text-white rounded-lg text-xs font-bold shadow-sm transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>

                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-10 text-sm text-center text-gray-400">
                                        History kosong.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>
                <div class="p-6 md:p-8 border-t border-gray-50 bg-white">
                    <p class="text-sm text-gray-400 font-bold uppercase tracking-widest text-center sm:text-left"
                        x-text="activeTab === 'list' 
        ? 'Menampilkan ' + totalLatihan + ' Set Latihan Soal' 
        : 'Menampilkan ' + totalHistory + ' Set Latihan Soal yang dihapus'">
                    </p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
