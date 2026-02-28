<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-blue-50 flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">

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
            class="w-full px-4 py-2 sm:py-3 border rounded-xl mb-4 text-sm sm:text-base">

        <div x-data="{ showPassword: false, showConfirm: false }" class="space-y-4">

            <!-- PASSWORD BARU -->
            <div class="relative">
                <input
                    :type="showPassword ? 'text' : 'password'"
                    name="password"
                    required
                    placeholder="Password Baru"
                    class="w-full px-4 py-2 sm:py-3 border rounded-xl pr-12 
                           text-sm sm:text-base
                           focus:outline-none focus:ring-2 focus:ring-blue-400 transition">

                <button type="button"
                    @click="showPassword = !showPassword"
                    class="absolute right-3 top-1/2 -translate-y-1/2 
                           text-gray-400 hover:text-blue-500 transition">

                    <svg x-show="!showPassword"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 sm:h-6 sm:w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5
                            c4.477 0 8.268 2.943 9.542 7
                            -1.274 4.057-5.065 7-9.542 7
                            -4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <svg x-show="showPassword"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 sm:h-6 sm:w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19
                            c-4.477 0-8.268-2.943-9.542-7
                            a9.956 9.956 0 012.043-3.368
                            m3.1-2.42A9.953 9.953 0 0112 5
                            c4.477 0 8.268 2.943 9.542 7
                            a9.965 9.965 0 01-4.132 5.411
                            M15 12a3 3 0 00-3-3
                            m0 0a3 3 0 00-3 3
                            m3-3l6 6" />
                    </svg>
                </button>
            </div>

            <!-- KONFIRMASI PASSWORD -->
            <div class="relative">
                <input
                    :type="showConfirm ? 'text' : 'password'"
                    name="password_confirmation"
                    required
                    placeholder="Konfirmasi Password"
                    class="w-full px-4 py-2 sm:py-3 border rounded-xl pr-12 
                           text-sm sm:text-base
                           focus:outline-none focus:ring-2 focus:ring-blue-400 transition">

                <button type="button"
                    @click="showConfirm = !showConfirm"
                    class="absolute right-3 top-1/2 -translate-y-1/2 
                           text-gray-400 hover:text-blue-500 transition">

                    <svg x-show="!showConfirm"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 sm:h-6 sm:w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5
                            c4.477 0 8.268 2.943 9.542 7
                            -1.274 4.057-5.065 7-9.542 7
                            -4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <svg x-show="showConfirm"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 sm:h-6 sm:w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19
                            c-4.477 0-8.268-2.943-9.542-7
                            a9.956 9.956 0 012.043-3.368
                            m3.1-2.42A9.953 9.953 0 0112 5
                            c4.477 0 8.268 2.943 9.542 7
                            a9.965 9.965 0 01-4.132 5.411
                            M15 12a3 3 0 00-3-3
                            m0 0a3 3 0 00-3 3
                            m3-3l6 6" />
                    </svg>
                </button>
            </div>

        </div>

        <div class="pt-4">
            <button type="submit"
                class="w-full bg-blue-500 text-white 
                       py-2 sm:py-3 
                       text-sm sm:text-base
                       rounded-xl hover:bg-blue-600 transition">
                Reset Password
            </button>
        </div>

    </form>
</div>

</body>
</html>