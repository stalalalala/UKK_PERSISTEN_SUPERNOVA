<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instruksi Pengerjaan</title>

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
                                    class="inline-flex items-center  gap-2 px-4 py-1 bg-blue-100/50 text-blue-600 rounded-lg text-xs font-bold uppercase tracking-widest mb-3">
                                    <i class="fa-solid fa-layer-group"></i> Kategori Ujian
                                </div>
                                <h3 class="text-2xl md:text-2xl font-black text-[#2E3B66] leading-tight mb-2">
                                    {{ $latihan->subtes }} - Set {{ $latihan->set_ke }}

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
                                        <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Jumlah
                                            Pertanyaan</p>
                                        <p class="text-xl font-extrabold text-[#2E3B66]">
                                            {{ $latihan->questions_count ?? '0' }} <span
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
                                        <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Alokasi
                                            Waktu</p>
                                        <p class="text-xl font-extrabold text-[#2E3B66]">
                                            {{ $latihan->durasi }} <span
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
                                        <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Metode
                                            Ujian</p>
                                        <p class="text-lg font-extrabold text-[#2E3B66]">Pilihan Ganda <span
                                                class="text-xs font-medium text-gray-400 block tracking-normal">Single
                                                Answer Selection</span></p>
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
                                Intruksi <span class="text-blue-500">Pengerjaan Latihan Soal</span>
                            </h2>
                        </div>

                        <div class="flex-1 overflow-y-auto custom-scroll p-2 space-y-6">
                            <div class="flex items-start gap-5 instruction-card transition">
                                <div
                                    class="icon-number w-6 sm:w-12 w-6 sm:h-12 shrink-0 rounded-md sm:rounded-2xl bg-[#FEA33A] shadow-lg shadow-orange-100 flex items-center justify-center text-white font-bold text-sm sm:text-xl transition duration-300">
                                    1</div>
                                <div>
                                    <h4 class="font-bold text-[#2E3B66]">Mekanisme Pemilihan Jawaban</h4>
                                    <p class="text-sm text-gray-500 leading-relaxed font-medium">
                                        Bacalah setiap butir soal dengan teliti sebelum menentukan pilihan. Klik pada
                                        salah satu opsi jawaban yang kamu anggap paling benar. Sistem akan menandai
                                        pilihanmu secara otomatis, dan kamu dapat mengubah jawaban tersebut selama
                                        durasi pengerjaan masih tersedia. Pastikan memahami setiap konteks pertanyaan
                                        agar poin dapat diberikan secara maksimal sesuai akurasi jawabanmu.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-5 instruction-card transition">
                                <div
                                    class="icon-number w-6 sm:w-12 w-6 sm:h-12 shrink-0 rounded-md sm:rounded-2xl bg-[#9885FB] shadow-lg shadow-purple-100 flex items-center justify-center text-white font-bold text-sm sm:text-xl transition duration-300">
                                    2</div>
                                <div>
                                    <h4 class="font-bold text-[#2E3B66]">Manajemen Waktu Pengerjaan</h4>
                                    <p class="text-sm text-gray-500 leading-relaxed font-medium">
                                        Timer atau penghitung waktu mundur akan segera aktif begitu kamu menekan tombol
                                        mulai. Perhatikan sisa waktu yang tertera di pojok layar secara berkala untuk
                                        mengatur ritme pengerjaan soal. Apabila waktu habis sebelum kamu menekan tombol
                                        selesai, sistem akan secara otomatis mengunci seluruh jawaban terakhir yang
                                        tersimpan dan menutup sesi pengerjaan secara permanen.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-5 instruction-card transition">
                                <div
                                    class="icon-number w-6 sm:w-12 w-6 sm:h-12 shrink-0 rounded-md sm:rounded-2xl bg-[#FF908E] shadow-lg shadow-red-100 flex items-center justify-center text-white font-bold text-sm sm:text-xl transition duration-300">
                                    3</div>
                                <div>
                                    <h4 class="font-bold text-[#2E3B66]">Optimasi Tampilan Soal</h4>
                                    <p class="text-sm text-gray-500 leading-relaxed font-medium">
                                        Beberapa soal mungkin dilengkapi dengan teks bacaan yang panjang, tabel, atau
                                        gambar pendukung. Anda dapat melakukan scroll pada area soal atau memperbesar
                                        gambar jika diperlukan untuk melihat detail informasi. Pastikan Anda membaca
                                        seluruh premis yang diberikan sebelum menentukan pilihan akhir.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-5 instruction-card transition">
                                <div
                                    class="icon-number w-6 sm:w-12 w-6 sm:h-12 shrink-0 rounded-md sm:rounded-2xl bg-[#4B8A81] shadow-lg shadow-teal-100 flex items-center justify-center text-white font-bold text-sm sm:text-xl transition duration-300">
                                    4</div>
                                <div>
                                    <h4 class="font-bold text-[#2E3B66]">Navigasi dan Panel Kontrol Soal</h4>
                                    <p class="text-sm text-gray-500 leading-relaxed font-medium">
                                        Kamu memiliki kebebasan penuh untuk melompat antar soal menggunakan panel nomor
                                        yang tersedia. Gunakan fitur ini untuk mendahulukan pertanyaan yang dianggap
                                        lebih mudah atau memberikan tanda ragu-ragu pada soal yang memerlukan pemikiran
                                        lebih lanjut. Warna pada panel navigasi akan berubah secara dinamis untuk
                                        memudahkanmu membedakan soal yang sudah dijawab, belum dijawab, atau ditandai.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-5 instruction-card transition">
                                <div
                                    class="icon-number w-6 sm:w-12 w-6 sm:h-12 shrink-0 rounded-md sm:rounded-2xl bg-[#3171CD] shadow-lg shadow-blue-100 flex items-center justify-center text-white font-bold text-sm sm:text-xl transition duration-300">
                                    5</div>
                                <div>
                                    <h4 class="font-bold text-[#2E3B66]">Verifikasi Akhir dan Pengiriman</h4>
                                    <p class="text-sm text-gray-500 leading-relaxed font-medium">
                                        Sebelum mengakhiri sesi, lakukan verifikasi ulang pada seluruh daftar soal untuk
                                        memastikan tidak ada pertanyaan yang terlewat. Setelah merasa yakin dengan semua
                                        jawaban, tekan tombol 'Selesai' atau 'Kumpulkan'. Setelah konfirmasi pengiriman
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
                    <a href="/" class="w-full md:w-auto order-2 md:order-1">
                        <button
                            class="w-full px-10 py-2 rounded-xl font-semibold text-gray-400 bg-white border border-gray-200 hover:bg-gray-100 transition duration-300">
                            Kembali
                        </button>
                    </a>
                    <a href="{{ route('latihan.soal', $latihan->id) }}" class="w-full md:w-auto order-1 md:order-2">
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
