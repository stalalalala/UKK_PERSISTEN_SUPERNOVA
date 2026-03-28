<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Soal Minat Bakat - Admin | PERSISTEN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        .active-page {
            background-color: #4A72D4 !important;
            color: white !important;
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(74, 114, 212, 0.3);
        }

        .custom-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: #BFDBFE;
            border-radius: 10px;
        }

        /* Smooth transition untuk auto-resize */
        textarea {
            transition: height 0.1s ease;
        }
    </style>
</head>

<body class="bg-[#E9EFFF] min-h-screen p-3 sm:p-6 md:p-8">

    <div class="max-w-full mx-auto px-2 md:px-10 lg:px-20" x-data="soalApp()">

        {{-- HEADER & NAVIGATION --}}
        <div class="mb-4 md:mb-6">
            <button onclick="window.history.back()"
                class="group flex items-center gap-2 text-blue-500 font-bold text-[10px] md:text-xs uppercase tracking-widest hover:text-blue-700">
                <div
                    class="w-8 h-8 md:w-10 md:h-10 bg-white rounded-xl shadow-sm flex items-center justify-center group-hover:bg-blue-500 group-hover:text-white transition-all">
                    <i class="fa-solid fa-arrow-left"></i>
                </div>
                <span>Kembali</span>
            </button>
        </div>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6 md:mb-8">
            <h1
                class="text-lg md:text-2xl lg:text-3xl font-extrabold text-[#2D3B61] tracking-tight flex items-center gap-2">
                MANAJEMEN SOAL
                <span class="text-blue-500 text-[10px] md:text-sm bg-blue-100/50 px-2 md:px-3 py-1 rounded-lg"
                    x-text="categoryName"></span>
            </h1>

            <div class="flex gap-2">
                <button @click="showImportModal = true"
                    class="w-10 h-10 md:w-12 md:h-12 bg-emerald-500 text-white rounded-xl md:rounded-2xl shadow-lg hover:bg-emerald-600 transition-all flex items-center justify-center group relative">
                    <i class="fa-solid fa-file-excel text-sm md:text-base"></i>
                    <span
                        class="absolute -bottom-10 scale-0 group-hover:scale-100 transition-all bg-gray-800 text-white text-[10px] py-1 px-2 rounded whitespace-nowrap shadow-xl z-50">Import
                        Soal</span>
                </button>

                <button @click="showHistory = true"
                    class="relative w-10 h-10 md:w-12 md:h-12 bg-white rounded-xl md:rounded-2xl shadow-sm border border-blue-50 flex items-center justify-center">
                    <i class="fa-solid fa-clock-rotate-left text-blue-400 text-sm md:text-base"></i>
                    <template x-if="history.length > 0">
                        <span
                            class="absolute -top-1 -right-1 w-4 h-4 md:w-5 md:h-5 bg-red-500 text-white text-[9px] md:text-[10px] flex items-center justify-center rounded-full border-2 border-[#E9EFFF]"
                            x-text="history.length"></span>
                    </template>
                </button>
                <button @click="showFormAdd = !showFormAdd"
                    class="px-4 md:px-6 bg-[#4A72D4] text-white rounded-xl md:rounded-2xl font-bold text-[10px] md:text-xs uppercase shadow-lg hover:bg-[#3A5BB2]">
                    + Soal Baru
                </button>
            </div>
        </div>

        {{-- SEARCH --}}
        <div class="relative mb-6">
            <input type="text" x-model="searchQuery" @input="currentPage = 1" placeholder="Cari pertanyaan..."
                class="w-full pl-10 md:pl-12 pr-6 py-3 md:py-5 bg-white rounded-2xl border-none shadow-sm focus:ring-2 focus:ring-blue-400 outline-none text-sm md:text-lg">
            <i
                class="fa-solid fa-magnifying-glass absolute left-4 md:left-5 top-1/2 -translate-y-1/2 text-blue-300 text-sm md:text-xl"></i>
        </div>

        {{-- FORM ADD SOAL (AUTO RESIZE) --}}
        <div x-show="showFormAdd" x-cloak class="mb-8" x-transition>
            <div class="bg-white p-4 md:p-6 rounded-[2rem] md:rounded-3xl shadow-xl border-b-8 border-blue-400">
                <textarea x-model="newText" x-ref="newTextarea"
                    @input="$el.style.height = 'auto'; $el.style.height = $el.scrollHeight + 'px'"
                    class="w-full p-3 md:p-4 bg-blue-50/50 border-none rounded-xl md:rounded-2xl focus:ring-2 focus:ring-blue-400 outline-none mb-4 text-xs md:text-lg leading-relaxed overflow-hidden"
                    placeholder="Tulis soal baru..." style="min-height: 80px; resize: none;"></textarea>

                <div class="flex justify-end gap-2 md:gap-3">
                    <button @click="showFormAdd = false"
                        class="text-[10px] md:text-xs font-bold text-blue-400 px-3">Batal</button>
                    <button @click="saveNew()"
                        class="px-6 md:px-8 py-2 md:py-3 bg-[#4A72D4] text-white rounded-xl text-[10px] md:text-xs font-bold shadow-lg">Simpan</button>
                </div>
            </div>
        </div>

        {{-- MAIN LIST --}}
        <div class="grid grid-cols-1 gap-4 min-h-[300px]">
            <template x-for="(soal, index) in paginatedQuestions" :key="soal.id">
                <div
                    class="group bg-white p-4 md:p-8 rounded-[1.5rem] md:rounded-[2.5rem] shadow-sm border border-transparent hover:border-blue-200 flex items-start gap-3 md:gap-6 transition-all">
                    <div class="w-10 h-10 md:w-14 md:h-14 bg-blue-50 text-blue-500 flex items-center justify-center rounded-xl md:rounded-2xl font-black shrink-0 text-sm md:text-xl shadow-inner"
                        x-text="((currentPage - 1) * itemsPerPage) + (index + 1)"></div>
                    <div class="flex-1">
                        <p class="text-slate-700 font-medium leading-relaxed text-xs md:text-lg" x-text="soal.text"></p>
                    </div>
                    <button
                        @click="
                            Swal.fire({
                            title: 'Hapus Soal?',
                            text: 'Soal akan dipindahkan ke History',
                            icon: 'warning',
                            width: '340px',
                            showCancelButton: true,
                            confirmButtonColor: '#ef4444',
                            confirmButtonText: 'Ya, Hapus!',
                            customClass: { popup: 'rounded-3xl shadow-xl', title: 'text-lg font-bold', confirmButton: 'px-5 py-2.5 rounded-xl text-sm',   cancelButton: 'px-5 py-2.5 rounded-xl text-sm bg-gray-100 text-gray-600 hover:bg-gray-200' }
                                }).then(async (result) => {
                                    if(result.isConfirmed){
                                        try {
                                            const response = await fetch(`{{ url('admin/minat-bakat/soal') }}/${soal.id}`, {
                                                method: 'DELETE',
                                                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
                                            });

                                            if(response.ok){
                                                const now = new Date();
                                                const deletedAt = now.toLocaleString('id-ID');

                                                history.unshift({ ...soal, deletedAt, id_history: Date.now() });
                                                localStorage.setItem('recycle_bin_soal', JSON.stringify(history));

                                                questions = questions.filter(q => q.id !== soal.id);
                                            }
                                        } catch(e){
                                            Swal.fire('Error', 'Gagal menghapus', 'error')
                                        }
                                    }
                                })
                                "
                        class="text-red-500 px-3 py-1.5 rounded-lg text-xs hover:bg-red-600 hover:text-white transition-all shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </div>
            </template>
            <template x-if="filteredQuestions.length === 0">
                <div
                    class="text-center py-20 md:py-32 bg-white/50 rounded-[2rem] md:rounded-[3rem] border-2 border-dashed border-blue-200">
                    <p class="text-blue-400 font-medium text-sm md:text-lg">Belum ada soal ditemukan.</p>
                </div>
            </template>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-10 flex items-center justify-center gap-1 md:gap-2" x-show="totalPages > 1">
            <button @click="currentPage--" :disabled="currentPage === 1"
                class="w-9 h-9 md:w-12 md:h-12 rounded-lg md:rounded-xl bg-white disabled:opacity-20 shadow-sm"><i
                    class="fa-solid fa-chevron-left text-xs"></i></button>
            <div class="flex gap-1 md:gap-2">
                <template x-for="p in totalPages" :key="p">
                    <button @click="currentPage = p"
                        class="w-9 h-9 md:w-12 md:h-12 rounded-lg md:rounded-xl bg-white font-bold text-[10px] md:text-sm shadow-sm transition-all"
                        :class="currentPage === p ? 'active-page' : ''" x-text="p"></button>
                </template>
            </div>
            <button @click="currentPage++" :disabled="currentPage === totalPages"
                class="w-9 h-9 md:w-12 md:h-12 rounded-lg md:rounded-xl bg-white disabled:opacity-20 shadow-sm"><i
                    class="fa-solid fa-chevron-right text-xs"></i></button>
        </div>

        <div x-show="showImportModal" x-cloak class="fixed inset-0 z-[100] overflow-y-auto">
            <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" @click="showImportModal = false">
            </div>
            <div class="relative min-h-screen flex items-center justify-center p-4">
                <div class="relative bg-white w-full max-w-lg rounded-[25px] md:rounded-[35px] shadow-2xl p-6 md:p-8 transform transition-all"
                    x-show="showImportModal" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-8"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-base md:text-xl font-bold text-gray-800 flex items-center gap-3">
                            <i class="fa-solid fa-file-excel text-emerald-500"></i> Import Soal
                        </h3>
                        <button @click="showImportModal = false"
                            class="text-gray-400 hover:text-red-500 transition-colors">
                            <i class="fa-solid fa-circle-xmark text-xl md:text-2xl"></i>
                        </button>
                    </div>

                    <div class="mb-6 grid grid-cols-2 gap-2 p-1 bg-gray-100 rounded-xl md:rounded-2xl">
                        <button @click="importMode = 'single'"
                            :class="importMode === 'single' ? 'bg-white shadow-sm text-blue-600' : 'text-gray-500'"
                            class="py-2 rounded-lg md:rounded-xl text-[9px] md:text-[10px] font-black uppercase transition-all">Kategori
                            Ini</button>
                        <button @click="importMode = 'all'"
                            :class="importMode === 'all' ? 'bg-white shadow-sm text-blue-600' : 'text-gray-500'"
                            class="py-2 rounded-lg md:rounded-xl text-[9px] md:text-[10px] font-black uppercase transition-all">Semua
                            Kategori</button>
                    </div>

                    <div
                        class="border-4 border-dashed border-gray-100 rounded-[20px] md:rounded-[25px] p-6 md:p-10 flex flex-col items-center justify-center group hover:border-emerald-300 transition-all bg-gray-50/50">
                        <div
                            class="w-14 h-14 md:w-20 md:h-20 bg-emerald-50 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-cloud-arrow-up text-2xl md:text-3xl text-emerald-500"></i>
                        </div>
                        <p class="text-xs md:text-sm font-bold text-gray-600 text-center"
                            x-text="importMode === 'single' ? 'Upload untuk ' + categoryName : 'Upload Semua Kategori'">
                        </p>
                        <p class="text-[9px] md:text-[10px] text-gray-400 mt-2">Format: .xlsx, .xls</p>

                        <input type="file" class="hidden" x-ref="soalExcelInput" @change="importExcel($event)"
                            accept=".xlsx,.xls">
                        <button @click="$refs.soalExcelInput.click()"
                            class="mt-4 md:mt-6 px-5 md:px-6 py-2 bg-emerald-500 text-white rounded-lg md:rounded-xl text-[10px] md:text-xs font-bold hover:bg-emerald-600 transition-all">
                            Pilih File
                        </button>
                    </div>

                    <div
                        class="mt-6 md:mt-8 p-3 md:p-4 bg-emerald-50 rounded-xl md:rounded-2xl flex items-center justify-between">
                        <div class="flex items-center gap-2 md:gap-3">
                            <i class="fa-solid fa-circle-info text-emerald-500 text-xs md:text-base"></i>
                            <span
                                class="text-[9px] md:text-[11px] font-bold text-emerald-700 uppercase tracking-tight">Butuh
                                Template?</span>
                        </div>
                        <button @click="unduhTemplate()"
                            class="text-[9px] md:text-[11px] font-black text-emerald-600 hover:underline uppercase">
                            DOWNLOAD
                        </button>
                    </div>

                    <button @click="showImportModal = false"
                        class="w-full mt-4 md:mt-6 py-3 md:py-4 rounded-xl md:rounded-2xl text-xs md:text-sm font-bold text-gray-400 hover:bg-gray-50 transition-all text-center uppercase">
                        Batalkan
                    </button>
                </div>
            </div>
        </div>

        {{-- MODAL HISTORY --}}
        <div x-show="showHistory" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div @click="showHistory = false" class="absolute inset-0 bg-blue-900/40 backdrop-blur-sm"></div>
            <div x-show="showHistory" x-transition x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                class="relative bg-[#F8FAFF] w-full max-w-2xl max-h-[85vh] rounded-[2rem] md:rounded-[2.5rem] shadow-2xl flex flex-col overflow-hidden">
                <div class="p-4 md:p-6 bg-white border-b flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-8 h-8 md:w-10 md:h-10 bg-blue-50 text-blue-500 rounded-lg md:rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-clock-rotate-left text-sm md:text-base"></i>
                        </div>
                        <h2 class="text-sm md:text-lg font-black text-[#2D3B61] uppercase tracking-tight">History</h2>
                    </div>
                    <button @click="showHistory = false"
                        class="w-8 h-8 md:w-10 md:h-10 rounded-lg md:rounded-xl bg-gray-50 text-gray-400 hover:bg-gray-100"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="flex-1 overflow-y-auto p-4 md:p-6 space-y-3 custom-scroll">
                    <template x-for="h in history" :key="h.id_history">
                        <div class="bg-white rounded-xl md:rounded-2xl p-3 md:p-4 shadow-sm border border-blue-50">
                            <p class="text-slate-600 text-[10px] md:text-sm mb-3 md:mb-4 leading-relaxed"
                                x-text="h.text"></p>
                            <div class="flex justify-between items-center border-t border-dashed pt-3">
                                <span class="text-[8px] md:text-[9px] font-bold text-blue-300 uppercase"
                                    x-text="h.deletedAt"></span>
                                <div class="flex gap-1 md:gap-2">
                                    <button
                                        @click="
                                    Swal.fire({
                                        title: 'Pulihkan Soal?',
                                        text: 'Data akan dikembalikan ke daftar Soal',
                                        icon: 'question',
                                        width: '340px',
                                        showCancelButton: true,
                                        confirmButtonColor: '#22c55e',
                                        confirmButtonText: 'Ya, Pulihkan!',
                                        cancelButtonText: 'Batal',
                                        customClass: { popup: 'rounded-3xl shadow-xl', title: 'text-lg font-bold', confirmButton: 'px-5 py-2.5 rounded-xl text-sm',   cancelButton: 'px-5 py-2.5 rounded-xl text-sm bg-gray-100 text-gray-600 hover:bg-gray-200' }
                                        }).then(async (result) => {
                                            if(result.isConfirmed){
                                                try {
                                                    const response = await fetch('{{ route('admin.minatBakat.soal.restore') }}', {
                                                        method: 'POST',
                                                        headers: {
                                                            'Content-Type': 'application/json',
                                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                            'Accept': 'application/json'
                                                        },
                                                        body: JSON.stringify({ text: h.text, category: categoryName })
                                                    });

                                                    if(response.ok){
                                                        const restored = await response.json();
                                                        questions.unshift(restored);

                                                        history = history.filter(item => item.id_history !== h.id_history);
                                                        localStorage.setItem('recycle_bin_soal', JSON.stringify(history));
                                                    }
                                                } catch(e){
                                                    Swal.fire('Error', 'Gagal restore', 'error')
                                                }
                                            }
                                        })
                                        "
                                        class="text-blue-500 px-2 py-1 rounded-lg text-xs hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 4v6h6M20 20v-6h-6M4 10a8 8 0 0116 0 8 8 0 01-16 0z" />
                                        </svg>
                                    </button>
                                    <button
                                        @click="
                                    Swal.fire({
                                        title: 'Hapus Permanen?',
                                        text: 'Data tidak bisa dikembalikan!',
                                        width: '340px',
                                        icon: 'error',
                                        showCancelButton: true,
                                        confirmButtonColor: '#ef4444',
                                        confirmButtonText: 'Ya, Hapus!',
                                        cancelButtonText: 'Batal',
                                        customClass: { popup: 'rounded-3xl shadow-xl', title: 'text-lg font-bold', confirmButton: 'px-5 py-2.5 rounded-xl text-sm',   cancelButton: 'px-5 py-2.5 rounded-xl text-sm bg-gray-100 text-gray-600 hover:bg-gray-200' }
                                            }).then((result) => {
                                                if(result.isConfirmed){
                                                    history = history.filter(item => item.id_history !== h.id_history);
                                                    localStorage.setItem('recycle_bin_soal', JSON.stringify(history));
                                                }
                                            })
                                            "
                                        class="text-red-500 px-3 py-1.5 rounded-lg text-xs hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>



    </div>

    <script>
        function soalApp() {
            return {
                showFormAdd: false,
                showHistory: false,
                showImportModal: false,
                importMode: 'single',
                searchQuery: '',
                newText: '',
                currentPage: 1,
                itemsPerPage: 10,
                categoryName: '{{ $categoryName }}',
                questions: @json($questions),
                actionId: null,
                actionText: '',
                selectedItem: null,

                history: JSON.parse(localStorage.getItem('recycle_bin_soal') || '[]'),

                saveHistory() {
                    localStorage.setItem('recycle_bin_soal', JSON.stringify(this.history));
                },

                get filteredQuestions() {
                    return this.questions.filter(q => q.text.toLowerCase().includes(this.searchQuery.toLowerCase()));
                },
                get paginatedQuestions() {
                    let start = (this.currentPage - 1) * this.itemsPerPage;
                    return this.filteredQuestions.slice(start, start + this.itemsPerPage);
                },
                get totalPages() {
                    return Math.ceil(this.filteredQuestions.length / this.itemsPerPage) || 1;
                },

                unduhTemplate() {
                    const wb = XLSX.utils.book_new();
                    let header, filename;
                    if (this.importMode === 'single') {
                        header = [
                            ['Pertanyaan']
                        ];
                        filename = `Template_Soal_${this.categoryName}.xlsx`;
                    } else {
                        header = [
                            ['Kategori', 'Pertanyaan']
                        ];
                        filename = `Template_Semua_Kategori.xlsx`;
                    }
                    const dummy = this.importMode === 'single' ? [
                        ['Contoh soal...']
                    ] : [
                        [this.categoryName, 'Contoh soal...']
                    ];
                    const ws = XLSX.utils.aoa_to_sheet([...header, ...dummy]);
                    XLSX.utils.book_append_sheet(wb, ws, "Soal");
                    XLSX.writeFile(wb, filename);
                },

                async importExcel(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    const reader = new FileReader();

                    reader.onload = async (e) => {
                        try {
                            const data = new Uint8Array(e.target.result);
                            const workbook = XLSX.read(data, {
                                type: 'array'
                            });
                            const sheet = workbook.Sheets[workbook.SheetNames[0]];
                            const jsonData = XLSX.utils.sheet_to_json(sheet, {
                                header: 1
                            });

                            const response = await fetch('{{ route('admin.minatBakat.soal.importBulk') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    data: jsonData,
                                    mode: this.importMode,
                                    current_category: this.categoryName
                                })
                            });

                            if (response.ok) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data berhasil diimport',
                                    width: '340px',
                                    padding: '1.8rem',
                                    confirmButtonColor: '#4A72D4',
                                    customClass: {
                                        popup: 'rounded-3xl shadow-xl',
                                        title: 'text-lg font-bold',
                                        confirmButton: 'rounded-xl px-6 py-2'
                                    }
                                }).then(() => location.reload());
                            } else {
                                throw new Error();
                            }

                        } catch (err) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Data Gagal Tersimpan!',
                                width: '340px',
                                confirmButtonColor: '#ef4444',
                                customClass: {
                                    popup: 'rounded-3xl shadow-xl',
                                    title: 'text-lg font-bold'
                                }
                            });
                        }
                    };

                    reader.readAsArrayBuffer(file);
                },

                async saveNew() {
                    if (!this.newText.trim()) return;
                    try {
                        const response = await fetch('{{ route('admin.minatBakat.soal.store') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                text: this.newText,
                                category: this.categoryName
                            })
                        });
                        if (response.ok) {
                            const newSoal = await response.json();
                            this.questions.unshift(newSoal);
                            this.newText = '';
                            this.showFormAdd = false;
                            this.currentPage = 1;
                            // Reset tinggi textarea
                            if (this.$refs.newTextarea) this.$refs.newTextarea.style.height = 'auto';
                        }
                    } catch (e) {
                        console.error(e);
                    }
                },

            }
        }
    </script>
</body>

</html>
