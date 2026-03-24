<footer class="bg-[#24283b] text-white mt-10 pt-10 pb-10 px-3 md:px-11">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-start gap-12 md:gap-20">

        <!-- LOGO + DESKRIPSI -->
        <div class="flex-[1.5]">
            <div class="flex gap-3 items-center">
                <img src="{{ asset('img/bg-home-1.png') }}" alt="" class="w-8 h-8">
                <h2 class="text-3xl md:text-4xl font-bold tracking-tight">PERSISTEN</h2>
            </div>

            <p class="mt-6 text-gray-300 text-sm md:text-sm opacity-90 text-justify md:text-left leading-relaxed">
                Platform pembelajaran UTBK yang dirancang untuk menjaga konsistensi belajar dengan menyediakan pelacakan
                perkembangan dan sistem yang mendorong agar tetap teratur dalam berlatih selama proses persiapan
                berlangsung.
            </p>
        </div>

        <!-- MOBILE: 2 KOLOM -->
        <div class="grid grid-cols-2 gap-10 w-full md:hidden">

            <!-- QUICK LINKS -->
            <div>
                <h3 class="text-base font-semibold mb-4 tracking-widest uppercase text-white/90">
                    Quick Links
                </h3>
                <ul class="space-y-2 text-gray-300 text-sm">
                    <li><a href="#" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="#" class="hover:text-white transition">Try Out</a></li>
                    <li><a href="#" class="hover:text-white transition">Latihan Soal</a></li>
                    <li><a href="#" class="hover:text-white transition">Fundamental</a></li>
                    <li><a href="#" class="hover:text-white transition">Video</a></li>
                </ul>
            </div>

            <!-- BELAJAR (GRID 2 KOLOM BIAR RAPI) -->
            <div>
                <h3 class="text-base font-semibold mb-4 tracking-widest uppercase text-white/90">
                    Belajar
                </h3>
                <ul class="grid grid-cols-2 gap-y-2 gap-x-4 text-gray-300 text-sm">
                    <li><a href="#" class="hover:text-white uppercase">PU</a></li>
                    <li><a href="#" class="hover:text-white uppercase">PK</a></li>

                    <li><a href="#" class="hover:text-white uppercase">PPU</a></li>
                    <li><a href="#" class="hover:text-white uppercase">PM</a></li>

                    <li><a href="#" class="hover:text-white uppercase">PBM</a></li>
                    <li><a href="#" class="hover:text-white uppercase">LBI</a></li>

                    <li><a href="#" class="hover:text-white uppercase">LBE</a></li>
                </ul>
            </div>

        </div>

        <!-- DESKTOP -->
        <div class="hidden md:block w-[1px] bg-gray-600 self-stretch opacity-30"></div>

        <!-- QUICK LINKS DESKTOP -->
        <div class="hidden md:block flex-1">
            <h3 class="text-lg font-bold mb-8 tracking-widest uppercase text-white/90">
                Quick Links
            </h3>
            <ul class="space-y-3 text-gray-300 text-sm">
                <li><a href="#" class="hover:text-white transition">Beranda</a></li>
                <li><a href="#" class="hover:text-white transition">Try Out</a></li>
                <li><a href="#" class="hover:text-white transition">Latihan Soal</a></li>
                <li><a href="#" class="hover:text-white transition">Fundamental</a></li>
                <li><a href="#" class="hover:text-white transition">Video Pembelajaran</a></li>
            </ul>
        </div>

        <div class="hidden md:block w-[1px] bg-gray-600 self-stretch opacity-30"></div>

        <!-- BELAJAR DESKTOP -->
        <div class="hidden md:block flex-1">
            <h3 class="text-lg font-bold mb-8 tracking-widest uppercase text-white/90">
                Belajar
            </h3>
            <ul class="space-y-3 text-gray-300 text-sm">
                <li><a href="#" class="hover:text-white uppercase">PU</a></li>
                <li><a href="#" class="hover:text-white uppercase">PPU</a></li>
                <li><a href="#" class="hover:text-white uppercase">PBM</a></li>
                <li><a href="#" class="hover:text-white uppercase">PK</a></li>
                <li><a href="#" class="hover:text-white uppercase">PM</a></li>
                <li><a href="#" class="hover:text-white uppercase">LBI</a></li>
                <li><a href="#" class="hover:text-white uppercase">LBE</a></li>
            </ul>
        </div>

    </div>

    <!-- COPYRIGHT -->
    <div class="mt-10 border-t border-gray-700/50 text-center pt-6">
        <p class="text-gray-500 text-xs tracking-widest">
            © 2026 PERSISTEN, team SUPERNOVA.
        </p>
    </div>
</footer>
