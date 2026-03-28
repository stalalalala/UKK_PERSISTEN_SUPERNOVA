<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password | PERSISTEN</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
</head>

<body class="font-po bg-blue-50 flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">

    <div class="bg-white p-6 sm:p-8 lg:p-10 rounded-3xl shadow-xl w-full max-w-sm sm:max-w-md lg:max-w-lg xl:max-w-xl">

        <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-center text-blue-600 mb-4 sm:mb-6">
            Lupa Password
        </h2>

        @if (session('status'))
            <div
                class="bg-green-100 text-green-600 p-4 rounded-xl mb-4 text-sm sm:text-base border border-green-200 flex items-center">
                <i class="fa-solid fa-circle-check mr-2"></i>
                {{ session('status') }}
            </div>
        @endif

        @error('email')
            <div class="bg-red-100 text-red-600 p-4 rounded-xl mb-4 text-sm border border-red-200 flex items-center">
                <i class="fa-solid fa-circle-exclamation mr-2"></i>
                {{ $message }}
            </div>
        @enderror

        <div x-data="{
            waiting: false,
            seconds: 0,
            storageKey: 'reset_password_timer',
        
            init() {
                let savedTime = localStorage.getItem(this.storageKey);
                if (savedTime) {
                    let currentTime = Math.floor(Date.now() / 1000);
                    let diff = savedTime - currentTime;
        
                    if (diff > 0) {
                        this.seconds = diff;
                        this.startCountdown(true);
                    } else {
                        localStorage.removeItem(this.storageKey);
                    }
                }
            },
        
            startCountdown(isResume = false) {
                this.waiting = true;
        
                if (!isResume) {
                    this.seconds = 60;
                    let expiryTime = Math.floor(Date.now() / 1000) + this.seconds;
                    localStorage.setItem(this.storageKey, expiryTime);
                }
        
                let timer = setInterval(() => {
                    this.seconds--;
                    if (this.seconds <= 0) {
                        clearInterval(timer);
                        this.waiting = false;
                        localStorage.removeItem(this.storageKey);
                    }
                }, 1000);
            }
        }">

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4"
                @submit="startCountdown(false)">
                @csrf

                <div class="relative">
                    <input type="email" name="email" required value="{{ old('email') }}"
                        placeholder="Masukkan Email"
                        class="w-full px-4 py-2 sm:py-3 border rounded-xl text-sm sm:text-base outline-none focus:ring-2 focus:ring-blue-400 @error('email') border-red-500 @enderror">
                </div>

                <button type="submit" :disabled="waiting"
                    :class="waiting ? 'bg-gray-400 cursor-not-allowed opacity-80' :
                        'bg-blue-500 hover:bg-blue-600 shadow-lg shadow-blue-200'"
                    class="w-full text-white py-2 sm:py-3 rounded-xl text-sm sm:text-base font-semibold transition-all duration-300 flex items-center justify-center gap-2">

                    <template x-if="!waiting">
                        <span>Kirim Link Reset</span>
                    </template>

                    <template x-if="waiting">
                        <span class="flex items-center">
                            <i class="fa-solid fa-spinner animate-spin mr-2"></i>
                            Tunggu <span x-text="seconds" class="mx-1"></span> Detik
                        </span>
                    </template>
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-blue-600 transition">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Masuk
                </a>
            </div>
        </div>
    </div>

</body>

</html>
