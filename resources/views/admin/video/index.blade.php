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

<div x-data="videoApp()" class="flex h-screen overflow-hidden">

    <!-- ================= SIDEBAR ================= -->
   <aside x-data="{ currentPage: 'video' }" :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
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

         <a href="{{ route('admin.latihan.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
            </svg>
            <span class="text-md font-regular">Manajemen latihan soal</span>
        </a>

         <a href="{{ route('admin.videoPembelajaran.index') }}" x-init="if(currentPage === 'video') { $el.scrollIntoView({ block: 'center' }) }"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl bg-[#D4DEF7]  text-[#2E3B66] transition-all duration-200 group text-left">
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

    <!-- ================= MAIN ================= -->
    <main class="flex-1 p-4 md:p-8 overflow-y-auto h-screen">
        <header class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4">
            <div class="flex items-center w-full gap-4">
                <button @click="mobileMenuOpen = true" class="lg:hidden p-3 bg-white rounded-xl shadow-sm">
                    <i class="fa-solid fa-bars text-gray-600"></i>
                </button>
                <div class="relative w-full group flex items-center gap-2">
                    <input type="text" placeholder="Search...."
                           class="w-full bg-white border-none rounded-full py-3 pl-12 pr-4 shadow-sm focus:ring-2 focus:ring-blue-400 outline-none transition-all">
                    <button class="bg-[#4A72D4] hover:bg-blue-600 text-white px-6 py-3 rounded-full text-sm font-medium shadow-sm transition-all active:scale-95 shrink-0">Cari</button>
                </div>
            </div>
        </header>

        <h2 class="text-2xl font-semibold text-slate-700 mb-6">Manajemen Video Pembelajaran</h2>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-4 md:p-6 overflow-hidden">

            <!-- ================= TAB ================= -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                <div class="flex bg-gray-100 p-1 rounded-2xl w-full md:w-auto">
                    <button @click="activeTab = 'active'"
                        :class="activeTab === 'active' ? 'bg-white shadow-sm text-[#4A72D4]' : 'text-gray-500 hover:text-gray-700'"
                        class="px-6 py-2 rounded-xl text-sm font-bold transition-all flex-1 md:flex-none">Daftar Video</button>
                    <button @click="activeTab = 'history'"
                        :class="activeTab === 'history' ? 'bg-white shadow-sm text-[#4A72D4]' : 'text-gray-500 hover:text-gray-700'"
                        class="px-6 py-2 rounded-xl text-sm font-bold transition-all flex-1 md:flex-none flex items-center justify-center gap-2">
                        <i class="fa-solid fa-clock-rotate-left text-xs"></i>
                        History
                    </button>
                </div>

                <div x-show="activeTab === 'active'" x-transition>
                    <button @click="openAddModal()"
                        class="w-full md:w-auto bg-[#4A72D4] hover:bg-blue-600 text-white px-6 py-3 rounded-2xl text-sm font-bold flex items-center justify-center gap-2 transition-all active:scale-95 shadow-md shadow-blue-100">
                        <i class="fa-solid fa-plus text-xs"></i>
                        Tambah Video
                    </button>
                </div>
            </div>

            <!-- ================= TABLE ACTIVE ================= -->
            <div x-show="activeTab === 'active'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2">
                <div class="overflow-x-auto rounded-2xl border border-gray-50">
                    <table class="w-full text-sm min-w-[800px]">
                        <thead class="bg-[#F8FAFF] text-[#4A72D4]">
                        <tr>
                            <th class="p-4 text-left font-bold uppercase tracking-wider">ID Video</th>
                            <th class="p-4 text-left font-bold uppercase tracking-wider">Subtes</th>
                            <th class="p-4 text-left font-bold uppercase tracking-wider">Judul Video</th>
                            <th class="p-4 text-left font-bold uppercase tracking-wider">Link</th>
                            <th class="p-4 text-center font-bold uppercase tracking-wider">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                        @foreach($videos as $video)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="p-4 font-mono text-xs text-slate-500">{{ $video->kode }}</td>
                            <td class="p-4">
                                <span class="bg-blue-50 text-[#4A72D4] px-3 py-1 rounded-full text-[11px] font-bold">{{ $video->subtes }}</span>
                            </td>
                            <td class="p-4 font-semibold text-slate-700">{{ $video->judul_video }}</td>
                            <td class="p-4 text-slate-700 truncate max-w-[100px]">{{ $video->link }}</td>
                            <td class="p-4 text-center space-x-2">
                                <button @click="openEditModal(@js($video))"
                                    class="bg-blue-500 text-white px-3 py-1.5 rounded-lg text-xs hover:bg-blue-600 transition-all shadow-sm">Ubah</button>
                                <button @click="handleDelete('{{ $video->id }}')"
                                    class="bg-red-500 text-white px-3 py-1.5 rounded-lg text-xs hover:bg-red-600 transition-all shadow-sm">Hapus</button>
                                <form id="form-delete-{{ $video->id }}" action="{{ route('admin.videoPembelajaran.destroy', $video->id) }}" method="POST" class="hidden">
                                    @csrf @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ================= TABLE HISTORY ================= -->
            <div x-show="activeTab === 'history'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" style="display: none;">
                <div class="overflow-x-auto rounded-2xl border border-red-50">
                    <table class="w-full text-sm min-w-[800px]">
                        <thead class="bg-red-50/30 text-red-600">
                        <tr>
                            <th class="p-4 text-left font-bold uppercase tracking-wider">ID Video</th>
                            <th class="p-4 text-left font-bold uppercase tracking-wider">Subtes</th>
                            <th class="p-4 text-left font-bold uppercase tracking-wider">Judul Video</th>
                            <th class="p-4 text-left font-bold uppercase tracking-wider">Link</th>
                            <th class="p-4 text-center font-bold uppercase tracking-wider">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                        @foreach($history as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 font-mono text-xs text-slate-500">{{ $video->kode }}</td>
                            <td class="p-4">
                                <span class="bg-blue-50 text-[#4A72D4] px-3 py-1 rounded-full text-[11px] font-bold">{{ $item->subtes }}</span>
                            </td>
                            <td class="p-4 font-semibold text-slate-700">{{ $item->judul_video }}</td>
                            <td class="p-4 text-slate-700 truncate max-w-[100px]">{{ $item->link }}</td>
                            <td class="p-4 text-center space-x-2">
                                <button @click="handleRestore('{{ $item->id }}')"
                                    class="bg-emerald-500 text-white px-3 py-1.5 rounded-lg text-xs hover:bg-emerald-600 transition-all shadow-sm">Pulihkan</button>
                                <button @click="handleForceDelete('{{ $item->id }}')"
                                    class="bg-red-500 text-white px-3 py-1.5 rounded-lg text-xs hover:bg-red-600 transition-all shadow-sm">Hapus</button>
                                <form id="form-restore-{{ $item->id }}" action="{{ route('admin.videoPembelajaran.restore', $item->id) }}" method="POST" class="hidden">@csrf</form>
                                <form id="form-force-delete-{{ $item->id }}" action="{{ route('admin.videoPembelajaran.force-delete', $item->id) }}" method="POST" class="hidden">@csrf @method('DELETE')</form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

    <!-- ================= MODAL TAMBAH/UBAH ================= -->
    <div x-show="openModalVideo" x-cloak class="fixed inset-0 z-[100] bg-black/50 backdrop-blur-sm flex items-center justify-center p-4" x-transition>
        <div @click.away="closeModal()" class="bg-white w-full max-w-md rounded-[32px] p-8 shadow-2xl">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-extrabold text-slate-800" x-text="isEditVideo ? 'Ubah Video' : 'Tambah Video'"></h3>
                <button @click="closeModal()" class="text-gray-300 hover:text-red-500 transition-colors">
                    <i class="fa-solid fa-circle-xmark text-2xl"></i>
                </button>
            </div>

            <form :action="isEditVideo ? `/admin/videoPembelajaran/${videoData.id}` : '{{ route('admin.videoPembelajaran.store') }}'" method="POST">
                @csrf
                <template x-if="isEditVideo">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div class="space-y-1 mb-3">
                    <label class="text-[10px] font-bold text-slate-400 uppercase ml-1 tracking-widest">Kategori Subtes</label>
                    <select name="subtes" x-model="videoData.subtes" class="w-full bg-[#F3F6FF] border-none rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none appearance-none">
                        <option value="">Pilih Subtes</option>
                        <option>Penalaran Umum</option>
                        <option>Pengetahuan dan Pemahaman Umum</option>
                        <option>Pemahaman Bacaan dan Menulis</option>
                        <option>Pengetahuan Kuantitatif</option>
                        <option>Penalaran Matematika</option>
                        <option>Literasi dalam Bahasa Indonesia</option>
                        <option>Literasi dalam Bahasa Inggris</option>
                    </select>
                </div>

                <div class="space-y-1 mb-3">
                    <label class="text-[10px] font-bold text-slate-400 uppercase ml-1 tracking-widest">Judul Video</label>
                    <input type="text" name="judul_video" x-model="videoData.judul_video" class="w-full bg-[#F3F6FF] border-none rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none" placeholder="Masukkan judul video..." required>
                </div>

                <div class="space-y-1 mb-6">
                    <label class="text-[10px] font-bold text-slate-400 uppercase ml-1 tracking-widest">Link / URL Video</label>
                    <input type="url" name="link" x-model="videoData.link" class="w-full bg-[#F3F6FF] border-none rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none" placeholder="https://youtube.com/..." required>
                </div>

                <div class="flex gap-3">
                    <button type="button" @click="closeModal()" class="flex-1 bg-slate-50 text-slate-400 font-bold py-3.5 rounded-2xl hover:bg-slate-100 transition-all">Batal</button>
                    <button type="submit" class="flex-1 bg-[#4A72D4] text-white font-bold py-3.5 rounded-2xl hover:bg-blue-600 shadow-lg shadow-blue-100 transition-all active:scale-95">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
function videoApp() {
    return {
        // ================= STATE =================
        mobileMenuOpen: false,
        activeTab: 'active',
        openModalVideo: false,
        isEditVideo: false,
        videoData: { id: '', subtes: '', judul_video: '', link: '' },

        // ================= MODAL =================
        openAddModal() {
            this.openModalVideo = true;
            this.isEditVideo = false;
            this.videoData = { id: '', subtes: '', judul_video: '', link: '' };
        },
        openEditModal(video) {
            this.openModalVideo = true;
            this.isEditVideo = true;
            this.videoData = { ...video };
        },
        closeModal() {
            this.openModalVideo = false;
        },

        // ================= CRUD =================
        handleDelete(id) {
            Swal.fire({
                title: 'Hapus Video?',
                text: "Data akan dipindahkan ke tab history.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-3xl',
                    confirmButton: 'rounded-xl px-4 py-2',
                    cancelButton: 'rounded-xl px-4 py-2'
                }
            }).then((result) => {
                if(result.isConfirmed) {
                    document.getElementById(`form-delete-${id}`).submit();
                }
            })
        },
        handleRestore(id) {
            Swal.fire({
                title: 'Pulihkan Video?',
                text: "Video akan dikembalikan ke daftar aktif.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Pulihkan!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-3xl',
                    confirmButton: 'rounded-xl px-4 py-2',
                    cancelButton: 'rounded-xl px-4 py-2'
                }
            }).then((result) => {
                if(result.isConfirmed) {
                    document.getElementById(`form-restore-${id}`).submit();
                }
            })
        },
        handleForceDelete(id) {
            Swal.fire({
                title: 'Hapus Permanen?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Hapus Permanen',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-3xl',
                    confirmButton: 'rounded-xl px-4 py-2',
                    cancelButton: 'rounded-xl px-4 py-2'
                }
            }).then((result) => {
                if(result.isConfirmed) {
                    document.getElementById(`form-force-delete-${id}`).submit();
                }
            })
        }
    }
}
</script>

</body>
</html>
