<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | PERSISTEN</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.svg') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <div class="max-w-[1440px] mx-auto px-4 md:px-10">

        <main
            class="flex flex-col lg:flex-row items-center lg:items-start justify-center gap-8 md:gap-12 p-6 md:p-10 lg:p-16 mt-6 rounded-[35px] bg-[#E2EDFE] border-2 border-blue-400 mb-10 relative overflow-hidden">

            {{-- Bagian Foto --}}
            <div class="flex flex-col items-center shrink-0 w-full lg:w-auto">
                <div
                    class="w-40 h-40 md:w-52 md:h-52 rounded-full border-[10px] border-white shadow-sm overflow-hidden bg-white relative">
                    <img id="previewPhoto"
                        @if ($user->photo) src="{{ asset('storage/' . $user->photo) }}"  
                @else  
                    src="https://via.placeholder.com/150?text=Belum+ada+foto" @endif
                        alt="Profile" class="w-full h-full object-cover">
                </div>

                <h1 class="text-xl md:text-2xl font-bold text-[#3D4B7A] mt-6 md:mt-10 text-center">Edit Profil</h1>

                <label for="photoInput"
                    class="mt-4 md:mt-6 bg-[#6EB4FF] hover:bg-blue-500 text-white px-5 py-2.5 text-sm rounded-full font-medium flex items-center gap-2 shadow-lg transition-all active:scale-95 cursor-pointer">
                    <i class="fa-solid fa-camera"></i> Ubah Foto
                </label>
            </div>

            {{-- Bagian Form --}}
            <div class="bg-white rounded-[20px] md:rounded-[35px] p-5 md:p-10 shadow-sm w-full border border-white">


                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4 md:space-y-6">
                    @csrf
                    <input type="file" name="photo" id="photoInput" class="hidden">

                    {{-- Nama --}}
                    <div class="space-y-1 md:space-y-2">
                        <label class="block text-[#4A5578] font-semibold text-xs md:text-sm ml-1">Nama Pengguna</label>
                        <div
                            class="flex items-center bg-white rounded-xl md:rounded-2xl border-2 border-[#6EB4FF] overflow-hidden">
                            <div
                                class="bg-[#6EB4FF] px-3 md:px-4 py-2 md:py-3 text-white flex items-center justify-center">
                                <i class="fa-solid fa-user text-sm md:text-lg"></i>
                            </div>
                            <input type="text" name="name" value="{{ $user->name }}"
                                class="w-full px-3 md:px-4 py-2 md:py-3 outline-none text-[#4A5578] text-xs md:text-sm font-medium">
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="space-y-1 md:space-y-2">
                        <label class="block text-[#4A5578] font-semibold text-xs md:text-sm ml-1">Email</label>
                        <div
                            class="flex items-center bg-gray-50 rounded-xl md:rounded-2xl border-2 border-[#6EB4FF] overflow-hidden">
                            <div
                                class="bg-[#6EB4FF] px-3 md:px-4 py-2 md:py-3 text-white flex items-center justify-center">
                                <i class="fa-solid fa-envelope text-sm md:text-lg"></i>
                            </div>
                            <input type="email" value="{{ $user->email }}" readonly
                                class="w-full px-3 md:px-4 py-2 md:py-3 outline-none text-gray-400 text-xs md:text-sm font-medium bg-gray-50 cursor-not-allowed">
                        </div>
                    </div>

                    {{-- Nomor Telepon --}}
                    <div class="space-y-1 md:space-y-2" x-data="{ hp: '{{ $user->no_hp }}', hpError: '' }">
                        <label class="block text-[#4A5578] font-semibold text-xs md:text-sm ml-1">Nomor Telepon</label>
                        <div class="flex items-center bg-white rounded-xl md:rounded-2xl border-2 overflow-hidden transition-all"
                            :class="hpError ? 'border-red-500' : 'border-[#6EB4FF]'">
                            <div class="bg-[#6EB4FF] px-3 md:px-4 py-2 md:py-3 text-white flex items-center justify-center"
                                :class="hpError ? 'bg-red-500' : ''">
                                <i class="fa-solid fa-phone text-sm md:text-lg"></i>
                            </div>
                            <input type="text" name="no_hp" x-model="hp"
                                @input="hp = hp.replace(/[^0-9]/g, ''); hpError = (hp.length > 0 && hp.length < 11) ? 'Minimal 11 digit' : '';"
                                class="w-full px-3 md:px-4 py-2 md:py-3 outline-none text-[#4A5578] text-xs md:text-sm font-medium">
                        </div>
                        <p x-show="hpError" x-text="hpError"
                            class="text-red-500 text-[10px] font-semibold italic ml-2"></p>
                    </div>

                    {{-- Password --}}
                    <div class="space-y-2" x-data="{
                        password: '',
                        confirm: '',
                        passwordError: '',
                        showPassword: false,
                        showConfirm: false,
                    
                        validate() {
                            // kalau dua-duanya kosong → aman
                            if (!this.password && !this.confirm) {
                                this.passwordError = '';
                                return;
                            }
                    
                            // kalau salah satu doang
                            if (!this.password || !this.confirm) {
                                this.passwordError = 'Password dan konfirmasi harus diisi keduanya';
                                return;
                            }
                    
                            // validasi isi password
                            if (this.password.length < 6) {
                                this.passwordError = 'Minimal 6 karakter';
                                return;
                            }
                    
                            if (!/[0-9]/.test(this.password)) {
                                this.passwordError = 'Wajib ada angka';
                                return;
                            }
                    
                            if (!/[^A-Za-z0-9]/.test(this.password)) {
                                this.passwordError = 'Wajib ada simbol (@$!%*#?&)';
                                return;
                            }
                    
                            // cek sama atau tidak
                            if (this.password !== this.confirm) {
                                this.passwordError = 'Konfirmasi password tidak sama';
                                return;
                            }
                    
                            // lolos semua
                            this.passwordError = '';
                        }
                    }">
                        <label class="block text-[#4A5578] font-semibold text-sm ml-1">Kata Sandi (Kosongkan jika tidak
                            diubah)</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">

                            {{-- Input Password Baru --}}
                            <div class="space-y-1">
                                <div class="relative flex items-center bg-white rounded-lg md:rounded-2xl border-2 border-[#6EB4FF] overflow-hidden transition-all"
                                    :class="passwordError ? 'border-red-500' : 'border-[#6EB4FF]'">
                                    <div class="bg-[#6EB4FF] px-2 md:px-4 py-1 md:py-3 text-white flex items-center justify-center"
                                        :class="passwordError ? 'bg-red-500' : ''">
                                        <i class="fa-solid fa-lock text-lg"></i>
                                    </div>
                                    <input :type="showPassword ? 'text' : 'password'" name="password"
                                        x-model="password" @input="validate()" placeholder="kata sandi baru"
                                        class="w-full px-2 md:px-4 py-1 md:py-3 pr-10 outline-none text-[#4A5578] text-xs md:text-sm font-medium placeholder:text-gray-300">

                                    <button type="button" @click="showPassword = !showPassword"
                                        class="absolute right-3 text-gray-400 hover:text-[#6EB4FF] transition-colors">
                                        <i class="fa-solid" :class="showPassword ? 'fa-eye' : 'fa-eye-slash'"></i>
                                    </button>
                                </div>
                                <p x-show="passwordError" x-text="passwordError"
                                    class="text-red-500 text-[10px] md:text-xs font-semibold italic ml-2"></p>
                            </div>

                            {{-- Konfirmasi Password --}}
                            <div
                                class="relative flex items-center bg-white rounded-lg md:rounded-2xl border-2 border-[#6EB4FF] overflow-hidden">
                                <div
                                    class="bg-[#6EB4FF] px-2 md:px-4 py-1 md:py-3 text-white flex items-center justify-center">
                                    <i class="fa-solid fa-lock text-lg"></i>
                                </div>
                                <input :type="showConfirm ? 'text' : 'password'" name="password_confirmation"
                                    x-model="confirm" @input="validate()" placeholder="konfirmasi kata sandi baru"
                                    class="w-full px-2 md:px-4 py-1 md:py-3 pr-10 outline-none text-[#4A5578] text-xs md:text-sm font-medium placeholder:text-gray-300">

                                <button type="button" @click="showConfirm = !showConfirm"
                                    class="absolute right-3 text-gray-400 hover:text-[#6EB4FF] transition-colors">
                                    <i class="fa-solid" :class="showConfirm ? 'fa-eye' : 'fa-eye-slash'"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-end items-center gap-3 md:gap-4 pt-4">
                        <a href="{{ route('profile.index') }}" class="w-full sm:w-auto">
                            <button type="button"
                                class="w-full bg-white border-2 border-gray-200 text-gray-400 font-medium px-8 py-2.5 rounded-full hover:bg-gray-50 text-xs md:text-sm">
                                Batal
                            </button>
                        </a>
                        <button type="submit" :disabled="passwordError"
                            class="w-full sm:w-auto bg-[#6EB4FF] hover:bg-blue-500 text-white px-8 py-3 rounded-full font-medium shadow-lg text-xs md:text-sm transition-all active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
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
