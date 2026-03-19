<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Web UTBK</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite('resources/css/app.css')
</head>

<body class="font-poppins bg-white min-h-screen flex flex-col overflow-x-hidden relative">

    <div class="fixed top-1/2 -translate-y-1/2 -right-[40vw] lg:-right-[20vw] h-[100vh] lg:h-[140vh] aspect-square bg-[#4A69BD] rounded-full z-0 opacity-20 lg:opacity-100"></div>

    <nav class="relative z-30 w-full pt-6 px-4">
        <div class="max-w-6xl mx-auto flex items-center bg-[#F3F4F6]/80 backdrop-blur-md rounded-full shadow-sm border border-white">
            <div class="w-24 md:w-28 h-8 md:h-9 bg-[#4A9FFF] rounded-full mx-4"></div>
            <div class="flex-grow"></div>
            <div class="w-16 md:w-20 h-8 md:h-9 bg-[#FFB81C] rounded-full mx-4"></div>
        </div>
    </nav>

    <main class="relative z-10 flex-grow flex items-center py-6 md:py-10">
        <div class="max-w-6xl mx-auto w-full px-4">
            
            <div class="bg-[#E8F1FF] w-full rounded-[30px] md:rounded-[50px] p-6 md:p-12 lg:p-16 shadow-2xl border-4 border-white/60 relative overflow-hidden">
                
                <div class="flex justify-between items-center mb-8 md:mb-10 gap-2">
                <h1 class="text-3xl sm:text-4xl md:text-6xl font-black text-[#2E3B66] leading-none">Daftar</h1>
                
                <a href="{{ route('login.google') }}" 
                    class="flex items-center gap-3 bg-white p-2.5 md:px-4 md:py-2 rounded-xl md:rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all group">
                    <span class="hidden md:block text-xs font-bold text-gray-400 uppercase leading-none">Daftar dengan</span>
                    <img src="https://www.gstatic.com/images/branding/product/1x/googleg_48dp.png" alt="Google" class="w-6 h-6 md:w-6 md:h-6 group-hover:scale-110 transition-transform">
                </a>
            </div>

                {{-- FORM REGISTER --}}
                <form method="POST" action="{{ route('register') }}" class="grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-5 md:gap-y-6">
                    @csrf

                    {{-- Kolom kiri --}}
                    <div class="space-y-5 md:space-y-6">
                        {{-- Nama --}}
                        <div class="space-y-2">
                            <label class="block text-gray-500 font-bold ml-1 text-sm md:text-base">Nama pengguna</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                placeholder="contoh"
                                autocomplete="off" 
                                class="w-full px-5 py-3.5 md:px-6 md:py-4 rounded-2xl border-2 border-[#4A9FFF] focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all bg-white text-sm md:text-base">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1 ml-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- No HP --}}
                        <div class="space-y-2" x-data="{ hp: '{{ old('no_hp') }}', hpError: '' }">
                            <label class="block text-gray-500 font-bold ml-1 text-sm md:text-base">No telepon</label>
                            
                            <input type="text" 
                                name="no_hp" 
                                placeholder="081234567890" 
                                x-model="hp"
                                @input="
                                    hp = hp.replace(/[^0-9]/g, ''); 
                                    if (hp.length > 0 && hp.length < 11) {
                                        hpError = 'Minimal 11 digit (Baru: ' + hp.length + ')';
                                    } else {
                                        hpError = '';
                                    }
                                "
                                class="w-full px-5 py-3.5 md:px-6 md:py-4 rounded-2xl border-2 transition-all bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 text-sm md:text-base"
                                :class="hpError ? 'border-red-500' : 'border-[#4A9FFF]'">

                            <p x-show="hpError" x-text="hpError" class="text-red-500 text-xs mt-1 ml-2 font-semibold italic"></p>
                            
                            @error('no_hp')
                                <p class="text-red-500 text-xs mt-1 ml-2 font-semibold italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Kolom kanan --}}
                    <div class="space-y-5 md:space-y-6">
                        {{-- Email --}}
                        <div class="space-y-2">
                            <label class="block text-gray-500 font-bold ml-1 text-sm md:text-base">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                placeholder="contoh@gmail.com"
                                autocomplete="off" 
                                class="w-full px-5 py-3.5 md:px-6 md:py-4 rounded-2xl border-2 border-[#4A9FFF] focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all bg-white text-sm md:text-base">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1 ml-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div x-data="{ showPassword: false, showConfirm: false }" class="space-y-5 md:space-y-6">
                            {{-- Password --}}
                            <div x-data="{ password: '', passwordError: '' }" class="space-y-2">
                                <label class="block text-gray-500 font-bold ml-1 text-sm md:text-base">Buat sandi</label>
                                
                                <div class="relative">
                                    <input :type="showPassword ? 'text' : 'password'" 
                                        name="password"
                                        placeholder="xxxxxxxx"
                                        autocomplete="new-password"
                                        x-model="password"
                                        @input="
                                            passwordError = (password.length < 6) ? 'Minimal 6 karakter' : 
                                                            (!/[0-9]/.test(password)) ? 'Wajib ada angka' : 
                                                            (!/[^A-Za-z0-9]/.test(password)) ? 'Wajib ada simbol(@$!%*#?&)' : '';
                                        "
                                        class="w-full px-5 py-3.5 md:px-6 md:py-4 rounded-2xl border-2 border-[#4A9FFF] focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all bg-white pr-12 text-sm md:text-base">
                                    
                                    <button type="button" @click="showPassword = !showPassword"
                                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 focus:outline-none hover:text-[#4A9FFF] transition-colors">
                                        <i class="fa-solid text-lg" :class="showPassword ? 'fa-eye' : 'fa-eye-slash'"></i>
                                    </button>
                                </div>
                                <p x-show="passwordError" x-text="passwordError" class="text-red-500 text-[10px] md:text-xs mt-1 font-semibold italic ml-2"></p>
                            </div>

                            {{-- Confirm Password --}}
                            <div class="space-y-2">
                                <label class="block text-gray-500 font-bold ml-1 text-sm md:text-base">Konfirmasi sandi</label>
                                
                                <div class="relative">
                                    <input :type="showConfirm ? 'text' : 'password'" 
                                        name="password_confirmation"
                                        placeholder="xxxxxxxx"
                                        class="w-full px-5 py-3.5 md:px-6 md:py-4 rounded-2xl border-2 border-[#4A9FFF] focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all bg-white pr-12 text-sm md:text-base">
                                    
                                    <button type="button" @click="showConfirm = !showConfirm"
                                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 focus:outline-none hover:text-[#4A9FFF] transition-colors">
                                        <i class="fa-solid text-lg" :class="showConfirm ? 'fa-eye' : 'fa-eye-slash'"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol - Stack di mobile, Row di desktop --}}
                    <div class="lg:col-span-2 flex flex-col-reverse md:flex-row justify-center items-center gap-4 md:gap-6 pt-6 md:pt-10">
                        {{-- Login --}}
                        <a href="{{ route('login') }}" 
                            class="w-full md:max-w-[240px] bg-[#FFB81C] text-white font-black py-4 rounded-3xl text-lg md:text-xl shadow-[0_6px_0_0_#d99c16] active:translate-y-1 active:shadow-none transition-all flex items-center justify-center">
                            Masuk
                        </a>

                        {{-- Daftar --}}
                        <button type="submit"
                            class="w-full md:max-w-[240px] bg-[#4A9FFF] text-white font-black py-4 rounded-3xl text-lg md:text-xl shadow-[0_6px_0_0_#3a86db] active:translate-y-1 active:shadow-none transition-all flex items-center justify-center">
                            Daftar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </main>

</body>
</html>