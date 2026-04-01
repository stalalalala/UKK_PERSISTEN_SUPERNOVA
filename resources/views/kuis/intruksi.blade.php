<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instruksi Pengerjaan Kuis | PERSISTEN</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.svg') }}">

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

<body class="bg-white font-po overflow-x-hidden ">

    <div class="max-w-[1440px] mx-auto min-h-screen flex flex-col ">
        <div class="max-w-[1440px] mx-auto min-h-screen flex flex-col">
            <main class="flex-1 flex ">
                <div class="bg-white border border-gray-100 w-full flex flex-col overflow-hidden md:max-h-[100vh]">

                    <div class="flex-1 flex flex-col md:flex-row overflow-y-auto md:overflow-hidden">

                        <div
                            class="w-full md:w-[42%] bg-slate-50 p-3 px-0 md:p-5 md:pb-0 flex flex-col items-center justify-start border-b md:border-b-0 md:border-r border-gray-100">

                            <div class="w-full space-y-6 px-2">
                                <div class="align-top md:text-left mb-8">
                                    <div
                                        class="inline-flex items-center  gap-2 px-4 py-1 bg-blue-100/50 text-blue-600 rounded-lg text-xs font-bold uppercase tracking-widest mb-3">
                                        <i class="fa-solid fa-layer-group"></i> Kategori Ujian
                                    </div>
                                    <h3 class="text-2xl md:text-2xl font-black text-[#2E3B66] leading-tight mb-2">
                                        Kuis Fundamental - Set {{ $kuis->set_ke }}

                                    </h3>
                                    <p class="text-xs text-gray-400 font-medium">Pastikan Anda siap sebelum memulai sesi
                                        latihan ini.</p>
                                </div>

                                <div class="space-y-3">
                                    <div
                                        class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:border-orange-200 transition-all group">
                                        <div
                                            class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                            <i class="fa-solid fa-clipboard-list text-orange-400 text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">
                                                Jumlah
                                                Pertanyaan</p>
                                            <p class="text-xl font-extrabold text-[#2E3B66]">
                                                {{ $kuis->questions_count ?? '0' }} <span
                                                    class="text-xs font-medium text-gray-400 block tracking-normal">Soal</span>
                                            </p>
                                        </div>
                                    </div>

                                    <div
                                        class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:border-blue-200 transition-all group">
                                        <div
                                            class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                            <i class="fa-solid fa-stopwatch text-blue-400 text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">
                                                Alokasi
                                                Waktu</p>
                                            <p class="text-xl font-extrabold text-[#2E3B66]">
                                                {{ $kuis->durasi }} <span
                                                    class="text-xs font-medium text-gray-400 block tracking-normal">Menit
                                                    Pengerjaan</span>
                                            </p>
                                        </div>
                                    </div>

                                    <div
                                        class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:border-green-200 transition-all group">
                                        <div
                                            class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                            <i class="fa-solid fa-circle-check text-green-500 text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">
                                                Metode
                                                Ujian</p>
                                            <p class="text-lg font-extrabold text-[#2E3B66]">Pilihan Ganda</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full md:w-[58%] flex flex-col p-6 md:p-5 overflow-hidden bg-white">
                            <div class="mb-2">
                                <div
                                    class="inline-block px-4 py-1 bg-blue-50 text-blue-500 rounded-full text-xs font-bold uppercase tracking-widest mb-3">
                                    Penting!
                                </div>
                                <h2 class="text-xl md:text-2xl font-black text-[#2E3B66] leading-tight">
                                    Intruksi <span class="text-blue-500">Pengerjaan Kuis</span>
                                </h2>
                            </div>

                            <div x-data="{ open: null }" class="flex-1 overflow-y-auto custom-scroll p-2 space-y-6">
                                <div class="flex items-start gap-5 instruction-card transition cursor-pointer"
                                    @click="if (window.innerWidth < 768) open === 1 ? open = null : open = 1">

                                    <div
                                        class="icon-number w-6 sm:w-12 sm:h-12 shrink-0 rounded-md sm:rounded-2xl bg-[#FEA33A] shadow-lg shadow-orange-100 flex items-center justify-center text-white font-bold text-sm sm:text-xl transition duration-300">
                                        1
                                    </div>

                                    <div class="w-full">

                                        <!-- Header + Chevron -->
                                        <div class="flex items-center justify-between">
                                            <h4 class="font-bold text-[#2E3B66]">
                                                Mekanisme Pemilihan Jawaban
                                            </h4>

                                            <!-- Chevron hanya HP -->
                                            <i class="fa-solid fa-chevron-down md:hidden transition-transform duration-300"
                                                :class="open === 1 ? 'rotate-180 text-blue-500' : 'text-gray-400'">
                                            </i>
                                        </div>

                                        <!-- Isi -->
                                        <p class="text-sm text-gray-500 leading-relaxed font-medium  overflow-hidden"
                                            x-show="open === 1 || window.innerWidth >= 768"
                                            x-transition:enter="transition ease-out duration-500"
                                            x-transition:enter-start="opacity-0 -translate-y-2 scale-y-95"
                                            x-transition:enter-end="opacity-100 translate-y-0 scale-y-100"
                                            x-transition:leave="transition ease-in duration-300"
                                            x-transition:leave-start="opacity-100 translate-y-0 scale-y-100"
                                            x-transition:leave-end="opacity-0 -translate-y-2 scale-y-95"
                                            style="transform-origin: top;">
                                            Bacalah setiap butir soal dengan teliti sebelum menentukan pilihan.
                                            Klik pada salah satu opsi jawaban yang kamu anggap paling benar.
                                            Sistem akan menandai pilihanmu secara otomatis, dan kamu dapat
                                            mengubah jawaban tersebut selama durasi pengerjaan masih tersedia.
                                            Pastikan memahami setiap konteks pertanyaan agar poin dapat diberikan
                                            secara maksimal sesuai akurasi jawabanmu.
                                        </p>

                                    </div>
                                </div>

                                <div class="flex items-start gap-5 instruction-card transition cursor-pointer"
                                    @click="if (window.innerWidth < 768) open === 2 ? open = null : open = 2">

                                    <div
                                        class="icon-number w-6 sm:w-12 sm:h-12 shrink-0 rounded-md sm:rounded-2xl bg-[#9885FB] shadow-lg shadow-purple-100 flex items-center justify-center text-white font-bold text-sm sm:text-xl transition duration-300">
                                        2
                                    </div>

                                    <div class="w-full">

                                        <div class="flex items-center justify-between">
                                            <h4 class="font-bold text-[#2E3B66]">Manajemen Waktu Pengerjaan</h4>

                                            <i class="fa-solid fa-chevron-down md:hidden transition-transform duration-300"
                                                :class="open === 2 ? 'rotate-180 text-blue-500' : 'text-gray-400'">
                                            </i>
                                        </div>

                                        <p class="text-sm text-gray-500 leading-relaxed font-medium  overflow-hidden"
                                            x-show="open === 2 || window.innerWidth >= 768"
                                            x-transition:enter="transition ease-out duration-400"
                                            x-transition:enter-start="opacity-0 -translate-y-2 scale-y-95"
                                            x-transition:enter-end="opacity-100 translate-y-0 scale-y-100"
                                            x-transition:leave="transition ease-in duration-300"
                                            x-transition:leave-start="opacity-100 translate-y-0 scale-y-100"
                                            x-transition:leave-end="opacity-0 -translate-y-2 scale-y-95"
                                            style="transform-origin: top;">
                                            Timer atau penghitung waktu mundur akan segera aktif begitu kamu menekan
                                            tombol
                                            mulai. Perhatikan sisa waktu yang tertera di pojok layar secara berkala
                                            untuk
                                            mengatur ritme pengerjaan soal. Apabila waktu habis sebelum kamu menekan
                                            tombol
                                            selesai, sistem akan secara otomatis mengunci seluruh jawaban terakhir yang
                                            tersimpan dan menutup sesi pengerjaan secara permanen.
                                        </p>

                                    </div>
                                </div>

                                <div class="flex items-start gap-5 instruction-card transition cursor-pointer"
                                    @click="if (window.innerWidth < 768) open === 3 ? open = null : open = 3">

                                    <div
                                        class="icon-number w-6 sm:w-12 sm:h-12 shrink-0 rounded-md sm:rounded-2xl bg-[#FF908E] shadow-lg shadow-red-100 flex items-center justify-center text-white font-bold text-sm sm:text-xl transition duration-300">
                                        3
                                    </div>

                                    <div class="w-full">

                                        <div class="flex items-center justify-between">
                                            <h4 class="font-bold text-[#2E3B66]">Optimasi Tampilan Soal</h4>

                                            <i class="fa-solid fa-chevron-down md:hidden transition-transform duration-300"
                                                :class="open === 3 ? 'rotate-180 text-blue-500' : 'text-gray-400'">
                                            </i>
                                        </div>

                                        <p class="text-sm text-gray-500 leading-relaxed font-medium  overflow-hidden"
                                            x-show="open === 3 || window.innerWidth >= 768"
                                            x-transition:enter="transition ease-out duration-400"
                                            x-transition:enter-start="opacity-0 -translate-y-2 scale-y-95"
                                            x-transition:enter-end="opacity-100 translate-y-0 scale-y-100"
                                            x-transition:leave="transition ease-in duration-300"
                                            x-transition:leave-start="opacity-100 translate-y-0 scale-y-100"
                                            x-transition:leave-end="opacity-0 -translate-y-2 scale-y-95"
                                            style="transform-origin: top;">
                                            Beberapa soal mungkin dilengkapi dengan teks bacaan yang panjang, tabel,
                                            atau
                                            gambar pendukung. Anda dapat melakukan scroll pada area soal atau
                                            memperbesar
                                            gambar jika diperlukan untuk melihat detail informasi. Pastikan Anda membaca
                                            seluruh premis yang diberikan sebelum menentukan pilihan akhir.
                                        </p>

                                    </div>
                                </div>

                                <div class="flex items-start gap-5 instruction-card transition cursor-pointer"
                                    @click="if (window.innerWidth < 768) open === 4 ? open = null : open = 4">

                                    <div
                                        class="icon-number w-6 sm:w-12 sm:h-12 shrink-0 rounded-md sm:rounded-2xl bg-[#4B8A81] shadow-lg shadow-teal-100 flex items-center justify-center text-white font-bold text-sm sm:text-xl transition duration-300">
                                        4
                                    </div>

                                    <div class="w-full">

                                        <div class="flex items-center justify-between">
                                            <h4 class="font-bold text-[#2E3B66]">Navigasi dan Panel Kontrol Soal</h4>

                                            <i class="fa-solid fa-chevron-down md:hidden transition-transform duration-300"
                                                :class="open === 4 ? 'rotate-180 text-blue-500' : 'text-gray-400'">
                                            </i>
                                        </div>

                                        <p class="text-sm text-gray-500 leading-relaxed font-medium  overflow-hidden"
                                            x-show="open === 4 || window.innerWidth >= 768"
                                            x-transition:enter="transition ease-out duration-400"
                                            x-transition:enter-start="opacity-0 -translate-y-2 scale-y-95"
                                            x-transition:enter-end="opacity-100 translate-y-0 scale-y-100"
                                            x-transition:leave="transition ease-in duration-300"
                                            x-transition:leave-start="opacity-100 translate-y-0 scale-y-100"
                                            x-transition:leave-end="opacity-0 -translate-y-2 scale-y-95"
                                            style="transform-origin: top;">
                                            Kamu memiliki kebebasan penuh untuk melompat antar soal menggunakan panel
                                            nomor
                                            yang tersedia. Gunakan fitur ini untuk mendahulukan pertanyaan yang dianggap
                                            lebih mudah atau memberikan tanda ragu-ragu pada soal yang memerlukan
                                            pemikiran
                                            lebih lanjut. Warna pada panel navigasi akan berubah secara dinamis untuk
                                            memudahkanmu membedakan soal yang sudah dijawab, belum dijawab, atau
                                            ditandai.
                                        </p>

                                    </div>
                                </div>

                                <div class="flex items-start gap-5 instruction-card transition cursor-pointer"
                                    @click="if (window.innerWidth < 768) open === 5 ? open = null : open = 5">

                                    <div
                                        class="icon-number w-6 sm:w-12 sm:h-12 shrink-0 rounded-md sm:rounded-2xl bg-[#3171CD] shadow-lg shadow-blue-100 flex items-center justify-center text-white font-bold text-sm sm:text-xl transition duration-300">
                                        5
                                    </div>

                                    <div class="w-full">

                                        <div class="flex items-center justify-between">
                                            <h4 class="font-bold text-[#2E3B66]">Verifikasi Akhir dan Pengiriman</h4>

                                            <i class="fa-solid fa-chevron-down md:hidden transition-transform duration-300"
                                                :class="open === 5 ? 'rotate-180 text-blue-500' : 'text-gray-400'">
                                            </i>
                                        </div>

                                        <p class="text-sm text-gray-500 leading-relaxed font-medium  overflow-hidden"
                                            x-show="open === 5 || window.innerWidth >= 768"
                                            x-transition:enter="transition ease-out duration-400"
                                            x-transition:enter-start="opacity-0 -translate-y-2 scale-y-95"
                                            x-transition:enter-end="opacity-100 translate-y-0 scale-y-100"
                                            x-transition:leave="transition ease-in duration-300"
                                            x-transition:leave-start="opacity-100 translate-y-0 scale-y-100"
                                            x-transition:leave-end="opacity-0 -translate-y-2 scale-y-95"
                                            style="transform-origin: top;">
                                            Sebelum mengakhiri sesi, lakukan verifikasi ulang pada seluruh daftar soal
                                            untuk
                                            memastikan tidak ada pertanyaan yang terlewat. Setelah merasa yakin dengan
                                            semua
                                            jawaban, tekan tombol 'Selesai' atau 'Kumpulkan'. Setelah konfirmasi
                                            pengiriman
                                            dilakukan, kamu tidak akan bisa kembali ke halaman soal dan hasil skor akhir
                                            akan segera diproses oleh sistem untuk ditampilkan di halaman ringkasan.
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="px-6 md:px-12 py-4 bg-slate-50 border-t border-gray-100 flex flex-col md:flex-row justify-end gap-3 md:gap-4 shrink-0">
                        <a href="{{ route('kuis.index') }}" class="w-full md:w-auto order-2 md:order-1">
                            <button
                                class="w-full px-10 py-2 rounded-xl font-semibold text-gray-400 bg-white border border-gray-200 hover:bg-gray-100 transition duration-300">
                                Kembali
                            </button>
                        </a>
                        <a href="{{ route('kuis.soal', $kuis->id) }}" class="w-full md:w-auto order-1 md:order-2">
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
