<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERSISTEN - {{ $tryout->nama_tryout }} - {{ $currentCategory->nama_kategori }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        [x-cloak] {
            display: none !important;
    @vite('resources/css/app.css')
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 font-po min-h-screen py-10 overflow-x-hidden px-6 md:px-10">

    <div x-data="{ 
        soalAktif: parseInt(localStorage.getItem('last_soal_{{ $tryout->id }}_{{ $currentCategory->id }}')) || 1, 
        totalSoal: {{ $soals->count() }}, 
        jawabanTerpilih: JSON.parse(localStorage.getItem('jawaban_to_{{ $tryout->id }}_{{ $currentCategory->id }}')) || {},
        
        // PERBAIKAN TIMER: Cek localStorage dulu, jika tidak ada baru pakai durasi asli
        timeLeft: parseInt(localStorage.getItem('timer_{{ $tryout->id }}_{{ $currentCategory->id }}')) ?? {{ ($totalDurasi ?? 30) * 60 }}, 
        
        timerText: '',
        showExitModal: false,
        showConfirmNextModal: false, 
        
        adaSoalKosong() {
            return Object.keys(this.jawabanTerpilih).length < this.totalSoal;
        },

        pindahHalaman() {
            this.sendData().then(() => {
                this.clearData();
                @if($nextCategory)
                    window.location.href = '{{ route('tryout.jeda', [$tryout->id, $nextCategory->id]) }}';
                @else
                    window.location.href = '{{ route('tryout.hasil', $tryout->id) }}';
                @endif
            }).catch(error => {
                console.error('Gagal mengirim jawaban:', error);
                window.location.reload(); 
            });
        },

        sendData() {
            return fetch('{{ route('tryout.simpan', $tryout->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ jawaban: this.jawabanTerpilih })
            });
        },

        init() {
            // Jika di localStorage nilainya null (pertama kali buka), set ke durasi asli
            if (isNaN(this.timeLeft) || this.timeLeft === null) {
                this.timeLeft = {{ ($totalDurasi ?? 30) * 60 }};
            }

            this.updateTimerText();
            this.startTimer();
            this.lockHistory();

            this.$watch('jawabanTerpilih', (value) => {
                localStorage.setItem('jawaban_to_{{ $tryout->id }}_{{ $currentCategory->id }}', JSON.stringify(value));
            });

            this.$watch('soalAktif', (value) => {
                localStorage.setItem('last_soal_{{ $tryout->id }}_{{ $currentCategory->id }}', value);
            });
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
            this.timerText = `${minutes.toString().padStart(2, '0')}.${seconds.toString().padStart(2, '0')}`;
        },

        startTimer() {
            let timer = setInterval(() => {
                if (this.timeLeft > 0) {
                    this.timeLeft--;
                    this.updateTimerText();
                    // SIMPAN SISA WAKTU KE STORAGE TIAP DETIK
                    localStorage.setItem('timer_{{ $tryout->id }}_{{ $currentCategory->id }}', this.timeLeft);
                } else {
                    clearInterval(timer);
                    this.pindahHalaman();
                }
            }, 1000);
        },

        clearData() {
            localStorage.removeItem('jawaban_to_{{ $tryout->id }}_{{ $currentCategory->id }}');
            localStorage.removeItem('last_soal_{{ $tryout->id }}_{{ $currentCategory->id }}');
            localStorage.removeItem('timer_{{ $tryout->id }}_{{ $currentCategory->id }}');
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

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

        /* Mencegah scroll bodi utama di laptop agar layout tetap fit di layar */
        @media (min-width: 1024px) {
            .desktop-fixed {
                height: 100vh;
                overflow: hidden;
            }
        }
    </style>
</head>

<body class="p-4 md:p-6 pt-0 desktop-fixed">

    <div x-data="kuisApp()" @keydown.window.enter="nextSoal()" x-init="startTimer()" x-cloak
        class="h-full flex flex-col max-w-[1440px] mx-auto">

        <div class="flex flex-row items-center justify-between mb-4 shrink-0">
            <h1 class="text-lg md:text-xl font-bold text-[#2E3B66]">
                {{ $tryout->nama_tryout }}
            </h1>
            </h1>
            <div class="flex items-center gap-2 md:gap-4">
                <div
                    class="flex items-center gap-2 bg-blue-50 border-2 border-[#4FAAFD] px-2 h-8  rounded-full shadow-sm transition-all">
                    <svg class="w-5 h-5 text-[#4FAAFD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-base md:text-lg font-medium text-[#4FAAFD] leading-none"
                        x-text="formatTime(timeLeft)">
                    </p>
                </div>

                <button @click="confirmExit()"
                    class="bg-red-500 hover:bg-red-600 text-white  border-2 border-red-600 px-3 h-8 rounded-full font-medium text-xs md:text-sm shadow-xl transition-all active:scale-95 flex items-center justify-center">
                    KELUAR
                </button>
            </div>
        </div>

        <div class="bg-white rounded-[35px] shadow-sm overflow-hidden border border-gray-100 flex flex-col lg:flex-row">
            <div class="flex-1 p-5 sm:p-10 md:p-14 lg:p-16 border-b lg:border-b-0 lg:border-r border-gray-100">
                @foreach($soals as $index => $soal)
                <div x-show="soalAktif === {{ $index + 1 }}" x-cloak>
                    <p class="text-xs md:text-sm font-semibold text-[#2E3B66] mb-4">Subtes: {{ $currentCategory->nama_kategori }}</p>

                    @if($soal->materi_teks)
                    <div class="mb-6 p-4 bg-slate-50 border-l-4 border-[#3B82F6] rounded-r-xl text-gray-700 text-sm md:text-base leading-relaxed italic">
                        {!! $soal->materi_teks !!}
                    </div>
                    @endif

                    @if($soal->image_url)
                    <div class="mb-8 flex justify-center">
                        <div class="max-w-full overflow-hidden rounded-2xl border-2 border-gray-100 shadow-sm bg-white">
                            <img src="{{ str_contains($soal->image_url, 'http') ? $soal->image_url : asset('storage/' . $soal->image_url) }}" 
                                alt="Gambar Soal" 
                                class="max-h-[300px] md:max-h-[450px] w-auto object-contain p-2"
                                onerror="this.onerror=null; this.src='https://placehold.co/600x400?text=Gambar+Tidak+Ditemukan';">
                        </div>
                    </div>
                    @endif

                    <div class="mb-10 text-gray-800 text-base sm:text-lg md:text-xl font-medium leading-relaxed">
                        {!! $soal->pertanyaan !!}
                    </div>
                    <div class="w-full h-2.5 bg-gray-100 rounded-full mb-6">
                        <div class="h-full bg-blue-400 rounded-full transition-all duration-500"
                            :style="'width:' + (Object.keys(jawabanTerpilih).length / questions.length * 100) + '%'">
                        </div>
                    </div>
                </div>

                <div class="flex-grow overflow-y-auto custom-scroll px-4 md:px-6">
                    <div class="bg-blue-50/50 p-4 rounded-xl border border-blue-100 mb-6">
                        <div class="text-[#2E3B66] text-lg leading-relaxed whitespace-pre-line"
                            x-text="questions[soalAktifIdx].materi_teks || 'Baca teks berikut untuk menjawab pertanyaan.'">
                        </div>
                    </div>

                    <div class="px-4 mb-10">
                        <div class="text-[#2E3B66] text-lg font-medium leading-relaxed"
                            x-text="questions[soalAktifIdx].pertanyaan">
                        </div>
                    </div>

                    <div class="hidden lg:block mb-10 pt-6 border-t border-gray-100">
                        <h4 class="text-xs font-semibold text-gray-400 uppercase mb-4">Navigasi Soal:</h4>
                        <div class="grid grid-cols-10 gap-2">
                            <template x-for="(q, index) in questions" :key="q.id">
                                <button @click="soalAktifIdx = index"
                                    class="relative aspect-square flex items-center justify-center rounded-lg font-bold text-xs transition-all border-2"
                                    :class="soalAktifIdx === index ? 'bg-[#4FAAFD] border-[#4FAAFD] text-white shadow-md' :
                                        (jawabanTerpilih[q.id] ? 'border-[#4FAAFD] text-[#4FAAFD] bg-blue-50' :
                                            'border-gray-100 text-gray-300 bg-white hover:bg-gray-50')">

                                    <span x-text="index + 1"></span>

                                    <template x-if="jawabanTerpilih[q.id]">
                                        <div class="absolute -top-2 -right-2 w-5 h-5 bg-white text-blue-400 text-[10px] flex items-center justify-center rounded-full border-2 border-blue-400 shadow-sm uppercase"
                                            x-text="jawabanTerpilih[q.id]">
                                        </div>
                                    </template>
                                </button>
                            </template>
                        </div>
                    </div>
        <div x-show="showExitModal" class="fixed inset-0 z-[99] flex items-center justify-center p-4" x-transition x-cloak>
            <div class="fixed inset-0 bg-black/50" @click="showExitModal = false"></div>
            <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full relative z-10 text-center shadow-2xl">
                <div class="w-20 h-20 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>

                <div class="p-4 bg-white border-t border-gray-50 shrink-0">
                    <div class="flex items-center gap-4">
                        <button @click="prevSoal()" :disabled="soalAktifIdx === 0"
                            class="flex-1 py-3 md:py-4 border-2 border-gray-200 rounded-2xl font-bold text-gray-400 hover:bg-gray-50 disabled:opacity-30 transition-all">
                            Kembali
                        </button>
                        <button @click="nextSoal()"
                            class="flex-1 py-3 md:py-4 bg-[#4FAAFD] text-white rounded-2xl font-bold shadow-lg shadow-blue-100 hover:bg-blue-600 transition-all active:scale-95">
                            <span x-text="soalAktifIdx === questions.length - 1 ? 'Selesai' : 'Selanjutnya'"></span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-[40%] bg-white p-4 flex flex-col ">
                <h3 class="text-sm font-bold text-blue-500 uppercase tracking-widest mb-3">Pilih Jawaban</h3>
                <p class="text-xs font-medium text-gray-400">Pilih satu jawaban yang paling tepat.</p>
                <div class="space-y-4 overflow-y-auto custom-scroll">
                    <template x-for="opt in ['a', 'b', 'c', 'd', 'e']" :key="opt">
                        <div @click="pilihJawaban(questions[soalAktifIdx].id, opt)"
                            class="group flex items-center p-5 rounded-xl border-2 cursor-pointer transition-all duration-200"
                            :class="jawabanTerpilih[questions[soalAktifIdx].id] === opt ?
                                'bg-[#D6E9FF] border-blue-400 shadow-sm' :
                                'bg-[#F8FBFF] border-transparent hover:border-blue-100'">

                            <div class="w-10 h-10  rounded-full flex items-center justify-center font-black mr-4 shrink-0 shadow-sm transition-all"
                                :class="jawabanTerpilih[questions[soalAktifIdx].id] === opt ? 'bg-blue-500 text-white' :
                                    'bg-white text-blue-500'">
                                <span class="uppercase" x-text="opt"></span>
                            </div>

                            <span class="text-lg md:text-base text-[#2E3B66] leading-snug"
                                x-text="questions[soalAktifIdx]['opsi_' + opt]"></span>
                        </div>
                    </template>
                </div>

                <div class="lg:hidden mt-10 pt-6 border-t border-gray-100">
                    <h4 class="text-xs font-semibold text-gray-400 uppercase mb-4">Navigasi Soal:</h4>
                    <div class="grid grid-cols-5 sm:grid-cols-8 gap-2">
                        <template x-for="(q, index) in questions" :key="q.id">
                            <button @click="soalAktifIdx = index"
                                class="relative aspect-square flex items-center justify-center rounded-lg font-bold text-xs border-2"
                                :class="soalAktifIdx === index ? 'bg-[#4FAAFD] border-[#4FAAFD] text-white' :
                                    (jawabanTerpilih[q.id] ? 'border-[#4FAAFD] text-[#4FAAFD] bg-blue-50' :
                                        'border-gray-100 text-gray-300 bg-white')">

                                <span x-text="index + 1"></span>

                                <template x-if="jawabanTerpilih[q.id]">
                                    <div class="absolute -top-2 -right-2 w-5 h-5 bg-white text-blue-400 text-[10px] flex items-center justify-center rounded-full border-2 border-blue-400 shadow-sm uppercase"
                                        x-text="jawabanTerpilih[q.id]">
                                    </div>
                                </template>
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="showConfirmNextModal" class="fixed inset-0 z-[99] flex items-center justify-center p-4" x-transition x-cloak>
            <div class="fixed inset-0 bg-black/50" @click="showConfirmNextModal = false"></div>
            <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full relative z-10 text-center shadow-2xl">
                <div class="w-20 h-20 bg-orange-100 text-orange-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <h3 class="text-xl font-black text-[#2E3B66] mb-2">Soal Belum Lengkap</h3>
                <p class="text-gray-500 text-sm mb-8">Masih ada soal yang belum dijawab. Yakin ingin melanjutkan ke subtes berikutnya?</p>
                <div class="flex flex-col gap-3">
                    <button @click="pindahHalaman()" class="w-full py-3 rounded-xl font-bold bg-[#3B82F6] text-white">Ya, Lanjutkan</button>
                    <button @click="showConfirmNextModal = false" class="w-full py-3 rounded-xl font-bold bg-gray-100 text-gray-500">Batal, Cek Lagi</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function kuisApp() {
            // Nama unik untuk storage berdasarkan ID kuis agar tidak bentrok antar set kuis
            const storageTimerKey = 'timer_tryout_{{ $tryout->id }}_{{ $currentCategory->id }}';
            const storageJawabanKey = 'jawaban_tryout_{{ $tryout->id }}_{{ $currentCategory->id }}';

            return {
                soalAktifIdx: 0,
                questions: @json($soals),

                // Ambil jawaban dari localStorage jika ada, kalau tidak ada set object kosong
                jawabanTerpilih: JSON.parse(localStorage.getItem(storageJawabanKey)) || {},

                // Ambil timer dari localStorage, jika tidak ada pakai durasi asli
                timeLeft: localStorage.getItem(storageTimerKey) ?
                    parseInt(localStorage.getItem(storageTimerKey)) : {{ $currentCategory->durasi * 60 }},

                startTimer() {

                    // ambil waktu dari localStorage jika ada
                    let savedTime = localStorage.getItem(storageTimerKey);

                    if (savedTime !== null) {
                        this.timeLeft = parseInt(savedTime);
                    }

                    let timer = setInterval(() => {

                        if (this.timeLeft > 0) {
                            this.timeLeft--;

                            // simpan setiap detik
                            localStorage.setItem(storageTimerKey, this.timeLeft);

                        } else {

                            clearInterval(timer);

                            // hapus timer setelah selesai
                            localStorage.removeItem(storageTimerKey);

                            this.submitTryout();
                        }

                    }, 1000);
                },

                formatTime(seconds) {
                    let min = Math.floor(seconds / 60);
                    let sec = seconds % 60;
                    return `${min}:${sec < 10 ? '0' : ''}${sec}`;
                },

                pilihJawaban(soalId, opsi) {
                    this.jawabanTerpilih[soalId] = opsi;

                    localStorage.setItem(storageJawabanKey, JSON.stringify(this.jawabanTerpilih));
                },

                nextSoal() {
                    if (this.soalAktifIdx < this.questions.length - 1) {
                        this.soalAktifIdx++;
                        if (window.innerWidth < 1024) window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    } else {
                        if (confirm('Selesaikan subtes ini?')) {
                            this.submitTryout();
                        }
                    }
                },

                prevSoal() {
                    if (this.soalAktifIdx > 0) this.soalAktifIdx--;
                },

                submitTryout() {

                    fetch('{{ route('tryout.simpan', $tryout->id) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                jawaban: this.jawabanTerpilih
                            })
                        })
                        .then(() => {

                            localStorage.removeItem(storageTimerKey);
                            localStorage.removeItem(storageJawabanKey);

                            @if ($nextCategory)
                                window.location.href = '{{ route('tryout.jeda', [$tryout->id, $nextCategory->id]) }}';
                            @else
                                window.location.href = '{{ route('tryout.hasil', $tryout->id) }}';
                            @endif

                        });
                },

                confirmExit() {
                    if (confirm('Progres akan hilang. Yakin ingin keluar?')) {
                        // Hapus storage jika user sengaja keluar/batal
                        localStorage.removeItem(storageTimerKey);
                        localStorage.removeItem(storageJawabanKey);

                        window.location.href = "{{ route('tryout.index') }}";
                    }
                }
            }
        }
    </script>
</body>

</html>
