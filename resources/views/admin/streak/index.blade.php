<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persisten</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            letter-spacing: -0.01em;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #4A72D4;
            border-radius: 10px;
        }

        .main-content {
            height: 100vh;
            overflow-y: auto;
        }
    </style>
</head>

<body class="bg-[#F4F7FF] text-[#2D3B61] overflow-hidden" x-data="{
    mobileMenuOpen: false,
    currentView: 'main',

    confirmSoftDelete(id) {
        Swal.fire({
            title: 'Pindahkan ke History?',
            text: 'Pet akan dinonaktifkan sementara.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4A72D4',
            confirmButtonText: 'PINDAHKAN'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-' + id).submit()
            }
        })
    },

    confirmPermanentDelete(id) {
        Swal.fire({
            title: 'Hapus Permanen?',
            text: 'Data visual pet akan hilang selamanya.',
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            confirmButtonText: 'HAPUS SELAMANYA'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('force-' + id).submit()
            }
        })
    }
}">

    <div class="flex h-screen w-full relative">

        <!-- SIDEBAR (TETAP SAMA) -->
        <aside x-data="{ currentPage: 'streak' }" :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed inset-y-0 left-0 z-50 w-72 bg-[#4A72D4] text-white flex flex-col p-6 shadow-xl transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 shrink-0 h-full">

            <div class="flex items-center justify-between mb-10 px-2">
                <div class="flex items-center gap-3">
                    <div class="bg-white p-2 rounded-xl">
                        <svg class="w-6 h-6 text-[#4A72D4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold tracking-tight">P E R S I S T E N</h1>
                </div>
                <button @click="mobileMenuOpen = false" class="lg:hidden p-2 hover:bg-white/10 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <nav class="flex-1 space-y-1 overflow-y-auto pr-2 custom-scrollbar">
                <a href="{{ route('admin.dashboard.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                    </svg>
                    <span class="text-md font-regular">Dashboard</span>
                </a>

                <a href="{{ route('admin.user.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl  transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen user</span>
                </a>

                <a href="{{ route('admin.streak.index') }}" x-init="if (currentPage === 'streak') { $el.scrollIntoView({ block: 'center' }) }"
                    class="w-full flex items-center gap-4 px-4 py-3 bg-[#D4DEF7]  text-[#2E3B66] rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 18a3.75 3.75 0 0 0 .495-7.468 5.99 5.99 0 0 0-1.925 3.547 5.975 5.975 0 0 1-2.133-1.001A3.75 3.75 0 0 0 12 18Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen streak</span>
                </a>

                <a href="{{ route('admin.tryout.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen tryout</span>
                </a>

                <a href="{{ route('admin.kuis.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl  transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen kuis</span>
                </a>

                <a href="{{ route('admin.latihan.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                    <span class="text-md font-regular">Manajemen latihan soal</span>
                </a>

                <a href="{{ route('admin.videoPembelajaran.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-9">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen video pembelajaran</span>
                </a>

                <a href="{{ route('admin.minatBakat.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                    </svg>
                    <span class="text-md font-regular">Manajemen minat bakat</span>
                </a>



                <a href="{{ route('admin.peluang.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen peluang PTN</span>
                </a>

                <a href="{{ route('admin.laporan.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                    </svg>
                    <span class="text-md font-regular">Monitoring dan laporan</span>
                </a>
            </nav>

            <form action="{{ route('logout') }}" method="POST" class="w-full inline">
                @csrf
                <button type="submit"
                    class="mt-4 w-full flex items-center bg-white/10 hover:bg-white/20 px-6 py-3 rounded-2xl transition-all group border border-white/20 backdrop-blur-sm shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-5 md:size-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                    <span class="text-white text-md font-medium tracking-wide ml-4">Logout</span>
                </button>
            </form>
        </aside>

        <div x-show="mobileMenuOpen" x-transition:enter="transition opacity-ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition opacity-ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="mobileMenuOpen = false"
            class="fixed inset-0 bg-black/50 z-40 lg:hidden">
        </div>

        <!-- CONTENT -->
        <main class="flex-1 main-content custom-scrollbar">

            <header class="flex flex-col lg:flex-row lg:items-center justify-between p-4 lg:px-8 lg:pt-8 lg:pb-4 gap-4 flex-shrink-0 w-full">
    <div class="flex items-center justify-between w-full lg:w-auto gap-4 lg:order-2">
        <button @click="mobileMenuOpen = true" class="lg:hidden p-3 bg-white rounded-xl shadow-sm shrink-0">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        @php
            use Illuminate\Support\Facades\Auth;
            $user = Auth::user();
        @endphp

        <div x-data="{ open: false }" class="relative flex-1 lg:flex-initial">
            <div @click="open = !open" 
                class="flex items-center justify-between lg:justify-start gap-3 bg-white p-1 pr-4 pl-1 rounded-full shadow-sm cursor-pointer border border-transparent hover:border-blue-100 transition-all w-full lg:w-auto">
                
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-gray-200 rounded-full overflow-hidden border-2 border-white shrink-0">
                        <img src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=Admin&background=random' }}" 
                             alt="Admin" class="w-full h-full object-cover">
                    </div>
                    <span class="font-bold text-sm text-gray-700 truncate lg:max-w-none">Admin</span>
                </div>
                
                <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
            </div>

            <div x-show="open" @click.away="open = false"
                class="absolute right-0 mt-2 w-64 bg-white rounded-2xl shadow-xl border border-gray-100 z-50 overflow-hidden"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100">
                <div class="p-4 bg-gray-50/50 border-b border-gray-100">
                    <p class="font-bold text-gray-800">{{ $user->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ $user->email }}</p>
                </div>
                <div class="p-4 text-xs text-gray-500 bg-white">
                    {{ $user->no_hp ?? '-' }}
                </div>
            </div>
        </div>
    </div>

    <div x-data="{
            keyword: '',
            routes: {
                'dashboard': '{{ route('admin.dashboard.index') }}',
                'user': '{{ route('admin.user.index') }}',
                'streak': '{{ route('admin.streak.index') }}',
                'monitoring': '{{ route('admin.laporan.index') }}',
                'video': '{{ route('admin.videoPembelajaran.index') }}',
                'peluang': '{{ route('admin.peluang.index') }}',
                'tryout': '{{ route('admin.tryout.index') }}',
                'minat bakat': '{{ route('admin.minatBakat.index') }}',
                'kuis': '{{ route('admin.kuis.index') }}',
                'latihan': '{{ route('admin.latihan.index') }}'
            },
            goToPage(){
                let search = this.keyword.toLowerCase()
                for (let key in this.routes) {
                    if (key.includes(search)) {
                        window.location.href = this.routes[key]
                        return
                    }
                }
                alert('Halaman tidak ditemukan')
            }
        }"
        class="relative w-full lg:flex-grow flex items-center gap-2 lg:order-1"
    >
        <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
            <input 
                type="text" 
                x-model="keyword" 
                placeholder="Cari halaman..." 
                @keydown.enter="goToPage()"
                class="w-full bg-white border-none rounded-full py-3 pl-12 pr-4 shadow-sm focus:ring-2 focus:ring-blue-400 outline-none transition-all text-sm"
            >
        </div>

        <button 
            @click="goToPage()" 
            class="bg-[#4A72D4] hover:bg-blue-600 text-white px-6 py-3 rounded-full text-sm font-bold shadow-sm transition-all active:scale-95 shrink-0"
        >
            Cari
        </button>
    </div>
</header>


            <div class="p-4 lg:px-8 " x-show="currentView==='main'">

                <div class="bg-white p-4  rounded-xl shadow-sm border border-blue-100 overflow-hidden mb-10">

                    <div
                        class="p-6 md:p-8 border-b border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4">

                        <div>
                            <h3 class="text-xl font-bold text-gray-800"
                                x-text="currentView === 'main' ? 'Pet Streak' : 'History Pet'">
                            </h3>

                            <p class="text-sm text-gray-400"
                                x-text="currentView === 'main' 
            ? 'Kelola visual pet berdasarkan level streak pengguna'
            : 'Pet yang dihapus sementara dapat dipulihkan di sini'">
                            </p>
                        </div>

                        <div class="flex flex-wrap items-center gap-3">

                            <!-- Toggle History -->
                            <button @click="currentView = currentView === 'main' ? 'history' : 'main'"
                                class="flex-1 md:flex-none bg-orange-500 hover:bg-orange-600 text-white px-5 py-3 rounded-xl font-semibold text-xs transition-all flex items-center justify-center gap-2 shadow-lg shadow-orange-100 active:scale-95">

                                <i
                                    :class="currentView === 'main'
                                        ?
                                        'fa-solid fa-clock-rotate-left' :
                                        'fa-solid fa-list'"></i>

                                <span x-text="currentView === 'main' ? 'History' : 'Daftar'"></span>

                            </button>

                            <!-- Tambah Pet -->
                            <a href="{{ route('admin.streak.create') }}"
                                class="flex-1 md:flex-none bg-[#4A72D4] hover:bg-blue-600 text-white px-5 py-3 rounded-xl font-semibold text-xs transition-all flex items-center justify-center gap-2 shadow-lg shadow-blue-100 active:scale-95">

                                <i class="fa-solid fa-plus"></i> Tambah Pet

                            </a>

                        </div>

                    </div>

                    <div class="overflow-x-auto">

                        <table class="w-full text-left">

                            <thead class="bg-blue-50/30 text-[#4A72D4] text-[11px] font-bold text-gray-400 uppercase">
                                <tr>
                                    <th class="px-10 py-6 text-center">Visual Pet</th>
                                    <th class="px-10 py-6 text-center">Level Perubahan</th>
                                    <th class="px-10 py-6 text-center">SVG Animasi</th>
                                    <th class="px-10 py-6 text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                                @foreach ($streaks as $streak)
                                    <tr class="hover:bg-blue-50/20 transition-all">
                                        <td class="px-10 py-8 text-center">
                                            <div
                                                class="w-60 h-60 bg-white rounded-3xl p-3 mx-auto flex items-center justify-center overflow-hidden">
                                                <img src="{{ $streak->svg_path ? asset('storage/' . $streak->svg_path) : '' }}"
                                                    class="w-full h-full object-contain">
                                            </div>
                                            <p
                                                class="text-[10px] font-bold text-gray-400 mt-2 uppercase tracking-widest">
                                                {{ $streak->nama }}</p>
                                        </td>

                                        <td class="px-10 py-8 text-center">
                                            <span
                                                class="inline-flex items-center gap-2 bg-indigo-50 text-[#4A72D4] px-6 py-3 rounded-2xl font-black text-lg">
                                                <span class="text-sm opacity-50 font-bold">LV.</span>
                                                {{ $streak->min_level }}
                                            </span>
                                        </td>

                                        <td class="px-10 py-8">
                                            <div class="flex justify-center items-center">
                                                @if ($streak->svg_animated_path)
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-8 w-8 text-green-500" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-8 w-8 text-gray-300" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                @endif
                                            </div>
                                        </td>

                                        <td class="px-10 py-8 text-center">
                                            <div class="flex justify-center gap-2">
                                                @if (!$streak->is_default)
                                                    <!-- Tombol Edit -->
                                                    <a href="{{ route('admin.streak.edit', $streak->id) }}"
                                                        class="h-11 px-4 py-2 flex items-center bg-blue-50 text-[#4A72D4] rounded-xl font-black text-[10px] uppercase hover:bg-blue-100 transition-all">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                        </svg>
                                                    </a>

                                                    <!-- Tombol Delete -->
                                                    <button @click="confirmSoftDelete({{ $streak->id }})"
                                                        class="h-11 px-4 py-2 bg-red-50 text-red-500 rounded-xl font-black text-[10px] uppercase hover:bg-red-100 transition-all">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                    </button>

                                                    <!-- Form Delete -->
                                                    <form id="delete-{{ $streak->id }}"
                                                        action="{{ route('admin.streak.delete', $streak->id) }}"
                                                        method="POST" class="hidden">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @else
                                                    <!-- Default Label -->
                                                    <span
                                                        class="text-gray-400 font-black text-[10px] uppercase">Default</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>

                </div>

            </div>


            <div class="p-4 lg:px-8" x-show="currentView==='history'">

                <div class="bg-white rounded-xl shadow-sm border border-red-50 overflow-hidden">

                    <div class="p-6 bg-red-50/40 border-b border-red-100 flex items-center justify-between">
                        <div>
                            <h3 class="font-bold text-red-500 text-lg">
                                History Pet
                            </h3>
                            <p class="text-xs text-gray-400">
                                Pet yang dipindahkan ke history dapat dihapus permanen atau dipulihkan
                            </p>
                        </div>
                        <button @click="currentView='main'"
                            class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-3 rounded-xl text-xs font-bold transition-all">
                            <i class="fa-solid fa-list mr-1"></i> Daftar
                        </button>
                    </div>

                    <div class="overflow-x-auto">

                        <table class="w-full text-left">
                            <thead class="bg-gray-50 text-[11px] font-bold uppercase text-gray-400">
                                <tr>
                                    <th class="px-8 py-4 text-center">Pet</th>
                                    <th class="px-8 py-4 text-center">Level</th>
                                    <th class="px-8 py-4 text-center">SVG Animasi</th>
                                    <th class="px-8 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                                @forelse ($trash as $streak)
                                    <tr class="hover:bg-gray-50 transition-all">

                                        <!-- PET -->
                                        <td class="px-8 py-6 text-center">
                                            <div class="flex flex-col items-center gap-2">

                                                <div
                                                    class="w-20 h-20 bg-gray-50 rounded-xl flex items-center justify-center overflow-hidden">
                                                    @if ($streak->svg_path)
                                                        <img src="{{ asset('storage/' . $streak->svg_path) }}"
                                                            class="w-full h-full object-contain grayscale opacity-60">
                                                    @else
                                                        <span class="text-gray-300 text-xs">No Image</span>
                                                    @endif
                                                </div>

                                                <span class="text-xs font-semibold text-gray-400 uppercase">
                                                    {{ $streak->nama }}
                                                </span>
                                            </div>
                                        </td>

                                        <!-- LEVEL -->
                                        <td class="px-8 py-6 text-center">
                                            <span
                                                class="bg-gray-100 text-gray-500 px-4 py-2 rounded-xl font-bold text-sm">
                                                LV {{ $streak->min_level }}
                                            </span>
                                        </td>

                                        <!-- ANIMASI -->
                                        <td class="px-8 py-6 text-center">
                                            @if ($streak->svg_animated_path)
                                                <svg class="h-6 w-6 text-green-500 mx-auto" fill="none"
                                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @else
                                                <svg class="h-6 w-6 text-gray-300 mx-auto" fill="none"
                                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @endif
                                        </td>

                                        <!-- ACTION -->
                                        <td class="px-8 py-6 text-center flex gap-2 justify-center">

                                            <!-- Restore -->
                                            <form action="{{ route('admin.streak.restore', $streak->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl shadow-lg transition-all">
                                                    <i class="fa-solid fa-rotate-left"></i>
                                                </button>
                                            </form>

                                            <!-- Permanent Delete -->
                                            <button @click="confirmPermanentDelete({{ $streak->id }})"
                                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl shadow-lg transition-all">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>

                                            <form id="force-{{ $streak->id }}"
                                                action="{{ route('admin.streak.forceDelete', $streak->id) }}"
                                                method="POST" class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                        </td>

                                    </tr>
                                @empty
                                    <!-- EMPTY STATE -->
                                    <tr>
                                        <td colspan="4" class="text-center py-10 text-gray-400">
                                            Tidak ada data history 🚫
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>

                    </div>

                </div>

            </div>


        </main>
    </div>
    @if (session('success'))
        <div x-data x-init="Swal.fire({
            icon: 'success',
            title: '{{ session('success') }}',
        
            width: '340px',
            padding: '1.8rem',
        
            background: '#ffffff',
            color: '#334155',
        
            confirmButtonText: 'Oke',
            confirmButtonColor: '#4A72D4',
        
            customClass: {
                popup: 'rounded-3xl shadow-xl',
                title: 'text-lg font-bold',
                confirmButton: 'rounded-xl px-6 py-2'
            },
        
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })"></div>
    @endif

    @if (session('error'))
        <div x-data x-init="Swal.fire({
            icon: 'error',
            title: '{{ session('error') }}',
        
            width: '340px',
            padding: '1.8rem',
        
            background: '#ffffff',
            color: '#334155',
        
            confirmButtonText: 'Coba Lagi',
            confirmButtonColor: '#ef4444',
        
            customClass: {
                popup: 'rounded-3xl shadow-xl',
                title: 'text-lg font-bold',
                confirmButton: 'rounded-xl px-6 py-2'
            },
        
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })"></div>
    @endif
</body>

</html>
