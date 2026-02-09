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

    <div class="max-w-[1440px] mx-auto">

        <main class="p-4 md:p-10 flex justify-center">
            <div
                class="w-full bg-white border-2 border-gray-100 rounded-[25px] md:rounded-[35px] p-5 md:p-10 shadow-sm text-center">

                <div class="flex items-center gap-2 text-xs text-gray-400 font-medium mb-4 md:mb-6">
                    <span>Try Out UTBK</span>
                    <span><i class="fa-solid fa-chevron-right text-[10px]"></i></span>
                    <span class="text-gray-600">Istirahat</span>
                </div>

                <h2 class="text-2xl md:text-3xl font-bold text-[#2E3B66] uppercase text-left tracking-wide mb-8">
                    Istirahat Sejenak
                </h2>

                <div
                    class="inline-block bg-[#6EB4FF] text-white mt-0 md:mt-4 text-3xl md:text-4xl font-bold px-10 py-3 rounded-[25px] shadow-lg mb-8">
                    01.00
                </div>

                <div class="mb-10">
                    <h3 class="text-lg md:text-2xl font-bold text-[#2E3B66] mb-2 md:mb-4">Saatnya Istirahat Sejenak!
                    </h3>
                    <p class="text-[#2E3B66] text-sm md:text-base max-w-2xl mx-auto leading-relaxed">
                        Istirahatlah sejenak sebelum memulai subtes berikutnya. Gunakan waktu jeda ini untuk istirahat
                        agar fokus dan siap menghadapi soal selanjutnya.
                    </p>
                </div>

                <div class="bg-[#E2EDFE] rounded-[20px] md:rounded-[30px] overflow-hidden mb-10 text-left">
                    <div class="bg-[#A5BBEC]/30 px-6 py-4 flex items-center gap-3">
                        <i class="fa-solid fa-book-open text-[#2E3B66] text-xl"></i>
                        <h4 class="font-bold text-[#2E3B66]">Subtes Try Out Selanjutnya</h4>
                    </div>

                    <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-6">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-6 h-6 rounded-full bg-green-500 flex items-center justify-center text-white text-[10px]">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <span class="text-sm font-medium text-[#2E3B66]">Penalaran Umum</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full border-2 border-white bg-white"></div>
                            <span class="text-sm font-medium text-[#2E3B66]">Pengetahuan Kuantitatif</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full border-2 border-white bg-white"></div>
                            <span class="text-sm font-medium text-[#2E3B66]">Literasi Bahasa Inggris</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full border-2 border-white bg-white"></div>
                            <span class="text-sm font-medium text-[#2E3B66]">Pemahaman dan Pengetahuan Umum</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full border-2 border-white bg-white"></div>
                            <span class="text-sm font-medium text-[#2E3B66]">Penalaran Manusia</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full border-2 border-white bg-white"></div>
                            <span class="text-sm font-medium text-[#2E3B66]">Pemahaman Bacaan dan Menulis</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full border-2 border-white bg-white"></div>
                            <span class="text-sm font-medium text-[#2E3B66]">Literasi Bahasa Indonesia</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row justify-center items-center gap-4">
                    <button
                        class="w-full md:w-auto px-10 py-3 bg-white border-2 border-gray-100 text-gray-400 font-medium rounded-full hover:bg-gray-50 transition">
                        Keluar Ujian
                    </button>
                    <button
                        class="w-full md:w-auto px-12 py-3 bg-[#6EB4FF] hover:bg-blue-500 text-white font-medium rounded-full shadow-lg shadow-blue-100 transition active:scale-95">
                        Mulai Kembali
                    </button>
                </div>
            </div>
        </main>
    </div>

</body>

</html>
