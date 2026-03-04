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
    <style>
        /* Memastikan font Poppins terpakai */
        body { font-family: 'Poppins', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="bg-slate-100 overflow-x-hidden">

<div x-data="userApp()" class="flex h-screen overflow-hidden">

    <aside x-data="{ currentPage: 'user' }" :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
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
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
            <span class="text-md font-regular">Dashboard</span>
        </a>

        <a href="{{ route('admin.user.index') }}"  x-init="if(currentPage === 'user') { $el.scrollIntoView({ block: 'center' }) }"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl bg-[#D4DEF7]  text-[#2E3B66] transition-all duration-200 group text-left">
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <input type="text" placeholder="Search...." class="w-full bg-white border-none rounded-full py-3 pl-12 pr-4 shadow-sm focus:ring-2 focus:ring-blue-400 outline-none transition-all">
                </div>
                <button class="bg-[#4A72D4] hover:bg-blue-600 text-white px-6 py-3 rounded-full text-sm font-medium shadow-sm transition-all active:scale-95 shrink-0">
                    Cari
                </button>
            </div>
        </div>
@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
@endphp
        <div x-data="{ open: false }" class="relative inline-block">
    <!-- Trigger -->
    <div @click="open = !open" 
         class="flex items-center gap-3 bg-white p-1 pr-4 pl-1 rounded-full shadow-sm cursor-pointer shrink-0 self-end md:self-auto">
        <div class="w-10 h-10 bg-gray-200 rounded-full overflow-hidden border-2 border-white">
            <img src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=Admin&background=random' }}" alt="Admin">
        </div>
        <span class="font-bold text-sm hidden sm:block text-gray-700">Admin</span>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </div>

    <!-- Dropdown -->
    <div x-show="open" @click.away="open = false"
         class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 z-50"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95">
        <div class="p-4">
            <p class="font-semibold text-gray-700">{{ $user->name }}</p>
            <p class="text-sm text-gray-500">{{ $user->email }}</p>
            <p class="text-sm text-gray-500">{{ $user->no_hp ?? '-' }}</p>
        </div>
    </div>
</div>
    </header>

    <h2 class="text-2xl font-semibold text-slate-700 mb-6">Manajemen User</h2>

    <div x-data="userTableApp()" class="bg-white rounded-3xl shadow-sm border border-gray-100 p-4 md:p-6 overflow-hidden">
        
        <div class="flex gap-6 mb-6 border-b border-gray-100">
            <button @click="tab='admin'" :class="tab==='admin' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-400 hover:text-gray-600'" class="pb-3 text-sm font-bold transition-all">Admin</button>
            <button @click="tab='peserta'" :class="tab==='peserta' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-400 hover:text-gray-600'" class="pb-3 text-sm font-bold transition-all">Peserta</button>
            <button @click="tab='history'" :class="tab==='history' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-400 hover:text-gray-600'" class="pb-3 text-sm font-bold transition-all">History</button>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
            <div class="relative w-full md:w-80">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text"
                x-model="search"
                :placeholder="tab === 'admin' ? 'Search Admin....' : (tab === 'peserta' ? 'Search Peserta....' : 'Search History....')"
                class="w-full bg-[#F3F6FF] border border-transparent rounded-full py-2.5 pl-11 pr-4 text-sm focus:ring-2 focus:ring-blue-400 outline-none">
                        </div>

            <button x-show="tab==='admin'" @click="openModal=true; isEdit=false; resetForm()" class="w-full md:w-auto bg-[#4A72D4] hover:bg-blue-600 text-white px-6 py-2.5 rounded-xl text-sm font-bold flex items-center justify-center gap-2 transition-all active:scale-95 shadow-sm">
                <i class="fa-solid fa-plus text-xs"></i> Tambah Admin
            </button>
        </div>

        <div class="overflow-x-auto rounded-2xl border border-gray-50">
            <table class="w-full text-sm min-w-[600px]">
                <thead class="bg-[#F8FAFF] text-[#4A72D4]">
                    <tr>
                        <th class="p-4 text-left font-bold">ID</th>
                        <th class="p-4 text-left font-bold">Nama</th>
                        <th class="p-4 text-left font-bold" x-text="tab === 'history' ? 'Status Hapus' : 'Status'">Status</th>
                        <th class="p-4 text-left font-bold" x-text="tab === 'history' ? 'Modul' : 'No HP'">No HP</th>
                        <th class="p-4 text-left font-bold" x-text="tab === 'history' ? 'Waktu Hapus' : 'Bergabung'">Bergabung</th>
                        <th class="p-4 text-left font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">

{{-- ================= ADMIN ================= --}}
            <tbody x-show="tab==='admin'">
    <template x-for="user in filteredAdmins" :key="user.id">
        <tr class="hover:bg-slate-50 transition-colors">

             <td class="p-4 font-semibold text-blue-600">
                <span x-text="user.kode"></span>
            </td>

            <td class="p-4">
                <div class="flex items-center gap-3">
                    <img 
                        :src="user.photo 
                            ? '/storage/' + user.photo 
                            : 'https://ui-avatars.com/api/?name=' + user.name + '&background=random'"
                        :alt="user.name"
                        class="w-10 h-10 rounded-full object-cover"
                    >
                    <span class="font-semibold text-slate-700" x-text="user.name"></span>
                </div>
            </td>

            <td class="p-4">
                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-[11px] font-bold">
                    Aktif
                </span>
            </td>

            <td class="p-4 text-gray-500" x-text="user.no_hp"></td>

            <td class="p-4 text-gray-500"
                x-text="new Date(user.created_at).toLocaleDateString('id-ID', { day:'2-digit', month:'long', year:'numeric' })">
            </td>

            <td class="p-4">
                <div class="flex gap-2">

                    <button 
                        @click="editData({
                            id: user.id,
                            nama: user.name,
                            wa: user.no_hp,
                            email: user.email
                        })"
                        class="px-3 py-1 bg-yellow-400 text-white rounded-lg text-xs font-semibold hover:bg-yellow-500">
                        Edit
                    </button>

                    <button 
                        @click="
                            selectedId = user.id;
                            selectedName = user.name;
                            isTrashed = user.deleted_at ? true : false;
                            showDeleteConfirm = true;
                        "
                        class="px-3 py-1 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600">
                        Hapus
                    </button>

                </div>
            </td>

        </tr>
    </template>
</tbody>


{{-- ================= PESERTA ================= --}}
          <tbody x-show="tab==='peserta'">
    <template x-for="user in filteredPesertas" :key="user.id">
        <tr class="hover:bg-slate-50 transition-colors">

            
            <td class="p-4 font-semibold text-blue-600">
    <span x-text="user.kode"></span>
</td>

            <td class="p-4 font-semibold text-slate-700" x-text="user.name"></td>

            <td class="p-4">
                <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-[11px] font-bold">
                    Aktif
                </span>
            </td>

            <td class="p-4 text-gray-500" x-text="user.no_hp"></td>

            <td class="p-4 text-gray-500"
                x-text="new Date(user.created_at).toLocaleDateString('id-ID', { day:'2-digit', month:'long', year:'numeric' })">
            </td>

            <td class="p-4">
                <div class="flex gap-2">

                    <button 
                        @click="
                            selectedId = user.id;
                            selectedName = user.name;
                            isTrashed = user.deleted_at ? true : false;
                            showDeleteConfirm = true;
                        "
                        class="px-3 py-1 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600">
                        Hapus
                    </button>

                </div>
            </td>

        </tr>
    </template>
</tbody>


{{-- ================= HISTORY ================= --}}
            <tbody x-show="tab==='history'">
    <template x-for="user in filteredHistory" :key="user.id">
        <tr class="hover:bg-slate-50 transition-colors">

            
            <td class="p-4 font-semibold text-blue-600">
    <span x-text="user.kode"></span>
</td>

            <td class="p-4 font-semibold text-slate-700" x-text="user.name"></td>

            <td class="p-4">
                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-[11px] font-bold">
                    Terhapus
                </span>
            </td>

            <td class="p-4 text-gray-500 font-medium"
                x-text="user.role.toUpperCase()">
            </td>

            <td class="p-4 text-gray-400"
                x-text="new Date(user.deleted_at).toLocaleDateString('id-ID', { day:'2-digit', month:'long', year:'numeric' })">
            </td>

            <td class="p-4">
                <div class="flex gap-2">

                    <!-- Restore -->
                    <form :action="`/admin/user/restore/${user.id}`" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-3 py-1 bg-green-500 text-white rounded-lg text-xs font-semibold hover:bg-green-600">
                            Restore
                        </button>
                    </form>

                    <!-- Hapus Permanen -->
                    <button
                        @click="
                            selectedId = user.id;
                            selectedName = user.name;
                            isTrashed = true;
                            showDeleteConfirm = true;
                        "
                        class="px-3 py-1 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600">
                        Hapus Permanen
                    </button>

                </div>
            </td>

        </tr>
    </template>
</tbody>
            </table>
        </div>
       <div x-show="openModal" x-cloak 
     class="fixed inset-0 z-[100] bg-black/50 backdrop-blur-sm flex items-center justify-center p-4"
     x-transition>

    <div @click.away="openModal=false"
         class="bg-white w-full max-w-lg rounded-[32px] shadow-2xl flex flex-col max-h-[90vh] overflow-hidden transition-all">

        <div class="p-8 pb-4 flex justify-between items-center border-b border-gray-50 shrink-0">
            <h3 class="text-xl font-extrabold text-slate-800"
                x-text="isEdit ? 'Ubah Data Admin' : 'Tambah Admin Baru'"></h3>
            <button @click="openModal=false"
                    class="text-gray-300 hover:text-red-500 transition-colors">
                <i class="fa-solid fa-circle-xmark text-2xl"></i>
            </button>
        </div>

        <div class="p-8 overflow-y-auto flex-1">
            
                {{-- Pesan sukses --}}
                @if (session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Pesan error --}}
                @if (session('error'))
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif
            <form class="space-y-4 pr-1"
                  method="POST"
                  enctype="multipart/form-data"
                  :action="isEdit 
                    ? '/admin/user/' + form.id 
                    : '{{ route('admin.user.store') }}'">

                @csrf
                <template x-if="isEdit">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                {{-- FOTO --}}
                <div class="flex flex-col items-center justify-center border-2 border-dashed border-slate-100 rounded-3xl py-6 bg-slate-50 hover:bg-blue-50 transition-all cursor-pointer relative group">
                    <input type="file" name="photo"
                           class="absolute inset-0 opacity-0 cursor-pointer">
                    <div class="bg-white p-3 rounded-full shadow-sm text-[#4A72D4] mb-2">
                        <i class="fa-solid fa-camera text-xl"></i>
                    </div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        Unggah Foto Profil
                    </p>
                </div>

                {{-- NAMA & WA --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase ml-1">
                            Nama Lengkap
                        </label>
                        <input type="text" name="name"
                               x-model="form.nama"
                               class="w-full bg-slate-100 border-none rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none">
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase ml-1">
                            No HP
                        </label>
                        <input type="text" name="no_hp"
                               x-model="form.wa"
                               class="w-full bg-slate-100 border-none rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none">
                    </div>
                </div>

                {{-- EMAIL --}}
                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-slate-400 uppercase ml-1">
                        Alamat Email
                    </label>
                    <input type="email" name="email"
                           x-model="form.email"
                           class="w-full bg-slate-100 border-none rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none">
                </div>

                {{-- PASSWORD --}}
               <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <!-- Password -->
                <div x-data="{ password: '', passwordError: '', show: false }" class="space-y-1 relative">
                    <label class="text-[10px] font-bold text-slate-400 uppercase ml-1">Kata Sandi</label>
                    <input :type="show ? 'text' : 'password'" name="password" x-model="password"
                        @input="passwordError = password.length >= 6 || password.length === 0 ? '' : 'Minimal 6 karakter'"
                        class="w-full bg-slate-100 border-none rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none pr-10">
                    <button type="button" @click="show = !show"
                        class="absolute right-3 top-[32px] text-gray-400">
                        <template x-if="!show">
                            <!-- Icon mata tertutup -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-5 0-9-4-9-9 0-1.135.204-2.22.575-3.225M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </template>
                        <template x-if="show">
                            <!-- Icon mata terbuka -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </template>
                    </button>
                    <p x-text="passwordError" class="text-red-600 text-[11px] mt-1"></p>
                </div>

            <!-- Konfirmasi Password -->
                    <div x-data="{ showConfirm: false }" class="space-y-1 relative">
                        <label class="text-[10px] font-bold text-slate-400 uppercase ml-1">Konfirmasi Sandi</label>
                        <input :type="showConfirm ? 'text' : 'password'" name="password_confirmation"
                            class="w-full bg-slate-100 border-none rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none pr-10">
                        <button type="button" @click="showConfirm = !showConfirm"
                            class="absolute right-3 top-[32px] text-gray-400">
                            <template x-if="!showConfirm">
                                <!-- Icon mata tertutup -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-5 0-9-4-9-9 0-1.135.204-2.22.575-3.225M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </template>
                            <template x-if="showConfirm">
                                <!-- Icon mata terbuka -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </template>
                        </button>
                    </div>
                </div>

                {{-- FOOTER BUTTON --}}
                <div class="pt-6 flex gap-3 border-t border-gray-50">
                    <button type="button"
                            @click="openModal=false"
                            class="flex-1 bg-slate-50 text-slate-400 font-bold py-3.5 rounded-2xl hover:bg-slate-100 transition-all">
                        Batal
                    </button>

                    <button type="submit"
                        
                        class="flex-1 bg-[#4A72D4] text-white font-bold py-3.5 rounded-2xl hover:bg-blue-600 shadow-lg shadow-blue-100 transition-all">
                    Simpan Data
                </button>
                </div>

            </form>
        </div>
    </div>
</div>

      <div x-show="showDeleteConfirm" x-cloak class="fixed inset-0 z-[120] bg-black/50 backdrop-blur-sm flex items-center justify-center p-4"
     x-transition>
    <div @click.away="showDeleteConfirm = false"
         class="bg-white w-full max-w-sm rounded-[32px] p-8 text-center shadow-2xl relative">

        <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fa-solid fa-trash-can text-3xl"></i>
        </div>

        <h3 class="text-xl font-extrabold text-slate-800 mb-2">
            Konfirmasi Hapus
        </h3>

        <p class="text-sm text-slate-500 mb-8 px-4">
            Apakah anda yakin ingin menghapus
            <span class="font-bold text-slate-800" x-text="selectedName"></span>?
        </p>

        <div class="flex gap-3">
            <button @click="showDeleteConfirm=false"
                    class="flex-1 bg-slate-50 text-slate-400 font-bold py-3 rounded-2xl hover:bg-slate-100 transition-all">
                Batal
            </button>

            <!-- Tombol hapus tergantung status -->
            <template x-if="isTrashed">
                <form :action="'/admin/user/' + selectedId + '/force-delete'" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full bg-red-500 text-white font-bold py-3 rounded-2xl hover:bg-red-600 shadow-lg shadow-red-100 transition-all">
                        Hapus Permanen
                    </button>
                </form>
            </template>

            <template x-if="!isTrashed">
                <form :action="'/admin/user/' + selectedId" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full bg-yellow-500 text-white font-bold py-3 rounded-2xl hover:bg-yellow-600 shadow-lg shadow-yellow-100 transition-all">
                        Hapus Sementara
                    </button>
                </form>
            </template>
        </div>
    </div>
</div>

    </div>
</main>
</div>

<script>
function userApp() {
    return {
        tab: 'admin',
        search: '', 
        admins: @json($admins),
        pesertas: @json($pesertas),
        history: @json($history),

        openModal: false,
        isEdit: false,
        showDeleteConfirm: false,
        selectedName: '',
        selectedId: '',
        isTrashed: false,

        form: {
            id: '',
            nama: '',
            wa: '',
            email: ''
        },

        //  FILTER ADMIN
        get filteredAdmins() {
            return this.admins.filter(u =>
                u.name.toLowerCase().includes(this.search.toLowerCase()) ||
                (u.no_hp && u.no_hp.includes(this.search)) ||
                u.id.toString().includes(this.search)
            );
        },

        //  FILTER PESERTA
        get filteredPesertas() {
            return this.pesertas.filter(u =>
                u.name.toLowerCase().includes(this.search.toLowerCase()) ||
                (u.no_hp && u.no_hp.includes(this.search)) ||
                u.id.toString().includes(this.search)
            );
        },

        //  FILTER HISTORY
       get filteredHistory() {
        return this.history.filter(u =>
            u.name.toLowerCase().includes(this.search.toLowerCase()) ||
            u.id.toString().includes(this.search) ||
            (u.role && u.role.toLowerCase().includes(this.search.toLowerCase()))
        );
    },

        editData(data) {
            this.isEdit = true;
            this.form.id = data.id;
            this.form.nama = data.nama;
            this.form.wa = data.wa;
            this.form.email = data.email;
            this.openModal = true;
        },

        confirmDelete(user) {
            this.selectedId = user.id;
            this.selectedName = user.name;
            this.isTrashed = user.deleted_at ? true : false;
            this.showDeleteConfirm = true;
        },

        resetForm() {
            this.isEdit = false;
            this.form.id = '';
            this.form.nama = '';
            this.form.wa = '';
            this.form.email = '';
        }
    }
}
</script>
</body>
</html>