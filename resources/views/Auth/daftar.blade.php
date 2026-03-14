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
                            autocomplete="off" 
                            class="w-full px-6 py-4 rounded-2xl border-2 border-[#4A9FFF] focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all bg-white">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                   
                    {{-- No HP --}}
                    <div class="space-y-2" x-data="{ hp: '{{ old('no_hp') }}', hpError: '' }">
                        <label class="block text-gray-500 font-bold ml-1">No telepon</label>
                        
                        <input type="text" 
                            name="no_hp" 
                            placeholder="081234567890" 
                            x-model="hp"
                          
                            @input="
                                hp = hp.replace(/[^0-9]/g, ''); 
                                if (hp.length > 0 && hp.length < 11) {
                                    hpError = 'Nomor HP minimal 11 digit (Baru: ' + hp.length + ')';
                                } else {
                                    hpError = '';
                                }
                            "
                            class="w-full px-6 py-4 rounded-2xl border-2 transition-all bg-white focus:outline-none focus:ring-4 focus:ring-blue-100"
                            :class="hpError ? 'border-red-500' : 'border-[#4A9FFF]'">

                        
                        <p x-show="hpError" x-text="hpError" class="text-red-500 text-xs mt-1 ml-2 font-semibold italic"></p>
                        
                        
                        @error('no_hp')
                            <p class="text-red-500 text-xs mt-1 ml-2 font-semibold italic">{{ $message }}</p>
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
                            autocomplete="off" 
                            class="w-full px-6 py-4 rounded-2xl border-2 border-[#4A9FFF] focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all bg-white">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                   
                    <div x-data="{ showPassword: false, showConfirm: false }" class="space-y-6">
                    <div x-data="{ password: '', passwordError: '' }" class="space-y-2">
                        <label class="block text-gray-500 font-bold ml-1">Buat sandi</label>
                        
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
                                class="w-full px-6 py-4 rounded-2xl border-2 border-[#4A9FFF] focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all bg-white pr-12">
                            
                            {{-- Tombol Mata Font Awesome --}}
                            <button type="button" @click="showPassword = !showPassword"
                                    class="absolute right-4 top-0 h-full flex items-center text-gray-400 focus:outline-none hover:text-[#4A9FFF] transition-colors">
                                <i class="fa-solid text-lg" :class="showPassword ? 'fa-eye' : 'fa-eye-slash'"></i>
                            </button>
                        </div>
                        <p x-show="passwordError" x-text="passwordError" class="text-red-500 text-xs mt-1 font-semibold italic ml-2"></p>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-gray-500 font-bold ml-1">Konfirmasi sandi</label>
                        
                        <div class="relative">
                            <input :type="showConfirm ? 'text' : 'password'" 
                                name="password_confirmation"
                                placeholder="xxxxxxxx"
                                class="w-full px-6 py-4 rounded-2xl border-2 border-[#4A9FFF] focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all bg-white tracking-widest pr-12">
                            
                            {{-- Tombol Mata Font Awesome --}}
                            <button type="button" @click="showConfirm = !showConfirm"
                                    class="absolute right-4 top-0 h-full flex items-center text-gray-400 focus:outline-none hover:text-[#4A9FFF] transition-colors">
                                <i class="fa-solid text-lg" :class="showConfirm ? 'fa-eye' : 'fa-eye-slash'"></i>
                            </button>
                        </div>
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