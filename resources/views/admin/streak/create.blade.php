<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karakter Streak</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
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




        @keyframes float {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-10px)
            }
        }

        @keyframes wiggle {

            0%,
            100% {
                transform: rotate(-5deg)
            }

            50% {
                transform: rotate(5deg)
            }
        }
    </style>
</head>

<script>
    function streakPageGuard() {

        return {

            allowLeave: false,

            init() {

                // trap tombol back browser
                history.pushState(null, null, location.href)

                window.addEventListener('popstate', () => {

                    if (!this.allowLeave) {

                        this.confirmLeave()

                        history.pushState(null, null, location.href)

                    }

                })

            },

            confirmLeave() {

                Swal.fire({
                    title: "Kembali ke halaman daftar?",
                    text: "Karakter streak yang sedang dibuat akan hilang.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#4A72D4",
                    cancelButtonColor: "#9CA3AF",
                    confirmButtonText: "Ya, kembali",
                    cancelButtonText: "Tetap di sini"
                }).then((result) => {

                    if (result.isConfirmed) {

                        this.allowLeave = true
                        window.location.href = "{{ route('admin.streak.index') }}"

                    }

                })

            }

        }

    }
</script>

<body class="bg-[#F4F7FF] text-[#2D3B61] overflow-hidden" x-data="{ ...streakPageGuard(), activeMenu: 'Manajemen Streak', mobileMenuOpen: false }" x-init="init()">

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
        <main class="flex-1 main-content p-6 lg:p-10 bg-[#F8FAFC]">
            <header class="flex flex-col md:flex-row items-center justify-between pb-4 gap-4 flex-shrink-0">
                <div class="flex items-center w-full gap-4">
                    <button @click="mobileMenuOpen = true" class="lg:hidden p-3 bg-white rounded-xl shadow-sm">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

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
                        goToPage() {
                            let search = this.keyword.toLowerCase()
                    
                            for (let key in this.routes) {
                                if (key.includes(search)) {
                                    window.location.href = this.routes[key]
                                    return
                                }
                            }
                    
                            alert('Halaman tidak ditemukan')
                        }
                    }" class="relative w-full group flex items-center gap-2">

                        <div class="relative w-full">

                            <!-- ICON -->
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </div>

                            <input type="text" x-model="keyword" placeholder="Cari halaman..."
                                @keydown.enter="goToPage()"
                                class="w-full bg-white border-none rounded-full py-3 pl-12 pr-4 shadow-sm focus:ring-2 focus:ring-blue-400 outline-none transition-all">
                        </div>

                        <button @click="goToPage()"
                            class="bg-[#4A72D4] hover:bg-blue-600 text-white px-6 py-3 rounded-full text-sm font-medium shadow-sm transition-all active:scale-95 shrink-0">
                            Cari
                        </button>

                    </div>
                </div>

                @php
                    use Illuminate\Support\Facades\Auth;
                    $user = Auth::user();
                @endphp
                <div x-data="{ open: false }" class="relative flex w-full md:w-auto md:inline-block">

                    <div @click="open = !open"
                        class="flex items-center gap-3 bg-white p-1 pr-4 pl-1 rounded-full shadow-sm shrink-0 
                                ml-auto md:ml-0 cursor-pointer">

                        <div class="w-10 h-10 bg-gray-200 rounded-full overflow-hidden border-2 border-white">
                            <img src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=Admin&background=random' }}"
                                alt="Admin">
                        </div>

                        <span class="font-bold text-sm hidden sm:block text-gray-700">Admin</span>

                        <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
                    </div>

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

            <div class="w-full mx-auto">


                <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
                    <div>
                        {{-- <nav
                            class="flex items-center gap-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                            <a href="#" class="hover:text-[#4A72D4] transition-colors">Admin</a>
                            <span>/</span>
                            <a href="#" class="hover:text-[#4A72D4] transition-colors">Streak System</a>
                            <span>/</span>
                            <span class="text-gray-600">Tambah Karakter</span>
                        </nav> --}}
                        <h1 class="text-2xl font-extrabold text-[#4A72D4] tracking-tight">
                            Tambah Karakter Streak
                        </h1>
                        @if ($errors->any())
                            <div class="mb-5 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-xl">
                                <p class="font-bold">Terjadi Kesalahan:</p>
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <p class="text-gray-400 text-sm mt-1 shadow-sm-none">Tentukan parameter visual dan ambang batas
                            level
                            untuk karakter baru.</p>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.streak.index') }}" @click.prevent="confirmLeave()"
                            class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 bg-white font-bold text-sm hover:bg-gray-50 transition-all">
                            Batal
                        </a>
                    </div>
                </div>

                <form action="{{ route('admin.streak.store') }}" @submit="allowLeave = true" method="POST"
                    enctype="multipart/form-data" x-data="streakForm()" x-init="init()">
                    @csrf

                    <div class="space-y-8">

                        <div class="lg:col-span-7 space-y-6">

                            <div
                                class="bg-white rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100/50 p-8 overflow-hidden relative">

                                <div class="flex items-center gap-4 mb-8">
                                    <div
                                        class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-[#4A72D4]">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h2 class="text-lg font-bold text-gray-800">Identitas Karakter</h2>
                                        <p class="text-xs text-gray-400">Nama dan batasan akses level pengguna.</p>
                                    </div>
                                </div>

                                <div class="space-y-5">
                                    <div class="group">
                                        <label
                                            class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2 ml-1 group-focus-within:text-[#4A72D4] transition-colors">Nama
                                            Karakter</label>
                                        <input type="text" name="nama" x-model="form.nama" required
                                            class="w-full bg-gray-50/50 border border-gray-200 rounded-2xl px-5 py-4 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-[#4A72D4] transition-all outline-none text-gray-700 font-medium"
                                            placeholder="John Doe">
                                    </div>

                                    <div class="group">
                                        <label
                                            class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2 ml-1 group-focus-within:text-[#4A72D4] transition-colors">Minimum
                                            Level</label>
                                        <div class="relative">
                                            <input type="number" name="min_level" x-model="form.min_level" required
                                                min="1"
                                                class="w-full bg-gray-50/50 border border-gray-200 rounded-2xl pl-5 pr-14 py-4 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-[#4A72D4] transition-all outline-none text-gray-700 font-medium"
                                                placeholder="1">
                                            <div
                                                class="absolute right-4 top-1/2 -translate-y-1/2 px-3 py-1 bg-white border border-gray-100 rounded-lg text-[10px] font-black text-gray-400 shadow-sm">
                                                LVL</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-8 items-start">

                                <!-- KOLOM KIRI -->
                                <div
                                    class="bg-white rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100/50 p-8">

                                    <!-- HEADER -->
                                    <div class="flex items-center gap-4 mb-8">
                                        <div
                                            class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-500">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-bold text-gray-800">Visual & Motion</h2>
                                            <p class="text-xs text-gray-400">Upload asset vektor dan tentukan perilaku
                                                animasi.</p>
                                        </div>
                                    </div>

                                    <!-- 🔥 GRID DI DALAM CARD -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                                        <!-- KOLOM 1 -->
                                        <div class="space-y-6">

                                            <!-- UPLOAD -->
                                            <div
                                                class="bg-white rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100/50 p-8">

                                                <!-- TITLE -->
                                                <div class="flex items-center gap-4 mb-4">
                                                    <div
                                                        class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-[#4A72D4]">
                                                        🎨
                                                    </div>
                                                    <div>
                                                        <h2 class="text-lg font-bold text-gray-800">SVG Karakter</h2>
                                                        <p class="text-xs text-gray-400">
                                                            Upload aset visual karakter dalam format SVG
                                                        </p>
                                                    </div>
                                                </div>

                                                <!-- 🔥 INFO BOX -->
                                                <div
                                                    class="mb-6 p-4 rounded-xl bg-blue-50 border border-blue-100 text-xs text-blue-700 leading-relaxed">
                                                    <ul class="space-y-1">
                                                        <li>• Format wajib: <span class="font-semibold">.svg</span>
                                                        </li>
                                                        <li>• Disarankan ukuran: <span class="font-semibold">1:1
                                                                (square)</span></li>
                                                        <li>• Maksimal size: <span class="font-semibold">2MB</span>
                                                        </li>
                                                        <li>• Gunakan <span class="font-semibold">vector clean (tanpa
                                                                background)</span></li>
                                                        <li>• SVG akan digunakan sebagai <span
                                                                class="font-semibold">tampilan karakter utama</span>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <!-- UPLOAD AREA -->
                                                <div
                                                    class="relative group border-2 border-dashed border-gray-200 hover:border-[#4A72D4] hover:bg-blue-50/30 rounded-[1.5rem] p-8 text-center transition-all">

                                                    <input type="file" name="svg_static" accept=".svg"
                                                        @change="previewSvg($event, 'normal')"
                                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">

                                                    <div class="space-y-3">
                                                        <div
                                                            class="w-14 h-14 bg-white shadow-sm border border-gray-100 rounded-2xl flex items-center justify-center mx-auto text-xl">
                                                            +
                                                        </div>

                                                        <p class="text-sm font-bold text-gray-700">
                                                            Upload SVG
                                                        </p>

                                                        <p class="text-xs text-gray-400">
                                                            Klik atau drag file ke sini
                                                        </p>
                                                    </div>
                                                </div>

                                                <!-- OPTIONAL ERROR (Laravel Validation) -->
                                                @error('svg')
                                                    <p class="text-xs text-red-500 mt-3">{{ $message }}</p>
                                                @enderror

                                            </div>

                                            <!-- PREVIEW -->
                                            <div class="bg-gray-900 rounded-xl p-3 shadow-2xl">
                                                <div class="bg-[#1A1C1E] rounded-[2rem] p-6">
                                                    <p class="text-xs text-gray-400 mb-4 uppercase text-center">
                                                        Static Preview
                                                    </p>

                                                    <div
                                                        class="aspect-square bg-[#0D0F10] rounded-2xl flex items-center justify-center">
                                                        <template x-if="svgPreview">
                                                            <img :src="svgPreview" :class="animationClass"
                                                                class="w-72 h-72 object-contain">
                                                        </template>

                                                        <div x-show="!svgPreview" class="text-gray-500 text-xs">
                                                            Belum ada SVG
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- KOLOM 2 -->
                                        <div class="space-y-6">

                                            <!-- UPLOAD -->
                                            <div
                                                class="bg-white rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100/50 p-8">

                                                <!-- TITLE -->
                                                <div class="flex items-center gap-4 mb-4">
                                                    <div
                                                        class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-500">
                                                        ✨
                                                    </div>
                                                    <div>
                                                        <h2 class="text-lg font-bold text-gray-800">SVG Animasi</h2>
                                                        <p class="text-xs text-gray-400">
                                                            Versi karakter dengan efek animasi (opsional)
                                                        </p>
                                                    </div>
                                                </div>

                                                <!-- INFO -->
                                                <div
                                                    class="mb-6 p-4 rounded-xl bg-purple-50 border border-purple-100 text-xs text-purple-700 leading-relaxed">
                                                    <ul class="space-y-1">
                                                        <li>• Format wajib: <span class="font-semibold">.svg</span>
                                                        </li>
                                                        <li>• Disarankan ukuran: <span class="font-semibold">1:1
                                                                (square)</span></li>
                                                        <li>• Maksimal size: <span class="font-semibold">2MB</span>
                                                        </li>
                                                        <li>• Disarankan sudah memiliki <span
                                                                class="font-semibold">animasi bawaan (SVG
                                                                animate)</span></li>

                                                        <li>• Gunakan <span class="font-semibold">vector clean (tanpa
                                                                background)</span></li>

                                                    </ul>
                                                </div>

                                                <!-- UPLOAD -->
                                                <div
                                                    class="relative group border-2 border-dashed border-gray-200 hover:border-purple-400 hover:bg-purple-50/30 rounded-[1.5rem] p-8 text-center transition-all">

                                                    <input type="file" name="svg_animated" accept=".svg"
                                                        @change="previewSvg($event, 'animasi')"
                                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">

                                                    <div class="space-y-3">
                                                        <div
                                                            class="w-14 h-14 bg-white shadow-sm border border-gray-100 rounded-2xl flex items-center justify-center mx-auto text-xl">
                                                            ✨
                                                        </div>

                                                        <p class="text-sm font-bold text-gray-700">
                                                            Upload SVG Animasi
                                                        </p>

                                                        <p class="text-xs text-gray-400">
                                                            Klik atau drag file ke sini
                                                        </p>
                                                    </div>
                                                </div>

                                                <!-- ERROR -->
                                                @error('svg_animasi')
                                                    <p class="text-xs text-red-500 mt-3">{{ $message }}</p>
                                                @enderror

                                            </div>

                                            <!-- PREVIEW -->
                                            <div class="bg-gray-900 rounded-xl p-3 shadow-2xl">
                                                <div class="bg-[#1A1C1E] rounded-[2rem] p-6">
                                                    <p class="text-xs text-gray-400 mb-4 uppercase text-center">
                                                        Animasi Preview
                                                    </p>

                                                    <div
                                                        class="aspect-square bg-[#0D0F10] rounded-2xl flex items-center justify-center">
                                                        <template x-if="svgPreviewAnimasi">
                                                            <img :src="svgPreviewAnimasi" :class="animationClass"
                                                                class="w-72 h-72 object-contain">
                                                        </template>

                                                        <div x-show="!svgPreviewAnimasi"
                                                            class="text-gray-500 text-xs">
                                                            Belum ada SVG
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>


                            </div>

                        </div>


                    </div>
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-[#4A72D4] hover:bg-[#3b5eb8] text-white rounded-2xl py-4 font-black text-lg shadow-xl">
                            Simpan Karakter
                        </button>
                    </div>
            </div>
            </form>
    </div>
    </main>
    </div>
    <script>
        function streakForm() {
            return {
                svgPreview: null,
                svgPreviewAnimasi: null,
                animation: '',
                form: {
                    nama: '',
                    min_level: ''
                },

                init() {
                    // restore form
                    const saved = localStorage.getItem('streakForm')
                    if (saved) {
                        this.form = JSON.parse(saved)
                    }

                    // restore preview SVG
                    const svg = localStorage.getItem('svgPreview')
                    if (svg) {
                        this.svgPreview = svg
                    }

                    const svgAnim = localStorage.getItem('svgPreviewAnimasi')
                    if (svgAnim) {
                        this.svgPreviewAnimasi = svgAnim
                    }

                    // auto save form
                    this.$watch('form', (value) => {
                        localStorage.setItem('streakForm', JSON.stringify(value))
                    }, {
                        deep: true
                    })
                },

                previewSvg(event, type) {
                    const file = event.target.files[0]

                    if (file) {
                        const reader = new FileReader()

                        reader.onload = (e) => {
                            const base64 = e.target.result

                            if (type === 'normal') {
                                this.svgPreview = base64
                                localStorage.setItem('svgPreview', base64)
                            }

                            if (type === 'animasi') {
                                this.svgPreviewAnimasi = base64
                                localStorage.setItem('svgPreviewAnimasi', base64)
                            }
                        }

                        reader.readAsDataURL(file)
                    }
                },

                get animationClass() {
                    if (!this.animation) return ''
                    return 'animate-' + this.animation
                }
            }
        }
    </script>

</body>

</html>
