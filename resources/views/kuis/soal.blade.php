<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERSISTEN - Kuis Fundamental</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Scrollbar styling agar lebih tipis dan rapi */
        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-slate-100 font-po h-screen overflow-hidden p-4 md:p-6 lg:p-10">

    <div x-data="{ soalAktif: 1, totalSoal: 20, jawabanTerpilih: {} }" x-cloak class="h-full flex flex-col max-w-[1600px] mx-auto">

        <div class="flex flex-row items-center justify-between mb-6 shrink-0">
            <h1 class="text-xl md:text-3xl font-black text-[#2E3B66]">Try Out UTBK - 1</h1>
            <div class="flex items-center gap-2 md:gap-4">
                <div
                    class="flex items-center gap-2 bg-white border-2 border-[#4FAAFD] px-4 py-1.5 md:py-2 rounded-full">
                    <svg class="w-5 h-5 text-[#4FAAFD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-base md:text-lg font-bold text-[#4FAAFD] font-mono">30.00</p>
                </div>
                <a href="#"
                    class="bg-[#3B82F6] text-white px-4 md:px-8 py-2 md:py-3 rounded-full font-bold text-xs md:text-sm shadow-md hover:bg-blue-600 transition-all">Keluar
                    Ujian</a>
            </div>
        </div>

        <div
            class="bg-white rounded-[40px] shadow-sm border border-gray-100 flex-1 flex flex-col lg:flex-row overflow-hidden min-h-0">

            <div
                class="flex-1 flex flex-col p-6 md:p-10 overflow-y-auto custom-scroll border-b lg:border-b-0 lg:border-r-2 border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-sm font-bold text-gray-400">UTBK: Penalaran Umum</p>
                    <p class="text-sm font-bold text-gray-400">Soal <span x-text="soalAktif"></span> dari <span
                            x-text="totalSoal"></span></p>
                </div>

                <div class="w-full h-2.5 bg-gray-100 rounded-full mb-8">
                    <div class="h-full bg-blue-400 rounded-full transition-all duration-500"
                        :style="'width:' + (Object.keys(jawabanTerpilih).length / totalSoal * 100) + '%'"></div>
                </div>

                <div class="mb-10 flex-grow">
                    <div
                        class="text-blue-600 text-lg font-medium leading-relaxed underline decoration-blue-300 underline-offset-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat.
                    </div>
                    <div class="mt-6 text-gray-700 text-lg">
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                        pariatur.
                    </div>
                </div>

                <div class="grid grid-cols-5 sm:grid-cols-7 gap-3 mb-10">
                    <template x-for="i in totalSoal">
                        <button @click="soalAktif = i"
                            class="relative aspect-square flex items-center justify-center rounded-2xl font-bold text-lg transition-all border-2"
                            :class="soalAktif === i ? 'bg-[#4FAAFD] border-[#4FAAFD] text-white shadow-lg' :
                                (jawabanTerpilih[i] ? 'border-[#4FAAFD] text-[#4FAAFD] bg-white' :
                                    'border-[#4FAAFD] text-[#4FAAFD] bg-white hover:bg-blue-50')">
                            <span x-text="i"></span>
                            <template x-if="jawabanTerpilih[i]">
                                <div
                                    class="absolute -top-2 -right-2 w-6 h-6 bg-white text-[#4FAAFD] text-[10px] rounded-full flex items-center justify-center border-2 border-[#4FAAFD] font-black z-10 shadow-sm">
                                    <span x-text="jawabanTerpilih[i]"></span>
                                </div>
                            </template>
                        </button>
                    </template>
                </div>

                <div class="flex items-center gap-4 mt-auto">
                    <button @click="if(soalAktif > 1) soalAktif--" :disabled="soalAktif === 1"
                        class="flex-1 py-4 border-2 border-gray-200 rounded-2xl font-bold text-gray-400 hover:bg-gray-50 disabled:opacity-30 transition-all">Kembali</button>
                    <button @click="if(soalAktif < totalSoal) soalAktif++"
                        class="flex-1 py-4 bg-[#4FAAFD] text-white rounded-2xl font-bold shadow-lg shadow-blue-100 hover:bg-blue-600 transition-all active:scale-95">
                        <span x-text="soalAktif === totalSoal ? 'Selesai' : 'Selanjutnya'"></span>
                    </button>
                </div>
            </div>

            <div class="w-full lg:w-[45%] xl:w-[40%] bg-white p-6 md:p-10 flex flex-col overflow-y-auto custom-scroll">
                <h3 class="text-xl font-bold text-[#2E3B66] mb-6">Pilih Jawaban:</h3>

                <div class="space-y-4">
                    <template x-for="opt in ['A', 'B', 'C', 'D', 'E']">
                        <div @click="jawabanTerpilih[soalAktif] = opt"
                            class="group flex items-center p-5 rounded-[25px] border-2 cursor-pointer transition-all duration-200"
                            :class="jawabanTerpilih[soalAktif] === opt ? 'bg-[#D6E9FF] border-blue-400' :
                                'bg-[#EAF5FF] border-transparent hover:border-blue-200'">

                            <div class="mr-4 shrink-0">
                                <div class="w-6 h-6 rounded-full border-2 bg-white flex items-center justify-center"
                                    :class="jawabanTerpilih[soalAktif] === opt ? 'border-blue-500' : 'border-gray-300'">
                                    <div x-show="jawabanTerpilih[soalAktif] === opt"
                                        class="w-3 h-3 rounded-full bg-blue-500"></div>
                                </div>
                            </div>

                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-black mr-4 shrink-0 shadow-sm transition-all"
                                :class="jawabanTerpilih[soalAktif] === opt ? 'bg-blue-500 text-white' : 'bg-white text-blue-500'">
                                <span x-text="opt"></span>
                            </div>

                            <span class="text-sm md:text-base font-semibold text-[#2E3B66] leading-snug">
                                Lorem ipsum dolor sit amet, consectetur sit amet adipiscing elit.
                            </span>
                        </div>
                    </template>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
