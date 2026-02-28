<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persisten</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; letter-spacing: -0.01em; }
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; height: 5px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #4A72D4; border-radius: 10px; }
        .main-content { height: 100vh; overflow-y: auto; }
    </style>
</head>
<body class="bg-[#F4F7FF] text-[#2D3B61] overflow-hidden" 
      x-data="{ 
        showModal: false, 
        editMode: false,
        imageUrl: null,
        targetLevel: '',
        mobileMenuOpen: false,
        activeMenu: 'Manajemen streak',
        currentView: 'main', 
        
        openAddModal() {
            this.editMode = false;
            this.imageUrl = null;
            this.targetLevel = '';
            this.showModal = true;
        },

        openEditModal(img, lvl) {
            this.editMode = true;
            this.imageUrl = img;
            this.targetLevel = lvl;
            this.showModal = true;
        },

        fileChosen(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = (e) => { this.imageUrl = e.target.result; };
        },

        confirmSoftDelete() {
            Swal.fire({
                title: 'Pindahkan ke History?',
                text: 'Pet akan dinonaktifkan sementara.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4A72D4',
                confirmButtonText: 'PINDAHKAN',
                customClass: { popup: 'rounded-[30px]', confirmButton: 'rounded-xl px-6 py-3 font-bold text-xs uppercase' }
            });
        },

        confirmPermanentDelete() {
            Swal.fire({
                title: 'Hapus Permanen?',
                text: 'Data visual pet akan hilang selamanya.',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                confirmButtonText: 'HAPUS SELAMANYA',
                customClass: { popup: 'rounded-[30px]', confirmButton: 'rounded-xl px-6 py-3 font-bold text-xs uppercase' }
            });
        }
      }">

    <div class="flex h-screen w-full relative">
        
        <aside x-data="{ currentPage: 'streak' }" :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
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
                
               <a href="{{ route('admin.dashboard.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl  transition-all duration-200 group text-left">
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

        <a href="{{ route('admin.streak.index') }}" x-init="if(currentPage === 'streak') { $el.scrollIntoView({ block: 'center' }) }"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl bg-[#D4DEF7]  text-[#2E3B66] transition-all duration-200 group text-left">
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

         <a href="{{ route('admin.laporan.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
            </svg>
            <span class="text-md font-regular">Monitoring dan laporan</span>
        </a>

            </nav>

             <form action="{{ route('logout') }}" method="POST" class="w-full inline">
    @csrf
    <button type="submit" class="mt-4 w-full flex items-center bg-white/10 hover:bg-white/20 px-6 py-3 rounded-2xl transition-all group border border-white/20 backdrop-blur-sm shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 md:size-6 text-white">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
        </svg>
        <span class="text-white text-md font-medium tracking-wide ml-4">Logout</span>
    </button>
    </form>
        </aside>

        <main class="flex-1 main-content p-4 md:p-10 custom-scrollbar">
            
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
            <div x-show="currentView === 'main'" x-transition>
                <div class="bg-white rounded-[35px] shadow-sm border border-blue-100 overflow-hidden mb-10">
                    <div class="p-8 border-b border-gray-50 flex justify-between items-center">
                        <div class="flex items-center gap-4">
                            <h3 class="font-black text-lg text-[#1E293B]">Pet Aktif</h3>
                            <button @click="currentView = 'history'" class="text-[10px] font-black uppercase tracking-widest text-[#4A72D4] bg-blue-50 px-4 py-2 rounded-full">
                                <i class="fa-solid fa-trash-can mr-1"></i> Lihat History
                            </button>
                        </div>
                        <button @click="openAddModal()" class="bg-[#4A72D4] text-white px-6 py-3 rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg shadow-blue-200">
                            Tambah Pet
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-blue-50/30 text-[#4A72D4] text-[10px] uppercase font-black">
                                <tr>
                                    <th class="px-10 py-6 text-center">Visual Pet</th>
                                    <th class="px-10 py-6 text-center">Level Perubahan</th>
                                    <th class="px-10 py-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr class="group hover:bg-blue-50/20 transition-all">
                                    <td class="px-10 py-8 text-center">
                                        <div class="w-20 h-20 bg-white rounded-3xl p-3 mx-auto border border-blue-50">
                                            <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" class="w-full h-full object-contain pet-img-row">
                                        </div>
                                    </td>
                                    <td class="px-10 py-8 text-center">
                                        <span class="bg-indigo-50 text-[#4A72D4] px-6 py-3 rounded-2xl font-black text-lg lvl-text-row">1</span>
                                    </td>
                                    <td class="px-10 py-8 text-center">
                                        <div class="flex justify-center gap-2">
                                            <button @click="openEditModal('https://cdn-icons-png.flaticon.com/512/616/616408.png', 1)" class="h-11 px-5 bg-blue-50 text-[#4A72D4] rounded-xl font-black text-[10px] uppercase">Edit</button>
                                            <button @click="confirmSoftDelete()" class="h-11 px-5 bg-red-50 text-red-500 rounded-xl font-black text-[10px] uppercase">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="group hover:bg-blue-50/20 transition-all">
                                    <td class="px-10 py-8 text-center">
                                        <div class="w-20 h-20 bg-white rounded-3xl p-3 mx-auto border border-blue-50">
                                            <img src="https://cdn-icons-png.flaticon.com/512/616/616430.png" class="w-full h-full object-contain">
                                        </div>
                                    </td>
                                    <td class="px-10 py-8 text-center">
                                        <span class="bg-indigo-50 text-[#4A72D4] px-6 py-3 rounded-2xl font-black text-lg">10</span>
                                    </td>
                                    <td class="px-10 py-8 text-center">
                                        <div class="flex justify-center gap-2">
                                            <button @click="openEditModal('https://cdn-icons-png.flaticon.com/512/616/616430.png', 10)" class="h-11 px-5 bg-blue-50 text-[#4A72D4] rounded-xl font-black text-[10px] uppercase">Edit</button>
                                            <button @click="confirmSoftDelete()" class="h-11 px-5 bg-red-50 text-red-500 rounded-xl font-black text-[10px] uppercase">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div x-show="currentView === 'history'" x-transition x-cloak>
                <button @click="currentView = 'main'" class="mb-6 flex items-center gap-2 text-[#4A72D4] font-bold text-sm"><i class="fa-solid fa-arrow-left"></i> Kembali</button>
                <div class="bg-white rounded-[35px] shadow-sm border border-red-50 overflow-hidden">
                    <div class="p-8 bg-red-50/20 border-b border-red-100"><h3 class="font-black text-lg text-red-500 uppercase">History Sampah</h3></div>
                    <table class="w-full text-left">
                        <tbody class="divide-y divide-gray-100">
                            <tr>
                                <td class="px-10 py-6 text-center"><img src="https://cdn-icons-png.flaticon.com/512/616/616554.png" class="w-12 h-12 grayscale opacity-50 mx-auto"></td>
                                <td class="px-10 py-6 font-black text-slate-400">Level 50</td>
                                <td class="px-10 py-6 text-right">
                                    <button @click="confirmPermanentDelete()" class="bg-red-500 text-white px-5 py-2.5 rounded-xl font-black text-[10px] uppercase">Hapus Permanen</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <div x-show="showModal" x-cloak class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
        <div @click.away="showModal = false" class="bg-white w-full max-w-md rounded-[40px] overflow-hidden shadow-2xl">
            <div class="bg-[#4A72D4] p-8 text-white">
                <h4 class="text-xl font-black uppercase tracking-tight" x-text="editMode ? 'Edit Data Pet' : 'Tambah Pet Baru'"></h4>
            </div>
            <div class="p-8 space-y-6">
                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Visual Pet</label>
                    <div class="h-44 border-2 border-dashed border-blue-100 rounded-[30px] bg-blue-50/30 flex items-center justify-center cursor-pointer overflow-hidden relative" @click="$refs.fileInput.click()">
                        <input type="file" x-ref="fileInput" class="hidden" @change="fileChosen">
                        <template x-if="!imageUrl">
                            <div class="text-center">
                                <i class="fa-solid fa-cloud-arrow-up text-[#4A72D4] text-3xl mb-2"></i>
                                <p class="text-[9px] font-black uppercase text-gray-400">Pilih Gambar</p>
                            </div>
                        </template>
                        <template x-if="imageUrl">
                            <img :src="imageUrl" class="w-32 h-32 object-contain">
                        </template>
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Berubah Saat Level</label>
                    <div class="relative">
                        <input type="number" x-model="targetLevel" placeholder="Masukkan level..." class="w-full bg-gray-50 border border-gray-100 px-6 py-5 rounded-[25px] font-black text-xl text-[#4A72D4] outline-none">
                        <span class="absolute right-6 top-1/2 -translate-y-1/2 text-[10px] font-black text-gray-300 uppercase italic">Hari</span>
                    </div>
                </div>

                <div class="flex gap-4 pt-4">
                    <button @click="showModal = false" class="flex-1 py-4 font-black text-xs uppercase text-gray-400">Batal</button>
                    <button @click="showModal = false" class="flex-[2] bg-[#4A72D4] text-white py-4 rounded-2xl font-black text-xs uppercase tracking-widest">
                        <span x-text="editMode ? 'Simpan Perubahan' : 'Tambah Pet'"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>