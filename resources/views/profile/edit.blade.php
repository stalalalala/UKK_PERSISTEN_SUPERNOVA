<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERSISTEN - Latihan Soal</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite('resources/css/app.css')
</head>

<body class="bg-white font-po overflow-x-hidden">

    <div class="max-w-[1440px] mx-auto" x-data="{ open: false }">
        <nav class="flex justify-between items-center bg-gray-100 rounded-full mx-4 md:mx-10 mt-4 relative z-10">
            <div class="w-20 md:w-28 h-12 bg-blue-400 rounded-full flex-shrink-0"></div>

            <ul class="hidden lg:flex gap-12 text-gray-800 font-medium text-sm">
                <li><a href="/" class="font-bold hover:text-blue-500">Edit Profile</a></li>
            </ul>

            <div class="flex items-center gap-2">
                <div class="flex items-center gap-2 bg-[#FBBA16] rounded-full">
                    <a href="/"
                        class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#3171CD] flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>

                    </a>
                    <button
                        class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#4B8A81] flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg>
                    </button>
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

    <main
        class="max-w-[1440px] mx-auto flex flex-col md:flex-row items-center justify-center gap-8 md:gap-12 p-8 md:p-10 mt-6 rounded-[35px] bg-[#E2EDFE] border-2 border-blue-400 mx-4 md:mx-10 mb-10 relative overflow-hidden">

        <div class="flex flex-col items-center shrink-0">
            <div class="relative group">
                <div
                    class="w-44 h-44 md:w-52 md:h-52 rounded-full border-[10px] border-white shadow-sm overflow-hidden bg-white">
                    <img src="https://i.pinimg.com/564x/07/33/ba/0733ba760b29378474dea0fdbcb97107.jpg" alt="Profile"
                        class="w-full h-full object-cover">
                </div>
            </div>

            <h1 class="text-2xl font-bold text-[#3D4B7A] mt-8 md:mt-10 text-center  md:-top-1 md:left-20">
                Edit
                Profil
            </h1>

            <button
                class="mt-6 bg-[#6EB4FF] hover:bg-blue-500 text-white px-5 py-2.5 text-sm rounded-full font-medium flex items-center gap-2 shadow-lg transition-all active:scale-95">
                <i class="fa-solid fa-camera"></i> Ubah Foto
            </button>
        </div>

        <div class="bg-white rounded-[20px] md:rounded-[35px] p-6 md:p-10 shadow-sm w-full border border-white">
            <form class="space-y-6">

                <div class="space-y-2">
                    <label class="block text-[#4A5578] font-semibold text-sm ml-1">Nama Pengguna</label>
                    <div
                        class="flex items-center bg-white rounded-lg md:rounded-2xl border-2 border-[#6EB4FF] overflow-hidden">
                        <div
                            class="bg-[#6EB4FF] px-2 md:px-4 py-1 md:py-3 text-white flex items-center justify-center">
                            <i class="fa-solid fa-user text-lg"></i>
                        </div>
                        <input type="text" value="Bang Jeemin"
                            class="w-full px-2 md:px-4 py-1 md:py-3 outline-none text-[#4A5578] text-xs md:text-sm font-medium placeholder:text-gray-300">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-[#4A5578] font-semibold text-sm ml-1">Email</label>
                    <div
                        class="flex items-center bg-white rounded-lg md:rounded-2xl border-2 border-[#6EB4FF] overflow-hidden">
                        <div
                            class="bg-[#6EB4FF] px-2 md:px-4 py-1 md:py-3 text-white flex items-center justify-center">
                            <i class="fa-solid fa-envelope text-lg"></i>
                        </div>
                        <input type="email" value="contoh@gmail.com"
                            class="w-full px-2 md:px-4 py-1 md:py-3 outline-none text-[#4A5578] text-xs md:text-sm font-medium placeholder:text-gray-300">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-[#4A5578] font-semibold text-sm ml-1">Nomor Telepon</label>
                    <div
                        class="flex items-center bg-white rounded-lg md:rounded-2xl border-2 border-[#6EB4FF] overflow-hidden">
                        <div
                            class="bg-[#6EB4FF] px-2 md:px-4 py-1 md:py-3 text-white flex items-center justify-center">
                            <i class="fa-solid fa-phone text-lg"></i>
                        </div>
                        <input type="text" value="0888-8635-3456"
                            class="w-full px-2 md:px-4 py-1 md:py-3 outline-none text-[#4A5578] text-xs md:text-sm font-medium placeholder:text-gray-300">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-[#4A5578] font-semibold text-sm ml-1">Kata Sandi</label>
                    <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                        <div
                            class="flex items-center bg-white rounded-lg md:rounded-2xl border-2 border-[#6EB4FF] overflow-hidden">
                            <div
                                class="bg-[#6EB4FF] px-2 md:px-4 py-1 md:py-3 text-white flex items-center justify-center">
                                <i class="fa-solid fa-lock text-lg"></i>
                            </div>
                            <input type="password" placeholder="kata sandi baru"
                                class="w-full px-2 md:px-4 py-1 md:py-3 outline-none text-[#4A5578] text-xs md:text-sm font-medium placeholder:text-[#AAB4D1]">
                        </div>
                        <div
                            class="flex items-center bg-white rounded-lg md:rounded-2xl border-2 border-[#6EB4FF] overflow-hidden">
                            <div
                                class="bg-[#6EB4FF] px-2 md:px-4 py-1 md:py-3 text-white flex items-center justify-center">
                                <i class="fa-solid fa-lock text-lg"></i>
                            </div>
                            <input type="password" placeholder="konfirmasi kata sandi baru"
                                class="w-full px-2 md:px-4 py-1 md:py-3 outline-none text-[#4A5578] text-xs md:text-sm font-medium placeholder:text-[#AAB4D1]">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end items-center text-xs md:text-sm gap-4 pt-4">
                    <a href="/tryout/index"><button type="button"
                            class="bg-white border-2 border-gray-200 text-gray-400 font-medium px-8 py-2.5 rounded-full hover:bg-gray-50 transition-all">
                            Batal
                        </button></a>
                    <button type="submit"
                        class="bg-[#6EB4FF] hover:bg-blue-500 text-white px-8 py-3 rounded-full font-medium shadow-lg shadow-blue-200 transition-all active:scale-95">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>
    </div>

</body>

</html>
