<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERSISTEN</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite('resources/css/app.css')
</head>

<body class="font-poppins bg-white overflow-x-hidden">

    <div class="max-w-[1440px] mx-auto">
        <nav class="flex justify-between items-center bg-gray-100 rounded-full mx-4 md:mx-10 mt-4">
            <div class="w-20 md:w-28 h-12 bg-blue-400 rounded-full flex-shrink-0"></div>

            <ul class="hidden lg:flex gap-12 text-gray-800 font-medium text-sm">
                <li><a href="/" class="font-bold hover:text-blue-500 text-bold">Beranda</a></li>
                <li><a href="/streak" class="hover:text-blue-500 cursor-pointer">Pet Streak</a></li>
                <li><a href="/tryout" class="hover:text-blue-500 cursor-pointer">Try Out</a></li>
                <li><a href="/latihan" class="hover:text-blue-500 cursor-pointer">Latihan Soal</a></li>
                <li><a href="/video" class="hover:text-blue-500 cursor-pointer">Video Pembelajaran</a></li>
            </ul>

            <div class="flex gap-2">
                <div class="flex items-center gap-3 bg-[#FBBA16] rounded-full">
                    <button
                        class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#3171CD] flex items-center justify-center text-white"><a
                            href="/profile">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-5 md:size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg></a>
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
    </div>

    <div class="py-16 pb-10">
        <div class="max-w-[1440px] mx-auto">
            <section class="px-4 md:px-10 mt-8">
                <div
                    class="bg-gradient-to-r from-blue-100 to-blue-50 rounded-[35px] px-6 md:px-8 py-8 flex flex-col lg:flex-row justify-between items-center lg:items-end relative overflow-hidden gap-10">

                    <object data="{{ asset('img/pet-1.svg') }}" type="image/svg+xml"
                        class="absolute top-[30%] md:top-[45%] left-1/2 md:left-1/6 -translate-x-1/2 -translate-y-1/2 w-50 md:w-[340px] z-0 pointer-events-none">
                    </object>

                    <div class="max-w-xl relative z-10 text-center lg:text-left">
                        <h1 class="text-3xl md:text-5xl text-[#2E3B66] font-extrabold leading-tight">
                            MENJELANG UTBK?
                        </h1>
                        <p class="mt-3 text-base md:text-lg text-[#2E3B66] leading-relaxed">
                            Belajar sedikit setiap hari lebih baik daripada <br class="hidden md:block">
                            sekali tapi berhenti. <br class="hidden md:block">
                            Yuk mulai dari sekarang bersama
                            <span class="text-blue-500 font-bold">Persisten</span>.
                        </p>
                    </div>

                    <div class="relative z-10 w-full max-w-xs md:max-w-none md:w-auto">
                        <div class="bg-white rounded-[35px] pb-6 relative shadow-xl">
                            <div
                                class="relative bg-[#4375D1] text-white rounded-[35px] px-10 md:px-20 py-8 md:py-10 z-10">
                                <h2 class="text-5xl md:text-[75px] font-extrabold text-center leading-none">H-70</h2>
                                <div
                                    class="bg-white text-[#4375D1] font-semibold rounded-full px-4 py-2 mt-4 text-center text-xs md:text-sm">
                                    Menjelang Pelaksanaan SNBT
                                </div>
                            </div>
                            <div
                                class="absolute bottom-[58px] left-[10%] w-[80%] h-14 bg-gradient-to-r from-yellow-400 via-white to-yellow-400 rounded-[40px] z-0">
                            </div>

                            <div class="flex justify-around mt-8 text-xs md:text-sm text-[#4375D1] font-medium">
                                <div class="flex items-center gap-1 md:gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <span>70 hari</span>
                                </div>
                                <div class="flex items-center gap-1 md:gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg> <span>7 jam</span>
                                </div>
                                <div class="flex items-center gap-1 md:gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg> <span>10 menit</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mt-6 flex justify-center px-4">
                <div class="flex flex-col md:flex-row items-center gap-4 w-full max-w-3xl">
                    <div
                        class="flex items-center bg-white border border-gray-200 shadow-md rounded-full px-6 py-3 w-full md:w-[600px]">
                        <i class="fa-solid fa-magnifying-glass text-gray-400 text-sm mr-3"></i>
                        <input type="text" placeholder="Cari  Try Out, Latihan Soal atau Belajar Fundamental ..."
                            class="w-full outline-none text-gray-500 text-sm">
                    </div>
                    <button
                        class="w-full md:w-auto bg-blue-400 hover:bg-blue-500 text-white px-10 py-3 rounded-full font-semibold text-sm shadow-md">
                        Cari
                    </button>
                </div>
            </section>

            <section class="mt-8 px-4 md:px-10">
                @php
                    $subs = [
                        ['PU', 'bg-[#FEA33A]'],
                        ['PBM', 'bg-[#9885FB]'],
                        ['PPU', 'bg-[#FF908E]'],
                        ['PK', 'bg-[#4CAA60]'],
                        ['PM', 'bg-[#CEA4EC]'],
                        ['LBI', 'bg-[#A5BBEC]'],
                        ['LBE', 'bg-[#4B8A81]'],
                    ];
                @endphp

                <div class="grid justify-items-center grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-5">
                    @foreach ($subs as $s)
                        <div
                            class="{{ $s[1] }} rounded-[30px] w-full h-full text-white shadow-lg hover:shadow-2xl hover:-translate-y-3 transition duration-300 cursor-pointer text-center">
                            <div class="px-2 py-3">
                                <div
                                    class="w-16 h-16 bg-white/30 rounded-full mt-1 mx-auto flex items-center justify-center font-bold text-xl">
                                    {{ $s[0] }}
                                </div>
                                <p class="mt-3 font-medium text-md">Mulai</p>
                                <p class="font-medium text-md">Latihan!</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>

    <div class="bg-[#EAF2FE] py-16">
        <div class="max-w-[1440px] mx-auto flex flex-col px-4 md:px-10 py-10 gap-6">

            <section style="background-image: url('{{ asset('img/bg-home-1.png') }}');"
                class="relative bg-cover bg-center bg-no-repeat rounded-[35px] px-4 md:px-14 py-30 overflow-hidden min-h-[300px] flex items-center">

                <div class="relative z-10 max-w-xl">
                    <h1 class="text-3xl md:text-5xl font-extrabold text-[#2E3B66]">Belajar dari Nol?</h1>
                    <p class="mt-3 text-base md:text-lg text-[#2E3B66]">
                        Kuasai fundamental dulu sebelum masuk <br> latihan tingkat lanjut.
                        <br><span class="font-bold">Yuk latihan pemahaman dasarmu!</span>
                    </p>
                    <a href="/kuis"> <button
                            class="mt-7 bg-orange-400 hover:bg-orange-500 text-white font-bold px-8 md:px-10 py-3 rounded-full text-lg flex items-center gap-4 shadow-md">
                            Mulai Kuis
                            <span class="bg-white/30 w-8 h-8 flex items-center justify-center rounded-full">➜</span>
                        </button></a>
                </div>
            </section>

            <section class="border-2 bg-white border-gray-200 rounded-[3rem] p-8 md:p-10 mb-20">
                <div class="mb-10">
                    <h2 class="text-3xl font-black text-[#2E3B66]">Try Out UTBK</h2>
                    <p class="text-gray-500 font-medium">Simulasikan ujian UTBK mu dengan berbagai sesi Try Out disini!
                    </p>
                </div>

                <div x-show="currentPage === 1" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6"
                    x-transition>
                    <div
                        class="bg-blue-50 rounded-[2rem] p-6 flex flex-col items-center relative hover:shadow-lg transition-all border border-blue-100 group">
                        <div class="w-full flex justify-between items-start mb-2">
                            <span class="text-blue-400 font-bold pt-1 text-lg uppercase tracking-tighter">Try
                                Out</span>
                            <span class="bg-blue-600 text-white text-lg px-4 py-1 rounded-full font-bold">UTBK</span>
                        </div>
                        <div
                            class="text-[100px] font-black text-blue-500 leading-none my-6 group-hover:scale-110 transition-transform">
                            1</div>
                        <div
                            class="bg-white px-4 py-1.5 rounded-full flex items-center gap-2 text-sm font-medium text-blue-500 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>

                            <span>Selesai</span>
                        </div>
                    </div>

                    <div
                        class="bg-blue-50 rounded-[2rem] p-6 flex flex-col items-center relative hover:shadow-lg transition-all border border-blue-100 group">
                        <div class="w-full flex justify-between items-start mb-2">
                            <span class="text-blue-400 font-bold pt-1 text-lg uppercase tracking-tighter">Try
                                Out</span>
                            <span class="bg-blue-600 text-white text-lg px-4 py-1 rounded-full font-bold">UTBK</span>
                        </div>
                        <div
                            class="text-[100px] font-black text-blue-500 leading-none my-6 group-hover:scale-110 transition-transform">
                            2</div>
                        <div
                            class="bg-white px-4 py-1.5 rounded-full flex items-center gap-2 text-sm font-medium text-blue-500 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>

                            <span>20-27 Maret</span>
                        </div>
                    </div>

                    <div
                        class="bg-gray-50 opacity-60 rounded-[2rem] p-6 flex flex-col items-center relative border border-gray-200">
                        <div class="w-full flex justify-between items-start mb-2">
                            <span class="text-gray-400 font-bold pt-1 text-lg uppercase tracking-tighter">Try
                                Out</span>
                            <span class="bg-gray-400 text-white text-lg px-4 py-1 rounded-full font-bold">UTBK</span>
                        </div>
                        <div class="text-[100px] font-black text-gray-300 leading-none my-6">3</div>
                        <div
                            class="bg-white px-4 py-1.5 rounded-full flex items-center gap-2 text-sm font-medium text-gray-400 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>

                            <span>Belum Tersedia</span>
                        </div>
                    </div>

                    <div class="flex-1 flex flex-col items-center justify-center min-h-[200px]">
                        <img src="{{ asset('img/slime.png') }}" class="w-44 md:w-52 mb-4" alt="Slime">
                        <button
                            class="bg-blue-500 hover:bg-blue-600 text-white px-10 py-2.5 rounded-full font-bold shadow-md transition-all hover:scale-105">
                            Lainnya
                        </button>
                    </div>


                </div>
            </section>
        </div>
    </div>

    <div class="max-w-[1440px] mx-auto">
        <section style="background-image: url('{{ asset('img/bg-home-2.png') }}');"
            class="relative bg-cover bg-center bg-no-repeat rounded-[40px] mx-4 md:mx-10 mt-10 mb-10 px-6 py-12 h-160 overflow-hidden shadow-sm border border-white/50">

            <div class="flex flex-col items-center text-center relative z-10">
                <h2 class="text-2xl md:text-4xl font-extrabold text-[#2E3B66] tracking-tight">
                    Tes Minat dan Bakat
                </h2>
                <p class="mt-4 text-[#2E3B66] text-sm md:text-lg max-w-2xl leading-relaxed font-medium">
                    Kenali potensi diri serta arahkan jurusan <br class="hidden md:block">
                    dan karir yang sesuai dengan minat dan bakatmu!
                </p>
                <div class="mt-8">
                    <button
                        class="bg-[#FCAE4B] hover:bg-[#f39c12] text-white font-bold px-10 py-3 rounded-full text-xl shadow-lg flex items-center gap-4 transition-transform hover:scale-105">
                        Mulai Tes
                        <div class="bg-white w-6 h-6 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#FCAE4B"
                                class="w-4 h-4">
                                <path fill-rule="evenodd"
                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </div>
            </div>
        </section>
    </div>

    @include('layouts.footer')


    <div class="max-w-[1440px] mx-auto">
        <section style="background-image: url('{{ asset('img/bg-home-2.png') }}');"
            class="relative bg-cover bg-center bg-no-repeat rounded-[40px] mx-4 md:mx-10 mt-10 mb-10 px-6 py-12 h-160 overflow-hidden shadow-sm border border-white/50">

            <div class="flex flex-col items-center text-center relative z-10">
                <h2 class="text-2xl md:text-4xl font-extrabold text-[#2E3B66] tracking-tight">
                    Tes Minat dan Bakat
                </h2>
                <p class="mt-4 text-[#2E3B66] text-sm md:text-lg max-w-2xl leading-relaxed font-medium">
                    Kenali potensi diri serta arahkan jurusan <br class="hidden md:block">
                    dan karir yang sesuai dengan minat dan bakatmu!
                </p>
                <div class="mt-8">
                    <button
                        class="bg-[#FCAE4B] hover:bg-[#f39c12] text-white font-bold px-10 py-3 rounded-full text-xl shadow-lg flex items-center gap-4 transition-transform hover:scale-105">
                        Mulai Tes
                        <div class="bg-white w-6 h-6 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#FCAE4B"
                                class="w-4 h-4">
                                <path fill-rule="evenodd"
                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </div>
            </div>
        </section>
    </div>


</body>

</html>
