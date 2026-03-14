<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
     @vite('resources/css/app.css')
</head>
<body class="font-po bg-blue-50 flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">

<div class="bg-white 
            w-full 
            max-w-sm sm:max-w-md lg:max-w-lg xl:max-w-xl
            p-6 sm:p-8 lg:p-10
            rounded-3xl shadow-xl">

    <h2 class="text-xl sm:text-2xl lg:text-3xl 
               font-bold text-center text-blue-600 
               mb-4 sm:mb-6">
        Reset Password
    </h2>


<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <input type="email" name="email" required placeholder="Email"
        class="w-full px-4 py-2 sm:py-3 border-2 border-blue-400 rounded-xl mb-4 text-sm sm:text-base focus:outline-none focus:ring-2 focus:ring-blue-100">

    <div x-data="{ password: '', passwordError: '', showPassword: false, showConfirm: false }" class="space-y-4">

        {{-- Input Password Baru --}}
        <div class="space-y-1">
            <div class="relative">
                <input
                    :type="showPassword ? 'text' : 'password'"
                    name="password"
                    x-model="password"
                    @input="
                        passwordError = (password.length < 6) ? 'Minimal 6 karakter' : 
                                        (!/[0-9]/.test(password)) ? 'Wajib ada angka' : 
                                        (!/[^A-Za-z0-9]/.test(password)) ? 'Wajib ada simbol(@$!%*#?&)' : '';
                    "
                    required
                    placeholder="Password Baru"
                    class="w-full px-4 py-2 sm:py-3 border-2 rounded-xl pr-12 text-sm sm:text-base focus:outline-none transition-all"
                    :class="passwordError ? 'border-red-500' : 'border-blue-400 focus:ring-2 focus:ring-blue-100'">

                <button type="button" @click="showPassword = !showPassword"
                    class="absolute right-4 top-0 h-full flex items-center text-gray-400 hover:text-blue-500 transition">
                    <i class="fa-solid" :class="showPassword ? 'fa-eye' : 'fa-eye-slash'"></i>
                </button>
            </div>
            <p x-show="passwordError" x-text="passwordError" class="text-red-500 text-[10px] md:text-xs font-semibold italic ml-2"></p>
        </div>

        {{-- Konfirmasi Password --}}
        <div class="relative">
            <input
                :type="showConfirm ? 'text' : 'password'"
                name="password_confirmation"
                required
                placeholder="Konfirmasi Password"
                class="w-full px-4 py-2 sm:py-3 border-2 border-blue-400 rounded-xl pr-12 text-sm sm:text-base focus:outline-none focus:ring-2 focus:ring-blue-100 transition">

            <button type="button" @click="showConfirm = !showConfirm"
                class="absolute right-4 top-0 h-full flex items-center text-gray-400 hover:text-blue-500 transition">
                <i class="fa-solid" :class="showConfirm ? 'fa-eye' : 'fa-eye-slash'"></i>
            </button>
        </div>

        <div class="pt-4">
            <button type="submit"
                class="w-full bg-blue-500 text-white py-2 sm:py-3 text-sm sm:text-base rounded-xl hover:bg-blue-600 transition font-bold shadow-lg shadow-blue-100">
                Reset Password
            </button>
        </div>
    </div>
</form>
</div>

</body>
</html>