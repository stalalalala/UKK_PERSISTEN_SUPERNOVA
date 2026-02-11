<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERSISTEN</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')

    <style>
        @keyframes slime-auto-only-left {

            0%,
            15% {
                transform: rotate(0deg) scale(1, 1);
            }

            25%,
            40% {
                transform: rotate(-10deg) scale(1.02, 0.98);
            }

            45% {
                transform: rotate(0deg) scale(1, 1);
            }

            50% {
                transform: scale(1.15, 0.85);
            }

            55% {
                transform: scale(0.95, 1.05);
            }

            60% {
                transform: scale(1, 1);
            }

            65%,
            100% {
                transform: rotate(0deg) scale(1, 1);
            }
        }

        @keyframes slime-breathe-soft {

            0%,
            100% {
                transform: scale(1, 1);
            }

            50% {
                transform: scale(1.01, 0.99);
            }
        }

        .slime-auto-left {
            transform-origin: bottom center;
            animation:
                slime-breathe-soft 3s ease-in-out infinite,
                slime-auto-only-left 7s ease-in-out infinite;
        }

        .slime-shadow {
            filter: drop-shadow(0 15px 30px rgba(0, 0, 0, 0.3));
        }

        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body class="font-poppins bg-white min-h-screen flex flex-col relative">

    <div
        class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 
                lg:left-auto lg:right-[-15vw] lg:translate-x-0 
                h-[90vh] md:h-[110vh] lg:h-[130vh] 
                aspect-square bg-[#4A69BD] rounded-full 
                z-0 flex items-center justify-center lg:justify-start 
                opacity-90 lg:opacity-100 transition-all duration-700 ease-in-out">

        <div
            class="slime-auto-left w-[300px] md:w-[450px] lg:w-[550px] 
                    lg:ml-10 mb-10 relative z-10">
            <object data="{{ asset('img/pet(tanpa_animasi).svg') }}" type="image/svg+xml"
                class="pointer-events-none select-none w-full h-auto slime-shadow">
            </object>
        </div>
    </div>

    <nav class="relative z-30 w-full pt-6 px-4">
        <div
            class="max-w-6xl mx-auto flex items-center bg-[#F3F4F6]/80 backdrop-blur-md rounded-full shadow-sm border border-white">
            <div class="w-24 md:w-28 h-8 md:h-9 bg-[#4A9FFF] rounded-full "></div>
            <div class="flex-grow"></div>
            <div class="w-16 md:w-20 h-8 md:h-9 bg-[#FFB81C] rounded-full "></div>
        </div>
    </nav>

    <main class="relative z-20 flex-grow flex items-center py-10">
        <div class="container mx-auto px-4 md:px-10">
            <div class="grid lg:grid-cols-12 gap-4 items-center">

                <div class="lg:col-span-6 xl:col-span-5 flex justify-center lg:justify-start">
                    <div
                        class="bg-white/10 lg:bg-[#E8F1FF]/90 backdrop-blur-[2px] lg:backdrop-blur-xl 
                                w-full max-w-[450px] md:max-w-[480px] 
                                rounded-[40px] md:rounded-[50px] 
                                p-8 md:p-12 shadow-2xl border-4 border-white/40 lg:border-white/60 transition-all">

                        <div class="flex justify-between items-center mb-8">
                            <h1
                                class="text-3xl md:text-4xl font-black text-white lg:text-[#2E3B66] drop-shadow-md lg:drop-shadow-none">
                                Masuk</h1>
                            <div class="flex items-center gap-2 bg-white px-3 py-1.5 rounded-xl shadow-sm">
                                <span class="text-[8px] md:text-[9px] font-bold text-gray-400 uppercase">Masuk
                                    dengan</span>
                                <img src="https://www.gstatic.com/images/branding/product/1x/googleg_48dp.png"
                                    alt="Google" class="w-4 h-4 md:w-5 md:h-5">
                            </div>
                        </div>

                        <form action="#" class="space-y-5">
                            <div class="space-y-2">
                                <label class="block text-white lg:text-gray-500 font-bold text-sm ml-1">Email</label>
                                <input type="email" placeholder="contoh@gmail.com"
                                    class="w-full px-5 py-3.5 rounded-2xl border-2 border-white lg:border-[#4A9FFF] focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all text-gray-800 bg-white/90 placeholder:text-gray-400">
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between px-1">
                                    <label class="text-white lg:text-gray-500 font-bold text-sm">Kata sandi</label>
                                    <a href="#"
                                        class="text-white lg:text-[#4A9FFF] font-bold text-xs hover:underline">Lupa
                                        sandi?</a>
                                </div>
                                <input type="password" placeholder="xxxxxxxx"
                                    class="w-full px-5 py-3.5 rounded-2xl border-2 border-white lg:border-[#4A9FFF] focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all text-gray-800 bg-white/90 tracking-widest">
                            </div>

                            <div class="md:col-span-2 flex justify-center gap-6 pt-10">
                                <a href="/daftar"
                                    class="w-full max-w-[240px] bg-[#FFB81C] text-white font-black py-4 rounded-3xl text-xl shadow-[0_6px_0_0_#d99c16] active:translate-y-1 active:shadow-none transition-all flex items-center justify-center">
                                    Daftar
                                </a>

                                <a href="#"
                                    class="w-full max-w-[240px] bg-[#4A9FFF] text-white font-black py-4 rounded-3xl text-xl shadow-[0_6px_0_0_#3a86db] active:translate-y-1 active:shadow-none transition-all flex items-center justify-center">
                                    Masuk
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-6 xl:col-span-7 hidden lg:block"></div>
            </div>
        </div>
    </main>

</body>

</html>
