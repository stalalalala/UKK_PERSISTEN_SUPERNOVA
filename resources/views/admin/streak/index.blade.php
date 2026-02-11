<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pet Streak - Persisten</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; letter-spacing: -0.01em; }
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; height: 5px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #4A72D4; border-radius: 10px; }
        .glass-effect { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); }
        
        /* Memastikan area konten utama bisa di-scroll dengan mulus */
        .main-content {
            height: 100vh;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }
    </style>
</head>
<body class="bg-[#F4F7FF] text-[#2D3B61] overflow-hidden" 
      x-data="{ 
        showModal: false, 
        editMode: false,
        imageUrl: null,
        mobileMenuOpen: false,
        activeMenu: 'Manajemen streak',
        selectedPet: { lv1: 5, lv2: 15 },
        
        fileChosen(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = (e) => { this.imageUrl = e.target.result; };
        }
      }">

    <div class="flex h-screen w-full relative">
        
        <aside :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
               class="fixed inset-y-0 left-0 z-50 w-72 bg-[#4A72D4] text-white flex flex-col p-6 shadow-xl transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 shrink-0">

            <div class="flex items-center justify-between mb-10 px-2 shrink-0">
                <div class="flex items-center gap-3">
                    <div class="bg-white p-2 rounded-xl">
                        <svg class="w-6 h-6 text-[#4A72D4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h1 class="text-xl font-black tracking-tighter uppercase">PERSISTEN</h1>
                </div>
                <button @click="mobileMenuOpen = false" class="lg:hidden p-2 hover:bg-white/10 rounded-full">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <nav class="flex-1 space-y-1 overflow-y-auto custom-scrollbar pr-2">
                <template x-for="item in ['Dashboard', 'Manajemen user', 'Manajemen streak', 'Manajemen tryout', 'Manajemen kuis', 'Manajemen latihan soal', 'Manajemen video pembelajaran']">
                    <button @click="activeMenu = item; if(window.innerWidth < 1024) mobileMenuOpen = false"
                        :class="activeMenu === item ? 'bg-white/20 shadow-inner' : 'hover:bg-white/10'"
                        class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left mb-1">
                        <div class="w-2 h-2 rounded-full transition-all" :class="activeMenu === item ? 'bg-white scale-125' : 'bg-white/30'"></div>
                        <span class="text-sm font-medium" x-text="item"></span>
                    </button>
                </template>
            </nav>

            <button class="mt-4 flex items-center justify-between bg-white/10 hover:bg-red-500/20 px-6 py-4 rounded-2xl transition-all group shrink-0">
                <span class="font-semibold text-sm">Logout</span>
                <i class="fa-solid fa-right-from-bracket group-hover:translate-x-1 transition-transform"></i>
            </button>
        </aside>

        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition opacity-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition opacity-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="mobileMenuOpen = false" 
             class="fixed inset-0 bg-black/50 z-40 lg:hidden"></div>

        <main class="flex-1 main-content p-4 md:p-10 custom-scrollbar">
            
            <header class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8 gap-6">
                <div class="flex items-center gap-4">
                    <button @click="mobileMenuOpen = true" class="lg:hidden bg-white p-3 rounded-xl shadow-sm text-[#4A72D4] active:scale-90 transition-transform">
                        <i class="fa-solid fa-bars-staggered text-xl"></i>
                    </button>
                    <div>
                        <h2 class="text-2xl md:text-3xl font-black text-[#1E293B] tracking-tight leading-tight">Manajemen Pet Streak</h2>
                        <p class="text-gray-400 text-xs md:text-sm mt-1 font-medium">Kelola evolusi dan syarat level pet.</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <div class="hidden sm:flex bg-white p-2.5 px-6 rounded-2xl shadow-sm border border-blue-100 items-center gap-4">
                        <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-[#4A72D4]">
                            <i class="fa-solid fa-paw text-lg"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest leading-none">Total Pet</p>
                            <p class="text-xl font-black text-[#1E293B]">12</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 bg-white p-1.5 pr-5 pl-1.5 rounded-2xl shadow-sm border border-blue-100 ml-auto">
                        <img src="/img/sean.jpg" class="w-10 h-10 bg-cover rounded-xl flex items-center justify-center text-white font-bold shadow-md"></img>
                        <div class="leading-none">
                            <p class="font-bold text-sm">Sean</p>
                            <p class="text-[10px] text-green-500 font-medium italic">Online</p>
                        </div>
                    </div>
                </div>
            </header>

            <div class="bg-white rounded-[30px] md:rounded-[40px] shadow-sm border border-blue-100 overflow-hidden mb-10">
                <div class="p-6 md:p-10 border-b border-gray-50 flex flex-col sm:flex-row justify-between items-center bg-white gap-4">
                    <div class="flex items-center gap-3 self-start">
                        <div class="w-2 h-8 bg-[#4A72D4] rounded-full"></div>
                        <h3 class="font-black text-lg text-[#1E293B]">Daftar Pet</h3>
                    </div>
                    
                    <button @click="showModal = true; editMode = false; imageUrl = null; selectedPet = {lv1:5, lv2:15}" 
                            class="w-full sm:w-auto bg-[#4A72D4] hover:bg-blue-600 text-white px-8 py-4 rounded-2xl font-black text-xs flex items-center justify-center gap-3 shadow-xl shadow-blue-200 transition-all hover:-translate-y-1 active:scale-95 uppercase tracking-widest">
                        <i class="fa-solid fa-plus text-sm"></i> Tambah Pet
                    </button>
                </div>

                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse min-w-[750px]">
                        <thead>
                            <tr class="bg-blue-50/30 text-[#4A72D4] text-[11px] uppercase font-black tracking-[0.15em]">
                                <th class="px-10 py-6 text-center">Visual Pet</th>
                                <th class="px-10 py-6 text-center">Level Evolusi</th>
                                <th class="px-10 py-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="group hover:bg-blue-50/40 transition-all duration-300">
                                <td class="px-10 py-8 text-center">
                                    <div class="w-20 h-20 md:w-24 md:h-24 bg-white rounded-[25px] md:rounded-[30px] border border-blue-50 p-3 mx-auto transition-all group-hover:scale-110 group-hover:rotate-3 shadow-sm group-hover:shadow-xl group-hover:shadow-blue-200/50">
                                        <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" class="w-full h-full object-contain">
                                    </div>
                                </td>
                                <td class="px-10 py-8 text-center">
                                    <div class="inline-flex items-center gap-4 md:gap-8 bg-white shadow-sm px-6 md:px-8 py-4 rounded-[24px] border border-blue-50 font-black group-hover:border-blue-200 transition-all">
                                        <div class="text-center">
                                            <p class="text-[9px] text-gray-400 uppercase tracking-widest mb-1">Evo 1</p>
                                            <p class="text-lg md:text-xl text-[#4A72D4]">Lv. 5</p>
                                        </div>
                                        <div class="h-10 w-[1px] bg-gray-100"></div>
                                        <div class="text-center">
                                            <p class="text-[9px] text-gray-400 uppercase tracking-widest mb-1">Evo 2</p>
                                            <p class="text-lg md:text-xl text-indigo-500">Lv. 15</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-8 text-center">
                                    <div class="flex items-center justify-center gap-3">
                                        <button @click="showModal = true; editMode = true; imageUrl = 'https://cdn-icons-png.flaticon.com/512/616/616408.png'; selectedPet = {lv1:5, lv2:15}" 
                                                class="h-11 px-5 bg-blue-50 text-[#4A72D4] rounded-xl hover:bg-[#4A72D4] hover:text-white transition-all font-black text-[10px] uppercase tracking-widest flex items-center gap-2">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </button>
                                        <button class="h-11 px-5 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all font-black text-[10px] uppercase tracking-widest flex items-center gap-2">
                                            <i class="fa-solid fa-trash-can"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="group hover:bg-blue-50/40 transition-all duration-300">
                                <td class="px-10 py-8 text-center">
                                    <div class="w-20 h-20 md:w-24 md:h-24 bg-white rounded-[25px] md:rounded-[30px] border border-blue-50 p-3 mx-auto transition-all group-hover:scale-110 group-hover:rotate-3 shadow-sm group-hover:shadow-xl group-hover:shadow-blue-200/50">
                                        <img src="https://cdn-icons-png.flaticon.com/512/616/616430.png" class="w-full h-full object-contain">
                                    </div>
                                </td>
                                <td class="px-10 py-8 text-center">
                                    <div class="inline-flex items-center gap-4 md:gap-8 bg-white shadow-sm px-6 md:px-8 py-4 rounded-[24px] border border-blue-50 font-black group-hover:border-blue-200 transition-all">
                                        <div class="text-center">
                                            <p class="text-[9px] text-gray-400 uppercase tracking-widest mb-1">Evo 1</p>
                                            <p class="text-lg md:text-xl text-[#4A72D4]">Lv. 10</p>
                                        </div>
                                        <div class="h-10 w-[1px] bg-gray-100"></div>
                                        <div class="text-center">
                                            <p class="text-[9px] text-gray-400 uppercase tracking-widest mb-1">Evo 2</p>
                                            <p class="text-lg md:text-xl text-indigo-500">Lv. 30</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-8 text-center">
                                    <div class="flex items-center justify-center gap-3">
                                        <button class="h-11 px-5 bg-blue-50 text-[#4A72D4] rounded-xl hover:bg-[#4A72D4] hover:text-white transition-all font-black text-[10px] uppercase tracking-widest flex items-center gap-2">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </button>
                                        <button class="h-11 px-5 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all font-black text-[10px] uppercase tracking-widest flex items-center gap-2">
                                            <i class="fa-solid fa-trash-can"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <div x-show="showModal" x-cloak 
         class="fixed inset-0 z-[60]