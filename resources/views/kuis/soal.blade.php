<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERSISTEN - Kuis {{ $kuis->set_ke }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
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

<body class="bg-slate-100 p-4 md:p-6 pt-0 desktop-fixed">

    <div x-data="kuisApp()" x-init="startTimer()" x-cloak class="h-full flex flex-col w-full mx-auto">

        <div class="flex flex-row items-center justify-between mb-4 shrink-0">
            <h1 class="text-lg md:text-xl font-bold text-[#2E3B66]">Set {{ $kuis->set_ke }} -
                <span class="text-blue-500">{{ $kuis->category->name ?? 'Kuis' }}</span>
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
                    class="bg-red-500 hover:bg-red-600 text-white  border-2 border-red-600 px-3 h-8 rounded-full font-medium text-xs md:text-sm shadow-md shadow-red-100 transition-all active:scale-95 flex items-center justify-center">
                    Keluar Ujian
                </button>
            </div>
        </div>

        <div
            class="bg-white rounded-xl shadow-sm border border-gray-100 flex-1 flex flex-col lg:flex-row overflow-hidden min-h-0">

            <div class="flex-1 flex flex-col min-h-0 border-b lg:border-b-0 lg:border-r-2 border-gray-100 bg-white">

                <div class="pt-5 px-4 md:px-7">
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-sm font-bold text-blue-500 uppercase tracking-widest">
                            {{ $kuis->kategori->name ?? 'Kuis Fundamental' }}</p>
                        <p class="text-sm font-medium text-gray-400">Soal <span x-text="soalAktifIdx + 1"></span> dari
                            <span x-text="questions.length"></span>
                        </p>
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
                            x-text="questions[soalAktifIdx].materi || 'Baca teks berikut untuk menjawab pertanyaan.'">
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
                                        <div
                                            class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-emerald-500 rounded-full border-2 border-white shadow-sm">
                                        </div>
                                    </template>
                                </button>
                            </template>
                        </div>
                    </div>
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
                <h3 class="text-sm font-semibold text-[#2E3B66] mb-4">Pilih Jawaban:</h3>
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
                                :class="soalAktifIdx === index ? 'bg-[#4FAAFD] border-[#4FAAFD] text-white' : (jawabanTerpilih[q
                                        .id] ? 'border-[#4FAAFD] text-[#4FAAFD] bg-blue-50' :
                                    'border-gray-100 text-gray-300 bg-white')">
                                <span x-text="index + 1"></span>
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <form id="formKuis" action="{{ route('kuis.submit', $kuis->id) }}" method="POST" class="hidden">
            @csrf
            <input type="hidden" name="jawaban" :value="JSON.stringify(jawabanTerpilih)">
        </form>
    </div>

    <script>
        function kuisApp() {
            return {
                soalAktifIdx: 0,
                questions: @json($kuis->questions),
                jawabanTerpilih: {},
                timeLeft: {{ $kuis->durasi * 60 }},
                startTimer() {
                    let timer = setInterval(() => {
                        if (this.timeLeft > 0) this.timeLeft--;
                        else {
                            clearInterval(timer);
                            this.submitKuis();
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
                },
                nextSoal() {
                    if (this.soalAktifIdx < this.questions.length - 1) {
                        this.soalAktifIdx++;
                        // Scroll otomatis ke atas konten soal jika di HP saat ganti nomor
                        if (window.innerWidth < 1024) window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    } else {
                        if (confirm('Yakin ingin menyelesaikan kuis?')) this.submitKuis();
                    }
                },
                prevSoal() {
                    if (this.soalAktifIdx > 0) this.soalAktifIdx--;
                },
                submitKuis() {
                    document.getElementById('formKuis').submit();
                },
                confirmExit() {
                    if (confirm('Progres akan hilang. Yakin ingin keluar?')) window.location.href =
                        "{{ route('kuis.index') }}";
                }
            }
        }
    </script>
</body>

</html>
