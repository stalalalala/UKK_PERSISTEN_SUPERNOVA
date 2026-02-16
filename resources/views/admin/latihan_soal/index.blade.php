<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false, openDeleteModal: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persisten - Manajemen Latihan Soal</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="//unpkg.com/alpinejs" defer></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#E8EBF7] flex h-screen overflow-hidden font-po">

    <div x-show="sidebarOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false" 
         class="fixed inset-0 bg-black/50 z-40 lg:hidden" style="display: none;"></div>

    <aside x-data="{ currentPage: 'latihan' }" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
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

         <a href="{{ route('admin.latihan.index') }}" x-init="if(currentPage === 'latihan') { $el.scrollIntoView({ block: 'center' }) }"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl bg-[#D4DEF7]  text-[#2E3B66] transition-all duration-200 group text-left">
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

    <main class="flex-1 flex flex-col h-screen overflow-hidden min-w-0">
        
        <header class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4 px-4 lg:px-8 pt-4">
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

        <section class="flex-1 p-4 lg:p-6 xl:p-8 overflow-y-auto">
            <div class="mb-6">
                <h2 class="text-xl lg:text-2xl font-bold text-gray-800">Daftar Latihan Soal</h2>
            </div>

            <div class="bg-white rounded-[1.5rem] lg:rounded-[2rem] shadow-sm p-4 lg:p-6 border border-blue-50">
                
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
                    <div class="flex flex-col">
                        <label class="text-[10px] font-bold text-gray-400 uppercase ml-1 mb-1 tracking-widest">Waktu Latihan</label>
                        <div class="flex items-center bg-[#F3F6FF] rounded-xl px-4 py-2 border border-gray-100 shadow-inner w-fit">
                            <i class="fa-solid fa-clock text-[#4A7DD9] mr-2"></i>
                            <input type="number" value="60" class="bg-transparent w-10 outline-none font-bold text-[#4A7DD9] text-lg">
                            <span class="text-[10px] font-bold text-gray-400 ml-1">MIN</span>
                        </div>
                    </div>

                   <div class="flex items-center gap-2 sm:gap-3">
                        <a href="" class="flex-1 sm:flex-none flex items-center justify-center gap-2 bg-[#4A85D9] text-white px-4 xl:px-6 py-3 rounded-xl font-bold text-xs xl:text-sm shadow-lg shadow-blue-100 hover:bg-blue-600 transition active:scale-95 h-[48px] min-w-[120px]">
                            <i class="fa-solid fa-plus text-[10px]"></i> 
                            <span>Tambah Soal</span>
                        </a>

                        <a href="" class="flex-1 sm:flex-none flex items-center justify-center gap-2 border-2 border-[#4A85D9] bg-white text-[#4A7DD9] px-4 xl:px-6 py-3 rounded-xl font-bold text-xs xl:text-sm hover:bg-blue-50 transition active:scale-95 h-[48px] min-w-[100px]">
                            <i class="fa-solid fa-history text-[10px]"></i> 
                            <span>History</span>
                        </a>
                    </div>
                </div>

               <div class="w-full overflow-x-auto scrollbar-thin scrollbar-thumb-[#4A7DD9] pb-4">
    <table class="w-full min-w-[1000px] xl:min-w-[1400px] border-separate border-spacing-y-3">
        <thead>
            <tr class="bg-[#D6E6FF] text-[#4A7DD9] text-left">
                <th class="p-4 rounded-l-xl uppercase text-[10px] font-bold tracking-widest">Pertanyaan</th>
                <th class="p-4 uppercase text-[10px] font-bold tracking-widest text-center">Opsi A</th>
                <th class="p-4 uppercase text-[10px] font-bold tracking-widest text-center">Opsi B</th>
                <th class="p-4 uppercase text-[10px] font-bold tracking-widest text-center">Opsi C</th>
                <th class="p-4 uppercase text-[10px] font-bold tracking-widest text-center">Opsi D</th>
                <th class="p-4 uppercase text-[10px] font-bold tracking-widest text-center">Opsi E</th>
                <th class="p-4 uppercase text-[10px] font-bold tracking-widest text-center">Jawaban</th>
                <th class="p-4 uppercase text-[10px] font-bold tracking-widest">Subtes</th>
                <th class="p-4 uppercase text-[10px] font-bold tracking-widest">Pembahasan</th>
                <th class="p-4 rounded-r-xl uppercase text-[10px] font-bold tracking-widest text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-xs text-gray-600">
            <tr class="bg-white hover:bg-blue-50 transition-all shadow-sm group">
                <td class="p-4 font-medium text-gray-800 rounded-l-xl border-y border-l border-gray-100 max-w-[200px] truncate">Contoh pertanyaan pengerjaan mesin uap?</td>
                <td class="p-4 text-center border-y border-gray-100">James Watt</td>
                <td class="p-4 text-center border-y border-gray-100">Edison</td>
                <td class="p-4 text-center border-y border-gray-100">Bell</td>
                <td class="p-4 text-center border-y border-gray-100">Newton</td>
                <td class="p-4 text-center border-y border-gray-100">Einstein</td>
                <td class="p-4 text-center border-y border-gray-100">
                    <span class="bg-[#4CAF50] text-white px-3 py-1 rounded-md font-bold">A</span>
                </td>
                <td class="p-4 font-semibold border-y border-gray-100 text-[#4A7DD9]">SAINTEK</td>
                <td class="p-4 border-y border-gray-100 max-w-[250px] italic text-gray-500">
                    James Watt adalah penemu yang menyempurnakan mesin uap sehingga menjadi penggerak Revolusi Industri.
                </td>
                <td class="p-4 rounded-r-xl border-y border-r border-gray-100">
                    <div class="flex justify-center gap-2">
                        <button class="bg-blue-500 text-white px-3 py-1.5 rounded-lg text-[10px] xl:text-xs hover:bg-blue-600 transition-all shadow-sm">Ubah</button>
                        <button class="bg-red-500 text-white px-3 py-1.5 rounded-lg text-[10px] xl:text-xs hover:bg-red-600 transition-all shadow-sm">Hapus</button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
            </div>
        </section>
    </main>

    <template x-teleport="body">
        <div x-show="openDeleteModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
             style="display: none;">
            
            <div @click.away="openDeleteModal = false" 
                 class="bg-white w-full max-w-[90%] sm:max-w-sm rounded-[2rem] lg:rounded-[2.5rem] p-6 lg:p-8 shadow-2xl overflow-hidden relative">
                
                <div class="absolute top-0 right-0 p-4 opacity-5">
                    <i class="fa-solid fa-trash-can text-6xl lg:text-8xl text-red-600"></i>
                </div>

                <div class="text-center relative">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 lg:h-20 lg:w-20 rounded-3xl bg-red-50 mb-6 transform rotate-12">
                        <i class="fa-solid fa-triangle-exclamation text-2xl lg:text-3xl text-red-500 transform -rotate-12"></i>
                    </div>
                    
                    <h3 class="text-lg lg:text-xl font-extrabold text-gray-800 mb-2">Hapus Soal?</h3>
                    <p class="text-xs lg:text-sm text-gray-500 mb-8 leading-relaxed">
                        Data soal ini akan dihapus dari sistem <span class="text-[#4A7DD9] font-bold">PERSISTEN</span>. Apakah Anda yakin?
                    </p>
                </div>

                <div class="flex flex-col gap-3">
                    <button @click="/* Jalankan fungsi hapus */; openDeleteModal = false" 
                            class="w-full py-3 lg:py-4 bg-red-500 text-white font-bold rounded-2xl hover:bg-red-600 shadow-lg shadow-red-200 transition-all active:scale-95 text-sm">
                        Ya, Hapus Data
                    </button>
                    <button @click="openDeleteModal = false" 
                            class="w-full py-3 lg:py-4 bg-gray-50 text-gray-400 font-bold rounded-2xl hover:bg-gray-100 transition-all text-sm">
                        Kembali
                    </button>
                </div>
            </div>
        </div>
    </template>

</body>
</html>