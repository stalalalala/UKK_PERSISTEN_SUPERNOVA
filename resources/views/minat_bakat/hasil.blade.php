<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Tes Minat & Bakat</title>
</head>
<body class="bg-gray-50 flex flex-col items-center justify-start md:justify-center min-h-screen p-4 md:p-6 lg:p-10">

    <div class="max-w-4xl w-full">
        
        <div class="flex justify-between items-center mb-6 px-1 md:px-4">
            <div class="flex items-center gap-2 text-blue-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-8 md:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                </svg>
                <h1 class="text-lg md:text-2xl font-bold tracking-tight">Tes Minat & Bakat</h1>
            </div>
            
            <button class="px-4 py-1.5 md:px-6 md:py-2 bg-white border border-blue-400 text-blue-500 rounded-full font-semibold shadow-sm hover:bg-blue-50 transition-all active:scale-95 text-xs md:text-base">
                Kembali
            </button>
        </div>

        <div class="bg-white rounded-[1.5rem] md:rounded-[2rem] border border-gray-200 shadow-xl p-4 md:p-8">
            
            <div class="text-center mb-6">
                <div class="inline-block w-full border border-gray-100 rounded-2xl p-4 md:p-6 bg-white relative overflow-hidden">
                    <h2 class="text-gray-500 text-xs md:text-base font-medium mb-6">Tiga Rekomendasi Jurusan Sesuai Minat & Bakatmu</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 md:gap-4">
                        <div class="bg-cyan-50 text-cyan-700 font-bold py-4 md:py-7 px-4 rounded-xl text-base md:text-xl border border-cyan-100 shadow-sm flex items-center justify-center">
                            Investigative
                        </div>
                        <div class="bg-purple-50 text-purple-700 font-bold py-4 md:py-7 px-4 rounded-xl text-base md:text-xl border border-purple-100 shadow-sm flex items-center justify-center">
                            Artistic
                        </div>
                        <div class="bg-orange-50 text-orange-700 font-bold py-4 md:py-7 px-4 rounded-xl text-base md:text-xl border border-orange-100 shadow-sm flex items-center justify-center">
                            Enterprising
                        </div>
                    </div>
                    
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-400 via-purple-400 to-orange-400"></div>
                </div>
            </div>

            <div class="bg-blue-50/50 rounded-[1.2rem] md:rounded-[2rem] p-3 md:p-6 mt-2">
                <div class="bg-white rounded-xl md:rounded-2xl p-5 md:p-8 shadow-inner border border-blue-100/50">
                    
                    <div class="mb-6 md:mb-8">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-1.5 h-4 md:h-5 bg-cyan-500 rounded-full"></div>
                            <h3 class="text-cyan-900 font-extrabold text-sm md:text-lg uppercase tracking-wide">Investigative</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed text-[11px] md:text-sm pl-3 border-l border-gray-100">
                            Fokus pada aktivitas yang memerlukan observasi, penyelidikan, dan evaluasi kritis. Orang dengan minat ini cenderung menyukai matematika, sains, dan pemecahan masalah yang kompleks secara logis.
                        </p>
                    </div>

                    <div class="mb-6 md:mb-8">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-1.5 h-4 md:h-5 bg-purple-500 rounded-full"></div>
                            <h3 class="text-purple-900 font-extrabold text-sm md:text-lg uppercase tracking-wide">Artistic</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed text-[11px] md:text-sm pl-3 border-l border-gray-100">
                            Menyukai ekspresi diri, kreativitas, dan intuisi. Mereka cenderung tidak menyukai struktur yang kaku dan lebih memilih bekerja di lingkungan yang memungkinkan inovasi seni, desain, atau komunikasi.
                        </p>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-1.5 h-4 md:h-5 bg-orange-500 rounded-full"></div>
                            <h3 class="text-orange-900 font-extrabold text-sm md:text-lg uppercase tracking-wide">Enterprising</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed text-[11px] md:text-sm pl-3 border-l border-gray-100">
                            Memiliki jiwa kepemimpinan, persuasif, dan berorientasi pada hasil. Cocok dalam bidang manajemen, bisnis, pemasaran, atau posisi yang membutuhkan kemampuan negosiasi dan pengambilan keputusan cepat.
                        </p>
                    </div>

                </div>
            </div>

        </div> </div>
</body>
</html>