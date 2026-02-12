<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false, selectedJawaban: '' }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Soal - Persisten</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="//unpkg.com/alpinejs" defer></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#E8EBF7] flex h-screen overflow-hidden font-poppins text-gray-700">

    <div x-show="sidebarOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         @click="sidebarOpen = false" 
         class="fixed inset-0 bg-black/50 z-40 lg:hidden" x-cloak></div>

   <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
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
        <button @click="sidebarOpen = false" class="lg:hidden p-2 hover:bg-white/10 rounded-full">
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
            <span class="text-md font-regular">Manajemen minat bakat</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen perangkingan</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen peluang PTN</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Monitoring dan laporan</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen sistem dan konten</span>
        </a>

        </nav>

    <button class="mt-4 w-full flex items-center bg-white/10 hover:bg-white/20 px-6 py-3 rounded-2xl transition-all group border border-white/20 backdrop-blur-sm shrink-0">
        <svg xmlns="http://www.w3.org/2000/xml" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 md:size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
        </svg>
        <span class="text-white text-md font-medium tracking-wide ml-4">Logout</span>
    </button>
</aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden min-w-0">
        
       <header class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4 px-4 pt-4 lg:px-8">
            <div class="flex items-center w-full gap-4">
                <button @click="sidebarOpen = true" class="lg:hidden p-3 bg-white rounded-xl shadow-sm">
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

        <section class="flex-1 p-4 lg:p-8 overflow-y-auto">
            <div class="w-full xl:px-4"> 
                <h2 class="text-2xl lg:text-3xl font-extrabold text-gray-800 mb-8">Tambah Soal Baru</h2>

                <form action="#" method="POST" class="space-y-6">
                    
                    <div class="bg-white p-6 lg:p-8 rounded-[1.5rem] lg:rounded-[2rem] shadow-sm border border-blue-50 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest ml-1">Waktu Pengerjaan</label>
                            <div class="flex items-center bg-[#F3F6FF] rounded-xl px-4 py-3 border border-gray-100 shadow-inner focus-within:ring-2 focus-within:ring-[#4A7DD9]/20 transition-all">
                                <i class="fa-solid fa-clock text-[#4A7DD9] mr-3"></i>
                                <input type="number" name="waktu_menit" value="60" class="bg-transparent w-full outline-none font-bold text-[#4A7DD9]">
                                <span class="text-[10px] font-bold text-gray-400">MENIT</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest ml-1">Kategori Subtes</label>
                            <div class="relative">
                                <select name="subtes" class="w-full bg-[#F3F6FF] rounded-xl px-4 py-3 border border-gray-100 outline-none font-semibold text-gray-700 appearance-none focus:ring-2 focus:ring-[#4A7DD9]/20 transition-all">
                                    <option value="Penalaran Umum">Penalaran Umum</option>
                                    <option value="Pengetahuan Alam">Pengetahuan Alam</option>
                                    <option value="Matematika">Matematika</option>
                                    <option value="Bahasa Inggris">Bahasa Inggris</option>
                                </select>
                                <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 lg:p-8 rounded-[1.5rem] lg:rounded-[2rem] shadow-sm border border-blue-50 space-y-8">
                        
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-3 tracking-widest ml-1">Isi Pertanyaan</label>
                            <textarea name="pertanyaan" rows="4" placeholder="Ketikkan teks soal di sini..." 
                                class="w-full bg-[#F3F6FF] rounded-2xl px-5 py-4 border border-gray-100 outline-none font-medium text-gray-700 focus:bg-white focus:ring-2 focus:ring-[#4A7DD9]/30 transition-all"></textarea>
                        </div>

                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
                            <template x-for="char in ['A', 'B', 'C', 'D', 'E']" :key="char">
                                <div class="flex items-center gap-3 group">
                                    <div class="w-10 h-10 flex-shrink-0 bg-white border-2 border-[#4A7DD9] text-[#4A7DD9] flex items-center justify-center rounded-xl font-black text-sm shadow-sm group-focus-within:bg-[#4A7DD9] group-focus-within:text-white transition-colors" x-text="char"></div>
                                    <input type="text" :name="'opsi_'+char.toLowerCase()" :placeholder="'Jawaban ' + char" 
                                        class="flex-1 bg-[#F3F6FF] rounded-xl px-4 py-3 border border-gray-100 outline-none focus:bg-white focus:ring-2 focus:ring-[#4A7DD9]/20 transition-all font-medium text-sm">
                                </div>
                            </template>
                        </div>

                        <div class="pt-8 border-t border-gray-100">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-5 tracking-widest text-center md:text-left ml-1">Pilih Kunci Jawaban Benar</label>
                            <div class="flex flex-wrap justify-center md:justify-start gap-4 lg:gap-6">
                                
                                <template x-for="item in ['A', 'B', 'C', 'D', 'E']" :key="item">
                                    <label class="relative group cursor-pointer">
                                        <input type="radio" name="jawaban_benar" :value="item" x-model="selectedJawaban" class="hidden peer">
                                        
                                        <div class="w-12 h-12 lg:w-16 lg:h-16 flex items-center justify-center rounded-2xl bg-[#F3F6FF] text-gray-400 font-bold text-lg 
                                                    border-2 border-transparent transition-all duration-200 
                                                    peer-checked:bg-[#4CAF50] peer-checked:text-white peer-checked:shadow-xl peer-checked:shadow-green-200 peer-checked:scale-110 
                                                    hover:bg-gray-200 group-active:scale-95" 
                                             x-text="item">
                                        </div>
                                        
                                        <div class="absolute -top-1 -right-1 bg-white text-[#4CAF50] rounded-full w-5 h-5 flex items-center justify-center shadow-md scale-0 peer-checked:scale-100 transition-transform duration-300">
                                            <i class="fa-solid fa-circle-check text-xs"></i>
                                        </div>
                                    </label>
                                </template>

                            </div>
                            <p class="mt-4 text-sm text-gray-400 italic text-center md:text-left ml-1" x-show="!selectedJawaban">Silakan pilih salah satu opsi di atas.</p>
                            <p class="mt-4 text-sm text-[#4CAF50] font-bold text-center md:text-left ml-1 uppercase tracking-widest" x-show="selectedJawaban" x-cloak>
                                Jawaban Terpilih: <span x-text="selectedJawaban"></span>
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 pb-10">
                        <button type="reset" @click="selectedJawaban = ''" class="w-full sm:w-auto bg-slate-50 text-slate-400 font-bold py-3 px-6 rounded-xl hover:bg-slate-100 transition-all">
                            Batal
                        </button>
                        <button type="submit" class="w-full sm:w-auto bg-[#4A72D4] text-white font-bold py-3 px-10 rounded-xl hover:bg-blue-600 shadow-lg shadow-blue-100 transition-all active:scale-95">
                            Simpan
                        </button>
                    </div>

                </form>
            </div>
        </section>
    </main>

</body>
</html>