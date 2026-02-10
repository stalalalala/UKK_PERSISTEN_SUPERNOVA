<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soal Page - Premium Layout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        html,
        body {
            overflow-x: hidden;
            width: 100%;
        }
    </style>
</head>

<body class="bg-slate-100 min-h-screen py-6 px-4 md:px-12 lg:px-20 xl:px-32">

    <div x-data="{ soalAktif: 1, totalSoal: 20, jawabanTerpilih: {} }" x-cloak class="max-w-[1440px] mx-auto">

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 px-2">
            <h1 class="text-2xl md:text-4xl font-black text-[#2E3B66] tracking-tight text-center md:text-left">
                Try Out UTBK - 1
            </h1>

            <div class="flex items-center justify-between md:justify-end gap-3 sm:gap-4">
                <div class="bg-white border-2 border-[#4FAAFD] px-4 py-2 md:px-6 md:py-3 rounded-3xl">
                    <p class="text-[18px] font-bold text-[#4FAAFD] font-mono leading-none ">30.00</p>
                </div>
                <a href=""
                    class="flex-1 md:flex-none flex items-center justify-center px-4 py-2 md:px-6 md:py-3 rounded-3xl text-white font-bold text-xs md:text-sm hover:bg-white hover:text-[#4FAAFD] transition-all bg-[#3B82F6]">
                    Keluar Ujian
                </a>
            </div>
        </div>

        <div
            class="bg-white rounded-3xl md:rounded-[2.5rem] shadow-2xl overflow-hidden border border-gray-100 flex flex-col lg:flex-row">

            <div class="flex-1 p-5 sm:p-10 md:p-14 lg:p-16 border-b lg:border-b-0 lg:border-r border-gray-100">

                <div class="flex flex-row justify-between items-center mb-6 gap-2">
                    <div class="flex flex-col">
                        <p class="text-xs md:text-sm font-semibold text-[#2E3B66]">UTBK: Penalaran Umum</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs md:text-sm font-semibold text-[#2E3B66] whitespace-nowrap">
                            Soal <span class="text-[#2E3B66] text-base" x-text="soalAktif"></span> dari <span
                                x-text="totalSoal"></span>
                        </p>
                    </div>
                </div>

                <div class="w-full h-2 bg-gray-100 rounded-full mb-8 overflow-hidden">
                    <div class="h-full bg-blue-500 transition-all duration-500"
                        :style="'width:' + (Object.keys(jawabanTerpilih).length / totalSoal * 100) + '%'"></div>
                </div>

                <div class="mb-10">
                    <div class="text-gray-800 text-base sm:text-xl md:text-2xl leading-relaxed font-regular">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt nisi molestias ea neque
                        consequatur voluptates nihil ad fuga, et tenetur quo repellat quisquam. Doloremque reiciendis,
                        voluptatum earum amet sequi tempore?
                    </div>
                </div>

                <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-7 gap-4 max-w-md">
                    <template x-for="i in totalSoal">
                        <button @click="soalAktif = i"
                            class="relative aspect-square flex items-center justify-center rounded-[1.25rem] font-bold text-lg transition-all border-2"
                            :class="soalAktif === i ?
                                'bg-[#4FAAFD] border-[#4FAAFD] text-white shadow-md' :
                                (jawabanTerpilih[i] ? 'border-[#4FAAFD] text-[#4FAAFD] bg-white' :
                                    'border-[#4FAAFD] text-[#4FAAFD] bg-white hover:bg-blue-50')">

                            <span x-text="i"></span>

                            <template x-if="jawabanTerpilih[i]">
                                <div
                                    class="absolute -top-2 -right-2 w-6 h-6 bg-white text-[#4FAAFD] text-xs rounded-full flex items-center justify-center border-2 border-[#4FAAFD] shadow-sm font-bold z-10">
                                    <span x-text="jawabanTerpilih[i]"></span>
                                </div>
                            </template>
                        </button>
                    </template>
                </div>

                <div class="flex items-center gap-3 mt-10 md:mt-14">
                    <button @click="if(soalAktif > 1) soalAktif--" :disabled="soalAktif === 1"
                        class="flex-1 py-3 px-2 text-gray-400 font-semibold text-[10px] md:text-sm border border-gray-200 rounded-3xl hover:bg-gray-50 disabled:opacity-20 transition-all">
                        Kembali
                    </button>
                    <button @click="if(soalAktif < totalSoal) soalAktif++"
                        class="flex-[1] py-3 px-2 bg-[#3B82F6] text-white font-semibold text-xs md:text-base rounded-3xl shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95">
                        <span x-text="soalAktif === totalSoal ? 'Kumpulkan Ujian' : 'Selanjutnya'"></span>
                    </button>
                </div>
            </div>

            <div class="w-full lg:w-[380px] xl:w-[450px] p-5 sm:p-10 lg:p-14 bg-slate-50/50">
                <h3 class="text-[18px] font-black text-[#2E3B66] tracking-widest mb-6 text-center lg:text-left">Pilih
                    Jawaban:</h3>

                <div class="space-y-4">
                    <template x-for="opt in ['A', 'B', 'C', 'D', 'E']">
                        <div @click="jawabanTerpilih[soalAktif] = opt"
                            :class="jawabanTerpilih[soalAktif] === opt ? 'border-[#3378FF] ring-1 ring-[#3378FF]' :
                                'border-transparent'"
                            class="group flex items-center p-4 rounded-2xl border-2 bg-[#E1F0FF] cursor-pointer transition-all duration-200 shadow-sm">
                            <div class="mr-4">
                                <div :class="jawabanTerpilih[soalAktif] === opt ? 'border-[#3378FF]' : 'border-gray-300'"
                                    class="w-6 h-6 rounded-full border-2 bg-white flex items-center justify-center transition-all">
                                    <div x-show="jawabanTerpilih[soalAktif] === opt"
                                        class="w-3 h-3 rounded-full bg-[#3378FF]" x-transition></div>
                                </div>
                            </div>

                            <div :class="jawabanTerpilih[soalAktif] === opt ? 'bg-[#3378FF] text-white' : 'bg-white text-[#3378FF]'"
                                class="w-9 h-9 rounded-full flex items-center justify-center font-bold mr-4 shrink-0 shadow-sm transition-colors">
                                <span x-text="opt"></span>
                            </div>

                            <span class="text-sm md:text-base font-medium text-[#2E3B66] leading-tight">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </span>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
