<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Web UTBK</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite('resources/css/app.css')
</head>

<body class="font-poppins bg-white min-h-screen flex flex-col overflow-x-hidden relative">

    <div class="fixed top-1/2 -translate-y-1/2 -right-[20vw] h-[140vh] aspect-square bg-[#4A69BD] rounded-full z-0 hidden lg:block"></div>

    <nav class="relative z-20 w-full pt-8 px-4">
        <div class="max-w-6xl mx-auto flex items-center bg-[#F3F4F6] rounded-full p-1 shadow-sm border border-white">
            <div class="w-40 md:w-52 h-10 bg-[#4A9FFF] rounded-full"></div>
            
            <div class="flex-grow"></div>
            
            <div class="w-24 md:w-32 h-10 bg-[#FFB81C] rounded-full"></div>
        </div>
    </nav>

  <main class="relative z-10 flex-grow flex items-center py-10">
    <div class="max-w-6xl mx-auto w-full px-4">
        
        <div class="bg-[#E8F1FF] w-full rounded-[50px] p-8 md:p-16 shadow-2xl border-4 border-white/60 relative overflow-hidden">
            
            <div class="flex justify-between items-center mb-10">
                <h1 class="text-4xl md:text-6xl font-black text-[#2E3B66]">Daftar</h1>
                
                <a href="{{ route('login.google') }}" 
                    class="flex items-center gap-3 bg-white px-4 py-2 rounded-2xl shadow-sm border border-gray-100">
                    <span class="text-xs font-bold text-gray-400 uppercase leading-none">Daftar dengan</span>
                    <img src="https://www.gstatic.com/images/branding/product/1x/googleg_48dp.png" alt="Google" class="w-6 h-6">
                </a>
            </div>

            {{-- FORM REGISTER --}}
            <form method="POST" action="{{ route('register') }}" class="grid md:grid-cols-2 gap-x-12 gap-y-6">
                @csrf

                {{-- Kolom kiri --}}
                <div class="space-y-6">
                    {{-- Nama --}}
                    <div class="space-y-2">
                        <label class="block text-gray-500 font-bold ml-1">Nama pengguna</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            placeholder="contoh" 
                            class="w-full px-6 py-4 rounded-2xl border-2 border-[#4A9FFF] focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all bg-white">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- No HP --}}
                    <div class="space-y-2">
                        <label class="block text-gray-500 font-bold ml-1">No telepon</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                            placeholder="081234567890" 
                            class="w-full px-6 py-4 rounded-2xl border-2 border-[#4A9FFF] focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all bg-white">
                        @error('no_hp')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Kolom kanan --}}
                <div class="space-y-6">
                    {{-- Email --}}
                    <div class="space-y-2">
                        <label class="block text-gray-500 font-bold ml-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            placeholder="contoh@gmail.com" 
                            class="w-full px-6 py-4 rounded-2xl border-2 border-[#4A9FFF] focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all bg-white">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                   
                     <div x-data="{ showPassword: false, showConfirm: false }" class="space-y-6">
                    <!-- Buat Sandi -->
                    <div class="space-y-2 relative">
                        <label class="block text-gray-500 font-bold ml-1">Buat sandi</label>
                        <input :type="showPassword ? 'text' : 'password'" name="password"
                            placeholder="xxxxxxxx"
                            class="w-full px-6 py-4 rounded-2xl border-2 border-[#4A9FFF] focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all bg-white tracking-widest pr-12">
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <template x-if="!showPassword">
                                <!-- Icon mata tertutup -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-5 0-9-4-9-9 0-1.135.204-2.22.575-3.225M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </template>
                            <template x-if="showPassword">
                                <!-- Icon mata terbuka -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </template>
                        </button>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Konfirmasi Sandi -->
                    <div class="space-y-2 relative">
                        <label class="block text-gray-500 font-bold ml-1">Konfirmasi sandi</label>
                        <input :type="showConfirm ? 'text' : 'password'" name="password_confirmation"
                            placeholder="xxxxxxxx"
                            class="w-full px-6 py-4 rounded-2xl border-2 border-[#4A9FFF] focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all bg-white tracking-widest pr-12">
                        <button type="button" @click="showConfirm = !showConfirm"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <template x-if="!showConfirm">
                                <!-- Icon mata tertutup -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-5 0-9-4-9-9 0-1.135.204-2.22.575-3.225M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </template>
                            <template x-if="showConfirm">
                                <!-- Icon mata terbuka -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
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

                {{-- Tombol --}}
                <div class="md:col-span-2 flex justify-center gap-6 pt-10">
                    {{-- Login --}}
                    <a href="{{ route('login') }}" 
                        class="w-full max-w-[240px] bg-[#FFB81C] text-white font-black py-4 rounded-3xl text-xl shadow-[0_6px_0_0_#d99c16] active:translate-y-1 active:shadow-none transition-all flex items-center justify-center">
                        Masuk
                    </a>

                    {{-- Daftar --}}
                    <button type="submit"
                        class="w-full max-w-[240px] bg-[#4A9FFF] text-white font-black py-4 rounded-3xl text-xl shadow-[0_6px_0_0_#3a86db] active:translate-y-1 active:shadow-none transition-all flex items-center justify-center">
                        Daftar
                    </button>
                </div>

            </form>
        </div>
    </div>
</main>

</body>
</html>