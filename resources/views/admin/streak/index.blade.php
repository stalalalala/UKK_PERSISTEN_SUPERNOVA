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
                
                <a href="#" @click="activeMenu = 'Dashboard'; currentView = 'main'"
                    :class="activeMenu === 'Dashboard' ? 'bg-[#D4DEF7] text-[#2E3B66]' : 'hover:bg-white/10 text-white'"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <div class="w-5 h-5 border-2 border-current rounded group-hover:border-white transition-colors shrink-0"></div>
                    <span class="text-md font-regular">Dashboard</span>
                </a>

                <a href="#" @click="activeMenu = 'Manajemen user'; currentView = 'main'"
                    :class="activeMenu === 'Manajemen user' ? 'bg-[#D4DEF7] text-[#2E3B66]' : 'hover:bg-white/10 text-white'"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen user</span>
                </a>

                <a href="#" @click="activeMenu = 'Manajemen streak'; currentView = 'main'"
                    :class="activeMenu === 'Manajemen streak' ? 'bg-[#D4DEF7] text-[#2E3B66]' : 'hover:bg-white/10 text-white'"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen streak</span>
                </a>

                <a href="#" @click="activeMenu = 'Manajemen tryout'; currentView = 'main'"
                    :class="activeMenu === 'Manajemen tryout' ? 'bg-[#D4DEF7] text-[#2E3B66]' : 'hover:bg-white/10 text-white'"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen tryout</span>
                </a>

                <a href="#" @click="activeMenu = 'Manajemen kuis'; currentView = 'main'"
                    :class="activeMenu === 'Manajemen kuis' ? 'bg-[#D4DEF7] text-[#2E3B66]' : 'hover:bg-white/10 text-white'"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen kuis</span>
                </a>

                <a href="#" @click="activeMenu = 'Manajemen latihan soal'; currentView = 'main'"
                    :class="activeMenu === 'Manajemen latihan soal' ? 'bg-[#D4DEF7] text-[#2E3B66]' : 'hover:bg-white/10 text-white'"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen latihan soal</span>
                </a>

                <a href="#" @click="activeMenu = 'Manajemen video pembelajaran'; currentView = 'main'"
                    :class="activeMenu === 'Manajemen video pembelajaran' ? 'bg-[#D4DEF7] text-[#2E3B66]' : 'hover:bg-white/10 text-white'"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen video pembelajaran</span>
                </a>

                <a href="#" @click="activeMenu = 'Manajemen minat bakat'; currentView = 'main'"
                    :class="activeMenu === 'Manajemen minat bakat' ? 'bg-[#D4DEF7] text-[#2E3B66]' : 'hover:bg-white/10 text-white'"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen minat bakat</span>
                </a>

                <a href="#" @click="activeMenu = 'Manajemen perangkingan'; currentView = 'main'"
                    :class="activeMenu === 'Manajemen perangkingan' ? 'bg-[#D4DEF7] text-[#2E3B66]' : 'hover:bg-white/10 text-white'"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen perangkingan</span>
                </a>

                <a href="#" @click="activeMenu = 'Manajemen peluang PTN'; currentView = 'main'"
                    :class="activeMenu === 'Manajemen peluang PTN' ? 'bg-[#D4DEF7] text-[#2E3B66]' : 'hover:bg-white/10 text-white'"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen peluang PTN</span>
                </a>

                <a href="#" @click="activeMenu = 'Monitoring dan laporan'; currentView = 'main'"
                    :class="activeMenu === 'Monitoring dan laporan' ? 'bg-[#D4DEF7] text-[#2E3B66]' : 'hover:bg-white/10 text-white'"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Monitoring dan laporan</span>
                </a>

                <a href="#" @click="activeMenu = 'Manajemen sistem dan konten'; currentView = 'main'"
                    :class="activeMenu === 'Manajemen sistem dan konten' ? 'bg-[#D4DEF7] text-[#2E3B66]' : 'hover:bg-white/10 text-white'"
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