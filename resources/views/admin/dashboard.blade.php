<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persisten Dashboard - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    @vite('resources/css/app.css')
</head>

<body class="bg-[#E9EFFF] h-screen font-po overflow-hidden text-[#2D3B61]" x-data="{ activeMenu: 'Dashboard', mobileMenuOpen: false }">

    <div class="flex h-full w-full">
        <aside x-data="{ currentPage: 'dashboard' }" :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
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
        
        <a href="#" x-init="if(currentPage === 'dashboard') { $el.scrollIntoView({ block: 'center' }) }"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl bg-[#D4DEF7]  text-[#2E3B66] transition-all duration-200 group text-left">
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

        
        </nav>

    <button class="mt-4 w-full flex items-center bg-white/10 hover:bg-white/20 px-6 py-3 rounded-2xl transition-all group border border-white/20 backdrop-blur-sm shrink-0">
        <svg xmlns="http://www.w3.org/2000/xml" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 md:size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
        </svg>
        <span class="text-white text-md font-medium tracking-wide ml-4">Logout</span>
    </button>
</aside>

        <main class="flex-1 flex flex-col min-w-0 h-full overflow-y-auto custom-scrollbar p-4 lg:p-8">

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

            <div class="grid grid-cols-12 gap-6 pb-8">
                <div
                    class="col-span-12 bg-white rounded-[20px] p-6 lg:p-8 lg:pb-12 shadow-sm border border-blue-50 relative overflow-hidden">
                    <div class="flex flex-col sm:flex-row justify-between items-start gap-4 mb-6">
                        <h2 class="text-xl font-bold text-[#4A72D4]">Perbandingan Pendaftar akun <span
                                class="text-[#3B455E] font-medium text-lg">dalam sebulan</span></h2>
                        <div class="flex bg-blue-50 p-1 rounded-full overflow-hidden">
                            <h1
                                class="px-5 py-1.5 bg-[#87A7F3] text-white rounded-full text-xs font-bold shadow-sm">Line</h1>
                           
                        </div>
                    </div>

                    <div class="w-full h-48 lg:h-64 mt-4 relative px-2">
                        <svg viewBox="0 0 800 200" class="w-full h-full" preserveAspectRatio="none">
                            <g stroke="#F1F5F9" stroke-width="1">
                                <line x1="0" y1="180" x2="800" y2="180" />
                                <line x1="0" y1="145" x2="800" y2="145" />
                                <line x1="0" y1="110" x2="800" y2="110" />
                                <line x1="0" y1="75" x2="800" y2="75" />
                                <line x1="0" y1="40" x2="800" y2="40" />
                                <line x1="0" y1="5" x2="800" y2="5" />
                            </g>

                            <defs>
                                <linearGradient id="chartGrad" x1="0" y1="0" x2="0"
                                    y2="1">
                                    <stop offset="0%" stop-color="#4A72D4" stop-opacity="0.4" />
                                    <stop offset="100%" stop-color="#4A72D4" stop-opacity="0" />
                                </linearGradient>
                            </defs>

                            <path
                                d="M0 160 L 100 150 Q 200 145, 300 120 T 500 135 T 700 80 L 800 70 L 800 200 L 0 200 Z"
                                fill="url(#chartGrad)" />

                            <path d="M0 160 L 100 150 Q 200 145, 300 120 T 500 135 T 700 80 L 800 70" stroke="#4A72D4"
                                stroke-width="4" fill="none" stroke-linecap="round" />

                            <circle cx="100" cy="150" r="6" fill="white" stroke="#4A72D4"
                                stroke-width="3" />
                            <circle cx="300" cy="120" r="6" fill="white" stroke="#4A72D4"
                                stroke-width="3" />
                            <circle cx="500" cy="135" r="6" fill="white" stroke="#4A72D4"
                                stroke-width="3" />
                            <circle cx="700" cy="80" r="6" fill="white" stroke="#4A72D4"
                                stroke-width="3" />
                        </svg>

                        <div
                            class="absolute inset-y-0 -left-6 flex flex-col justify-between text-[10px] text-gray-400 font-bold py-1">
                            <span>300</span><span>250</span><span>200</span><span>150</span><span>100</span><span>50</span>
                        </div>

                        <div
                            class="flex justify-around text-[10px] font-bold text-gray-400 mt-4 uppercase tracking-widest px-[6.25%]">
                            <span class="w-0 flex justify-center overflow-visible">Januari</span>
                            <span class="w-0 flex justify-center overflow-visible">Februari</span>
                            <span class="w-0 flex justify-center overflow-visible">Maret</span>
                            <span class="w-0 flex justify-center overflow-visible">April</span>
                        </div>
                    </div>

                    <div
                        class="mt-16 flex items-center justify-between bg-blue-50/50 p-3 rounded-2xl border border-blue-100">
                        <div class="flex items-center gap-3 pl-2">
                            <div class="w-5 h-5 bg-[#A6C1FF] rounded-full"></div>
                            <span class="text-[11px] font-medium text-gray-500">Pendaftar akun baru</span>
                        </div>
                        <div class="flex items-center gap-4 pr-2">
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 bg-[#A6C1FF] rounded-full opacity-60"></div>
                                <span class="text-sm font-bold text-[#4A72D4]">230</span>
                            </div>
                            <span class="text-[10px] font-medium text-gray-400 uppercase tracking-tighter">• Minggu
                                ke-1</span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 lg:col-span-7 space-y-6">

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div
                            class="bg-white rounded-[20px] p-6 shadow-sm flex items-center gap-6 border border-blue-50">
                            <div class="w-14 h-14 bg-[#A6C1FF] rounded-full shrink-0"></div>
                            <div>
                                <p class="text-[#4A72D4] text-xl font-bold">Total User</p>
                                <h3 class="text-2xl font-bold text-gray-700">2.124</h3>
                            </div>
                        </div>

                        <div class="bg-white rounded-[20px] p-6 shadow-sm border border-blue-50">
                            <div class="flex items-center gap-6 mb-4">
                                <div class="w-14 h-14 bg-[#5BB58D] rounded-full shrink-0"></div>
                                <div>
                                    <p class="text-[#5BB58D] text-xl font-bold">Total Try Out Aktif</p>
                                    <h3 class="text-2xl font-bold text-gray-700">12</h3>
                                </div>
                            </div>
                            <div class="w-full bg-blue-50 h-3 rounded-full overflow-hidden">
                                <div class="bg-[#4A72D4] h-full w-1/2 rounded-full"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-[20px] p-8 shadow-sm border border-blue-50">
                        <h2 class="text-xl font-bold mb-8 text-[#4A72D4]">Total Pendaftar <span
                                class="text-gray-400 font-normal">dalam sebulan</span></h2>

                        <div class="bg-gray-50 rounded-2xl p-6 text-center mb-8">
                            <span class="text-4xl font-black text-[#4A72D4] mr-3">777</span>
                            <span class="text-gray-400 font-bold uppercase text-xs tracking-widest">pendaftar
                                baru</span>
                        </div>

                        <div class="space-y-5">
                            <div class="flex items-center justify-between border-b border-gray-150 pb-3">
                                <div class="flex items-center gap-4">
                                    <div class="w-6 h-6 bg-[#A6C1FF] rounded-full"></div>
                                    <span class="font-bold text-gray-500">April</span>
                                </div>
                                <span class="font-black text-gray-700">234</span>
                            </div>
                            <div class="flex items-center justify-between border-b border-gray-150 pb-3">
                                <div class="flex items-center gap-4">
                                    <div class="w-6 h-6 bg-[#A6C1FF] rounded-full"></div>
                                    <span class="font-bold text-gray-500">Mei</span>
                                </div>
                                <span class="font-black text-gray-700">567</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-6 h-6 bg-[#A6C1FF] rounded-full"></div>
                                    <span class="font-bold text-gray-500">Juni</span>
                                </div>
                                <span class="font-black text-gray-700">892</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="col-span-12 lg:col-span-5 bg-white rounded-[20px] p-6 shadow-sm border border-blue-50 flex flex-col">
                    <h2 class="text-xl font-bold mb-4 text-[#4A72D4]">Aktivitas Admin Terbaru</h2>

                    <div class="space-y-2 relative flex-1">
                        <div class="absolute left-6 top-2 bottom-10 w-0.5 bg-blue-50"></div>

                        <div class="relative flex items-start gap-4 mb-8 group">
                            <div
                                class="w-12 h-12 bg-blue-100 text-[#4A72D4] rounded-full shrink-0 flex items-center justify-center relative z-10 shadow-sm group-hover:bg-[#4A72D4] group-hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <div class="pt-1">
                                <p class="text-sm font-bold text-gray-600 leading-tight">Admin menambahkan <span
                                        class="text-[#4A72D4]">20 user</span></p>
                                <span class="text-[11px] font-medium text-gray-400">2 mins ago</span>
                            </div>
                        </div>

                        <div class="relative flex items-start gap-4 group">
                            <div
                                class="w-12 h-12 bg-indigo-100 text-indigo-500 rounded-full shrink-0 flex items-center justify-center relative z-10 shadow-sm group-hover:bg-indigo-500 group-hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="pt-1">
                                <p class="text-sm font-bold text-gray-600 leading-tight">Admin mengupdate jadwal
                                    <span class="text-indigo-600">Try Out 3</span>
                                </p>
                                <span class="text-[11px] font-medium text-gray-400">1 hour ago</span>
                            </div>
                        </div>

                        <div class="relative flex items-start gap-4 mb-8 group">
                            <div
                                class="w-12 h-12 bg-teal-100 text-teal-500 rounded-full shrink-0 flex items-center justify-center relative z-10 shadow-sm group-hover:bg-teal-500 group-hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5" />
                                </svg>
                            </div>
                            <div class="pt-1">
                                <p class="text-sm font-bold text-gray-600 leading-tight">Admin menpublish hasil Try Out
                                </p>
                                <span class="text-[11px] font-medium text-gray-400">2 hours ago</span>
                            </div>
                        </div>

                        <div class="relative flex items-start gap-4 mb-8 group">
                            <div
                                class="w-12 h-12 bg-blue-100 text-[#4A72D4] rounded-full shrink-0 flex items-center justify-center relative z-10 shadow-sm group-hover:bg-[#4A72D4] group-hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <div class="pt-1">
                                <p class="text-sm font-bold text-gray-600 leading-tight">Admin menambahkan <span
                                        class="text-[#4A72D4]">20 user</span></p>
                                <span class="text-[11px] font-medium text-gray-400">2 mins ago</span>
                            </div>
                        </div>

                        <div class="relative flex items-start gap-4 mb-8 group">
                            <div
                                class="w-12 h-12 bg-indigo-100 text-indigo-500 rounded-full shrink-0 flex items-center justify-center relative z-10 shadow-sm group-hover:bg-indigo-500 group-hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="pt-1">
                                <p class="text-sm font-bold text-gray-600 leading-tight">Admin mengupdate jadwal
                                    <span class="text-indigo-600">Try Out 3</span>
                                </p>
                                <span class="text-[11px] font-medium text-gray-400">1 hour ago</span>
                            </div>
                        </div>

                        <div class="relative flex items-start gap-4 mb-8 group">
                            <div
                                class="w-12 h-12 bg-teal-100 text-teal-500 rounded-full shrink-0 flex items-center justify-center relative z-10 shadow-sm group-hover:bg-teal-500 group-hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5" />
                                </svg>
                            </div>
                            <div class="pt-1">
                                <p class="text-sm font-bold text-gray-600 leading-tight">Admin menpublish hasil Try Out
                                </p>
                                <span class="text-[11px] font-medium text-gray-400">2 hours ago</span>
                            </div>
                        </div>
                    </div>

                    <button
                        class="w-full py-3 mt-4 bg-blue-50/50 hover:bg-blue-100 text-[#4A72D4] text-sm font-bold rounded-2xl transition-colors border border-blue-100/50">
                        Lihat Semua
                    </button>
                </div>
            </div>
        </main>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
    </style>
</body>


</html>
