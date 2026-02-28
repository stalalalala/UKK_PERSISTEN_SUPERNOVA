<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 font-poppins min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">

    <div class="bg-white 
                rounded-3xl shadow-xl 
                w-full 
                max-w-sm sm:max-w-md lg:max-w-lg xl:max-w-xl
                p-6 sm:p-8 lg:p-10
                text-center relative">

        <div class="mb-5 sm:mb-6">
            <div class="mx-auto 
                        w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24
                        flex items-center justify-center 
                        rounded-full bg-blue-100">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="h-8 w-8 sm:h-10 sm:w-10 lg:h-12 lg:w-12 text-blue-400" 
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

        @if(session('success'))
            <p class="text-green-600 bg-green-100 
                      px-4 py-2 rounded-md mb-4 
                      text-sm sm:text-base">
                {{ session('success') }}
            </p>
        @endif

        @if(session('error'))
            <p class="text-red-600 bg-red-100 
                      px-4 py-2 rounded-md mb-4 
                      text-sm sm:text-base">
                {{ session('error') }}
            </p>
        @endif

        <!-- Tombol kirim ulang -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                class="w-full 
                       bg-blue-400 hover:bg-blue-500 
                       text-white font-semibold 
                       py-2 sm:py-3 
                       text-sm sm:text-base
                       rounded-2xl shadow-md 
                       transition-colors">
                Kirim Ulang Link Verifikasi
            </button>
        </form>

        <!-- Tombol logout -->
        <form method="POST" action="{{ route('logout') }}" class="mt-3 sm:mt-4">
            @csrf
            <button type="submit"
                class="w-full 
                       bg-gray-400 hover:bg-gray-500 
                       text-white font-semibold 
                       py-2 sm:py-3 
                       text-sm sm:text-base
                       rounded-2xl shadow-md 
                       transition-colors">
                Kembali ke Halaman Masuk
            </button>
        </form>

        <p class="text-blue-300 text-xs sm:text-sm mt-5 sm:mt-6">
            Terima kasih telah mendaftar! 😊
        </p>

    </div>

</body>
</html>