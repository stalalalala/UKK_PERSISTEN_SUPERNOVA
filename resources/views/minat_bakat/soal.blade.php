<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Minat & Bakat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .clip-slant { clip-path: polygon(0 15%, 100% 0, 100% 100%, 0 100%); }
        
        /* Mencegah teks meluap pada layar sangat kecil */
        .btn-text { font-size: clamp(7px, 1.2vw, 10px); }
    </style>
</head>
<body class="bg-blue-50 flex items-center justify-center min-h-screen p-2 sm:p-4" 
      x-data="{ 
        step: 1, 
        totalSteps: 50, 
        selected: null,
        nextStep() {
            if(this.selected !== null && this.step < this.totalSteps) {
                this.step++;
                this.selected = null;
            }
        },
        prevStep() { if(this.step > 1) this.step--; }
      }">

    <div class="bg-white rounded-3xl shadow-xl w-full max-w-4xl overflow-hidden border border-blue-100 flex flex-col">
        
        <div class="p-4 sm:p-6 flex justify-between items-center">
            <h1 class="text-lg sm:text-2xl font-bold text-slate-800">Tes Minat & Bakat</h1>
            <div class="bg-white border border-gray-200 px-3 py-1 sm:px-5 sm:py-1.5 rounded-full text-xs sm:text-sm font-bold text-gray-500 shadow-sm whitespace-nowrap">
                Soal <span x-text="step"></span> dari 50
            </div>
        </div>

        <div class="px-6 sm:px-12 mb-4">
            <div class="h-2 w-full bg-blue-100 rounded-full overflow-hidden">
                <div class="h-full bg-blue-500 transition-all duration-700 ease-out" 
                     :style="`width: ${(step / totalSteps) * 100}%` "></div>
            </div>
        </div>

        <div class="mx-4 sm:mx-8 mb-8 bg-slate-50 rounded-[2rem] sm:rounded-[2.5rem] p-6 sm:p-10 relative border border-blue-50">
            <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold shadow-lg ring-4 ring-white"
                 x-text="step"></div>
            
            <p class="text-center text-slate-600 text-base sm:text-xl leading-relaxed font-semibold mb-8 sm:mb-12">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.
            </p>

            <div class="max-w-3xl mx-auto flex flex-col items-center">
                <div class="grid grid-cols-5 gap-2 sm:gap-4 items-end w-full">
                    
                    <div class="flex flex-col items-center">
                        <button @click="selected = 1" 
                                class="w-full h-32 sm:h-48 bg-blue-500 clip-slant rounded-lg sm:rounded-xl flex items-end justify-center pb-4 sm:pb-6 px-1 transition-all outline-none"
                                :class="selected === 1 ? 'ring-2 sm:ring-4 ring-blue-200 shadow-lg scale-105' : 'opacity-70 hover:opacity-100'">
                            <span class="text-white btn-text font-bold uppercase text-center leading-none">Sangat Setuju</span>
                        </button>
                        <div class="py-2 sm:py-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-10 sm:w-10 text-blue-500 transition-all duration-300" :class="selected === 1 ? 'scale-125 opacity-100' : 'opacity-40'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>

                    <div class="flex flex-col items-center">
                        <button @click="selected = 2" 
                                class="w-full h-28 sm:h-40 bg-blue-300 clip-slant rounded-lg sm:rounded-xl flex items-end justify-center pb-4 sm:pb-6 px-1 transition-all outline-none"
                                :class="selected === 2 ? 'ring-2 sm:ring-4 ring-blue-100 shadow-lg scale-105' : 'opacity-70 hover:opacity-100'">
                            <span class="text-white btn-text font-bold uppercase text-center leading-none">Setuju</span>
                        </button>
                        <div class="py-2 sm:py-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-10 sm:w-10 text-blue-400 transition-all duration-300" :class="selected === 2 ? 'scale-125 opacity-100' : 'opacity-40'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>

                    <div class="flex flex-col items-center">
                        <button @click="selected = 3" 
                                class="w-full h-24 sm:h-32 bg-gray-400 clip-slant rounded-lg sm:rounded-xl flex items-end justify-center pb-4 sm:pb-6 px-1 transition-all outline-none"
                                :class="selected === 3 ? 'ring-2 sm:ring-4 ring-gray-200 shadow-lg scale-105' : 'opacity-70 hover:opacity-100'">
                            <span class="text-white btn-text font-bold uppercase text-center leading-none">Netral</span>
                        </button>
                        <div class="py-2 sm:py-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-10 sm:w-10 text-blue-300 transition-all duration-300" :class="selected === 3 ? 'scale-125 opacity-100' : 'opacity-40'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>

                    <div class="flex flex-col items-center">
                        <button @click="selected = 4" 
                                class="w-full h-20 sm:h-28 bg-red-300 clip-slant rounded-lg sm:rounded-xl flex items-end justify-center pb-4 sm:pb-6 px-1 transition-all outline-none"
                                :class="selected === 4 ? 'ring-2 sm:ring-4 ring-red-100 shadow-lg scale-105' : 'opacity-70 hover:opacity-100'">
                            <span class="text-white btn-text font-bold uppercase text-center leading-none">Tidak Setuju</span>
                        </button>
                        <div class="py-2 sm:py-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-10 sm:w-10 text-blue-400 transition-all duration-300" :class="selected === 4 ? 'scale-125 opacity-100' : 'opacity-40'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.172 15.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>

                    <div class="flex flex-col items-center">
                        <button @click="selected = 5" 
                                class="w-full h-16 sm:h-24 bg-red-500 clip-slant rounded-lg sm:rounded-xl flex items-end justify-center pb-4 sm:pb-6 px-1 transition-all outline-none"
                                :class="selected === 5 ? 'ring-2 sm:ring-4 ring-red-200 shadow-lg scale-105' : 'opacity-70 hover:opacity-100'">
                            <span class="text-white btn-text font-bold uppercase text-center leading-none">Sangat Tidak Setuju</span>
                        </button>
                        <div class="py-2 sm:py-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-10 sm:w-10 text-blue-500 transition-all duration-300" :class="selected === 5 ? 'scale-125 opacity-100' : 'opacity-40'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.172 15.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="h-2 w-full rounded-full bg-gradient-to-r from-blue-400 via-gray-300 to-red-400 opacity-40 mt-[-4px]"></div>
            </div>
        </div>

        <div class="p-4 sm:p-6 flex justify-between items-center bg-gray-50/50">
            <button @click="prevStep()" 
                    x-show="step > 1"
                    class="px-4 sm:px-6 py-2 sm:py-2.5 rounded-xl border border-gray-300 text-gray-500 font-bold hover:bg-white active:scale-95 transition-all outline-none text-sm sm:text-base">
                &larr; <span class="hidden sm:inline">Sebelumnya</span>
            </button>
            <div x-show="step === 1"></div> 
            
            <button @click="nextStep()"
                    :disabled="selected === null"
                    class="px-8 sm:px-12 py-3 bg-blue-500 text-white rounded-xl font-bold shadow-lg hover:bg-blue-600 disabled:bg-gray-300 disabled:shadow-none active:scale-95 transition-all outline-none text-sm sm:text-base">
                Selanjutnya
            </button>
        </div>
    </div>
</body>
</html>