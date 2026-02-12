<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Video</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-100 font-po overflow-x-hidden">

<div x-data="userApp()" class="flex h-screen overflow-hidden">

    <aside :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed inset-y-0 left-0 z-50 w-72 bg-[#4A72D4] text-white flex flex-col p-6 shadow-xl transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 shrink-0 h-full">

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
            <span class="text-md font-regular">Manajemen latihan
soal</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl bg-[#D4DEF7]  text-[#2E3B66] transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen video
pembelajaran</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen minat 
bakat</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen 
perangkingan</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen peluang
PTN</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Monitoring dan
laporan</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen sistem
dan konten</span>
        </a>

        </nav>

    <button class="mt-4 w-full flex items-center bg-white/10 hover:bg-white/20 px-6 py-3 rounded-2xl transition-all group border border-white/20 backdrop-blur-sm shrink-0">
        <svg xmlns="http://www.w3.org/2000/xml" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 md:size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
        </svg>
        <span class="text-white text-md font-medium tracking-wide ml-4">Logout</span>
    </button>
</aside>

    <main class="flex-1 p-4 md:p-8 overflow-y-auto h-screen">

        <header class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4">
            <div class="flex items-center w-full gap-4">
                <button @click="mobileMenuOpen = true" class="lg:hidden p-3 bg-white rounded-xl shadow-sm">
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

            <div class="flex items-center gap-3 bg-white p-1 pr-4 pl-1 rounded-full shadow-sm shrink-0 self-end md:self-auto">
                <div class="w-10 h-10 bg-gray-200 rounded-full overflow-hidden border-2 border-white">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=random" alt="Admin">
                </div>
                <span class="font-bold text-sm hidden sm:block text-gray-700">Admin</span>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </header>

        <h2 class="text-2xl font-semibold text-slate-700 mb-6">Manajemen Video Pembelajaran</h2>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-4 md:p-6 overflow-hidden" 
     x-data="videoApp()">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div class="flex bg-gray-100 p-1 rounded-2xl w-full md:w-auto">
            <button @click="activeTab = 'active'" 
                :class="activeTab === 'active' ? 'bg-white shadow-sm text-[#4A72D4]' : 'text-gray-500 hover:text-gray-700'"
                class="px-6 py-2 rounded-xl text-sm font-bold transition-all flex-1 md:flex-none">
                Daftar Video
            </button>
            <button @click="activeTab = 'history'" 
                :class="activeTab === 'history' ? 'bg-white shadow-sm text-[#4A72D4]' : 'text-gray-500 hover:text-gray-700'"
                class="px-6 py-2 rounded-xl text-sm font-bold transition-all flex-1 md:flex-none flex items-center justify-center gap-2">
                <i class="fa-solid fa-clock-rotate-left text-xs"></i>
                History
            </button>
        </div>

        <div x-show="activeTab === 'active'" x-transition>
            <button @click="openModalVideo = true; isEditVideo = false" 
                class="w-full md:w-auto bg-[#4A72D4] hover:bg-blue-600 text-white px-6 py-3 rounded-2xl text-sm font-bold flex items-center justify-center gap-2 transition-all active:scale-95 shadow-md shadow-blue-100">
                <i class="fa-solid fa-plus text-xs"></i>
                Tambah Video
            </button>
        </div>
    </div>

    <div x-show="activeTab === 'active'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2">
        <div class="overflow-x-auto rounded-2xl border border-gray-50">
            <table class="w-full text-sm min-w-[800px]">
                <thead class="bg-[#F8FAFF] text-[#4A72D4]">
                    <tr>
                        <th class="p-4 text-left font-bold uppercase tracking-wider">ID Video</th>
                        <th class="p-4 text-left font-bold uppercase tracking-wider">Subtes</th>
                        <th class="p-4 text-left font-bold uppercase tracking-wider">Judul Video</th>
                        <th class="p-4 text-center font-bold uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-4 font-mono text-xs text-slate-500">123-VID</td>
                        <td class="p-4">
                            <span class="bg-blue-50 text-[#4A72D4] px-3 py-1 rounded-full text-[11px] font-bold">Penalaran Umum</span>
                        </td>
                        <td class="p-4 font-semibold text-slate-700">Logika Analitik</td>
                        <td class="p-4 text-center space-x-2">
                            <button @click="openModalVideo = true; isEditVideo = true" class="bg-blue-500 text-white px-3 py-1.5 rounded-lg text-xs hover:bg-blue-600 transition-all shadow-sm">Ubah</button>
                            <button @click="handleDelete('123-VID')" class="bg-red-500 text-white px-3 py-1.5 rounded-lg text-xs hover:bg-red-600 transition-all shadow-sm">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="activeTab === 'history'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" style="display: none;">
        <div class="overflow-x-auto rounded-2xl border border-red-50">
            <table class="w-full text-sm min-w-[800px]">
                <thead class="bg-red-50/30 text-red-600">
                    <tr>
                        <th class="p-4 text-left font-bold uppercase tracking-wider">ID Video</th>
                        <th class="p-4 text-left font-bold uppercase tracking-wider">Judul Video</th>
                        <th class="p-4 text-left font-bold uppercase tracking-wider">Status</th>
                        <th class="p-4 text-center font-bold uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <tr class="hover:bg-gray-50">
                        <td class="p-4 font-mono text-xs text-slate-400 italic">099-VID</td>
                        <td class="p-4 font-medium text-slate-500 line-through">Pengetahuan Kuantitatif Old</td>
                        <td class="p-4">
                            <span class="text-[10px] text-red-400 font-bold uppercase tracking-tighter bg-red-50 px-2 py-0.5 rounded border border-red-100">Terhapus</span>
                        </td>
                        <td class="p-4 text-center">
                            <button @click="handleRestore('099-VID')" 
                                class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-xl text-xs font-bold transition-all active:scale-95 shadow-md shadow-emerald-100">
                                <i class="fa-solid fa-rotate-left"></i>
                                Pulihkan Video
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function videoApp() {
        return {
            activeTab: 'active', // 'active' atau 'history'
            openModalVideo: false, // Digunakan untuk modal Anda yang sudah ada
            isEditVideo: false,

            // Logika untuk menghapus dengan konfirmasi
            handleDelete(id) {
                Swal.fire({
                    title: 'Hapus Video?',
                    text: "Data akan dipindahkan ke tab history.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444', // red-500
                    cancelButtonColor: '#6b7280', // gray-500
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        popup: 'rounded-3xl',
                        confirmButton: 'rounded-xl px-4 py-2',
                        cancelButton: 'rounded-xl px-4 py-2'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Di sini panggil fungsi backend Anda
                        this.executeDelete(id);
                    }
                })
            },

            // Logika untuk memulihkan dengan konfirmasi
            handleRestore(id) {
                Swal.fire({
                    title: 'Pulihkan Video?',
                    text: "Video akan dikembalikan ke daftar aktif.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#10b981', // emerald-500
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Pulihkan!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        popup: 'rounded-3xl',
                        confirmButton: 'rounded-xl px-4 py-2',
                        cancelButton: 'rounded-xl px-4 py-2'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Di sini panggil fungsi backend Anda
                        this.executeRestore(id);
                    }
                })
            },

            executeDelete(id) {
                // Contoh feedback sukses setelah hapus
                Swal.fire({
                    title: 'Terhapus!',
                    text: `Video ${id} berhasil dipindahkan.`,
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
            },

            executeRestore(id) {
                // Contoh feedback sukses setelah pulihkan
                Swal.fire({
                    title: 'Dipulihkan!',
                    text: `Video ${id} kembali aktif.`,
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        }
    }
</script>
    </main>

    <div x-show="openModalVideo" x-cloak class="fixed inset-0 z-[100] bg-black/50 backdrop-blur-sm flex items-center justify-center p-4" x-transition>
        <div @click.away="openModalVideo = false" class="bg-white w-full max-w-md rounded-[32px] p-8 shadow-2xl">
            
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-extrabold text-slate-800" x-text="isEditVideo ? 'Ubah Video' : 'Tambah Video'"></h3>
                <button @click="openModalVideo = false" class="text-gray-300 hover:text-red-500 transition-colors">
                    <i class="fa-solid fa-circle-xmark text-2xl"></i>
                </button>
            </div>

            <form class="space-y-5">
                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-slate-400 uppercase ml-1 tracking-widest">ID Video</label>
                    <input type="text" class="w-full bg-[#F3F6FF] border-none rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none" placeholder="#VID-XXXX">
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-slate-400 uppercase ml-1 tracking-widest">Kategori Subtes</label>
                    <select class="w-full bg-[#F3F6FF] border-none rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none appearance-none">
                    <option>Pilih Subtes</option>
                    <option>Penalaran Umum</option>
                    <option>Pengetahuan dan Pemahaman Umum</option>
                    <option>Pemahaman Bacaan dan Menulis</option>
                    <option>Pengetahuan Kuantitatif</option>
                    <option>Penalaran Matematika</option>
                    <option>Literasi dalam Bahasa Indonesia</option>
                    <option>Literasi dalam Bahasa Inggris</option>
                      </select>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-slate-400 uppercase ml-1 tracking-widest">Judul Video</label>
                    <input type="text" class="w-full bg-[#F3F6FF] border-none rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none" placeholder="Masukkan judul video...">
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-slate-400 uppercase ml-1 tracking-widest">Link / URL Video</label>
                    <input type="url" class="w-full bg-[#F3F6FF] border-none rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none" placeholder="https://youtube.com/...">
                </div>

                <div class="flex gap-3 pt-6">
                    <button type="button" @click="openModalVideo = false" class="flex-1 bg-slate-50 text-slate-400 font-bold py-3.5 rounded-2xl hover:bg-slate-100 transition-all">Batal</button>
                    <button type="submit" class="flex-1 bg-[#4A72D4] text-white font-bold py-3.5 rounded-2xl hover:bg-blue-600 shadow-lg shadow-blue-100 transition-all active:scale-95">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function userApp() {
    return {
        openModalVideo: false,
        isEditVideo: false,
        mobileMenuOpen: false 
    }
}
</script>
</body>
</html>