<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERSISTEN - Jeda Try Out</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-white font-po overflow-x-hidden" 
    x-data="{ 
        timeLeft: 0,
        timerText: '',
        canContinue: false,
        showExitModal: false,

        init() {
            // 1. Ambil data tersimpan
            let savedTime = localStorage.getItem('jeda_timer_{{ $tryout->id }}_{{ $next_category_id }}');
            
            if (savedTime === null) {
                // Jika benar-benar baru (belum ada storage), set 60 detik
                this.timeLeft = 60;
                localStorage.setItem('jeda_timer_{{ $tryout->id }}_{{ $next_category_id }}', 60);
            } else {
                // Jika sudah ada, ambil nilainya
                this.timeLeft = parseInt(savedTime);
            }

            // 2. Cek apakah sudah boleh lanjut
            if (this.timeLeft <= 0) {
                this.timeLeft = 0;
                this.canContinue = true;
            }

            this.updateTimerText();
            this.startTimer();
            this.lockHistory();
        },

        lockHistory() {
            history.pushState(null, null, window.location.href);
            window.onpopstate = () => {
                this.showExitModal = true;
                history.pushState(null, null, window.location.href);
            };
        },

        updateTimerText() {
            let minutes = Math.floor(this.timeLeft / 60);
            let seconds = this.timeLeft % 60;
            this.timerText = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        },

        startTimer() {
            if (this.canContinue) return;

            let timer = setInterval(() => {
                if (this.timeLeft > 0) {
                    this.timeLeft--;
                    this.updateTimerText();
                    localStorage.setItem('jeda_timer_{{ $tryout->id }}_{{ $next_category_id }}', this.timeLeft);
                } else {
                    this.canContinue = true;
                    this.timerText = '00:00';
                    localStorage.setItem('jeda_timer_{{ $tryout->id }}_{{ $next_category_id }}', 0);
                    clearInterval(timer);
                }
            }, 1000);
        },

        clearSessionData() {
            // Menghapus data pengerjaan dan timer sebelum keluar ke index
            localStorage.clear();
        }
    }">
    <div class="max-w-[1440px] mx-auto">
        <main class="p-4 md:p-10 flex justify-center">
            <div class="w-full bg-white border-2 border-gray-100 rounded-[25px] md:rounded-[35px] p-5 md:p-10 shadow-sm text-center">
                <div class="flex items-center gap-2 text-xs text-gray-400 font-medium mb-4 md:mb-6">
                    <span>Try Out UTBK</span>
                    <span><i class="fa-solid fa-chevron-right text-[10px]"></i></span>
                    <span class="text-gray-600">Istirahat</span>
                </div>
                <h2 class="text-2xl md:text-3xl font-bold text-[#2E3B66] uppercase text-left tracking-wide mb-8">Istirahat Sejenak</h2>
                
                <div class="inline-block bg-[#6EB4FF] text-white mt-0 md:mt-4 text-3xl md:text-4xl font-bold px-10 py-3 rounded-[25px] shadow-lg mb-8" 
                     x-text="timerText">
                </div>

                <div class="mb-10 text-center">
                    <h3 class="text-lg md:text-2xl font-bold text-[#2E3B66] mb-2 md:mb-4">Saatnya Istirahat Sejenak!</h3>
                    <p class="text-[#2E3B66] text-sm md:text-base max-w-2xl mx-auto leading-relaxed" x-show="!canContinue">Istirahatlah sejenak sebelum memulai subtes berikutnya.</p>
                    <p class="text-green-500 text-sm md:text-base font-bold max-w-2xl mx-auto leading-relaxed" x-show="canContinue" x-cloak>Waktu istirahat selesai! Silahkan lanjut ke subtes berikutnya.</p>
                </div>

                <div class="bg-[#E2EDFE] rounded-[20px] md:rounded-[30px] overflow-hidden mb-10 text-left">
                    <div class="bg-[#A5BBEC]/30 px-6 py-4 flex items-center gap-3">
                        <i class="fa-solid fa-book-open text-[#2E3B66] text-xl"></i>
                        <h4 class="font-bold text-[#2E3B66]">Daftar Subtes</h4>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-6">
                        @foreach($categories as $cat)
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full flex items-center justify-center {{ $cat->id < $next_category_id ? 'bg-green-500 text-white text-[10px]' : 'bg-white border-2 border-gray-200' }}">
                                @if($cat->id < $next_category_id)
                                    <i class="fa-solid fa-check"></i>
                                @endif
                            </div>
                            <span class="text-sm font-medium text-[#2E3B66]">{{ $cat->nama_kategori }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex flex-col md:flex-row justify-center items-center gap-4">
                    <button @click="showExitModal = true" 
                        class="w-full md:w-auto px-10 py-3 bg-white border-2 border-gray-100 text-gray-400 font-medium rounded-full hover:bg-gray-50 transition">
                        Keluar Ujian
                    </button>

                    <div class="w-full md:w-auto">
                        <a :href="canContinue ? '{{ route('tryout.soal', [$tryout->id, $next_category_id]) }}' : '#'" 
                           class="block w-full"
                           @click="if(!canContinue) $event.preventDefault()">
                            <button 
                                :class="canContinue ? 'bg-[#6EB4FF] shadow-lg active:scale-95' : 'bg-gray-300 cursor-not-allowed opacity-70'"
                                class="w-full px-12 py-3 text-white font-medium rounded-full transition-all duration-300">
                                <span x-text="canContinue ? 'Mulai Kembali' : 'Harap Tunggu...'"></span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div x-show="showExitModal" class="fixed inset-0 z-[99] flex items-center justify-center p-4" x-cloak>
        <div class="fixed inset-0 bg-black/50" @click="showExitModal = false"></div>
        <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full relative z-10 text-center shadow-2xl">
            <div class="w-20 h-20 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                <i class="fa-solid fa-circle-exclamation"></i>
            </div>
            <h3 class="text-xl font-black text-[#2E3B66] mb-2">Keluar Ujian?</h3>
            <p class="text-gray-500 text-sm mb-8">Data pengerjaan Anda akan hilang jika keluar sekarang. Yakin ingin keluar?</p>
            <div class="flex gap-4">
                <button @click="showExitModal = false" class="flex-1 py-3 rounded-xl font-bold bg-gray-100 text-gray-500">Batal</button>
                <a href="{{ route('tryout.index') }}" @click="clearSessionData()" class="flex-1 py-3 rounded-xl font-bold bg-red-500 text-white text-center">Ya, Keluar</a>
            </div>
        </div>
    </div>
</body>
</html>