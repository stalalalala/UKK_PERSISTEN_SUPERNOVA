<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERSISTEN - Pengerjaan {{ $tryout->nama_tryout }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-100 font-po min-h-screen py-10 overflow-x-hidden px-6 md:px-10">

    <div x-data="{ 
        soalAktif: parseInt(localStorage.getItem('last_soal_{{ $tryout->id }}_{{ $currentCategory->id }}')) || 1, 
        totalSoal: {{ $soals->count() }}, 
        // jawabanTerpilih sekarang menyimpan { 'ID_SOAL': 'JAWABAN' }
        jawabanTerpilih: JSON.parse(localStorage.getItem('jawaban_to_{{ $tryout->id }}_{{ $currentCategory->id }}')) || {},
        timeLeft: {{ ($totalDurasi ?? 30) * 60 }}, 
        timerText: '',
        showExitModal: false,
        showConfirmNextModal: false, 
        
        adaSoalKosong() {
            return Object.keys(this.jawabanTerpilih).length < this.totalSoal;
        },

        // INI FUNGSI PENGIRIMAN OTOMATIS SAAT WAKTU HABIS
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
                // Tetap pindah jika gagal agar tidak stuck, tapi idealnya beri peringatan
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
                } else {
                    clearInterval(timer);
                    this.pindahHalaman(); // OTOMATIS PINDAH SAAT 0
                }
            }, 1000);
        },

        clearData() {
            localStorage.removeItem('jawaban_to_{{ $tryout->id }}_{{ $currentCategory->id }}');
            localStorage.removeItem('last_soal_{{ $tryout->id }}_{{ $currentCategory->id }}');
        }
    }" x-init="init()" x-cloak class="max-w-[1440px] mx-auto">

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 px-2">
            <h1 class="text-2xl md:text-4xl font-black text-[#2E3B66] tracking-tight">
                {{ $tryout->nama_tryout }} - {{ $currentCategory->nama_kategori }}
            </h1>
            <div class="flex items-center justify-between md:justify-end gap-3 sm:gap-4">
                <div class="bg-white border-2 border-[#4FAAFD] px-4 py-2 md:px-6 md:py-3 rounded-3xl">
                    <p class="text-[18px] font-bold text-[#4FAAFD] font-mono leading-none" x-text="timerText"></p>
                </div>
                <button @click="showExitModal = true" class="bg-[#3B82F6] px-6 py-3 rounded-3xl text-white font-bold text-sm">Keluar Ujian</button>
            </div>
        </div>

        <div class="bg-white rounded-[35px] shadow-sm overflow-hidden border border-gray-100 flex flex-col lg:flex-row">
            <div class="flex-1 p-5 sm:p-10 md:p-14 lg:p-16 border-b lg:border-b-0 lg:border-r border-gray-100">
                @foreach($soals as $index => $soal)
                <div x-show="soalAktif === {{ $index + 1 }}">
                    <p class="text-xs md:text-sm font-semibold text-[#2E3B66] mb-6">Subtes: {{ $currentCategory->nama_kategori }}</p>
                    <div class="mb-10 text-gray-800 text-base sm:text-lg md:text-xl leading-relaxed">
                        {!! $soal->pertanyaan !!}
                    </div>
                </div>
                @endforeach

                <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-7 gap-4 max-w-md">
                    @foreach($soals as $index => $soal)
                        <button @click="soalAktif = {{ $index + 1 }}"
                            class="relative aspect-square flex items-center justify-center rounded-xl font-bold text-lg border-2 transition-all"
                            :class="soalAktif === {{ $index + 1 }} ? 'bg-[#4FAAFD] border-[#4FAAFD] text-white' : (jawabanTerpilih['{{ $soal->id }}'] ? 'border-[#4FAAFD] text-[#4FAAFD] bg-blue-50' : 'border-[#4FAAFD] text-[#4FAAFD] bg-white')">
                            <span>{{ $index + 1 }}</span>
                            <template x-if="jawabanTerpilih['{{ $soal->id }}']">
                                <div class="absolute -top-2 -right-2 w-6 h-6 bg-white text-[#4FAAFD] text-xs rounded-full flex items-center justify-center border-2 border-[#4FAAFD] font-bold z-10">
                                    <span x-text="jawabanTerpilih['{{ $soal->id }}']"></span>
                                </div>
                            </template>
                        </button>
                    @endforeach
                </div>

                <div class="flex items-center gap-3 mt-10 md:mt-14">
                    <button @click="if(soalAktif > 1) soalAktif--" 
                        :disabled="soalAktif === 1" 
                        class="flex-1 py-3 border-2 rounded-3xl font-semibold transition-all"
                        :class="soalAktif > 1 ? 'border-[#3B82F6] text-[#3B82F6] bg-blue-50' : 'border-gray-200 text-gray-400 opacity-50'">
                        Kembali
                    </button>
                    
                    <button @click="if(soalAktif < totalSoal) { 
                                soalAktif++ 
                            } else { 
                                if(adaSoalKosong()) {
                                    showConfirmNextModal = true;
                                } else {
                                    pindahHalaman();
                                }
                            }" 
                        class="flex-[1] py-3 bg-[#3B82F6] text-white font-semibold rounded-3xl hover:bg-blue-600 transition">
                        <span x-text="soalAktif === totalSoal ? 'Selesai Subtes' : 'Selanjutnya'"></span>
                    </button>
                </div>
            </div>

            <div class="w-full lg:w-[380px] xl:w-[450px] p-5 sm:p-10 lg:p-14 bg-slate-50/50">
                <h3 class="text-[18px] font-bold text-[#2E3B66] mb-6">Pilih Jawaban:</h3>
                @foreach($soals as $index => $soal)
                <div x-show="soalAktif === {{ $index + 1 }}" class="space-y-4">
                    @foreach(['a', 'b', 'c', 'd', 'e'] as $opt)
                    @php $kolom = 'opsi_' . $opt; @endphp
                    <div @click="jawabanTerpilih['{{ $soal->id }}'] = '{{ strtoupper($opt) }}'"
                        :class="jawabanTerpilih['{{ $soal->id }}'] === '{{ strtoupper($opt) }}' ? 'border-[#3378FF] ring-1 ring-[#3378FF]' : 'border-transparent'"
                        class="group flex items-center p-4 rounded-2xl border-2 bg-[#E1F0FF] cursor-pointer shadow-sm hover:bg-[#D4E9FF] transition-all">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center font-bold mr-4 shrink-0"
                            :class="jawabanTerpilih['{{ $soal->id }}'] === '{{ strtoupper($opt) }}' ? 'bg-[#3378FF] text-white' : 'bg-white text-[#3378FF]'">
                            {{ strtoupper($opt) }}
                        </div>
                        <span class="text-sm md:text-base font-medium text-[#2E3B66]">{{ $soal->$kolom }}</span>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>

        <div x-show="showExitModal" class="fixed inset-0 z-[99] flex items-center justify-center p-4" x-cloak>
            <div class="fixed inset-0 bg-black/50" @click="showExitModal = false"></div>
            <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full relative z-10 text-center shadow-2xl">
                <div class="w-20 h-20 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
                <h3 class="text-xl font-black text-[#2E3B66] mb-2">Keluar Ujian?</h3>
                <p class="text-gray-500 text-sm mb-8">Data pengerjaan subtes ini akan terhapus. Yakin ingin keluar?</p>
                <div class="flex gap-4">
                    <button @click="showExitModal = false" class="flex-1 py-3 rounded-xl font-bold bg-gray-100 text-gray-500">Batal</button>
                    <a href="{{ route('tryout.index') }}" @click="clearData()" class="flex-1 py-3 rounded-xl font-bold bg-red-500 text-white text-center">Ya, Keluar</a>
                </div>
            </div>
        </div>

        <div x-show="showConfirmNextModal" class="fixed inset-0 z-[99] flex items-center justify-center p-4" x-cloak>
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
</body>
</html>