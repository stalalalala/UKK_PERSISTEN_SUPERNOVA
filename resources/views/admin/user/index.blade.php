<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User</title>
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
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl bg-[#D4DEF7]  text-[#2E3B66] transition-all duration-200 group text-left">
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
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
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

        <h2 class="text-2xl font-semibold text-slate-700 mb-6">Manajemen User</h2>

      <div x-data="{ tab: 'admin', openModal: false, isEdit: false }" class="bg-white rounded-3xl shadow-sm border border-gray-100 p-4 md:p-6 overflow-hidden">
    
    <div class="flex gap-6 mb-6 border-b border-gray-100">
        <button @click="tab='admin'" :class="tab==='admin' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-400 hover:text-gray-600'" class="pb-3 text-sm font-bold transition-all">Admin</button>
        <button @click="tab='peserta'" :class="tab==='peserta' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-400 hover:text-gray-600'" class="pb-3 text-sm font-bold transition-all">Peserta</button>
    </div>

    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
        <div class="relative w-full md:w-80">
            <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
            <input type="text" :placeholder="tab === 'admin' ? 'Search Admin....' : 'Search Peserta....'" class="w-full bg-[#F3F6FF] border border-transparent rounded-full py-2.5 pl-11 pr-4 text-sm focus:ring-2 focus:ring-blue-400 outline-none">
        </div>

        <button x-show="tab==='admin'" @click="openModal=true; isEdit=false" class="w-full md:w-auto bg-[#4A72D4] hover:bg-blue-600 text-white px-6 py-2.5 rounded-xl text-sm font-bold flex items-center justify-center gap-2 transition-all active:scale-95 shadow-sm">
            <i class="fa-solid fa-plus text-xs"></i> Tambah Admin
        </button>
    </div>

    <div class="overflow-x-auto rounded-2xl border border-gray-50">
        <table class="w-full text-sm min-w-[600px]">
            <thead class="bg-[#F8FAFF] text-[#4A72D4]">
                <tr>
                    <th class="p-4 text-left font-bold">Nama</th>
                    <th class="p-4 text-left font-bold">Status</th>
                    <th class="p-4 text-left font-bold">No HP</th>
                    <th class="p-4 text-left font-bold">Bergabung</th>
                    <th class="p-4 text-left font-bold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <template x-if="tab==='admin'">
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-4 font-semibold text-slate-700">Sean</td>
                        <td class="p-4"><span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-[11px] font-bold">Aktif</span></td>
                        <td class="p-4 text-gray-500">+62 812-3455-7890</td>
                        <td class="p-4 text-gray-500">25 Februari 2026</td>
                        <td class="p-4 space-x-2">
                            <button @click="openModal=true; isEdit=true" class="bg-blue-500 text-white px-3 py-1 rounded-md text-xs hover:bg-blue-600 transition-all shadow-sm">Ubah</button>
                            <button class="bg-red-500 text-white px-3 py-1 rounded-md text-xs hover:bg-red-600 transition-all shadow-sm">Hapus</button>
                        </td>
                    </tr>
                </template>
                <template x-if="tab==='peserta'">
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-4 font-semibold text-slate-700">User Peserta</td>
                        <td class="p-4"><span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-[11px] font-bold">Aktif</span></td>
                        <td class="p-4 text-gray-500">+62 851-xxxx-xxxx</td>
                        <td class="p-4 text-gray-500">10 Januari 2026</td>
                        <td class="p-4"><button class="bg-red-500 text-white px-3 py-1 rounded-md text-xs hover:bg-red-600 transition-all shadow-sm">Hapus</button></td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <div x-show="openModal" x-cloak class="fixed inset-0 z-[100] bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div @click.away="openModal=false" class="bg-white w-full max-w-lg rounded-[32px] p-8 shadow-2xl overflow-y-auto max-h-[90vh]">
            
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-extrabold text-slate-800" x-text="isEdit ? 'Ubah Data Admin' : 'Tambah Admin Baru'"></h3>
                <button @click="openModal=false" class="text-gray-300 hover:text-red-500 transition-colors"><i class="fa-solid fa-circle-xmark text-2xl"></i></button>
            </div>

            <form class="space-y-4">
                <div class="flex flex-col items-center justify-center border-2 border-dashed border-slate-100 rounded-3xl py-6 bg-slate-50 hover:bg-blue-50 transition-all cursor-pointer relative group">
                    <input type="file" class="absolute inset-0 opacity-0 cursor-pointer">
                    <div class="bg-white p-3 rounded-full shadow-sm text-[#4A72D4] mb-2 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-camera text-xl"></i>
                    </div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Unggah Foto Profil</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase ml-1">Nama Lengkap</label>
                        <input type="text" class="w-full bg-slate-100 border-none rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none" placeholder="Masukkan nama...">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase ml-1">No WhatsApp</label>
                        <input type="text" class="w-full bg-slate-100 border-none rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none" placeholder="+62 8xxx...">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-slate-400 uppercase ml-1">Alamat Email</label>
                    <input type="email" class="w-full bg-slate-100 border-none rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none" placeholder="admin@persisten.com">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase ml-1">Kata Sandi</label>
                        <input type="password" class="w-full bg-slate-100 border-none rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none" placeholder="••••••••">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase ml-1">Konfirmasi Sandi</label>
                        <input type="password" class="w-full bg-slate-100 border-none rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none" placeholder="••••••••">
                    </div>
                </div>

                <div class="flex gap-3 pt-6">
                    <button type="button" @click="openModal=false" class="flex-1 bg-slate-50 text-slate-400 font-bold py-3.5 rounded-2xl hover:bg-slate-100 transition-all">Batal</button>
                    <button type="submit" class="flex-1 bg-[#4A72D4] text-white font-bold py-3.5 rounded-2xl hover:bg-blue-600 shadow-lg shadow-blue-100 transition-all active:scale-95">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
    </main>

    <div x-show="openModal" x-cloak
         class="fixed inset-0 z-[100] bg-black/40 flex items-center justify-center p-4"
         x-transition>
        <div @click.away="openModal=false"
             class="bg-white w-full max-w-[400px] rounded-2xl shadow-lg p-6 max-h-[90vh] overflow-y-auto">
            <h3 class="text-lg font-semibold text-slate-700 mb-4">Tambah Admin</h3>
            <div class="space-y-4">
                <input type="text" placeholder="Nama" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 outline-none">
                <input type="text" placeholder="No HP" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 outline-none">
                <input type="email" placeholder="Email" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 outline-none">
                <input type="password" placeholder="Buat Sandi" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 outline-none">
                <input type="password" placeholder="Konfirmasi Sandi" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 outline-none">
            </div>
            <div class="flex justify-end mt-6 space-x-2">
                <button @click="openModal=false" class="px-4 py-2 rounded-lg border text-slate-600">Batal</button>
                <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
function userApp() {
    return {
        tab: 'admin',
        openModal: false,
        mobileMenuOpen: false 
    }
}
</script>
</body>
</html>