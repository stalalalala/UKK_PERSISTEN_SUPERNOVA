<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERSISTEN - Edit Profile</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite('resources/css/app.css')
</head>

<body class="bg-white font-po overflow-x-hidden">

    <div class="max-w-[1440px] mx-auto" x-data="{ open: false }">
       <nav class="flex justify-between items-center bg-gray-100 rounded-full mx-4 md:mx-10 mt-4 relative z-10">
            <div class="w-20 md:w-28 h-12 bg-blue-400 rounded-full flex-shrink-0"></div>

            <ul class="hidden lg:flex gap-12 text-gray-800 font-medium text-sm">
                <li><a href="/" class=" hover:text-blue-500">Beranda</a></li>
                <li><a href="{{ route('streak.index') }}" class="hover:text-blue-500">Pet Streak</a></li>
                <li><a href="{{ route('tryout.index') }}" class="hover:text-blue-500">Try Out</a></li>
                <li><a href="{{ route('latihan.index') }}" class="hover:text-blue-500">Latihan Soal</a></li>
                <li><a href="{{ route('video.index') }}" class="hover:text-blue-500">Video Pembelajaran</a></li>
            </ul>

            <div class="flex items-center gap-2">
                <div class="flex items-center gap-2 bg-[#FBBA16] rounded-full">
                    <a href="{{ route('profile.index') }}"
                        class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#3171CD] flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-5 md:size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline" id="logout-form">
                        @csrf
                        <button type="submit" 
                                class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#4B8A81] flex items-center justify-center text-white hover:bg-red-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                            </svg>
                        </button>
                    </form>
                </div>

                <button @click="open = true"
                    class="lg:hidden p-2 text-gray-600 hover:bg-gray-200 rounded-full transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </nav>

        <div x-show="open" class="fixed inset-0 z-[100] flex items-center justify-center p-4" style="display: none;">
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="open = false"
                class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                class="relative bg-white rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Menu Utama</h2>
                    <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <ul class="space-y-3">
                    <li><a href="/"
                            class="block text-center py-3 px-4 bg-gray-50 rounded-xl font-semibold text-gray-700 hover:bg-blue-500 hover:text-white transition">Beranda</a>
                    </li>
                    <li><a href="{{ route('streak.index') }}"
                            class="block text-center py-3 px-4 bg-gray-50 rounded-xl font-semibold text-gray-700 hover:bg-blue-500 hover:text-white transition">Pet
                            Streak</a></li>
                    <li><a href="{{ route('tryout.index') }}"
                            class="block text-center py-3 px-4 bg-gray-50 rounded-xl font-semibold text-gray-700 hover:bg-blue-500 hover:text-white transition">Try
                            Out</a></li>
                    <li><a href="{{ route('latihan.index') }}"
                            class="block text-center py-3 px-4 bg-gray-50 rounded-xl font-semibold text-gray-700 hover:bg-blue-500 hover:text-white transition">Latihan
                            Soal</a></li>
                    <li><a href="{{ route('video.index') }}"
                            class="block text-center py-3 px-4 bg-gray-50 rounded-xl font-semibold text-gray-700 hover:bg-blue-500 hover:text-white transition">Video
                            Pembelajaran</a></li>
                </ul>
            </div>
        </div>
    </div>

  <main class="max-w-[1440px] mx-auto flex flex-col md:flex-row items-center justify-center gap-8 md:gap-12 p-8 md:p-10 mt-6 rounded-[35px] bg-[#E2EDFE] border-2 border-blue-400 mx-4 md:mx-10 mb-10 relative overflow-hidden">

    {{-- Bagian Foto --}}
    <div class="flex flex-col items-center shrink-0">
    <div class="w-44 h-44 md:w-52 md:h-52 rounded-full border-[10px] border-white shadow-sm overflow-hidden bg-white relative">
        <img id="previewPhoto"  
            @if($user->photo) 
                src="{{ asset('storage/'.$user->photo) }}"  
            @else  
                src="https://via.placeholder.com/150?text=Belum+ada+foto"  
            @endif  
            alt="Profile" class="w-full h-full object-cover">
    </div>

    <h1 class="text-2xl font-bold text-[#3D4B7A] mt-8 md:mt-10 text-center">Edit Profil</h1>

    <label for="photoInput"
        class="mt-6 bg-[#6EB4FF] hover:bg-blue-500 text-white px-5 py-2.5 text-sm rounded-full font-medium flex items-center gap-2 shadow-lg transition-all active:scale-95 cursor-pointer">
        <i class="fa-solid fa-camera"></i> Ubah Foto
    </label>
</div>

{{-- Bagian Form --}}
<div class="bg-white rounded-[20px] md:rounded-[35px] p-6 md:p-10 shadow-sm w-full border border-white">
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        {{ session('error') }}
    </div>
@endif
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Input file HARUS di dalam form --}}
        <input type="file" name="photo" id="photoInput" class="hidden">


            {{-- Nama --}}
            <div class="space-y-2">
                <label class="block text-[#4A5578] font-semibold text-sm ml-1">Nama Pengguna</label>
                <div class="flex items-center bg-white rounded-lg md:rounded-2xl border-2 border-[#6EB4FF] overflow-hidden">
                    <div class="bg-[#6EB4FF] px-2 md:px-4 py-1 md:py-3 text-white flex items-center justify-center">
                        <i class="fa-solid fa-user text-lg"></i>
                    </div>
                    <input type="text" name="name" value="{{ $user->name }}" class="w-full px-2 md:px-4 py-1 md:py-3 outline-none text-[#4A5578] text-xs md:text-sm font-medium placeholder:text-gray-300">
                </div>
            </div>

            {{-- Email --}}
            <div class="space-y-2">
                <label class="block text-[#4A5578] font-semibold text-sm ml-1">Email</label>
                <div class="flex items-center bg-white rounded-lg md:rounded-2xl border-2 border-[#6EB4FF] overflow-hidden">
                    <div class="bg-[#6EB4FF] px-2 md:px-4 py-1 md:py-3 text-white flex items-center justify-center">
                        <i class="fa-solid fa-envelope text-lg"></i>
                    </div>
                    <input type="email" value="{{ $user->email }}" readonly class="w-full px-2 md:px-4 py-1 md:py-3 outline-none text-gray-400 text-xs md:text-sm font-medium bg-gray-50">
                </div>
            </div>

            {{-- Nomor Telepon --}}
            <div class="space-y-2">
                <label class="block text-[#4A5578] font-semibold text-sm ml-1">Nomor Telepon</label>
                <div class="flex items-center bg-white rounded-lg md:rounded-2xl border-2 border-[#6EB4FF] overflow-hidden">
                    <div class="bg-[#6EB4FF] px-2 md:px-4 py-1 md:py-3 text-white flex items-center justify-center">
                        <i class="fa-solid fa-phone text-lg"></i>
                    </div>
                    <input type="text" name="no_hp" value="{{ $user->no_hp }}" class="w-full px-2 md:px-4 py-1 md:py-3 outline-none text-[#4A5578] text-xs md:text-sm font-medium placeholder:text-gray-300">
                </div>
            </div>

            {{-- Password --}}
            <div class="space-y-2">
                <label class="block text-[#4A5578] font-semibold text-sm ml-1">Kata Sandi</label>
                <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="flex items-center bg-white rounded-lg md:rounded-2xl border-2 border-[#6EB4FF] overflow-hidden">
                        <div class="bg-[#6EB4FF] px-2 md:px-4 py-1 md:py-3 text-white flex items-center justify-center">
                            <i class="fa-solid fa-lock text-lg"></i>
                        </div>
                        <input type="password" name="password" placeholder="kata sandi baru" class="w-full px-2 md:px-4 py-1 md:py-3 outline-none text-[#4A5578] text-xs md:text-sm font-medium placeholder:text-[#AAB4D1]">
                    </div>
                    <div class="flex items-center bg-white rounded-lg md:rounded-2xl border-2 border-[#6EB4FF] overflow-hidden">
                        <div class="bg-[#6EB4FF] px-2 md:px-4 py-1 md:py-3 text-white flex items-center justify-center">
                            <i class="fa-solid fa-lock text-lg"></i>
                        </div>
                        <input type="password" name="password_confirmation" placeholder="konfirmasi kata sandi baru" class="w-full px-2 md:px-4 py-1 md:py-3 outline-none text-[#4A5578] text-xs md:text-sm font-medium placeholder:text-[#AAB4D1]">
                    </div>
                </div>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end items-center text-xs md:text-sm gap-4 pt-4">
                <a href="{{ route('profile.index') }}">
                    <button type="button" class="bg-white border-2 border-gray-200 text-gray-400 font-medium px-8 py-2.5 rounded-full hover:bg-gray-50 transition-all">
                        Batal
                    </button>
                </a>
                <button type="submit" class="bg-[#6EB4FF] hover:bg-blue-500 text-white px-8 py-3 rounded-full font-medium shadow-lg shadow-blue-200 transition-all active:scale-95">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</main>

    <script>
    const photoInput = document.getElementById('photoInput');
    const previewPhoto = document.getElementById('previewPhoto');

    photoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewPhoto.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>

</body>

</html>
