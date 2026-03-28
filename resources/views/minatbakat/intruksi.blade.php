<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instruksi Minat dan Bakat | PERSISTEN</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .font-po {
            font-family: 'Poppins', sans-serif;
        }

        /* Smooth Custom Scrollbar */
        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: #E2E8F0;
            border-radius: 10px;
        }

        .instruction-card:hover .icon-number {
            transform: scale(1.1);
        }

        /* Glassmorphism subtle effect */
        .glass-subtest {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>

<body class="bg-white font-po overflow-x-hidden">

    <div class="max-w-[1440px] mx-auto min-h-screen flex flex-col">
        <main class="flex-1 flex items-center justify-center p-4 md:p-10">
            <div
                class="bg-white border border-gray-100 shadow-2xl shadow-blue-100/50 w-full rounded-xl flex flex-col overflow-hidden md:max-h-[85vh]">

                <div class="flex-1 flex flex-col md:flex-row overflow-y-auto md:overflow-hidden">

                    <div
                        class="w-full md:w-[42%] bg-slate-50 p-3 px-0 md:p-5 md:pb-0 flex flex-col items-center justify-start border-b md:border-b-0 md:border-r border-gray-100">

                        <div class="w-full space-y-6 px-2">
                            <div class="align-top md:text-left mb-8">
                                <div
                                    class="inline-flex items-center gap-2 px-4 py-1 bg-blue-100/50 text-blue-600 rounded-lg text-xs font-bold uppercase tracking-widest mb-3">
                                    <i class="fa-solid fa-brain"></i> Tes Psikologi
                                </div>
                                <h3 class="text-2xl md:text-2xl font-black text-[#2E3B66] leading-tight mb-2">
                                    Tes Minat dan Bakat
                                </h3>
                                <p class="text-xs text-gray-400 font-medium">Kenali potensi dan kepribadianmu untuk masa
                                    depan yang tepat.</p>
                            </div>

                            <div class="space-y-3">
                                <div
                                    class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:border-orange-200 transition-all group">
                                    <div
                                        class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <i class="fa-solid fa-list-check text-orange-400 text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Jumlah
                                            Pernyataan</p>
                                        <p class="text-xl font-extrabold text-[#2E3B66]">
                                            {{ $totalSoal ?? '100' }} <span
                                                class="text-xs font-medium text-gray-400 block tracking-normal">Butir
                                                Soal</span>
                                        </p>
                                    </div>
                                </div>

                                <div
                                    class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:border-green-200 transition-all group">
                                    <div
                                        class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <i class="fa-solid fa-face-smile text-green-500 text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Tipe
                                            Jawaban</p>
                                        <p class="text-lg font-extrabold text-[#2E3B66]">Pilihan Skala <span
                                                class="text-xs font-medium text-gray-400 block tracking-normal">Kejujuran
                                                Diri</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-[58%] flex flex-col p-6 md:p-5 overflow-hidden bg-white">
                        <div class="mb-2">
                            <div
                                class="inline-block px-4 py-1 bg-blue-50 text-blue-500 rounded-full text-xs font-bold uppercase tracking-widest mb-3">
                                Panduan Tes
                            </div>
                            <h2 class="text-xl md:text-2xl font-black text-[#2E3B66] leading-tight">
                                Instruksi <span class="text-blue-500">Tes Minat & Bakat</span>
                            </h2>
                        </div>

                        <div class="flex-1 overflow-y-auto custom-scroll p-2 space-y-6">
                            <div class="flex items-start gap-5 instruction-card transition">
                                <div
                                    class="icon-number w-6 sm:w-12 w-6 sm:h-12 shrink-0 rounded-md sm:rounded-2xl bg-[#FEA33A] shadow-lg shadow-orange-100 flex items-center justify-center text-white font-bold text-sm sm:text-xl transition duration-300">
                                    1</div>
                                <div>
                                    <h4 class="font-bold text-[#2E3B66]">Kejujuran adalah Kunci</h4>
                                    <p class="text-sm text-gray-500 leading-relaxed font-medium">
                                        Pilihlah jawaban yang paling menggambarkan dirimu yang sebenarnya, bukan apa
                                        yang kamu anggap "baik".
                                        Tidak ada jawaban benar atau salah dalam tes ini. Hasil yang akurat sangat
                                        bergantung pada seberapa jujur kamu menilai dirimu sendiri.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-5 instruction-card transition">
                                <div
                                    class="icon-number w-6 sm:w-12 w-6 sm:h-12 shrink-0 rounded-md sm:rounded-2xl bg-[#9885FB] shadow-lg shadow-purple-100 flex items-center justify-center text-white font-bold text-sm sm:text-xl transition duration-300">
                                    2</div>
                                <div>
                                    <h4 class="font-bold text-[#2E3B66]">Menentukan Tingkat Kesesuaian</h4>
                                    <p class="text-sm text-gray-500 leading-relaxed font-medium">
                                        Klik pada kotak pilihan warna yang tersedia. Semakin ke arah kiri (warna biru),
                                        berarti kamu semakin <strong>Setuju</strong> atau merasa sangat sesuai dengan
                                        pernyataan tersebut. Sebaliknya, semakin ke kanan berarti semakin tidak sesuai.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-5 instruction-card transition">
                                <div
                                    class="icon-number w-6 sm:w-12 w-6 sm:h-12 shrink-0 rounded-md sm:rounded-2xl bg-[#FF908E] shadow-lg shadow-red-100 flex items-center justify-center text-white font-bold text-sm sm:text-xl transition duration-300">
                                    3</div>
                                <div>
                                    <h4 class="font-bold text-[#2E3B66]">Waktu dan Spontanitas</h4>
                                    <p class="text-sm text-gray-500 leading-relaxed font-medium">
                                        Jawablah setiap pernyataan secara spontan. Biasanya, jawaban pertama yang muncul
                                        di pikiranmu adalah yang paling mendekati kenyataan. Jangan menghabiskan terlalu
                                        banyak waktu untuk merenungkan satu pernyataan.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-5 instruction-card transition">
                                <div
                                    class="icon-number w-6 sm:w-12 w-6 sm:h-12 shrink-0 rounded-md sm:rounded-2xl bg-[#4B8A81] shadow-lg shadow-teal-100 flex items-center justify-center text-white font-bold text-sm sm:text-xl transition duration-300">
                                    4</div>
                                <div>
                                    <h4 class="font-bold text-[#2E3B66]">Pantau Progress Pengerjaan</h4>
                                    <p class="text-sm text-gray-500 leading-relaxed font-medium">
                                        Gunakan bar progres di bagian atas untuk melihat seberapa jauh kamu telah
                                        mengerjakan tes. Pastikan seluruh pernyataan telah terisi sebelum kamu mencapai
                                        akhir halaman untuk mendapatkan hasil analisa yang lengkap.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-5 instruction-card transition">
                                <div
                                    class="icon-number w-6 sm:w-12 w-6 sm:h-12 shrink-0 rounded-md sm:rounded-2xl bg-[#3171CD] shadow-lg shadow-blue-100 flex items-center justify-center text-white font-bold text-sm sm:text-xl transition duration-300">
                                    5</div>
                                <div>
                                    <h4 class="font-bold text-[#2E3B66]">Penyimpanan Hasil Otomatis</h4>
                                    <p class="text-sm text-gray-500 leading-relaxed font-medium">
                                        Pastikan koneksi internetmu tetap aktif. Setelah menyelesaikan semua pernyataan,
                                        tekan tombol 'Selesai'. Sistem akan langsung memproses profil minat dan bakatmu
                                        untuk ditampilkan dalam bentuk grafik dan deskripsi karir yang cocok.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="px-6 md:px-12 py-4 bg-slate-50 border-t border-gray-100 flex flex-col md:flex-row justify-end gap-3 md:gap-4 shrink-0">
                    <a href="/tryout" class="w-full md:w-auto order-2 md:order-1">
                        <button
                            class="w-full px-10 py-2 rounded-xl font-semibold text-gray-400 bg-white border border-gray-200 hover:bg-gray-100 transition duration-300">
                            Batal
                        </button>
                    </a>
                    <a href="{{ route('minatbakat.soal') }}" class="w-full md:w-auto order-1 md:order-2">
                        <button
                            class="w-full px-12 py-2 rounded-xl font-semibold text-white bg-blue-500 hover:bg-blue-600 shadow-xl shadow-blue-200 transition duration-300 flex items-center justify-center gap-2">
                            Mulai Sekarang <i class="fa-solid fa-chevron-right text-xs"></i>
                        </button>
                    </a>
                </div>

            </div>
        </main>
    </div>
</body>

</html>
