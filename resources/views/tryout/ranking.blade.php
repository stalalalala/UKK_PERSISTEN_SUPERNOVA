<!DOCTYPE html>
<html lang="en">

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

<body class="font-po bg-white overflow-x-hidden h-screen">

    <div class="max-w-[1440px] mx-auto h-full flex flex-col px-4 md:px-10 py-6">

        <div class="flex justify-between items-center mb-6 shrink-0">
            <div class="flex items-center gap-3">
                <div class="text-[#3171CD] text-2xl md:text-3xl">
                    <i class="fa-solid fa-award"></i>
                </div>
                <h1 class="text-xl md:text-2xl font-bold text-[#2E3B66]">Peringkat Try Out</h1>
            </div>

            <a href="#"
                class="px-6 py-1.5 border-2 border-[#6EB4FF] text-[#6EB4FF] font-semibold rounded-full text-sm hover:bg-[#6EB4FF] hover:text-white transition-all">
                Kembali
            </a>
        </div>

        <div
            class="bg-[#E2EDFE] rounded-[20px] md:rounded-[35px] p-4 md:p-8 shadow-sm border border-blue-100 flex flex-col flex-1 min-h-0 overflow-hidden mb-4">

            <div
                class="grid grid-cols-12 mb-4 text-xs md:text-sm font-bold text-gray-500 uppercase tracking-widest shrink-0">
                <div class="col-span-3 md:col-span-2">Peringkat</div>
                <div class="col-span-5 md:col-span-7 ">Nama Peserta</div>
                <div class="col-span-4 md:col-span-3 text-right">Skor Try Out</div>
            </div>

            <div class="flex-1 overflow-y-auto pr-2 custom-scrollbar space-y-3">

                <div
                    class="grid grid-cols-12 items-center bg-white rounded-lg md:rounded-2xl p-3 md:p-4 border border-blue-50 shadow-sm">
                    <div class="col-span-2"><span
                            class="bg-blue-50 text-[#3171CD] font-semibold px-3 py-1 rounded-lg text-sm">#1</span></div>
                    <div class="col-span-7 font-semibold text-[#3171CD] text-sm md:text-base">Sean</div>
                    <div class="col-span-3 text-right font-bold text-[#3171CD] text-sm md:text-lg">981.52</div>
                </div>

                <div
                    class="grid grid-cols-12 items-center bg-white rounded-lg md:rounded-2xl p-3 md:p-4 border border-blue-50 shadow-sm">
                    <div class="col-span-2"><span
                            class="bg-blue-50 text-[#3171CD] font-semibold px-3 py-1 rounded-lg text-sm">#2</span></div>
                    <div class="col-span-7 font-semibold text-[#3171CD] text-sm md:text-base">Third</div>
                    <div class="col-span-3 text-right font-bold text-[#3171CD] text-sm md:text-lg">804.98</div>
                </div>

                <div
                    class="grid grid-cols-12 items-center bg-white rounded-lg md:rounded-2xl p-3 md:p-4 border border-blue-50 shadow-sm">
                    <div class="col-span-2"><span
                            class="bg-blue-50 text-[#3171CD] font-semibold px-3 py-1 rounded-lg text-sm">#3</span></div>
                    <div class="col-span-7 font-semibold text-[#3171CD] text-sm md:text-base">Bang Jeemin</div>
                    <div class="col-span-3 text-right font-bold text-[#3171CD] text-sm md:text-lg">542.85</div>
                </div>

                <div
                    class="grid grid-cols-12 items-center bg-white rounded-lg md:rounded-2xl p-3 md:p-4 border border-blue-50 shadow-sm">
                    <div class="col-span-2"><span class="text-gray-400 font-semibold px-3 py-1 text-sm">#4</span></div>
                    <div class="col-span-7 font-semibold text-[#3171CD] text-sm md:text-base">Jennie Blackping</div>
                    <div class="col-span-3 text-right font-bold text-[#3171CD] text-sm md:text-lg">532.99</div>
                </div>

                <div
                    class="grid grid-cols-12 items-center bg-white rounded-lg md:rounded-2xl p-3 md:p-4 border border-blue-50 shadow-sm">
                    <div class="col-span-2"><span class="text-gray-400 font-semibold px-3 py-1 text-sm">#5</span></div>
                    <div class="col-span-7 font-semibold text-[#3171CD] text-sm md:text-base">Sora</div>
                    <div class="col-span-3 text-right font-bold text-[#3171CD] text-sm md:text-lg">510.00</div>
                </div>

                <div
                    class="grid grid-cols-12 items-center bg-white rounded-lg md:rounded-2xl p-3 md:p-4 border border-blue-50 shadow-sm">
                    <div class="col-span-2"><span class="text-gray-400 font-semibold px-3 py-1 text-sm">#6</span></div>
                    <div class="col-span-7 font-semibold text-[#3171CD] text-sm md:text-base">Thipakorn</div>
                    <div class="col-span-3 text-right font-bold text-[#3171CD] text-sm md:text-lg">499.99</div>
                </div>

                <div
                    class="grid grid-cols-12 items-center bg-white rounded-lg md:rounded-2xl p-3 md:p-4 border border-blue-50 shadow-sm">
                    <div class="col-span-2"><span class="text-gray-400 font-semibold px-3 py-1 text-sm">#7</span></div>
                    <div class="col-span-7 font-semibold text-[#3171CD] text-sm md:text-base">Elsa</div>
                    <div class="col-span-3 text-right font-bold text-[#3171CD] text-sm md:text-lg">483.85</div>
                </div>

                <div
                    class="grid grid-cols-12 items-center bg-white rounded-lg md:rounded-2xl p-3 md:p-4 border border-blue-50 shadow-sm">
                    <div class="col-span-2"><span class="text-gray-400 font-semibold px-3 py-1 text-sm">#8</span></div>
                    <div class="col-span-7 font-semibold text-[#3171CD] text-sm md:text-base">Koko Narai</div>
                    <div class="col-span-3 text-right font-bold text-[#3171CD] text-sm md:text-lg">475.00</div>
                </div>

                <div
                    class="grid grid-cols-12 items-center bg-white rounded-lg md:rounded-2xl p-3 md:p-4 border border-blue-50 shadow-sm">
                    <div class="col-span-2"><span class="text-gray-400 font-semibold px-3 py-1 text-sm">#9</span></div>
                    <div class="col-span-7 font-semibold text-[#3171CD] text-sm md:text-base">Mingyu</div>
                    <div class="col-span-3 text-right font-bold text-[#3171CD] text-sm md:text-lg">450.78</div>
                </div>

                <div
                    class="grid grid-cols-12 items-center bg-white rounded-lg md:rounded-2xl p-3 md:p-4 border border-blue-50 shadow-sm">
                    <div class="col-span-2"><span class="text-gray-400 font-semibold px-3 py-1 text-sm">#10</span></div>
                    <div class="col-span-7 font-semibold text-[#3171CD] text-sm md:text-base">Park Bogum</div>
                    <div class="col-span-3 text-right font-bold text-[#3171CD] text-sm md:text-lg">444.44</div>
                </div>

                <div
                    class="grid grid-cols-12 items-center bg-white rounded-lg md:rounded-2xl p-3 md:p-4 border border-blue-50 shadow-sm">
                    <div class="col-span-2"><span class="text-gray-400 font-semibold px-3 py-1 text-sm">#11</span></div>
                    <div class="col-span-7 font-semibold text-[#3171CD] text-sm md:text-base">Peserta 11</div>
                    <div class="col-span-3 text-right font-bold text-[#3171CD] text-sm md:text-lg">430.00</div>
                </div>

                <div
                    class="grid grid-cols-12 items-center bg-white rounded-lg md:rounded-2xl p-3 md:p-4 border border-blue-50 shadow-sm">
                    <div class="col-span-2"><span class="text-gray-400 font-semibold px-3 py-1 text-sm">#12</span></div>
                    <div class="col-span-7 font-semibold text-[#3171CD] text-sm md:text-base">Peserta 12</div>
                    <div class="col-span-3 text-right font-bold text-[#3171CD] text-sm md:text-lg">420.00</div>
                </div>

                <div
                    class="grid grid-cols-12 items-center bg-white rounded-lg md:rounded-2xl p-3 md:p-4 border border-blue-50 shadow-sm">
                    <div class="col-span-2"><span class="text-gray-400 font-semibold px-3 py-1 text-sm">#13</span></div>
                    <div class="col-span-7 font-semibold text-[#3171CD] text-sm md:text-base">Peserta 13</div>
                    <div class="col-span-3 text-right font-bold text-[#3171CD] text-sm md:text-lg">410.00</div>
                </div>

                <div
                    class="grid grid-cols-12 items-center bg-white rounded-lg md:rounded-2xl p-3 md:p-4 border border-blue-50 shadow-sm">
                    <div class="col-span-2"><span class="text-gray-400 font-semibold px-3 py-1 text-sm">#14</span></div>
                    <div class="col-span-7 font-semibold text-[#3171CD] text-sm md:text-base">Peserta 14</div>
                    <div class="col-span-3 text-right font-bold text-[#3171CD] text-sm md:text-lg">400.00</div>
                </div>

                <div
                    class="grid grid-cols-12 items-center bg-white rounded-lg md:rounded-2xl p-3 md:p-4 border border-blue-50 shadow-sm">
                    <div class="col-span-2"><span class="text-gray-400 font-semibold px-3 py-1 text-sm">#15</span></div>
                    <div class="col-span-7 font-semibold text-[#3171CD] text-sm md:text-base">Peserta 15</div>
                    <div class="col-span-3 text-right font-bold text-[#3171CD] text-sm md:text-lg">390.00</div>
                </div>

                <div
                    class="grid grid-cols-12 items-center bg-white rounded-lg md:rounded-2xl p-3 md:p-4 border border-blue-50 shadow-sm">
                    <div class="col-span-2"><span class="text-gray-400 font-semibold px-3 py-1 text-sm">#16</span>
                    </div>
                    <div class="col-span-7 font-semibold text-[#3171CD] text-sm md:text-base">Peserta 16</div>
                    <div class="col-span-3 text-right font-bold text-[#3171CD] text-sm md:text-lg">380.00</div>
                </div>

                <div
                    class="grid grid-cols-12 items-center bg-white rounded-lg md:rounded-2xl p-3 md:p-4 border border-blue-50 shadow-sm">
                    <div class="col-span-2"><span class="text-gray-400 font-semibold px-3 py-1 text-sm">#17</span>
                    </div>
                    <div class="col-span-7 font-semibold text-[#3171CD] text-sm md:text-base">Peserta 17</div>
                    <div class="col-span-3 text-right font-bold text-[#3171CD] text-sm md:text-lg">370.00</div>
                </div>

                <div
                    class="grid grid-cols-12 items-center bg-white rounded-lg md:rounded-2xl p-3 md:p-4 border border-blue-50 shadow-sm">
                    <div class="col-span-2"><span class="text-gray-400 font-semibold px-3 py-1 text-sm">#18</span>
                    </div>
                    <div class="col-span-7 font-semibold text-[#3171CD] text-sm md:text-base">Peserta 18</div>
                    <div class="col-span-3 text-right font-bold text-[#3171CD] text-sm md:text-lg">360.00</div>
                </div>

                <div
                    class="grid grid-cols-12 items-center bg-white rounded-lg md:rounded-2xl p-3 md:p-4 border border-blue-50 shadow-sm">
                    <div class="col-span-2"><span class="text-gray-400 font-semibold px-3 py-1 text-sm">#19</span>
                    </div>
                    <div class="col-span-7 font-semibold text-[#3171CD] text-sm md:text-base">Peserta 19</div>
                    <div class="col-span-3 text-right font-bold text-[#3171CD] text-sm md:text-lg">350.00</div>
                </div>

                <div
                    class="grid grid-cols-12 items-center bg-white rounded-lg md:rounded-2xl p-3 md:p-4 border border-blue-50 shadow-sm">
                    <div class="col-span-2"><span class="text-gray-400 font-semibold px-3 py-1 text-sm">#20</span>
                    </div>
                    <div class="col-span-7 font-semibold text-[#3171CD] text-sm md:text-base">Peserta 20</div>
                    <div class="col-span-3 text-right font-bold text-[#3171CD] text-sm md:text-lg">340.00</div>
                </div>

            </div>

            <div class="mt-4 shrink-0">
                <div class="bg-white rounded-2xl p-4 border-2 border-blue-100 shadow-md">
                    <p class="text-sm md:text-xs font-bold text-gray-500  mb-2 ml-2 uppercase tracking-wide">
                        Peringkat Anda</p>
                    <div class="grid grid-cols-12 items-center bg-[#6EB4FF] rounded-xl p-3 md:p-4 shadow-md">
                        <div class="col-span-2 border-r border-white/30 text-left">
                            <span class="text-white font-semibold text-sm">#3</span>
                        </div>
                        <div class="col-span-7 px-4 font-semibold text-white text-sm md:text-base">Bang Jeemin</div>
                        <div class="col-span-3 text-right font-bold text-white text-sm md:text-lg">542.85</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        /* Hilangkan scrollbar di body utama */
        body {
            overscroll-behavior: none;
        }

        /* Custom scrollbar di area daftar peringkat */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #3171CD;
            border-radius: 10px;
        }
    </style>

</body>

</html>
