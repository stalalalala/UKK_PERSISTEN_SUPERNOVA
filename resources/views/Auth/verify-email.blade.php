<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email | PERSISTEN</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="font-po bg-blue-50 font-poppins min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">

    <div
        class="bg-white 
                rounded-3xl shadow-xl 
                w-full 
                max-w-sm sm:max-w-md lg:max-w-lg xl:max-w-xl
                p-6 sm:p-8 lg:p-10
                text-center relative">

        <div class="mb-5 sm:mb-6">
            <div
                class="mx-auto 
                        w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24
                        flex items-center justify-center 
                        rounded-full bg-blue-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 sm:h-10 sm:w-10 lg:h-12 lg:w-12 text-blue-400"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 12l-4 4m0 0l-4-4m4 4V8" />
                </svg>
            </div>
        </div>

        <h1 class="text-xl sm:text-2xl lg:text-3xl 
                   font-bold text-blue-700 mb-2">
            Verifikasi Email
        </h1>

        <p class="text-blue-600 
                  text-sm sm:text-base 
                  mb-5 sm:mb-6">
            Silakan cek email Anda untuk link verifikasi.
            Pastikan juga cek folder spam jika tidak muncul.
        </p>

        @if (session('success'))
            <p
                class="text-green-600 bg-green-100 
                      px-4 py-2 rounded-md mb-4 
                      text-sm sm:text-base">
                {{ session('success') }}
            </p>
        @endif

        @if (session('error'))
            <p
                class="text-red-600 bg-red-100 
                      px-4 py-2 rounded-md mb-4 
                      text-sm sm:text-base">
                {{ session('error') }}
            </p>
        @endif

        <!-- Tombol kirim ulang -->
        <div x-data="{
            canResend: true,
            timer: 0,
            storageKey: 'verification_expiry',
        
            init() {
                // Cek apakah ada waktu kedaluwarsa yang tersimpan saat halaman dimuat
                const expiry = localStorage.getItem(this.storageKey);
                if (expiry) {
                    const remaining = Math.floor((parseInt(expiry) - Date.now()) / 1000);
                    if (remaining > 0) {
                        this.startCountdown(remaining);
                    } else {
                        localStorage.removeItem(this.storageKey);
                    }
                }
            },
        
            startTimer() {
                // Set waktu kedaluwarsa 60 detik dari sekarang
                const expiryTime = Date.now() + (60 * 1000);
                localStorage.setItem(this.storageKey, expiryTime);
                this.startCountdown(60);
            },
        
            startCountdown(seconds) {
                this.canResend = false;
                this.timer = seconds;
        
                let interval = setInterval(() => {
                    this.timer--;
                    if (this.timer <= 0) {
                        this.canResend = true;
                        clearInterval(interval);
                        localStorage.removeItem(this.storageKey);
                    }
                }, 1000);
            }
        }">
            <form method="POST" action="{{ route('verification.send') }}" @submit="startTimer()">
                @csrf
                <button type="submit" :disabled="!canResend"
                    :class="!canResend ? 'bg-gray-300 cursor-not-allowed text-gray-500' :
                        'bg-blue-400 hover:bg-blue-500 text-white'"
                    class="w-full font-semibold py-2 sm:py-3 text-sm sm:text-base rounded-2xl shadow-md transition-colors">

                    <span x-show="canResend">Kirim Ulang Link Verifikasi</span>

                    <span x-show="!canResend" x-cloak>Tunggu <span x-text="timer"></span> detik</span>
                </button>
            </form>
        </div>


        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit"
                class="w-full flex items-center justify-center gap-2
               bg-gray-100 hover:bg-gray-200 
               text-gray-600 font-semibold 
               py-2 sm:py-3 
               text-sm sm:text-base
               rounded-xl transition-all duration-300">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali ke Halaman Masuk
            </button>
        </form>

    </div>

</body>

</html>
