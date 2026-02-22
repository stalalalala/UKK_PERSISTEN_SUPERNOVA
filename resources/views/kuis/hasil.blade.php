<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kuis - {{ $kuis->category->name ?? 'Kuis' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Menghapus scroll di desktop, mengizinkan di mobile jika sangat kecil */
        @media (min-width: 1024px) {
            body {
                overflow: hidden;
            }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.96);
        }

        .blob {
            position: absolute;
            width: 300px;
            height: 300px;
            background: linear-gradient(180deg, rgba(79, 170, 253, 0.2) 0%, rgba(79, 170, 253, 0) 100%);
            filter: blur(50px);
            border-radius: 50%;
            z-index: -1;
            animation: float 10s infinite alternate;
        }

        @keyframes float {
            from {
                transform: translate(0, 0);
            }

            to {
                transform: translate(20px, 40px);
            }
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen flex items-center justify-center relative overflow-x-hidden">

    <div class="blob top-0 left-0"></div>
    <div class="blob bottom-0 right-0"
        style="background: linear-gradient(180deg, rgba(255, 200, 0, 0.1) 0%, rgba(255, 200, 0, 0) 100%);"></div>

    <div
        class="bg-[#DAEDFE] w-full min-h-screen lg:h-screen flex flex-col items-center justify-center p-4 md:p-6 relative shadow-inner overflow-y-auto lg:overflow-hidden">

        <div class="relative w-full max-w-4xl flex flex-col items-center">

            <div
                class="hidden sm:block absolute bottom-[-10px] w-[80%] h-12 bg-gradient-to-r from-yellow-400 via-white to-yellow-400 rounded-full shadow-lg z-0">
            </div>

            <div
                class="relative z-10 bg-white glass-effect w-full rounded-3xl shadow-sm border border-white overflow-hidden">
                <div class="p-5 md:p-8 flex flex-col">

                    <div class="flex flex-col items-center justify-center gap-2 mb-4 text-[#2d4a85]">
                        <div class="bg-blue-50 p-2 rounded-xl animate-bounce">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h2 class="text-xl md:text-2xl font-extrabold tracking-tight text-center">
                            Hasil {{ $kuis->category->name ?? 'Kuis' }}
                            <span class="block text-blue-500 text-base md:text-lg font-bold">Kuis Fundamental - Set
                                {{ $kuis->set_ke }}</span>
                        </h2>
                    </div>

                    <div
                        class="mb-6 text-center bg-slate-50/50 rounded-2xl py-6 border-2 border-dashed border-blue-100">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Total Skor Kamu
                        </p>
                        <div class="text-6xl md:text-7xl font-black text-blue-500 tracking-tighter">
                            <span id="counter-score">0</span>
                        </div>
                        <p class="text-[10px] font-bold text-blue-400 mt-1">* 1 Soal = 5 Poin</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mb-8">
                        <div
                            class="bg-[#66cc66] rounded-2xl p-6 min-h-[150px] sm:min-h-[150px] md:min-h-[220px] flex flex-col items-center justify-between shadow-lg transition-transform active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 sm:h-10 sm:w-10 text-white/90"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="text-center">
                                <span
                                    class="text-4xl sm:text-3xl font-black text-white block leading-none">{{ $hasil['benar'] }}</span>
                                <span
                                    class="text-[12px] sm:text-[10px] font-bold text-white uppercase tracking-widest mt-1 block">Benar</span>
                            </div>
                        </div>

                        <div
                            class="bg-[#7a869a] rounded-2xl p-6 min-h-[150px] sm:min-h-[150px] md:min-h-[220px] flex flex-col items-center justify-between shadow-lg transition-transform active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 sm:h-10 sm:w-10 text-white/90"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="text-center">
                                <span
                                    class="text-4xl sm:text-3xl font-black text-white block leading-none">{{ $hasil['kosong'] }}</span>
                                <span
                                    class="text-[12px] sm:text-[10px] font-bold text-white uppercase tracking-widest mt-1 block">Kosong</span>
                            </div>
                        </div>

                        <div
                            class="bg-[#e65c5c] rounded-2xl p-6 min-h-[150px] sm:min-h-[150px] md:min-h-[220px] flex flex-col items-center justify-between shadow-lg transition-transform active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 sm:h-10 sm:w-10 text-white/90"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="text-center">
                                <span
                                    class="text-4xl sm:text-3xl font-black text-white block leading-none">{{ $hasil['salah'] }}</span>
                                <span
                                    class="text-[12px] sm:text-[10px] font-bold text-white uppercase tracking-widest mt-1 block">Salah</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <a href="{{ route('kuis.index') }}"
                            class="w-full py-4 bg-blue-500 text-white rounded-xl font-black text-xs hover:bg-blue-600 active:translate-y-1 transition-all text-center uppercase tracking-widest shadow-md">
                            Selesai & Keluar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <script>
        // Sound Effects
        const tickSound = new Audio('https://assets.mixkit.co/active_storage/sfx/2568/2568-preview.mp3');
        const successSound = new Audio('https://assets.mixkit.co/active_storage/sfx/1435/1435-preview.mp3');
        tickSound.volume = 0.5;

        function animateValue(obj, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const currentCount = Math.floor(progress * (end - start) + start);

                // Mainkan suara tick setiap angkanya berubah
                if (obj.innerHTML != currentCount && currentCount % 2 === 0) {
                    tickSound.cloneNode(true).play().catch(() => {});
                }

                obj.innerHTML = currentCount;
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                } else {
                    // Pas selesai, mainkan suara sukses/hore
                    successSound.play().catch(() => {});
                }
            };
            window.requestAnimationFrame(step);
        }

        // Update window.onload kamu
        window.onload = function() {
            // Beri delay sedikit biar user nggak kaget
            setTimeout(() => {
                const scoreDisplay = document.getElementById('counter-score');
                const finalScore = {{ round($hasil['skor']) }};

                // Tambahkan efek shake pada kontainer skor saat animasi jalan
                const scoreContainer = scoreDisplay.parentElement.parentElement;
                scoreContainer.classList.add('animate-pulse');

                animateValue(scoreDisplay, 0, finalScore, 2000);

                // Jalankan Confetti
                const duration = 3 * 1000;
                const end = Date.now() + duration;

                (function frame() {
                    confetti({
                        particleCount: 5, // Tambahin dikit biar lebih rame
                        angle: 60,
                        spread: 55,
                        origin: {
                            x: 0
                        },
                        colors: ['#4FAAFD', '#FFD700', '#66cc66']
                    });
                    confetti({
                        particleCount: 5,
                        angle: 120,
                        spread: 55,
                        origin: {
                            x: 1
                        },
                        colors: ['#4FAAFD', '#FFD700', '#66cc66']
                    });
                    if (Date.now() < end) requestAnimationFrame(frame);
                    else scoreContainer.classList.remove('animate-pulse');
                }());
            }, 500);
        };
    </script>
</body>

</html>
