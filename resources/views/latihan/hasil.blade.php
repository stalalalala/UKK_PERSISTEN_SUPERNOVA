<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Latihan Soal - Web UTBK</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="font-poppins bg-gray-50 min-h-screen pb-20 overflow-x-hidden">

    <header class="max-w-6xl mx-auto px-6 py-8 flex justify-between items-center relative z-10">
        <h1 class="text-3xl font-black text-[#2E3B66]">PU – Set 1</h1>
        <a href="{{ url('/latihan') }}" class="px-8 py-2 border-2 border-[#4A9FFF] text-[#4A9FFF] font-bold rounded-full hover:bg-[#4A9FFF] hover:text-white transition-all shadow-sm">
            Kembali
        </a>
    </header>

    <main class="max-w-6xl mx-auto px-4 mt-12">
        <div class="bg-white rounded-[40px] shadow-sm border-2 border-gray-100 p-6 md:p-10 relative">
            
            <div class="relative max-w-4xl mx-auto mb-16 z-10 -mt-20 md:-mt-24">
                <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-[95%] h-12 bg-gradient-to-r from-yellow-400 via-white to-yellow-400 rounded-[30px] z-0 opacity-80"></div>
                <div class="relative bg-white rounded-3xl shadow-xl border border-gray-100 p-6 md:p-8 z-10">
                    <div class="flex items-center justify-center gap-3 mb-8 text-[#2E3B66]">
                        <i class="fa-solid fa-bookmark text-2xl"></i>
                        <h2 class="text-2xl font-black tracking-tight">Hasil Latihan Soal</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-[#A7E4B5] rounded-2xl p-4 flex items-center justify-center gap-3 border-b-4 border-[#76C88A] shadow-sm">
                            <div class="bg-white/50 w-10 h-10 rounded-full flex items-center justify-center"><i class="fa-solid fa-check text-[#1B5E20] font-bold"></i></div>
                            <span class="text-[#1B5E20] font-black text-xl">15 benar</span>
                        </div>
                        <div class="bg-[#D1D5DB] rounded-2xl p-4 flex items-center justify-center gap-3 border-b-4 border-[#9CA3AF] shadow-sm">
                            <div class="bg-white/50 w-10 h-10 rounded-full flex items-center justify-center"><i class="fa-solid fa-minus text-gray-700 font-bold"></i></div>
                            <span class="text-gray-700 font-black text-xl">0 Kosong</span>
                        </div>
                        <div class="bg-[#FFB1B1] rounded-2xl p-4 flex items-center justify-center gap-3 border-b-4 border-[#EF4444] shadow-sm">
                            <div class="bg-white/50 w-10 h-10 rounded-full flex items-center justify-center"><i class="fa-solid fa-xmark text-[#B71C1C] font-bold"></i></div>
                            <span class="text-[#B71C1C] font-black text-xl">5 Salah</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-8" x-data="{ activeSoal: 1 }">
                
                <div class="bg-[#E8F1FF] rounded-[35px] p-6 md:p-8 transition-all duration-300 shadow-sm border border-blue-50">
                    <div class="flex justify-between items-center cursor-pointer" @click="activeSoal = (activeSoal === 1 ? null : 1)">
                        <div class="flex items-center gap-4">
                            <div class="bg-[#4A9FFF] text-white font-black px-5 py-2 rounded-2xl text-lg shadow-md">PU</div>
                            <span class="text-[#2E3B66] font-bold text-xl">Soal Nomor 1</span>
                        </div>
                        <div class="text-[#4A9FFF] transition-transform duration-500" :class="activeSoal === 1 ? 'rotate-180' : ''">
                            <i class="fa-solid fa-chevron-down text-2xl"></i>
                        </div>
                    </div>

                    <div x-show="activeSoal === 1" x-collapse>
                        <div class="mt-8 bg-white rounded-[30px] p-6 md:p-10 shadow-sm">
                            <div class="flex gap-5 mb-6">
                                <div class="w-10 h-10 bg-[#4A9FFF] text-white rounded-full flex items-center justify-center flex-shrink-0 font-black">1</div>
                                <div class="space-y-2">
                                    <h3 class="font-black text-[#2E3B66] text-xl">Soal:</h3>
                                    <p class="text-gray-600 font-medium leading-relaxed">Lorem ipsum dolor sit amet, consectetur sit amet adipiscing elit. Sed do eiusmod tempor...</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 ml-14 mb-8">
                                <div class="bg-[#A7E4B5] w-8 h-8 rounded-full flex items-center justify-center"><i class="fa-solid fa-check text-[#1B5E20] text-sm"></i></div>
                                <span class="text-[#2E7D32] font-black text-2xl">Jawaban : B</span>
                            </div>
                            <div class="ml-14 border-t border-gray-100 pt-6 font-medium text-gray-500">
                                <h4 class="font-black text-[#2E3B66] text-xl mb-3">Pembahasan:</h4>
                                <p>Penjelasan detail mengapa jawabannya B...</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-[#E8F1FF] rounded-[35px] p-6 md:p-8 transition-all duration-300 shadow-sm border border-blue-50">
                    <div class="flex justify-between items-center cursor-pointer" @click="activeSoal = (activeSoal === 2 ? null : 2)">
                        <div class="flex items-center gap-4">
                            <div class="bg-[#4A9FFF] text-white font-black px-5 py-2 rounded-2xl text-lg shadow-md">PU</div>
                            <span class="text-[#2E3B66] font-bold text-xl">Soal Nomor 2</span>
                        </div>
                        <div class="text-[#4A9FFF] transition-transform duration-500" :class="activeSoal === 2 ? 'rotate-180' : ''">
                            <i class="fa-solid fa-chevron-down text-2xl"></i>
                        </div>
                    </div>

                    <div x-show="activeSoal === 2" x-collapse>
                        <div class="mt-8 bg-white rounded-[30px] p-6 md:p-10 shadow-sm">
                            <div class="flex gap-5 mb-6">
                                <div class="w-10 h-10 bg-[#4A9FFF] text-white rounded-full flex items-center justify-center flex-shrink-0 font-black">2</div>
                                <div class="space-y-2">
                                    <h3 class="font-black text-[#2E3B66] text-xl">Soal:</h3>
                                    <p class="text-gray-600 font-medium leading-relaxed">Ini adalah teks pertanyaan untuk soal nomor 2...</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 ml-14 mb-8 text-[#B71C1C]">
                                <div class="bg-[#FFB1B1] w-8 h-8 rounded-full flex items-center justify-center"><i class="fa-solid fa-xmark text-sm"></i></div>
                                <span class="font-black text-2xl">Jawaban Kamu : A (Salah)</span>
                            </div>
                            <div class="ml-14 border-t border-gray-100 pt-6 font-medium text-gray-500">
                                <h4 class="font-black text-[#2E3B66] text-xl mb-3">Pembahasan:</h4>
                                <p>Jawaban yang benar seharusnya adalah C karena...</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>