<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>intruksi</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite('resources/css/app.css')
</head>

<body class="bg-white font-po overflow-x-hidden">

    <div class="max-w-[1440px] mx-auto">
        <nav class="flex justify-between items-center bg-gray-100 rounded-full mx-4 md:mx-10 mt-4">
            <div class="w-20 md:w-28 h-12 bg-blue-400 rounded-full flex-shrink-0"></div>

            <ul class="hidden lg:flex gap-12 text-gray-800 font-medium text-sm">
                <li><a href="/" class="font-medium hover:text-blue-500">Beranda</a></li>
                <li><a href="/streak" class="hover:text-blue-500 cursor-pointer">Pet Streak</a></li>
                <li><a href="/tryout" class="hover:text-blue-500 font-bold cursor-pointer">Try Out</a></li>
                <li><a href="/latihan" class="hover:text-blue-500 cursor-pointer">Latihan Soal</a></li>
                <li><a href="/video" class="hover:text-blue-500 cursor-pointer">Video Pembelajaran</a></li>
            </ul>

            <div class="flex gap-2">
                <div class="flex items-center gap-3 bg-[#FBBA16] rounded-full">
                    <button
                        class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#3171CD] flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-5 md:size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </button>
                    <button
                        class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#4B8A81] flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/xml" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-5 md:size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                        </svg>
                    </button>
                </div>
            </div>
        </nav>

        <main class=" flex-1 flex items-center justify-center p-4 md:p-10">
            <div
                class="bg-white border-2 border-gray-200 w-full max-w-[1440px] mx-auto rounded-[3rem] flex flex-col max-h-[85vh]">

                <div class="flex-1 flex flex-col md:flex-row p-8 md:p-12 gap-10 overflow-y-auto">

                    <div class="flex-1 flex flex-col md:flex-row p-8 md:p-12 gap-10 overflow-y-auto items-center">

                        <div class="w-full md:w-2/5 flex justify-center">
                            <div
                                class="w-64 h-64 md:w-full md:aspect-square flex items-center justify-center relative overflow-hidden">
                                <img src="{{ asset('img/slime.png') }}" alt="Slime"
                                    class="w-full h-full object-contain">
                            </div>
                        </div>

                        <div class="w-full md:w-3/5 flex flex-col">
                            <h2
                                class="text-2xl md:text-3xl font-extrabold text-[#2E3B66] mb-8 text-center md:text-left">
                                Instruksi Tes Minat dan Bakat
                            </h2>

                            <div class="space-y-6">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-[#FEA33A] flex-shrink-0 flex items-center justify-center text-white font-bold text-lg">
                                        1</div>
                                    <p class="text-gray-600 font-semibold pt-2">Pilih jawaban yang paling menggambarkan
                                        dirimu dengan mengklik kotak warna yang tersedia.</p>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-[#9885FB] flex-shrink-0 flex items-center justify-center text-white font-bold text-lg">
                                        2</div>
                                    <p class="text-gray-600 font-semibold pt-2">Tidak ada jawaban benar atau salah.
                                        Jawablah secara jujur dan spontan sesuai perasaanmu.</p>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-[#FF908E] flex-shrink-0 flex items-center justify-center text-white font-bold text-lg">
                                        3</div>
                                    <p class="text-gray-600 font-semibold pt-2">Semakin tinggi kotak ke arah kiri
                                        (biru), berarti kamu semakin <strong>Setuju</strong> dengan pernyataan tersebut.
                                    </p>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-[#4B8A81] flex-shrink-0 flex items-center justify-center text-white font-bold text-lg">
                                        4</div>
                                    <p class="text-gray-600 font-semibold pt-2">Pantau bar progres di bagian atas dan
                                        usahakan menyelesaikan semua soal tepat waktu.</p>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-[#3171CD] flex-shrink-0 flex items-center justify-center text-white font-bold text-lg">
                                        5</div>
                                    <p class="text-gray-600 font-semibold pt-2">Pastikan koneksi internet stabil hingga
                                        kamu menekan tombol "Selesai" agar hasilmu tersimpan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-12 py-8 bg-gray-50 flex justify-end gap-4 shrink-0">
                    <a href="/">

                        <button
                            class="px-8 py-3 rounded-full font-bold text-gray-400 bg-gray-200 hover:bg-gray-300 transition">Batal</button>
                    </a>
                    <a href="{{ route('minatbakat.soal') }}">
                        <button
                            class="px-10 py-3 rounded-full font-bold text-white bg-blue-500 hover:bg-blue-600 shadow-lg shadow-blue-200 transition">Mulai
                            Mengerjakan</button>
                    </a>
                </div>

            </div>
        </main>
    </div>
</body>

</html>
