<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kuis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4 bg-white">

    <div class="bg-[#DAEDFE] p-8 sm:p-12 rounded-[2rem] border-4 w-full max-w-5xl relative flex flex-col items-center">

        <div
            class="absolute bottom-[65px] w-[60%] h-14 bg-gradient-to-r from-yellow-400 via-white to-yellow-400 rounded-[40px] z-0">
        </div>

        <div class="relative z-10 bg-white rounded-[2rem] overflow-hidden shadow-lg mb-8 w-full max-w-2xl">

            <div class="p-6 py-10">
                <div class="flex items-center justify-center gap-3 mb-10 text-[#2d4a85]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-center">Hasil Kuis Fundamental</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-10">

                    <div
                        class="bg-[#66cc66] rounded-[2rem] h-[220px] sm:h-[280px] p-4 flex flex-col items-center shadow-md">
                        <div class="flex-grow flex items-center justify-center">
                            <div
                                class="w-14 h-14 sm:w-16 sm:h-16 rounded-full border-4 border-white/30 flex items-center justify-center">
                                <svg class="h-8 w-8 sm:h-10 sm:w-10 text-white" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                        <span class="font-bold text-base sm:text-lg text-white pb-2">15 benar</span>
                    </div>

                    <div
                        class="bg-[#7a869a] rounded-[2rem] h-[220px] sm:h-[280px] p-4 flex flex-col items-center shadow-md">
                        <div class="flex-grow flex items-center justify-center">
                            <div
                                class="w-14 h-14 sm:w-16 sm:h-16 rounded-full border-4 border-white/30 flex items-center justify-center">
                                <svg class="h-8 w-8 sm:h-10 sm:w-10 text-white" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="5"
                                        d="M20 12H4" />
                                </svg>
                            </div>
                        </div>
                        <span class="font-bold text-base sm:text-lg text-white pb-2">0 Kosong</span>
                    </div>

                    <div
                        class="bg-[#e65c5c] rounded-[2rem] h-[220px] sm:h-[280px] p-4 flex flex-col items-center shadow-md">
                        <div class="flex-grow flex items-center justify-center">
                            <div
                                class="w-14 h-14 sm:w-16 sm:h-16 rounded-full border-4 border-white/30 flex items-center justify-center">
                                <svg class="h-8 w-8 sm:h-10 sm:w-10 text-white" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>
                        <span class="font-bold text-base sm:text-lg text-white pb-2">5 Salah</span>
                    </div>

                </div>

                <div class="flex justify-center">
                    <button
                        class="w-full sm:w-auto px-12 py-3 border-2 border-[#b0d4ff] text-[#5c8ce5] rounded-full font-bold text-lg hover:bg-blue-50 transition-all">
                        Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
