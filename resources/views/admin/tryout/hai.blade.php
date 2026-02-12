<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persisten Dashboard - Manajemen TO</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-[#E9EFFF] h-screen overflow-hidden text-[#2D3B61]" x-data="{

    activeMenu: 'Manajemen TO',
    mobileMenuOpen: false,
    showImportModal: false,

    soalTersimpan: 0,
    targetSoal: 20,

    currentSet: 1,
    activeQuestion: 1,

    selectedSubtes: '',

    simpanSoal() {

        if (this.soalTersimpan < this.targetSoal) {

            this.soalTersimpan++;

            if (this.activeQuestion < 20) {
                this.activeQuestion++;
            }

            document.getElementById('formTO').reset();

            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }

}">

    <div class="flex h-full w-full">

        <!-- SIDEBAR -->
        <aside class="fixed inset-y-0 left-0 z-50 w-72 bg-[#4A72D4] text-white flex flex-col p-6 shadow-xl lg:static">

            <h1 class="text-2xl font-bold mb-10">PERSISTEN</h1>

            <nav class="flex-1 space-y-2 overflow-y-auto custom-scrollbar pr-2">

                <a href="#" class="block px-4 py-3 rounded-xl hover:bg-white/10">Dashboard</a>

                <a href="#" class="block px-4 py-3 rounded-xl bg-[#D4DEF7] text-[#2E3B66] font-bold">
                    Manajemen TO
                </a>

                <a href="#" class="block px-4 py-3 rounded-xl hover:bg-white/10">Manajemen Latihan</a>

            </nav>

            <button class="mt-4 w-full bg-white/10 py-3 rounded-xl hover:bg-white/20">
                Logout
            </button>

        </aside>


        <!-- MAIN -->
        <main class="flex-1 overflow-y-auto custom-scrollbar p-6">

            <!-- HEADER -->
            <header class="flex justify-between items-center mb-10">

                <h2 class="text-2xl font-extrabold text-[#4A72D4]">
                    Try Out - Set <span x-text="currentSet"></span>
                </h2>

                <button @click="showImportModal = true"
                    class="bg-emerald-500 text-white px-6 py-3 rounded-xl font-bold shadow-md hover:bg-emerald-600">
                    <i class="fa-solid fa-file-excel"></i>
                    Import Excel
                </button>

            </header>


            <!-- STEP 1: PILIH SUBTES -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-blue-50 mb-8">

                <h3 class="text-lg font-extrabold text-[#4A72D4] mb-4">
                    Pilih Subtes TO terlebih dahulu
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <template
                        x-for="item in [
                            'Penalaran Umum',
                            'PPU',
                            'PBM',
                            'PK',
                            'Penalaran Matematika',
                            'Literasi Bahasa Indonesia',
                            'Literasi Bahasa Inggris'
                        ]">

                        <button @click="selectedSubtes = item"
                            :class="selectedSubtes === item ?
                                'bg-[#4A72D4] text-white shadow-lg' :
                                'bg-gray-50 text-gray-600 hover:bg-blue-50'"
                            class="py-4 rounded-2xl font-bold text-sm transition-all">

                            <span x-text="item"></span>

                        </button>

                    </template>

                </div>

                <p class="text-[11px] text-gray-400 mt-4">
                    Subtes terpilih:
                    <span class="font-bold text-[#4A72D4]" x-text="selectedSubtes || '-'"></span>
                </p>

            </div>


            <!-- STEP 2: FORM INPUT SOAL -->
            <div x-show="selectedSubtes !== ''" x-transition>

                <div class="bg-white rounded-2xl p-8 shadow-sm border border-blue-50">

                    <h3 class="text-xl font-bold mb-2">
                        Input Soal Nomor <span x-text="activeQuestion"></span>
                    </h3>

                    <p class="text-sm text-gray-500 mb-6">
                        Subtes aktif:
                        <span class="font-bold text-[#4A72D4]" x-text="selectedSubtes"></span>
                    </p>

                    <!-- FORM -->
                    <form id="formTO" @submit.prevent="simpanSoal()" class="space-y-6">

                        <!-- PERTANYAAN -->
                        <textarea required placeholder="Masukkan pertanyaan..."
                            class="w-full bg-gray-50 rounded-2xl p-5 text-sm shadow-inner focus:ring-2 focus:ring-blue-200 outline-none resize-none"></textarea>

                        <!-- OPSI JAWABAN -->
                        <div class="grid grid-cols-1 gap-4" x-data="{ selected: null }">

                            <template x-for="(opt,i) in ['A','B','C','D','E']">

                                <div :class="selected === i ? 'bg-emerald-50 border-emerald-200' : 'bg-gray-50 border-transparent'"
                                    class="flex items-center gap-4 p-4 rounded-2xl border-2 transition-all">

                                    <span
                                        class="w-10 h-10 flex items-center justify-center bg-white rounded-xl shadow font-black text-[#4A72D4]"
                                        x-text="opt"></span>

                                    <input type="text" required placeholder="Tulis jawaban..."
                                        class="flex-1 bg-transparent outline-none text-sm font-medium">

                                    <input type="radio" name="benar" @click="selected = i" required
                                        class="w-5 h-5 accent-emerald-500 cursor-pointer">

                                </div>

                            </template>

                        </div>

                        <!-- BUTTON -->
                        <button type="submit" :disabled="soalTersimpan >= 20"
                            class="w-full bg-[#4A72D4] text-white py-4 rounded-2xl font-bold shadow-lg hover:bg-blue-700 disabled:bg-gray-300">

                            <i class="fa-solid fa-floppy-disk"></i>
                            Simpan Soal TO

                        </button>

                    </form>

                </div>

            </div>


            <!-- NAVIGASI SOAL -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-blue-50 mt-8">

                <h4 class="text-sm font-bold text-gray-500 mb-4">
                    Navigasi Soal
                </h4>

                <div class="grid grid-cols-5 gap-3">

                    <template x-for="n in 20">

                        <button @click="activeQuestion = n"
                            :class="{
                                'bg-[#4A72D4] text-white': activeQuestion === n,
                                'bg-emerald-500 text-white': n <= soalTersimpan && activeQuestion !== n,
                                'bg-gray-100 text-gray-400': n > soalTersimpan
                            }"
                            class="aspect-square rounded-xl font-bold text-xs">

                            <span x-text="n"></span>

                        </button>

                    </template>

                </div>

            </div>

        </main>

    </div>

</body>

</html>
