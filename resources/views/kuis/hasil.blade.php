<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kuis - {{ $kuis->category->name ?? 'Kuis' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        @media (min-width: 1024px) {
            body {
                overflow: hidden;
            }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.98);
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4 md:p-6 lg:p-8">

    <div class="relative w-full min-h-screen md:min-h-0 lg:h-[95vh] flex items-center justify-center">

        <div
            class="bg-[#DAEDFE] w-full h-auto lg:h-full rounded-xl border-4 border-white shadow-sm relative flex flex-col items-center justify-center p-6 md:p-12 overflow-visible">

            <div class="relative w-full max-w-2xl flex flex-col items-center">

                <div
                    class="absolute bottom-[-15px] w-[85%] h-16 bg-gradient-to-r from-yellow-400 via-white to-yellow-400 rounded-full shadow-lg z-0">
                </div>

                <div
                    class="relative z-10 bg-white glass-effect w-full rounded-[2.5rem] shadow-sm border border-white overflow-hidden">
                    <div class="p-6 md:p-10 flex flex-col">

                        <div class="flex flex-col items-center justify-center gap-3 mb-8 text-[#2d4a85]">
                            <div class="bg-blue-50 p-3 rounded-2xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-center">
                                Hasil {{ $kuis->category->name ?? 'Kuis' }}
                                <span class="block text-blue-500 text-lg md:text-xl font-bold mt-1">Set
                                    {{ $kuis->set_ke }}</span>
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 md:gap-6 mb-10">
                            <div
                                class="bg-[#66cc66] rounded-[2.5rem] p-6 flex flex-col items-center justify-center shadow-lg transform active:scale-95 transition-all h-[200px] md:h-[250px]">
                                <div
                                    class="w-14 h-14 rounded-full border-4 border-white/30 flex items-center justify-center mb-4">
                                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <span class="text-3xl font-black text-white leading-none">{{ $hasil['benar'] }}</span>
                                <span class="text-sm font-bold text-white uppercase mt-2">Benar</span>
                            </div>

                            <div
                                class="bg-[#7a869a] rounded-[2.5rem] p-6 flex flex-col items-center justify-center shadow-lg transform active:scale-95 transition-all h-[200px] md:h-[250px]">
                                <div
                                    class="w-14 h-14 rounded-full border-4 border-white/30 flex items-center justify-center mb-4">
                                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="5"
                                            d="M20 12H4" />
                                    </svg>
                                </div>
                                <span class="text-3xl font-black text-white leading-none">{{ $hasil['kosong'] }}</span>
                                <span class="text-sm font-bold text-white uppercase mt-2">Kosong</span>
                            </div>

                            <div
                                class="bg-[#e65c5c] rounded-[2.5rem] p-6 flex flex-col items-center justify-center shadow-lg transform active:scale-95 transition-all h-[200px] md:h-[250px]">
                                <div
                                    class="w-14 h-14 rounded-full border-4 border-white/30 flex items-center justify-center mb-4">
                                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                <span class="text-3xl font-black text-white leading-none">{{ $hasil['salah'] }}</span>
                                <span class="text-sm font-bold text-white uppercase mt-2">Salah</span>
                            </div>
                        </div>

                        <div class="flex justify-center mt-2">
                            <a href="{{ route('kuis.index') }}"
                                class="w-full sm:w-auto px-16 py-4 bg-blue-600 text-white rounded-full font-black text-lg shadow-xl hover:bg-blue-700 active:scale-95 transition-all text-center uppercase">
                                Selesai
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
