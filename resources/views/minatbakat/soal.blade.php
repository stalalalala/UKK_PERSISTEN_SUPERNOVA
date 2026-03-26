<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Minat & Bakat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            -webkit-tap-highlight-color: transparent;
        }

        .clip-slant {
            clip-path: polygon(0 15%, 100% 0, 100% 100%, 0 100%);
        }

        /* Ukuran teks adaptif untuk label di dalam batang */
        .btn-text {
            font-size: clamp(7px, 1.2vw, 11px);
            line-height: 1.1;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-blue-50 flex items-center justify-center min-h-screen p-2 sm:p-6" x-data="{
    step: parseInt(localStorage.getItem('minat_bakat_step')) || 1,
    totalSteps: {{ $soals->count() }},
    selected: null,
    jawaban: JSON.parse(localStorage.getItem('minat_bakat_jawaban')) || {},
    currentSoalId: null,
    showExitModal: false,

    init() {
        this.updateCurrentId();
        this.lockHistory();

        this.$watch('jawaban', (val) => {
            localStorage.setItem('minat_bakat_jawaban', JSON.stringify(val));
        });

        this.$watch('step', (val) => {
            localStorage.setItem('minat_bakat_step', val);
        });
    },

    lockHistory() {
        history.pushState(null, null, window.location.href);
        window.onpopstate = () => {
            this.showExitModal = true;
            history.pushState(null, null, window.location.href);
        };
    },

    updateCurrentId() {
        this.$nextTick(() => {
            const el = document.querySelector(`[data-step='${this.step}']`);
            if (el) {
                this.currentSoalId = el.getAttribute('data-soal-id');
                this.selected = this.jawaban[this.currentSoalId] || null;
            }
        });
    },

    nextStep() {
        if (this.selected !== null) {
            this.jawaban[this.currentSoalId] = this.selected;

            if (this.step < this.totalSteps) {
                this.step++;
                this.updateCurrentId();
            } else {
                this.clearData();
                this.$refs.minatBakatForm.submit();
            }
        }
    },

    prevStep() {
        if (this.step > 1) {
            this.step--;
            this.updateCurrentId();
        }
    },

    clearData() {
        localStorage.removeItem('minat_bakat_jawaban');
        localStorage.removeItem('minat_bakat_step');
    }
}" x-init="init()" x-cloak>

    <form action="{{ route('minatbakat.store') }}" method="POST" x-ref="minatBakatForm"
        class="w-full max-w-6xl mx-auto flex justify-center">
        @csrf

        <template x-for="(val, id) in jawaban" :key="id">
            <input type="hidden" :name="'jawaban[' + id + ']'" :value="val">
        </template>

        <div
            class="bg-white rounded-[1.5rem] md:rounded-[3rem] shadow-xl w-full overflow-hidden border border-blue-100 flex flex-col">

            <div class="p-5 md:p-10 flex flex-row justify-between items-center gap-2">
                <h1 class="text-base md:text-2xl font-bold text-slate-800">Tes Minat & Bakat</h1>
                <div class="flex items-center gap-2">
                    <div class="bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-full text-[10px] md:text-sm font-semibold text-slate-500 shadow-sm whitespace-nowrap">
                        <span x-text="step"></span> / {{ $soals->count() }}
                    </div>
                    <button type="button" @click="showExitModal = true"
                        class="bg-slate-200 px-4 py-1.5 rounded-full text-slate-600 font-bold text-[10px] md:text-sm transition hover:bg-slate-300">
                        Batal
                    </button>
                </div>
            </div>

            <div class="px-5 md:px-12 mb-4">
                <div class="h-1.5 md:h-2.5 w-full bg-blue-50 rounded-full overflow-hidden">
                    <div class="h-full bg-blue-500 transition-all duration-700 ease-out"
                        :style="`width: ${(step / totalSteps) * 100}%`"></div>
                </div>
            </div>

            <div class="mx-3 md:mx-10 mb-6 bg-slate-50 rounded-[2rem] p-6 md:p-14 relative border border-blue-50">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold shadow-lg ring-4 ring-white"
                    x-text="step"></div>

                @foreach ($soals as $index => $s)
                    <div x-show="step === {{ $index + 1 }}" x-cloak data-step="{{ $index + 1 }}"
                        data-soal-id="{{ $s->id }}">
                        <p class="text-center text-slate-700 text-sm md:text-xl leading-relaxed font-medium mb-8 md:mb-16">
                            {{ $s->text }}
                        </p>
                    </div>
                @endforeach

                <div class="max-w-3xl mx-auto flex flex-col items-center">
                    <div class="grid grid-cols-5 gap-1 md:gap-4 items-end w-full">

                        <div class="flex flex-col items-center">
                            <button type="button" @click="selected = 5"
                                class="w-full h-24 md:h-48 bg-blue-500 clip-slant rounded-md md:rounded-2xl flex items-end justify-center pb-3 md:pb-6 px-0.5 transition-all outline-none"
                              :class="selected === 5 ? 'ring-2 md:ring-4 ring-blue-200 shadow-lg scale-105' : 'opacity-60 hover:opacity-100'">
                                <span class="text-white btn-text font-bold uppercase text-center">Sangat<br>Setuju</span>
                            </button>
                            <div class="py-2 md:py-4">
                                <i class="fa-regular fa-face-laugh-beam text-lg md:text-4xl transition-all" :class="selected === 5 ? 'text-blue-500 scale-110' : 'text-blue-300 opacity-40'"></i>
                            </div>
                        </div>

                        <div class="flex flex-col items-center">
                            <button type="button" @click="selected = 4"
                                class="w-full h-20 md:h-40 bg-blue-300 clip-slant rounded-md md:rounded-2xl flex items-end justify-center pb-3 md:pb-6 px-0.5 transition-all outline-none"
                                :class="selected === 4 ? 'ring-2 md:ring-4 ring-blue-100 shadow-lg scale-105' : 'opacity-60 hover:opacity-100'">
                                <span class="text-white btn-text font-bold uppercase text-center">Setuju</span>
                            </button>
                            <div class="py-2 md:py-4">
                                <i class="fa-regular fa-face-smile text-lg md:text-4xl transition-all" :class="selected === 4 ? 'text-blue-400 scale-110' : 'text-blue-200 opacity-40'"></i>
                            </div>
                        </div>

                        <div class="flex flex-col items-center">
                            <button type="button" @click="selected = 3"
                                class="w-full h-16 md:h-32 bg-slate-400 clip-slant rounded-md md:rounded-2xl flex items-end justify-center pb-3 md:pb-6 px-0.5 transition-all outline-none"
                                :class="selected === 3 ? 'ring-2 md:ring-4 ring-slate-200 shadow-lg scale-105' : 'opacity-60 hover:opacity-100'">
                                <span class="text-white btn-text font-bold uppercase text-center">Netral</span>
                            </button>
                            <div class="py-2 md:py-4">
                                <i class="fa-regular fa-face-meh text-lg md:text-4xl transition-all" :class="selected === 3 ? 'text-slate-500 scale-110' : 'text-slate-300 opacity-40'"></i>
                            </div>
                        </div>

                        <div class="flex flex-col items-center">
                            <button type="button" @click="selected = 2"
                                class="w-full h-14 md:h-28 bg-red-300 clip-slant rounded-md md:rounded-2xl flex items-end justify-center pb-3 md:pb-6 px-0.5 transition-all outline-none"
                                :class="selected === 2 ? 'ring-2 md:ring-4 ring-red-100 shadow-lg scale-105' : 'opacity-60 hover:opacity-100'">
                                <span class="text-white btn-text font-bold uppercase text-center">Tidak<br>Setuju</span>
                            </button>
                            <div class="py-2 md:py-4">
                                <i class="fa-regular fa-face-frown text-lg md:text-4xl transition-all" :class="selected === 2 ? 'text-red-400 scale-110' : 'text-red-200 opacity-40'"></i>
                            </div>
                        </div>

                        <div class="flex flex-col items-center">
                            <button type="button" @click="selected = 1"
                                class="w-full h-12 md:h-20 bg-red-500 clip-slant rounded-md md:rounded-2xl flex items-end justify-center pb-3 md:pb-6 px-0.5 transition-all outline-none"
                                :class="selected === 1 ? 'ring-2 md:ring-4 ring-red-200 shadow-lg scale-105' : 'opacity-60 hover:opacity-100'">
                                <span class="text-white btn-text font-bold uppercase text-center leading-[0.85]">Sangat<br>Tidak</span>
                            </button>
                            <div class="py-2 md:py-4">
                                <i class="fa-regular fa-face-angry text-lg md:text-4xl transition-all" :class="selected === 1 ? 'text-red-600 scale-110' : 'text-red-300 opacity-40'"></i>
                            </div>
                        </div>
                    </div>
                    <div class="h-1.5 w-full rounded-full bg-gradient-to-r from-blue-400 via-slate-300 to-red-400 opacity-20 mt-[-2px]"></div>
                </div>
            </div>

            <div class="p-5 md:p-10 flex justify-between items-center bg-slate-50/50">
                <button type="button" @click="prevStep()" x-show="step > 1"
                    class="px-4 md:px-8 py-2.5 rounded-xl border border-slate-300 text-slate-500 font-bold hover:bg-white active:scale-95 transition-all text-xs md:text-base">
                    Kembali
                </button>
                <div x-show="step === 1"></div>

                <button type="button" @click="nextStep()" :disabled="selected === null"
                    class="px-6 md:px-12 py-3 bg-blue-500 text-white rounded-xl md:rounded-2xl font-bold shadow-lg hover:bg-blue-600 disabled:bg-slate-300 disabled:shadow-none active:scale-95 transition-all text-xs md:text-base">
                    <span x-text="step === totalSteps ? 'Lihat Hasil' : 'Selanjutnya'"></span>
                </button>
            </div>
        </div>
    </form>

    <div x-show="showExitModal" class="fixed inset-0 z-[99] flex items-center justify-center p-4" x-transition x-cloak>
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" @click="showExitModal = false"></div>
        <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full relative z-10 text-center shadow-2xl">
            <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Hentikan Tes?</h3>
            <p class="text-slate-500 text-sm mb-6">Progres pengerjaan soal saat ini akan hilang jika kamu keluar.</p>
            <div class="flex gap-3">
                <button @click="showExitModal = false" class="flex-1 py-3 rounded-xl font-bold bg-slate-100 text-slate-500">Batal</button>
                <a href="/" @click="clearData()" class="flex-1 py-3 rounded-xl font-bold bg-red-500 text-white text-center">Keluar</a>
            </div>
        </div>
    </div>
</body>

</html>