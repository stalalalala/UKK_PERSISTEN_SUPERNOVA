<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Streak - PERSISTEN</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/pet.css') }}">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-poppins min-h-screen overflow-x-hidden">

    <img src="{{ asset('img/bg-awan.jpg') }}" alt="Background" class="fixed top-0 left-0 w-full h-full object-cover -z-50 pointer-events-none contrast-90">

    <div class="max-w-[1440px] mx-auto">
        <nav class="flex justify-between items-center bg-gray-100 rounded-full mx-4 md:mx-10 mt-4 px-4 py-2 shadow-sm">
            <div class="w-20 md:w-28 h-10 md:h-12 bg-blue-400 rounded-full flex-shrink-0"></div>
            <ul class="hidden lg:flex gap-8 xl:gap-12 text-gray-800 font-medium text-sm">
                <li><a href="/" class="hover:text-blue-500 transition-colors">Beranda</a></li>
                <li><a href="/streak" class="font-bold text-blue-600">Pet Streak</a></li>
                <li><a href="/tryout" class="hover:text-blue-500 transition-colors">Try Out</a></li>
                <li><a href="/latihan" class="hover:text-blue-500 transition-colors">Latihan Soal</a></li>
                <li><a href="/video" class="hover:text-blue-500 transition-colors">Video</a></li>
            </ul>
            <div class="flex gap-2">
                <div class="flex items-center gap-2 bg-[#FBBA16] p-1 rounded-full">
                    <a href="/profile" class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-[#3171CD] flex items-center justify-center text-white">
                        <i class="fa-solid fa-user text-sm md:text-base"></i>
                    </a>
                    <button class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-[#4B8A81] flex items-center justify-center text-white">
                        <i class="fa-solid fa-right-from-bracket text-sm md:text-base"></i>
                    </button>
                </div>
            </div>
        </nav>
    </div>

    <main class="max-w-[1300px] mx-auto mt-10 px-4 md:px-6 pb-20" x-data="{ 
        xp: 100, 
        maxXp: 300, 
        isClicked: false,
        trigger() {
            this.isClicked = true;
            setTimeout(() => this.isClicked = false, 600);
        }
    }">

        <div class="flex flex-col items-center mb-12">
            <div class="bg-blue-600 text-white px-8 py-1.5 rounded-full font-bold shadow-lg -mb-10 z-20 tracking-widest text-sm italic">
                • Level 1 •
            </div>

            <div class="slime relative z-10 w-full max-w-[320px] md:max-w-[500px] lg:max-w-[600px]" 
                 :class="{ 'animate-bounce-slime': isClicked }" @click="trigger">
                <object data="{{ asset('img/pet(tanpa_animasi).svg') }}" type="image/svg+xml" class="pointer-events-none select-none w-full h-auto"></object>
            </div>

            <div class="w-full max-w-md -mt-5 md:-mt-10 relative z-20">
                <div class="bg-blue-400/30 rounded-full h-8 md:h-9 p-1 border-2 border-blue-400/50 shadow-inner relative overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-full rounded-full transition-all duration-700" :style="`width: ${(xp/maxXp)*100}%` "></div>
                    <div class="absolute inset-0 flex items-center justify-center text-white font-black text-sm md:text-lg drop-shadow-md">
                        <span x-text="xp"></span>/<span x-text="maxXp"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-16 lg:gap-8 items-stretch mt-24">
            
            <div class="glass-card rounded-[3rem] p-2 border-4 border-white/50 shadow-2xl relative">
                <div class="bg-white/80 rounded-[2.5rem] p-6 md:p-8 border-2 border-orange-300 shadow-inner h-full flex flex-col justify-between">
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-5">
                        <div class="relative md:absolute md:-left-12 md:-top-20 drop-shadow-2xl w-48 md:w-80">
                            <img src="{{ asset('img/api.png') }}" class="w-full h-auto object-contain">
                            <span class="absolute top-[60%] left-1/2 -translate-x-1/2 -translate-y-1/2 text-white font-black text-4xl md:text-5xl italic tracking-tighter drop-shadow-md">X7</span>
                        </div>
                        <div class="md:ml-48 text-center md:text-left">
                            <span class="inline-block bg-yellow-400 text-blue-900 text-[10px] font-black px-4 py-1 rounded-full uppercase tracking-wider mb-2">Semangat Menyala</span>
                            <h2 class="text-6xl md:text-7xl font-black text-[#2E3B66] leading-none">Hari</h2>
                            <p class="text-blue-800/60 text-sm md:text-base font-bold mt-2">Konsisten belajar bikin peluang naik!</p>
                        </div>
                    </div>
                    <div class="mt-8 bg-orange-100/60 rounded-[2rem] p-4 border-2 border-orange-200">
                        <div class="flex justify-between items-center text-center">
                            <div class="flex-1"><p class="text-[9px] font-black text-gray-500 uppercase mb-1">Login</p><span class="bg-green-500 text-white text-[10px] font-black px-3 py-1.5 rounded-full shadow-[0_3px_0_0_#16a34a]">50XP</span></div>
                            <div class="w-px h-8 bg-orange-200/50"></div>
                            <div class="flex-1"><p class="text-[9px] font-black text-gray-500 uppercase mb-1">Latihan</p><span class="bg-[#FF908E] text-white text-[10px] font-black px-3 py-1.5 rounded-full shadow-[0_3px_0_0_#e57373]">20XP</span></div>
                            <div class="w-px h-8 bg-orange-200/50"></div>
                            <div class="flex-1"><p class="text-[9px] font-black text-gray-500 uppercase mb-1">Kuis</p><span class="bg-[#FF908E] text-white text-[10px] font-black px-3 py-1.5 rounded-full shadow-[0_3px_0_0_#e57373]">20XP</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-[3rem] p-2 border-4 border-white/50 shadow-2xl relative">
                <div class="bg-white/20 backdrop-blur-sm rounded-[2.5rem] p-6 md:p-8 border-2 border-blue-200 shadow-inner h-full flex flex-col overflow-hidden">
                    <div class="absolute -right-8 top-0 md:right-4 md:top-4 opacity-30 md:opacity-80 pointer-events-none">
                        <img src="{{ asset('img/slime-tp.png') }}" class="w-32 md:w-64 h-auto object-contain">
                    </div>
                    <div class="mb-4 relative z-10">
                        <div class="bg-blue-600 text-white px-5 py-1.5 rounded-2xl font-black text-xs inline-block shadow-md uppercase tracking-wider">Misi Harian</div>
                    </div>
                    <ul class="mt-4 space-y-4 flex-grow relative z-10">
                        <li class="flex items-center gap-4"><input type="checkbox" checked class="w-6 h-6 rounded-lg border-2 border-blue-300 text-blue-600 focus:ring-0"><span class="text-[#2E3B66] font-bold text-sm md:text-base opacity-40 line-through">Login Harian</span></li>
                        <li class="flex items-center gap-4"><input type="checkbox" class="w-6 h-6 rounded-lg border-2 border-blue-300 text-blue-600 focus:ring-0"><span class="text-[#2E3B66] font-bold text-sm md:text-base">Kuis Fundamental</span></li>
                        <li class="flex items-center gap-4"><input type="checkbox" class="w-6 h-6 rounded-lg border-2 border-blue-300 text-blue-600 focus:ring-0"><span class="text-[#2E3B66] font-bold text-sm md:text-base">Latihan Soal</span></li>
                    </ul>
                    <div class="mt-10 bg-blue-50/50 rounded-[2rem] p-5 border-2 border-blue-100 relative z-10">
                        <div class="flex justify-between text-[10px] font-black text-blue-600 mb-2 uppercase tracking-widest"><span>Capai XP harian</span><span class="bg-blue-600 text-white px-3 py-0.5 rounded-full">25/75</span></div>
                        <div class="bg-white/50 rounded-full h-4 p-1 border border-blue-200 overflow-hidden"><div class="bg-blue-600 h-full w-[33%] rounded-full shadow-sm transition-all duration-1000"></div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-10 glass-card rounded-[2rem] p-4 md:p-6 border-2 border-white/40 flex flex-col md:flex-row items-center justify-between group hover:border-blue-300 transition-all shadow-lg relative overflow-hidden">
            <div class="flex items-center gap-5 relative z-10 w-full md:w-auto">
                <div class="bg-blue-100 p-3 md:p-4 rounded-2xl"><i class="fa-solid fa-lock text-blue-400 text-xl md:text-2xl"></i></div>
                <div>
                    <h3 class="text-[#2E3B66] font-black text-base md:text-lg leading-none">Evolusi Berikutnya <span class="text-xs font-bold text-gray-500 ml-2">(Lv 5)</span></h3>
                    <p class="text-blue-800/60 text-xs md:text-sm font-semibold mt-1">Capai <span class="text-blue-600 font-black">Level 5</span> untuk membuka bentuk baru!</p>
                </div>
            </div>
            <div class="absolute right-[-10px] md:right-[15%] pointer-events-none transition-all duration-700 group-hover:scale-110 opacity-20 md:opacity-100">
                <img src="{{ asset('img/slime-tp2.png') }}" class="w-32 md:w-64 lg:w-80 h-auto object-contain grayscale group-hover:grayscale-0">
            </div>
        </div>
    </main>

    @include('layouts.footer')
</body>
</html>