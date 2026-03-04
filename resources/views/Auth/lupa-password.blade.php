<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">

<div class="bg-white 
            p-6 sm:p-8 lg:p-10
            rounded-3xl shadow-xl 
            w-full 
            max-w-sm sm:max-w-md lg:max-w-lg xl:max-w-xl">

    <h2 class="text-xl sm:text-2xl lg:text-3xl 
               font-bold text-center text-blue-600 
               mb-4 sm:mb-6">
        Lupa Password
    </h2>

    @if (session('status'))
        <div class="bg-green-100 text-green-600 
                    p-3 rounded mb-4 text-sm sm:text-base">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <input type="email" name="email" required 
            placeholder="Masukkan Email"
            class="w-full 
                   px-4 py-2 sm:py-3
                   border rounded-xl 
                   text-sm sm:text-base">

        <button type="submit"
            class="w-full 
                   bg-blue-500 text-white 
                   py-2 sm:py-3 
                   rounded-xl 
                   text-sm sm:text-base
                   hover:bg-blue-600 transition">
            Kirim Link Reset
        </button>
    </form>
</div>

</body>
</html>