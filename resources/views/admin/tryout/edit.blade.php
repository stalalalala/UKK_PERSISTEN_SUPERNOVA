<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Soal Tryout - Admin | PERSISTEN</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-[#E9EFFF] h-screen overflow-hidden text-[#2D3B61]" x-data="editTryoutForm()">

    <div x-show="showImageModal" x-cloak
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm" x-transition>
        <div class="bg-white w-full max-w-md rounded-[30px] p-8 shadow-2xl" @click.away="showImageModal = false">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-lg text-[#4A72D4]">Tambah Gambar</h3>
                <button type="button" @click="showImageModal = false" class="text-gray-400 hover:text-red-500"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="space-y-6">
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-2">Upload
                        File</label>
                    <label
                        class="flex items-center justify-center w-full h-24 border-2 border-dashed border-blue-100 rounded-2xl bg-blue-50/50 cursor-pointer hover:bg-blue-50 transition-all text-center">
                        <div><i class="fa-solid fa-cloud-arrow-up text-blue-400 text-xl mb-1"></i>
                            <p class="text-[10px] font-bold text-blue-400 uppercase">Pilih File</p>
                        </div>
                        <input type="file" class="hidden" @change="handleImageFile">
                    </label>
                </div>
                <div class="relative flex items-center py-2">
                    <div class="flex-grow border-t border-gray-100"></div><span
                        class="mx-4 text-[10px] font-bold text-gray-300 uppercase">Atau</span>
                    <div class="flex-grow border-t border-gray-100"></div>
                </div>
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-2">Link Gambar
                        (URL)</label>
                    <div class="flex gap-2">
                        <input type="text" x-model="tempImageUrl" placeholder="https://..."
                            class="flex-1 bg-gray-50 rounded-xl py-3 px-4 text-xs outline-none">
                        <button type="button" @click="applyImageUrl"
                            class="bg-[#4A72D4] text-white px-4 rounded-xl text-xs font-bold">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex h-full w-full">
        <aside :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed inset-y-0 left-0 z-50 w-72 bg-[#4A72D4] text-white flex flex-col p-6 shadow-xl transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 shrink-0 h-full">

            <div class="flex items-center justify-between mb-10 px-2">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/logo.svg') }}" alt="Logo" class="w-14 h-14">
                    <h1 class="text-2xl font-bold tracking-tight">P E R S I S T E N</h1>
                </div>
                <button @click="mobileMenuOpen = false" class="lg:hidden p-2 hover:bg-white/10 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <nav
                class="flex-1 space-y-1 overflow-y-auto pr-2 
                [&::-webkit-scrollbar]:w-1 
                [&::-webkit-scrollbar-track]:bg-transparent 
                [&::-webkit-scrollbar-thumb]:bg-white/20 
                [&::-webkit-scrollbar-thumb]:rounded-full">

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

                <a href="{{ route('admin.streak.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 18a3.75 3.75 0 0 0 .495-7.468 5.99 5.99 0 0 0-1.925 3.547 5.975 5.975 0 0 1-2.133-1.001A3.75 3.75 0 0 0 12 18Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen streak</span>
                </a>

                <a href="{{ route('admin.tryout.index') }}" x-init="if (currentPage === 'tryout') { $el.scrollIntoView({ block: 'center' }) }"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left bg-[#D4DEF7]  text-[#2E3B66]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen tryout</span>
                </a>

                <a href="{{ route('admin.kuis.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
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
                    <span class="text-md font-regular">Manajemen latihan
                        soal</span>
                </a>

                <a href="{{ route('admin.videoPembelajaran.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-9">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen video
                        pembelajaran</span>
                </a>

                <a href="{{ route('admin.minatBakat.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                    </svg>
                    <span class="text-md font-regular">Manajemen minat
                        bakat</span>
                </a>



                <a href="{{ route('admin.peluang.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen peluang
                        PTN</span>
                </a>

                <a href="{{ route('admin.laporan.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                    </svg>
                    <span class="text-md font-regular">Monitoring dan
                        laporan</span>
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

        <main class="flex-1 flex flex-col h-full overflow-y-auto custom-scrollbar p-4 lg:p-8">
             <header class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4">
    <div class="flex items-center justify-between w-full lg:w-auto gap-4 lg:order-2">
        <button @click="mobileMenuOpen = true" class="lg:hidden p-3 bg-white rounded-xl shadow-sm shrink-0">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        @php
            use Illuminate\Support\Facades\Auth;
            $user = Auth::user();
            // Mengambil nama depan saja untuk tampilan ringkas di bar
            $firstName = explode(' ', trim($user->name))[0];
        @endphp

        <div x-data="{ open: false }" class="relative flex-1 lg:flex-initial">
            <div @click="open = !open" 
                class="flex items-center justify-between lg:justify-start gap-3 bg-white p-1 pr-4 pl-1 rounded-full shadow-sm cursor-pointer border border-transparent hover:border-blue-100 transition-all w-full lg:w-auto ml-auto">
                
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-gray-100 rounded-full overflow-hidden border-2 border-white shrink-0">
                        <img src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=4A72D4&color=fff' }}" 
                             alt="{{ $user->name }}" class="w-full h-full object-cover">
                    </div>
                    <span class="font-bold text-sm text-gray-700 truncate">{{ $firstName }}</span>
                </div>
                
                <i class="fa-solid fa-chevron-down text-gray-400 text-[10px]"></i>
            </div>

            <div x-show="open" 
                x-cloak
                @click.away="open = false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform scale-95 -translate-y-2"
                x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                class="absolute right-0 mt-3 w-64 bg-white rounded-[20px] shadow-2xl border border-gray-100 z-[100] overflow-hidden">
                
                <div class="p-5 bg-gradient-to-br from-gray-50 to-white border-b border-gray-100">
                    <p class="font-extrabold text-gray-800 leading-tight">{{ $user->name }}</p>
                    <p class="text-[11px] text-gray-400 mt-1 truncate">{{ $user->email }}</p>
                </div>
                
                <div class="p-4 flex flex-col gap-2 bg-white">
                    <div class="flex items-center gap-3 text-xs text-gray-500 p-2 bg-gray-50 rounded-xl border border-gray-100">
                        <i class="fa-solid fa-phone text-blue-400"></i>
                        <span>{{ $user->no_hp ?? 'No HP belum diatur' }}</span>
                    </div>
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
                let search = this.keyword.toLowerCase().trim();
                if(!search) return;
                for (let key in this.routes) {
                    if (key.includes(search)) {
                        window.location.href = this.routes[key];
                        return;
                    }
                }
                alert('Halaman tidak ditemukan');
            }
        }"
        class="relative w-full lg:flex-grow flex items-center gap-2 lg:order-1"
    >
        <div class="relative w-full group">
            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 group-focus-within:text-[#4A72D4] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
            <input 
                type="text" 
                x-model="keyword" 
                placeholder="Cari halaman..." 
                @keydown.enter="goToPage()"
                class="w-full bg-white border-none rounded-full py-3.5 pl-14 pr-4 shadow-sm focus:ring-2 focus:ring-blue-400 outline-none transition-all text-sm placeholder:text-gray-400 font-medium"
            >
        </div>

        <button 
            @click="goToPage()" 
            class="bg-[#4A72D4] hover:bg-blue-600 text-white px-7 py-3.5 rounded-full text-sm font-extrabold shadow-lg shadow-blue-100 transition-all active:scale-95 shrink-0"
        >
            Cari
        </button>
    </div>
</header>
            <form id="formTryout" action="{{ route('admin.tryout.update', $tryout->id) }}" method="POST" @submit.prevent="submitForm">
                @csrf
                @method('PUT')

                <input type="hidden" name="nama_tryout" :value="namaTryout">
                <input type="hidden" name="tanggal" :value="tglMulai">
                <input type="hidden" name="tanggal_akhir" :value="tglSelesai">
                <input type="hidden" name="payload_full_data" id="payload_full_data">

                <div x-show="activeSubtesIndex === null" x-transition>
                    <div class="mb-8 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <button type="button" @click="backToDaftarTryout()"
                                class="p-3 bg-white rounded-xl text-gray-400 hover:text-red-500 shadow-sm border border-blue-50 transition-all">
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>
                            <div>
                                <h2 class="text-2xl font-extrabold text-[#4A72D4]">Panel Edit Tryout</h2>
                                <p class="text-gray-400 text-xs mt-1 italic font-bold tracking-wide">Perbarui data
                                    subtes dan simpan perubahan.</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white p-8 rounded-[35px] shadow-sm mb-8 border border-blue-50 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Nama
                                Tryout *</label>
                            <input type="text" x-model="namaTryout" @input="isDirty = true" required
                                class="w-full bg-gray-50 rounded-2xl py-4 px-6 text-sm outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Mulai
                                *</label>
                            <input type="date" x-model="tglMulai" @input="isDirty = true" required
                                class="w-full bg-gray-50 rounded-2xl py-4 px-6 text-sm outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Selesai
                                *</label>
                            <input type="date" x-model="tglSelesai" @input="isDirty = true" required
                                class="w-full bg-gray-50 rounded-2xl py-4 px-6 text-sm outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <template x-for="(sub, index) in subtesList" :key="index">
                            <div @click="selectSubtes(index)"
                                class="bg-white p-6 rounded-[30px] shadow-sm border-2 border-transparent hover:border-[#4A72D4] cursor-pointer transition-all">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="p-3 rounded-2xl bg-blue-50 text-[#4A72D4]"><i
                                            class="fa-solid fa-book-open"></i></div>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase"
                                        x-text="'Subtes ' + (index + 1)"></span>
                                </div>
                                <h3 class="font-bold text-gray-800 text-sm" x-text="sub.name"></h3>
                                <div class="flex items-center justify-between mt-4">
                                    <p class="text-[10px] text-gray-400">Terisi: <span
                                            class="font-bold text-[#4A72D4]" x-text="sub.soalTerisi"></span>/20</p>
                                    <div class="flex items-center gap-1 text-[10px] font-bold text-orange-500"><i
                                            class="fa-solid fa-clock"></i> <span x-text="sub.waktu + 'm'"></span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div
                        class="mt-12 p-8 bg-white rounded-[35px] border-2 border-dashed border-gray-200 flex flex-col items-center">
                        <button type="button" @click="publikasikan()"
                            class="px-6 py-3 bg-[#4A72D4] text-white rounded-xl font-bold shadow-lg shadow-blue-100 hover:bg-blue-600 transition-all flex items-center gap-2">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>
                </div>

                <div x-show="activeSubtesIndex !== null" x-cloak x-transition>
                    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">

                        <div class="flex items-center gap-4 w-full md:w-auto">
                            <button type="button" @click="activeSubtesIndex = null"
                                class="p-3 bg-white rounded-xl text-gray-400 hover:text-red-500 shadow-sm border border-blue-50 transition-all">
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>
                            <h2 class="text-xl font-extrabold text-[#4A72D4]"
                                x-text="subtesList[activeSubtesIndex]?.name"></h2>
                        </div>

                        <div class="w-full md:w-48 flex flex-col gap-2" x-data="{ open: false }"
                            @click.away="open = false">
                            <div
                                class="bg-white px-4 py-3 rounded-2xl shadow-sm border border-blue-50 flex items-center gap-2 relative h-full">
                                <i class="fa-solid fa-stopwatch text-orange-400 text-sm"></i>

                                <button type="button" @click="open = !open"
                                    class="w-full flex items-center justify-between text-sm font-bold text-gray-700 focus:outline-none">
                                    <span x-text="subtesList[activeSubtesIndex].waktu + ' Menit'"></span>
                                    <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 transition-transform duration-200"
                                        :class="open ? 'rotate-180' : ''"></i>
                                </button>

                                <div x-show="open" x-transition
                                    class="absolute z-50 w-full mt-2 top-full left-0 bg-white border border-blue-50 shadow-xl rounded-2xl overflow-hidden py-2"
                                    style="display: none;">
                                    <template x-for="t in [20,25,30,35,40,45,50,55,60]">
                                        <div @click="subtesList[activeSubtesIndex].waktu = t; open = false"
                                            class="px-4 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-[#4A72D4] cursor-pointer transition-colors font-medium"
                                            x-text="t + ' Menit'">
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2 space-y-6">
                            <div class="bg-white rounded-[30px] p-8 shadow-sm border border-blue-50">
                                <div class="space-y-6">
                                    <div class="space-y-2">
                                        <label
                                            class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Materi
                                            / Teks</label>
                                        <div class="relative">
                                            <textarea id="materi_teks" @input="isDirty = true"
                                                class="w-full bg-gray-50 border-none rounded-[25px] p-6 text-sm outline-none min-h-[120px] resize-none"></textarea>
                                            <div class="absolute right-4 bottom-4">
                                                <button type="button" @click="showImageModal = true"
                                                    @input="isDirty = true"
                                                    class="flex items-center gap-2 bg-white/80 px-4 py-2 rounded-full shadow-sm border cursor-pointer hover:bg-blue-50 transition-all">
                                                    <i class="fa-solid fa-image text-blue-500"></i><span
                                                        class="text-[10px] font-bold uppercase">Gambar</span>
                                                </button>
                                            </div>
                                        </div>
                                        <template x-if="imageUrl">
                                            <div class="mt-2 relative inline-block group">
                                                <img :src="imageUrl"
                                                    class="max-h-32 rounded-xl border-2 border-white shadow-md">
                                                <button type="button" @click="imageUrl = null"
                                                    @input="isDirty = true"
                                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 text-[10px] opacity-0 group-hover:opacity-100 transition-opacity"><i
                                                        class="fa-solid fa-xmark"></i></button>
                                            </div>
                                        </template>
                                    </div>
                                    <div class="space-y-2">
                                        <label
                                            class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Pertanyaan
                                            Nomor <span x-text="activeQuestion"></span> *</label>
                                        <textarea id="pertanyaan_teks" @input="isDirty = true"
                                            class="w-full bg-gray-50 rounded-[25px] p-6 text-sm outline-none min-h-[100px] resize-none"></textarea>
                                    </div>
                                    <div class="grid grid-cols-1 gap-4">
                                        <template x-for="opt in ['A','B','C','D','E']">
                                            <div
                                                class="flex items-start gap-4 p-4 rounded-2xl border-2 bg-gray-50 transition-all">
                                                <span
                                                    class="w-10 h-10 shrink-0 flex items-center justify-center bg-white rounded-xl shadow-sm font-black text-[#4A72D4]"
                                                    x-text="opt"></span>
                                                <textarea :id="'opt_' + opt.toLowerCase()" placeholder="Isi opsi..." @input="isDirty = true"
                                                    class="flex-1 bg-transparent border-none outline-none text-sm pt-2 h-10 resize-none"></textarea>
                                                <input type="radio" name="correct_option" :value="opt"
                                                    class="mt-3 w-5 h-5 accent-emerald-500 cursor-pointer">
                                            </div>
                                        </template>
                                    </div>
                                    <div class="pt-6 border-t">
                                        <label
                                            class="text-[10px] font-bold text-orange-500 uppercase flex items-center gap-2 mb-2 ml-1"><i
                                                class="fa-solid fa-lightbulb"></i> Pembahasan *</label>
                                        <textarea id="pembahasan_teks" @input="isDirty = true"
                                            class="w-full bg-orange-50/30 border-2 border-orange-100 rounded-[25px] p-6 text-sm outline-none min-h-[100px] resize-none"></textarea>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between mt-10">
                                    <button type="button" @click="resetInputForm()"
                                        class="text-xs font-bold text-gray-400 uppercase tracking-widest hover:text-red-500 transition-colors">Reset
                                        Form</button>
                                    <button type="button" @click="simpanSoal()"
                                        class="bg-[#4A72D4] text-white px-10 py-4 rounded-2xl font-bold text-sm shadow-lg hover:-translate-y-1 transition-all">SIMPAN
                                        SOAL</button>
                                </div>
                            </div>
                        </div>

                        <div class="lg:col-span-1">
                            <div
                                class="bg-white p-6 rounded-[30px] shadow-sm border border-blue-50 text-center sticky top-8">
                                <h4 class="text-[10px] font-bold text-gray-400 uppercase mb-6 tracking-widest">Navigasi
                                    Soal</h4>
                                <div class="grid grid-cols-4 gap-2 mb-8">
                                    <template x-for="n in 20">
                                        <button type="button" @click="activeQuestion = n; loadQuestion()"
                                            :class="activeQuestion === n ? 'bg-[#4A72D4] text-white' : (subtesList[
                                                    activeSubtesIndex]?.questions[n - 1] ?
                                                'bg-emerald-500 text-white' : 'bg-gray-50 text-gray-400')"
                                            class="aspect-square rounded-xl border-2 flex items-center justify-center font-bold text-[10px] transition-all"
                                            x-text="n"></button>
                                    </template>
                                </div>
                                <button type="button" @click="activeSubtesIndex = null"
                                    class="w-full py-4 bg-emerald-500 text-white rounded-2xl font-black text-[10px] uppercase shadow-lg">Selesai
                                    Kelola</button>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    </form>
    </main>
    </div>

    <script>
        function editTryoutForm() {
            return {
                mobileMenuOpen: false,
                activeSubtesIndex: null,
                activeQuestion: 1,
                imageUrl: null,
                showImageModal: false,
                tempImageUrl: '',
                showPublishModal: false,
                isDirty: false,

                namaTryout: {!! json_encode($tryout->nama_tryout) !!},
                tglMulai: {!! json_encode($tryout->tanggal->format('Y-m-d')) !!},
                tglSelesai: {!! json_encode($tryout->tanggal_akhir ? $tryout->tanggal_akhir->format('Y-m-d') : '') !!},

                subtesList: {!! json_encode(
                    $tryout->categories->map(function ($cat) {
                        return [
                            'name' => $cat->nama_kategori,
                            'waktu' => (int) $cat->durasi,
                            'soalTerisi' => $cat->soals->count(),
                            'questions' => $cat->soals->map(function ($s) {
                                    return [
                                        'pertanyaan' => $s->pertanyaan ?? '',
                                        'opsi_a' => $s->opsi_a ?? '',
                                        'opsi_b' => $s->opsi_b ?? '',
                                        'opsi_c' => $s->opsi_c ?? '',
                                        'opsi_d' => $s->opsi_d ?? '',
                                        'opsi_e' => $s->opsi_e ?? '',
                                        'jawaban_benar' => $s->jawaban_benar ?? '',
                                        'pembahasan' => $s->pembahasan ?? '',
                                        'materi_teks' => $s->materi_teks ?? '',
                                        'image_url' => $s->image_url ?? null,
                                    ];
                                })->toArray(),
                        ];
                    }),
                ) !!},

                // 🔥 SWEET ALERT BACK
                confirmLeave() {
                    Swal.fire({
                        title: 'Yakin ingin keluar?',
                        text: 'Data tryout yang belum dipublikasikan akan hilang.',
                        icon: 'warning',
                        width: '340px',
                        padding: '1.8rem',
                        showCancelButton: true,
                        confirmButtonColor: '#4A72D4',
                        cancelButtonColor: '#E5E7EB',
                        cancelButtonText: 'Batal',
                        confirmButtonText: 'Ya, keluar',
                        customClass: {
                            popup: 'rounded-3xl shadow-xl',
                            title: 'text-lg font-bold text-gray-800',
                            htmlContainer: 'text-sm text-gray-500',
                            confirmButton: 'rounded-xl px-5 py-2',
                            cancelButton: 'rounded-xl px-5 py-2'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.isDirty = false;
                            localStorage.removeItem('persisten_tryout_edit_backup');
                            window.location.href = '/admin/tryout';
                        }
                    });
                },

                backToDaftarTryout() {
                    if (this.isDirty) {
                        this.confirmLeave();
                    } else {
                        window.location.href = '/admin/tryout';
                    }
                },

                selectSubtes(index) {
                    this.activeSubtesIndex = index;
                    this.activeQuestion = 1;
                    this.imageUrl = null;
                    this.$nextTick(() => {
                        this.loadQuestion();
                    });
                },

                handleImageFile(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.imageUrl = e.target.result;
                            this.showImageModal = false;
                        };
                        reader.readAsDataURL(file);
                    }
                },

                applyImageUrl() {
                    if (this.tempImageUrl.trim() !== '') {
                        this.imageUrl = this.tempImageUrl;
                        this.showImageModal = false;
                        this.tempImageUrl = '';
                    }
                },

                simpanSoal() {
                    let current = this.subtesList[this.activeSubtesIndex];
                    const jaw = document.querySelector("input[name='correct_option']:checked");

                    current.questions[this.activeQuestion - 1] = {
                        materi_teks: document.getElementById('materi_teks').value,
                        pertanyaan: document.getElementById('pertanyaan_teks').value,
                        opsi_a: document.getElementById('opt_a').value,
                        opsi_b: document.getElementById('opt_b').value,
                        opsi_c: document.getElementById('opt_c').value,
                        opsi_d: document.getElementById('opt_d').value,
                        opsi_e: document.getElementById('opt_e').value,
                        jawaban_benar: jaw ? jaw.value : '',
                        pembahasan: document.getElementById('pembahasan_teks').value,
                        image_url: this.imageUrl
                    };

                    current.soalTerisi = current.questions.filter(x => x && x.pertanyaan).length;

                    Swal.fire({
                        icon: 'success',
                        title: 'Tersimpan',
                        text: 'Soal nomor ' + this.activeQuestion
                    });
                },

                loadQuestion() {
                    let current = this.subtesList[this.activeSubtesIndex];
                    let data = current.questions[this.activeQuestion - 1];

                    if (data) {
                        document.getElementById('materi_teks').value = data.materi_teks || '';
                        document.getElementById('pertanyaan_teks').value = data.pertanyaan || '';
                        document.getElementById('opt_a').value = data.opsi_a || '';
                        document.getElementById('opt_b').value = data.opsi_b || '';
                        document.getElementById('opt_c').value = data.opsi_c || '';
                        document.getElementById('opt_d').value = data.opsi_d || '';
                        document.getElementById('opt_e').value = data.opsi_e || '';
                        document.getElementById('pembahasan_teks').value = data.pembahasan || '';
                        this.imageUrl = data.image_url || null;

                        document.getElementsByName('correct_option')
                            .forEach(r => r.checked = (r.value === data.jawaban_benar));
                    } else {
                        this.resetInputForm();
                    }
                },

                resetInputForm() {
                    ['materi_teks', 'pertanyaan_teks', 'opt_a', 'opt_b', 'opt_c', 'opt_d', 'opt_e', 'pembahasan_teks']
                    .forEach(id => {
                        const el = document.getElementById(id);
                        if (el) el.value = '';
                    });

                    this.imageUrl = null;
                    document.getElementsByName('correct_option')
                        .forEach(r => r.checked = false);
                },

                submitForm() {
                    this.isDirty = false;
                    localStorage.removeItem('persisten_tryout_edit_backup');
                    document.getElementById('payload_full_data').value = JSON.stringify(this.subtesList);
                    document.getElementById('formTryout').submit();
                },

                saveToLocal() {
                    const dataToSave = {
                        subtesList: this.subtesList,
                        namaTryout: this.namaTryout,
                        tglMulai: this.tglMulai,
                        tglSelesai: this.tglSelesai
                    };
                    localStorage.setItem('persisten_tryout_edit_backup', JSON.stringify(dataToSave));
                },

                publikasikan() {
                    this.showPublishModal = true;
                },

                confirmPublikasikan() {
                    this.isDirty = false;
                    localStorage.removeItem('persisten_tryout_edit_backup');
                    document.getElementById('payload_full_data').value = JSON.stringify(this.subtesList);
                    document.getElementById('formTryout').submit();
                },

                init() {
                    const saved = localStorage.getItem('persisten_tryout_edit_backup');
                    if (saved) {
                        const data = JSON.parse(saved);
                        this.subtesList = data.subtesList;
                        this.namaTryout = data.namaTryout;
                        this.tglMulai = data.tglMulai;
                        this.tglSelesai = data.tglSelesai;
                        this.isDirty = true;
                    }

                    this.$watch('subtesList', () => {
                        this.isDirty = true;
                        this.saveToLocal();
                    });
                    this.$watch('namaTryout', () => {
                        this.isDirty = true;
                        this.saveToLocal();
                    });
                    this.$watch('tglMulai', () => {
                        this.isDirty = true;
                        this.saveToLocal();
                    });
                    this.$watch('tglSelesai', () => {
                        this.isDirty = true;
                        this.saveToLocal();
                    });

                    history.pushState(null, null, window.location.href);

                    window.onpopstate = () => {
                        if (this.isDirty) {
                            history.pushState(null, null, window.location.href);
                            this.confirmLeave();
                        } else {
                            window.location.href = '/admin/tryout';
                        }
                    };
                }
            }
        }
    </script>

    {{-- MODAL PUBLIKASI --}}
    <div x-show="showPublishModal" x-cloak class="fixed inset-0 z-[180] flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="showPublishModal = false"></div>

        <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full relative z-[181] text-center shadow-2xl border border-blue-50"
            x-show="showPublishModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95">

            <div
                class="w-20 h-20 bg-blue-100 text-[#4A72D4] rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>

            <h3 class="text-xl font-black text-[#2E3B66] mb-2">Simpan Perubahan?</h3>
            <p class="text-gray-500 text-sm mb-8">Data tryout akan diperbarui sesuai dengan perubahan terbaru yang
                dibuat.</p>

            <div class="flex gap-3">
                <button type="button" @click="showPublishModal = false"
                    class="flex-1 py-3 rounded-xl font-bold bg-gray-100 text-gray-500 hover:bg-gray-200 transition-all">
                    Batal
                </button>
                <button type="button" @click="confirmPublikasikan()"
                    class="flex-1 py-3 rounded-xl font-bold bg-[#4A72D4] text-white shadow-lg shadow-blue-100 hover:bg-blue-600 transition-all">
                    Ya, Simpan
                </button>
            </div>
        </div>
    </div>
</body>

</html>
